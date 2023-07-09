<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMenu;

class Menu extends BaseController
{
    private $ModelMenu = null;
    private $db = null;

    public function __construct()
    {
        $this->ModelMenu = new ModelMenu();
        $this->db = \config\Database::connect();
        helper('form');
    }
    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Menu',
            'menu' => $this->ModelMenu->where('id_bb', session('data_user')['id_bb'])->findAll(),
        ];
        return view('admin/view_menu', $data);
    }

    public function insertData()
    {
        $data = [
            'nama_menu' => $this->request->getPost('nama_menu'),
            'jenis_menu' => $this->request->getPost('jenis_menu'),
            'harga_menu' => $this->request->getPost('harga_menu'),
            'id_bb' => session('data_user')['id_bb'],
        ];
        $this->ModelMenu->insert($data);
        return redirect()->to('menu')->with('success', 'Data berhasil ditambahkan');
    }

    public function editData($id_menu)
    {
        $data = [
            'nama_menu' => $this->request->getPost('nama_menu'),
            'jenis_menu' => $this->request->getPost('jenis_menu'),
            'harga_menu' => $this->request->getPost('harga_menu'),
        ];
        $this->ModelMenu->update($id_menu, $data);
        return redirect()->to('menu')->with('warning', 'Data berhasil diedit');
    }

    public function deleteData($id_menu)
    {
        $data = [
            'id_menu' => $id_menu,
        ];
        $this->ModelMenu->delete($data);
        return redirect()->to('menu')->with('danger', 'Data berhasil dihapus');
    }
}
