<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_data_helper extends Model
{
    protected $table      = 'data_helper';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'type', 'name', 'description', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    // select by type
    public function get_by_type($type){
        $this->select('
            *
        ')
        ->where('type', $type)
        ->where('deleted_at', NULL);
        
        return $this->get()->getResult();
    }

}
