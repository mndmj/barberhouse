<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRole extends Model
{
    protected $table            = 'tbl_role';
    protected $primaryKey       = 'id_role';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_role', 'nama_role'];
}
