<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarbershop extends Model
{
    protected $table            = 'tbl_bb';
    protected $primaryKey       = 'id_bb';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_bb', 'pemilik_bb', 'foto_bb', 'telepon_bb', 'alamat_bb', 'latitude', 'longitude', 'ket_bb'];
}
