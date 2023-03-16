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
    }
    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Informasi',
            'bb' => $this->ModelBB->findAll(),
        ];
        return view('admin/view_bb', $data);
    }

    public function insertData()
    {
        $data = [
            'nama_bb' => $this->request->getPost('nama_bb'),
            'telepon_bb' => $this->request->getPost('telepon_bb'),
            'foto_bb' => $this->request->getPost('foto_bb'),
            'alamat_bb' => $this->request->getPost('alamat_bb'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'jam_buka' => $this->request->getPost('jam_buka'),
            'jam_tutup' => $this->request->getPost('jam_tutup'),
            'ket_bb' => $this->request->getPost('ket_bb'),
            'id_bb' => session('data_user')['id_bb'],
        ];
        $this->ModelBB->insert($data);
        session()->setFlashdata('tambah', 'Data berhasil diubah !!');
        return redirect()->to('bb');
    }
}
