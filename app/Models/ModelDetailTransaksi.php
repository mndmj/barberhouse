<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailTransaksi extends Model
{
    protected $table            = 'tbl_detail_transaksi';
    protected $primaryKey       = 'id_dt';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_menu', 'id_transaksi', 'jumlah_dt', 'harga_dt'];
}
