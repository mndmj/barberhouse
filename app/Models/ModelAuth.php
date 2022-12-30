<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['username', 'password', 'email', 'token', 'id_role'];

    public function login($username, $password)
    {
        return $this->db->table('tbl_user')
            ->where('username', $username)
            ->where('password', $password)
            ->get()->getRowArray();
    }

    public function token($token, $email)
    {
        $dt = $this->db->table('tbl_user')
            ->where('token', $token)
            ->where('email', $email)
            ->get()->getResultArray();
        if (count($dt) == 1) {
            return true;
        }
        return false;
    }
}
