<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;

class Register extends BaseController
{
    public function __construct()
    {
        $this->ModelAuth = new ModelAuth();
        helper('form');
        helper('text');
    }

    public function index()
    {
        $data = [
            'validation' => (session('errors')) ? session('errors') : \Config\Services::validation()
        ];
        return view('view_token', $data);
    }

    public function token()
    {
        if ($this->validate([
            'token' => [
                'label' => 'Token',
                'rules'  => 'required|min_length[6]|max_length[6]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'max_length' => '{field} harus 6 karakter.',
                    'min_length' => '{field} harus 6 karakter.',
                ]
            ],
        ])) {
            $token = $this->request->getPost('token');
            // $cek_token = $this->ModelAuth->token($token);
            // dd();
            if ($this->ModelAuth->token($token, session('regist'))) {
                session()->set('success', 'Token benar');
                return redirect()->to(base_url());
            } else {
                session()->setFlashdata('peringatan', 'Token salah.');
                return redirect()->to(base_url('register'))->withInput()->with('error_input', true);
            }
        } else {
            // tidak valid
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to(base_url('register'));
        }
    }
}
