<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAntrian extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_antrian';
    protected $primaryKey       = 'id_antrian';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_antrian', 'id_user', 'id_bb', 'no_antrian', 'status_antrian', 'tgl_antrian'];
}
