<?php

namespace App\Models;

use CodeIgniter\Model;

class TrackerModel extends Model
{
    protected $table      = 'tracker';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['item_id', 'department_id', 'employee_id', 'location_id', 'date', 'referenceNo', 'issueQty', 'balanceQty', 'thru', 'remarks', 'created_at', 'updated_at', 'deleted_at'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
