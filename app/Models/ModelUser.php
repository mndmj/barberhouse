<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $deletedField     = 'delete_at';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['id_user', 'username', 'password', 'email', 'token', 'id_role', 'delete_at'];
}
