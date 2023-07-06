<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Exception;

class APIAuth extends ResourceController
{
    public function index()
    {
        $valid = $this->validate([
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
        ]);

        if (!$valid) {
            $data = [
                'id_user' => 0,
                'success' => false,
                'du_nama' => null,
                'msg' => "Data tidak sesuai"
            ];
        } else {
            try {
            } catch (Exception $e) {
                $dt = [
                    'us_id' => 0,
                    'success' => false,
                    'du_nama' => null,
                    'msg' => "Sistem masih dalam perbaikan" . $e
                ];
            }
        }
    }
}
