<?php

namespace App\Models;

use CodeIgniter\Model;

class City extends Model
{
    protected $table      = 'cities';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'state_id', 'created_at', 'updated_at'];
}