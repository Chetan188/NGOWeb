<?php

namespace App\Models;

use CodeIgniter\Model;

class Ngo extends Model
{
    protected $table      = 'ngos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['ngo_id','name','email','phone','country','state','city','address','banner','photos','documents','certifications','note','is_approved','created_by','updated_by','created_at','updated_at'];
}