<?php

namespace App\Controllers;

use App\Models\ModelUser;
use CodeIgniter\RESTful\ResourceController;

class APIAccount extends ResourceController
{
    private $ModelUser = null;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        return view('errors/html/error_404');
    }

    public function getDataUser()
    {
        if (!$this->validate([
            'id_user' => 'required|is_natural_no_zero',
        ])) {
            $data = null;
        } else {
            $data = $this->ModelUser->select('username,email,nama,jk,no_telp')
                ->join('tbl_detail_pelanggan', 'tbl_user.id_user = tbl_detail_pelanggan.id_user')
                ->where('tbl_user.id_user', $this->request->getPost('id_user'))
                ->first();
        }
        return $this->respond($data);
    }
}
