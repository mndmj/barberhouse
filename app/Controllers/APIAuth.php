<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class APIAuth extends ResourceController
{
    public function index()
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
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} yang Anda masukkan harus 8 digit.'
                ]
            ]
        ])) {
        }
    }
}
