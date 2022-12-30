<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use Exception;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->ModelAuth = new ModelAuth();
        helper('form');
        helper('text');
    }

    public function register()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ]
            ],
            'username_reg' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => '{field} wajib Diisi.',
                    'valid_email' => '{field} tidak valid.',
                ],
            ],
            'password_reg' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} yang Anda Masukkan harus 8 digit.'
                ]
            ],
        ])) {
            $token = random_string('alnum', 6);
            // $mail = new PHPMailer(true);
            $data = [
                'username' => $this->request->getPost('username_reg'),
                'password' => $this->request->getPost('password_reg'),
                'email' => $this->request->getPost('email'),
                'id_role' => '1',
                'token' => $token,
            ];
            try {
                $this->ModelAuth->insert($data);
                session()->set('regist', $this->request->getPost('email'));
                session()->setFlashdata('success', 'Berhasil melakukan registrasi');
                return redirect()->to(base_url('register'));
            } catch (Exception $e) {
                session()->setFlashdata('danger', 'Gagal melakukan registrasi');
                return redirect()->to(base_url('home'));
            }
        } else {
            // tidak valid
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to(base_url('/'))->withInput()->with('error_register', true);
        }
    }

    public function cek_login()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                // 'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    // 'min_length' => '{field} yang Anda Masukkan harus 8 digit.'
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
            session()->setFlashdata('errors', $this->validator);
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
