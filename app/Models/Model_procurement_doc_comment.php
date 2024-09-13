<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_procurement_doc_comment extends Model
{
    protected $table      = 'procurement_doc_comment';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_doc_file', 'id_doc', 'comment_file', 'page_detail', 'created_by',
        'comment_title', 'doc_step'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // count all not deleted row
    public function countNoFiltered()
    {
        $this->select('
                *
            ')
            ->where('deleted_at', NULL);

        return $this->countAllResults();
    }

    // get all
    public function get_all(){
        $this->select('
            transaksi.*,
            r.kode as kode_transaksi,
            p.kode_pasien as kode_pasien,
            p.nama as nama_pasien,
            k1.nama as payment_method,
            k2.nama as payment_status
        ')
        ->join('registration r', 'r.id=transaksi.id_registration', 'LEFT')
        ->join('pasien p', 'p.id=transaksi.id_pasien', 'LEFT')
        ->join('kategori k1', 'k1.id=transaksi.id_payment_method', 'LEFT')
        ->join('kategori k2', 'k2.id=transaksi.id_payment_status', 'LEFT')
        ->where('transaksi.deleted_at', NULL);
        
        return $this->get()->getResult();
    }

    // get by id
    public function get_by_idDoc_idApprover($payload) {
        // Validate that id_doc is provided
        if (!isset($payload['id_doc'])) {
            return [];
        }
    
        $this->select('
            *
        ')
        ->where('deleted_at', NULL)
        ->where('id_doc', $payload['id_doc']);
    
        if (isset($payload['id_approver']) && $payload['id_approver'] !== null) {
            $this->where('created_by', $payload['id_approver']);
        }
        
        return $this->get()->getResult();
    }
    

    // ajax for  list item
    protected $main_column_searchable = [
        'transaksi.id'
    ];
    protected $main_column_orderable = [
        'transaksi.id', 'transaksi.id'
    ];
    public function get_datatable_main()
    {
        $request = service('request');

        $this->select('
            transaksi.*,
            r.kode as kode_registrasi,
            p.kode_pasien as kode_pasien,
            p.nama as nama_pasien,
            k1.nama as payment_method,
            k2.nama as payment_status
        ')
        ->join('registration r', 'r.id=transaksi.id_registration', 'LEFT')
        ->join('pasien p', 'p.id=transaksi.id_pasien', 'LEFT')
        ->join('kategori k1', 'k1.id=transaksi.id_payment_method', 'LEFT')
        ->join('kategori k2', 'k2.id=transaksi.id_payment_status', 'LEFT')
        ->where('transaksi.deleted_at', NULL);

        if ($request->getPost('search')['value']) {
            $searchValue = $request->getPost('search')['value'];
            $i = 0;
            foreach ($this->main_column_searchable as $item) {
                if ($i === 0) {
                    $this->groupStart(); 
                    $this->like($item, $searchValue);
                } else {
                    $this->orLike($item, $searchValue);
                }
                if (count($this->main_column_searchable) - 1 == $i) {
                    $this->groupEnd(); 
                }
                $i++;
            }
        }

        if ($request->getPost('order')) {
            $orderColumn = $this->main_column_orderable[$request->getPost('order')[0]['column']];
            $orderDirection = $request->getPost('order')[0]['dir'];
            $this->orderBy($orderColumn, $orderDirection);
        } else {
            $this->orderBy('id', 'ASC');
        }

        if ($request->getPost('length') != -1) {
            $this->limit($request->getPost('length'), $request->getPost('start'));
        }

        // result set
        $result['return_data'] = $this->get()->getResult();
        $result['count_filtered'] = $this->countAllResults();
        $result['count_all'] = $this->countNoFiltered();

        return $result;
    }

}
