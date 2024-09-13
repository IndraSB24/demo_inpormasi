<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_construction_measurement_basis extends Model
{
    protected $table      = 'construction_measurement_basis';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_construction', 'progress_step', 'progress_name', 'progress_wf', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
