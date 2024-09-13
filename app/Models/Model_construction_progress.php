<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_construction_progress extends Model
{
    protected $table      = 'construction_progress';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_project', 'id_construction', 'step', 'actual_volume', 'actual_percent_per_construction', 'created_by',
        'evidence_filename'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // get by id
    public function get_by_id_construction($id_construction){
        $this->select('
            step as step,
            SUM(actual_volume) as total_inserted_volume
        ')
        ->where('id_construction', $id_construction)
        ->groupBy('step');
        
        return $this->get()->getResult();
    }

}
