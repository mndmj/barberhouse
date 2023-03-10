<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Antrian extends BaseController
{
    private $db = null;

    function __construct()
    {
        $this->db = \config\Database::connect();
    }
    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Antrian',
            'antrian' => $this->db->table('tbl_antrian')->where('id_bb', session('data_user')['id_bb'])->get()->getResultArray(),
        ];
        return view('admin/view_antrian', $data);
    }
}
