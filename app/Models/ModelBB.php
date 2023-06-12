<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBB extends Model
{
    protected $table            = 'tbl_bb';
    protected $primaryKey       = 'id_bb';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_bb', 'nama_bb', 'telepon_bb', 'foto_bb', 'alamat_bb', 'latitude', 'longitude', 'jam_buka', 'jam_tutup', 'ket_bb', 'id_detail_pemilik'];

    public function getPemilikBB()
    {
        return $this->table('tbl_bb')
            ->where('id_bb', session()->get('id_bb'))
            ->join('tbl_bb', 'tbl_bb.id_detail_pemilik = tbl_detail_pemilik.id_detail_pemilik', 'left')
            ->get()->getRowArray();
    }
}
