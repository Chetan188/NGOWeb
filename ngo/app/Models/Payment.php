<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment extends Model
{
    protected $table      = 'payments';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['ngo_id','amount','status','created_by','updated_by','created_at','updated_at'];
}