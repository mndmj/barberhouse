<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailUser extends Model
{
    protected $table            = 'tbl_detail_user';
    protected $primaryKey       = 'id_detail_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_detail_user', 'id_user', 'nama_user', 'telepon', 'alamat_user'];
}
