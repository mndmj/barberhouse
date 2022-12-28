<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_user', 'nama_menu', 'jenis_menu', 'harga_menu', 'id_bb'];

    public function login($username, $password)
    {
        return $this->db->table('tbl_user')->where(
            'username',
            $username
        )->where('password', $password)->get()->getRowArray();
    }
}
