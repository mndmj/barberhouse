<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailPelanggan extends Model
{
    protected $table            = 'tbl_detail_pelanggan';
    protected $primaryKey       = 'id_detail_pelanggan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama', 'telepon', 'jk', 'id_user'];
}
