<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;

class Transaksi extends BaseController
{
    private $ModelTransaksi = null;
    private $db = null;

    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
        $this->db = \config\Database::connect();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Transaksi',
        ];
        return view('admin/view_transaksi', $data);
    }
}
