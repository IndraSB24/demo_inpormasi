<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_project extends Model
{
    protected $table      = 'project_list';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'contract_no', 'award_date', 'manager', 'value', 'progress', 'created_by',
        'nama_project', 'deskripsi', 'start_date', 'end_date'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'name'      => 'required|min_length[3]',
        'price'     => 'required|numeric',
    ];

    protected $validationMessages = [
        'name'        => [
            'required' => 'Bagian Name Harus diisi',
            'min_length' => 'Minimal 3 Karakter'
        ],
        'price'        => [
            'required' => 'Bagian Price Harus diisi',
            'numeric' => 'Hanya bisa diisi dengan angka'
        ]
    ];
    protected $skipValidation  = true;

    public function reset_increment()
    {
        $sql = "ALTER TABLE project_list AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    // select all
    public function getAll(){
        //return $this->db->findAll();
    }
    
    // project list in home ------------------------------------------------------------------------------------------------------------------------------
    protected $columnSearch = ['contract_no']; // Add your searchable columns here
    protected $columnOrder  = [null, 'contract_no']; // Add your orderable columns here
    protected $order        = ['id' => 'asc']; // Default order
    private function _getDatatablesQuery()
    {
        $this->select('*')->from('project_list as pl');

        $i = 0;
        foreach ($this->columnSearch as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->groupStart();
                    $this->like($item, $_POST['search']['value']);
                } else {
                    $this->orLike($item, $_POST['search']['value']);
                }

                if (count($this->columnSearch) - 1 == $i) {
                    $this->groupEnd();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $orderColumn = $this->columnOrder[$_POST['order'][0]['column']] ?? null;
            if (!empty($orderColumn)) {
                $this->orderBy($orderColumn, $_POST['order'][0]['dir']);
            }
        } else if (isset($this->order)) {
            $this->orderBy(key($this->order), $this->order[key($this->order)]);
        }
    }

    public function getDatatables()
    {
        $this->_getDatatablesQuery();
        if ($_POST['length'] != -1) {
            $this->limit($_POST['length'], $_POST['start']);
        }
        return $this->get()->getResult();
    }

    public function countFiltered()
    {
        $this->_getDatatablesQuery();
        return $this->countAllResults();
    }

    public function countAll()
    {
        return $this->countAll();
    }
}
