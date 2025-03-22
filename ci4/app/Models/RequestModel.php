<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model
{
    protected $table      = 'request';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['division', 'office', 'code', 'risNo', 'purpose', 'item_id', 'request_qty', 'available', 'issue_qty', 'remarks', 'requested_by', 'requested_designation', 'requested_date', 'approved_by', 'approved_designation', 'approved_date', 'issued_by', 'issued_designation', 'issued_date', 'received_by', 'received_designation', 'received_date', 'status', 'type', 'created_at', 'updated_at', 'deleted_at'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
