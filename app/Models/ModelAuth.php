<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['username', 'password', 'email', 'token', 'status', 'id_role'];

    public function getDataLogin($username, $password)
    {
        $model_user = new ModelUser();
        return $model_user
            ->join('tbl_detail_pemilik', 'tbl_detail_pemilik.id_user=tbl_user.id_user')
            ->join('tbl_bb', 'tbl_bb.id_detail_pemilik=tbl_detail_pemilik.id_detail_pemilik')
            ->where('username', $username)
            ->where('password', md5($password))
            ->findAll();
    }

    public function login($username, $password)
    {
        $dt = $this->getDataLogin($username, $password);
        if (count($dt) == 1) {
            if ($dt[0]['id_role'] == 1) {
                return true;
            }
        }
        return false;
    }

    public function token($token, $email)
    {
        $model_user = new ModelUser();
        $dt = $model_user
            ->where('token', $token)
            ->where('email', $email)
            ->findAll();
        if (count($dt) == 1) {
            return true;
        }
        return false;
    }
}
