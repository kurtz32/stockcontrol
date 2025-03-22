<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestItemModel extends Model
{
    protected $table      = 'requested_items';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['item_id', 'request_id', 'requestQty', 'available', 'issueQty', 'remarks', 'created_at', 'updated_at', 'deleted_at'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
