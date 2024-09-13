<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_week extends Model
{
    protected $table      = 'data_week';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_project', 'week_number', 'start_date', 'end_date', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
 
    // count all not deleted row
    public function countAll($id_project)
    {
        $this->select('
            *
        ')
        ->where('id_project', $id_project)
        ->where('deleted_at', NULL);

        return $this->countAllResults();
    }

    // regex search
    public function search_item($keyword)
    {
        $this->select('
            item.*,
            sd.nama as nama_satuan,
            k1.nama as nama_jenis,
            k2.nama as nama_kategori
        ')
        ->join('satuan_dasar sd', 'sd.id=item.id_satuan', 'LEFT')
        ->join('kategori k1', 'k1.id=item.id_kategori_jenis', 'LEFT')
        ->join('kategori k2', 'k2.id=item.id_kategori_item', 'LEFT')
        ->like('item.nama', $keyword, 'both')
        ->orLike('item.kode_item', $keyword, 'both')
        ->where('item.deleted_at', NULL);
        
        return $this->get()->getResult();
    }

    // get weeks by project
    public function getWeeksByProject($id_project)
    {
        $this->select('
            *
        ')
        ->where('id_project', $id_project)
        ->where('deleted_at', NULL);
        
        return $this->get()->getResult();
    }

    // get rekap stock
    public function get_datatable_rekap_stock($id_project)
    {
        $request = service('request');

        // set searchable and orderable
        $column_searchable = [
            'item.nama'
        ];
        $column_orderable = [
            'item.id', 'item.nama'
        ];

        // Get the distinct entity IDs from the EntitasModel
        $entitasModel = new Model_entitas_usaha();
        $entities = $entitasModel->findAll();

        $entityIDs = [];
        foreach ($entities as $entity) {
            $entityIDs[] = $entity->id;
        }

        // Construct the SUM statements dynamically
        $sumStatements = '';
        foreach ($entityIDs as $entityID) {
            $sumStatements .= "SUM(CASE WHEN e.id = $entityID AND its.id_entitas = $entityID THEN its.jumlah ELSE 0 END) AS quantity_entity_$entityID, ";
        }
        // Remove the trailing comma
        $sumStatements = rtrim($sumStatements, ', ');

        $this->select('
            item.*,
            sd.nama as nama_satuan,
            ' . $sumStatements . '
        ')
        ->join('satuan_dasar sd', 'sd.id=item.id_satuan', 'LEFT')
        ->join('item_transaksi_stock its', 'its.id_item=item.id', 'LEFT')
        ->join('entitas e', 'e.id=its.id_entitas', 'LEFT')
        ->groupBy('item.id')
        ->where('item.deleted_at', NULL);

        if ($request->getPost('search')['value']) {
            $searchValue = $request->getPost('search')['value'];
            $i = 0;
            foreach ($column_searchable as $item) {
                if ($i === 0) {
                    $this->groupStart(); 
                    $this->like($item, $searchValue);
                } else {
                    $this->orLike($item, $searchValue);
                }
                if (count($column_searchable) - 1 == $i) {
                    $this->groupEnd(); 
                }
                $i++;
            }
        }

        if ($request->getPost('order')) {
            $orderColumn = $column_orderable[$request->getPost('order')[0]['column']];
            $orderDirection = $request->getPost('order')[0]['dir'];
            $this->orderBy($orderColumn, $orderDirection);
        } else {
            $this->orderBy('id', 'ASC');
        }

        if ($request->getPost('length') != -1) {
            $this->limit($request->getPost('length'), $request->getPost('start'));
        }

        // result set
        $result['list_entitas_id'] = $entityIDs;
        $result['return_data'] = $this->get()->getResult();
        $result['count_filtered'] = $this->countAllResults();
        $result['count_all'] = $this->countAll($id_project);

        return $result;
    }

    // get week number
    public function getWeekNumberByDate($date) {
        $sql = "
            SELECT
                week_number
            FROM
                data_week
            WHERE
                start_date <= ? AND end_date >= ?
        ";
    
        $query = $this->db->query($sql, [$date, $date]);
        $result = $query->getRow();
    
        return $result ? $result->week_number : null;
    }

}
