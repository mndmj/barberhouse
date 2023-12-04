<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBB;
use App\Models\ModelDetailPemilik;
use App\Models\ModelUser;
use Exception;

class Bb extends BaseController
{
    private $db = null;
    private $ModelBB = null;
    private $ModelDetailPemilik = null;
    private $ModelUser = null;

    function __construct()
    {
        $this->db = \config\Database::connect();
        $this->ModelBB = new ModelBB();
        $this->ModelDetailPemilik = new ModelDetailPemilik();
        $this->ModelUser = new ModelUser();
        helper('form');
    }
    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Informasi Barbershop',
            'dtBB' => $this->ModelBB->where('id_bb', session('data_user')['id_bb'])->first(),
            'dtPemilik' => $this->ModelDetailPemilik->where('id_user', session('data_user')['id_user'])->first(),
            'dtUser' => $this->ModelUser->where('id_user', session('data_user')['id_user'])->first()
        ];
        return view('admin/view_bb', $data);
    }

    public function updateInfo()
    {
        $dtUser = $this->ModelUser->find(session('data_user')['id_user']);
        if ($dtUser['password'] != md5((string)$this->request->getPost('passwordLama'))) {
            session()->setFlashdata('danger', 'Password Anda salah');
            return redirect()->to('bb');
        }
        if ($this->validate([
            'foto_bb' => 'uploaded[foto_bb]|max_size[foto_bb, 10240]|mime_in[foto_bb,image/jpeg,image/png]|ext_in[foto_bb,png,jpg,jpeg]'
        ])) {
            try {
                unlink('assets/images/barber/' . $this->request->getFile('foto_bb'));
            } catch (Exception $e) {
            }

            $foto_bb = $this->request->getFile('foto_bb');
            $fotoName = $foto_bb->getRandomName();
            $foto_bb->move("assets/images/barber/", $fotoName);
        }
        $data = [
            'nama_bb' => $this->request->getPost('nama_bb'),
            'telepon_bb' => $this->request->getPost('telepon'),
            'alamat_bb' => $this->request->getPost('alamat_bb'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'ket_bb' => $this->request->getPost('ket_bb'),
        ];
        if ($this->request->getPost('jam_buka')) {
            $data['jam_buka'] = $this->request->getPost('jam_buka');
        }
        if ($this->request->getPost('jam_tutup')) {
            $data['jam_tutup'] = $this->request->getPost('jam_tutup');
        }
        if (isset($fotoName)) {
            $data['foto_bb'] = $fotoName;
        }
        $dtPemilik = $this->ModelDetailPemilik->where('id_user', session('data_user')['id_bb'])->first();
        $this->ModelBB->update(session('data_user')['id_bb'], $data);
        $data = [];
        if ($this->request->getPost('username')) {
            $data['username'] = $this->request->getPost('username');
        }
        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }
        if (count($data) != 0) {
            $this->ModelUser->update(session('data_user')['id_user'], $data);
        }
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to('bb');
    }
}
