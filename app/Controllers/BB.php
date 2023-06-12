<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBB;

class BB extends BaseController
{
    private $db = null;
    private $ModelBB = null;

    function __construct()
    {
        $this->db = \config\Database::connect();
        $this->ModelBB = new ModelBB();
        helper('form');
    }
    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Informasi Barbershop',
        ];
        return view('admin/view_bb', $data);
    }

    public function updateInfo()
    {
        if ($this->ModelBB['foto_bb'] != '') {
            unlink('assets/images/barber/' . $this->ModelBB['foto_bb']);
        }
        $foto_bb = $this->request->getFile('foto_bb');
        $fotoName = $foto_bb->getRandomName();
        $data = [
            'id_bb' => session('data_user')['id_bb'],
            'nama_bb' => $this->request->getPost('nama_bb'),
            'foto_bb' => $fotoName,
            'telepon_bb' => $this->request->getPost('telepon_bb'),
            'alamat_bb' => $this->request->getPost('alamat_bb'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'jam_buka' => $this->request->getPost('jam_buka'),
            'jam_tutup' => $this->request->getPost('jam_tutup'),
            'ket_bb' => $this->request->getPost('ket_bb'),
            'id_detail_pemilik' => $this->ModelBB->getPemilikBB(),
        ];
        $this->ModelBB->where(session('data_user')['id_bb'])->update($data);
        session()->with('success', 'Data berhasil diubah !!');
        return redirect()->to('bb');
    }
}
