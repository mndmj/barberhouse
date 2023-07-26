<?php

namespace App\Controllers;

use App\Models\ModelDetailTransaksi;
use App\Models\ModelTransaksi;
use CodeIgniter\RESTful\ResourceController;

class APITransaksi extends ResourceController
{
    private $ModelTransaksi = null;
    private $ModelDetailTransaksi = null;

    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
        $this->ModelDetailTransaksi = new ModelDetailTransaksi();
    }

    public function index()
    {
        return view('errors/html/error_404');
    }

    public function detailTransaksi()
    {
        $id_transaksi =  $this->request->getPost('id_transaksi');
        //pake id transaksi

        //kurang select
        $detail_transaksi = $this->ModelDetailTransaksi->select('jumlah_dt, harga_dt, nama_menu, id_transaksi')
            ->join('tbl_menu', 'id_menu.tbl_menu = id_menu.tbl_detail_transaksi')
            ->where('id_transaksi', $id_transaksi)->findAll();

        return $this->respond($detail_transaksi);
    }
}
