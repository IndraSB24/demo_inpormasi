<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_karyawan_doc_role extends Model
{
    protected $table      = 'karyawan_doc_role';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_karyawan', 'doc_type', 'id_doc', 'id_doc_role', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // get list
    public function get_list(){
        $this->select('
            *
        ')
        ->where('deleted_at', NULL);
        
        return $this->get()->getResult();
    }

    // count all not deleted row
    public function countNoFiltered()
    {
        $this->select('
            *
        ')
        ->where('deleted_at', NULL);

        return $this->countAllResults();
    }

    // ajax for  list item
    protected $main_column_searchable = [
        'pde.description', 'r.name'
    ];
    protected $main_column_orderable = [
        'karyawan_doc_role.id', 'pde.description', 'r.name'
    ];
    public function get_datatable_main($id_karyawan)
    {
        $request = service('request');

        $this->select('
            karyawan_doc_role.*,
            pde.description as doc_name,
            r.name as role_name
        ')
        ->join('role r', 'r.id=karyawan_doc_role.id_doc_role', 'LEFT')
        ->join('project_detail_engineering pde', 'pde.id=karyawan_doc_role.id_doc', 'LEFT')
        ->where('karyawan_doc_role.deleted_at', NULL)
        ->where('karyawan_doc_role.id_karyawan', $id_karyawan);

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

    // get by id
    public function get_by_id($id){
        $this->select('
            karyawan_doc_role.*,
            pde.description as doc_name,
            r.name as role_name
        ')
        ->join('role r', 'r.id=karyawan_doc_role.id_doc_role', 'LEFT')
        ->join('project_detail_engineering pde', 'pde.id=karyawan_doc_role.id_doc', 'LEFT')
        ->where('karyawan_doc_role.id', $id);
        
        return $this->get()->getResult();
    }

    // get by id
    public function get_by_id_karyawan($id_karyawan){
        $this->select('
            karyawan_doc_role.*,
            r.name as role_name
        ')
        ->join('role r', 'r.id=karyawan_doc_role.id_doc_role', 'LEFT')
        ->where('doc_type', 'engineering')
        ->where('karyawan_doc_role.id_karyawan', $id_karyawan);
        
        return $this->get()->getResultArray();
    }

}
