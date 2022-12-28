<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->ModelAuth = new ModelAuth();
        helper('form');
    }

    public function register($id_user)
    {
    }

    public function cek_login()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                // 'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} Wajib diisi !!',
                    // 'min_length' => '{field} yang Anda Masukkan harus 8 digit !!'
                ]
            ]
        ])) {
            // valid
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelAuth->login($username, $password);
            if ($cek_login) {
                session()->set('username', $cek_login['username']);
                session()->set('password', $cek_login['password']);
                session()->set('level', 'admin');
                return redirect()->to(base_url('admin'));
            } else {
                session()->setFlashdata('peringatan', 'Username atau Password salah..!!');
                return redirect()->to(base_url('/'));
            }
        } else {
            // tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/'));
        }
    }

    public function logout()
    {
        session()->remove('username');
        session()->remove('password');
        session()->remove('level');
        session()->setFlashdata('pesan', 'Logout berhasil.');
        return redirect()->to(base_url('/'));
    }
}
