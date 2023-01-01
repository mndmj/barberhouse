<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailPemilik extends Model
{
    protected $table            = 'tbl_detail_pemilik';
    protected $primaryKey       = 'id_detail_pemilik';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_lengkap', 'email', 'telepon', 'jk', 'alamat', 'foto', 'id_user'];
}
