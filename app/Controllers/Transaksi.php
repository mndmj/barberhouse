<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelDetailTransaksi;
use App\Models\ModelTransaksi;

class Transaksi extends BaseController
{
    private $ModelDetailTransaksi = null;
    private $ModelTransaksi = null;
    private $db = null;

    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
        $this->ModelDetailTransaksi = new ModelDetailTransaksi();
        $this->db = \config\Database::connect();
        helper('form');
    }

    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Transaksi',
            'bb' => $this->db->table('tbl_bb')->where('id_bb', session('data_user')['id_bb'])->get()->getResultArray()[0],
            'keranjang' => $this->ModelDetailTransaksi
                ->join('tbl_menu', 'tbl_menu.id_menu=tbl_detail_transaksi.id_menu')
                ->join('tbl_transaksi', 'tbl_transaksi.id_transaksi=tbl_detail_transaksi.id_transaksi')
                ->where('id_antrian', session('id_antrian'))->findAll(),
        ];
        return view('admin/view_list_pelanggan', $data);
    }
}
