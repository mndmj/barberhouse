<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMenu extends Model
{
    protected $table            = 'tbl_menu';
    protected $primaryKey       = 'id_menu';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_menu', 'nama_menu', 'jenis_menu', 'harga_menu', 'id_bb'];

    public function getDataBB()
    {
        return $this->table('tbl_menu')
            ->where(
                'id_menu',
                session()->get('id_menu')
            )
            ->join('tbl_bb', 'tbl_bb.id_bb = tbl_menu.id_bb', 'left')
            ->get()->getRowArray();
    }
}
