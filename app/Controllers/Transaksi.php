<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBB;
use App\Models\ModelDetailTransaksi;
use App\Models\ModelMenu;
use App\Models\ModelTransaksi;

class Transaksi extends BaseController
{
    private $ModelDetailTransaksi = null;
    private $ModelMenu = null;
    private $ModelTransaksi = null;
    private $ModelBB = null;

    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
        $this->ModelMenu = new ModelMenu();
        $this->ModelBB = new ModelBB();
        $this->ModelDetailTransaksi = new ModelDetailTransaksi();
        helper('form');
    }

    public function index()
    {
        $dt_transaksi = $this->ModelTransaksi
            ->join('tbl_antrian', 'tbl_antrian.id_antrian = tbl_transaksi.id_antrian', 'left')
            ->join('tbl_user', 'tbl_user.id_user = tbl_antrian.id_user', 'left')
            ->join('tbl_detail_pelanggan', 'tbl_detail_pelanggan.id_user = tbl_user.id_user', 'left')
            ->join('tbl_bb', 'tbl_bb.id_bb = tbl_transaksi.id_bb')
            ->where('tbl_transaksi.id_bb', session('data_user')['id_bb'])
            ->findAll();
        $i = 0;
        foreach ($dt_transaksi as $dt) {
            $detail = $this->ModelDetailTransaksi->where('id_transaksi', $dt['id_transaksi'])->findAll();
            $total = 0;
            foreach ($detail as $value) {
                $total += $value['harga_dt'] * $value['jumlah_dt'];
            }
            $dt_transaksi[$i]['total_bayar'] = $total;
            $i++;
        }
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Transaksi',
            'bb' => $this->ModelBB->where('id_bb', session('data_user')['id_bb'])->first(),
            'transaksi' => $dt_transaksi,
        ];
        return view('admin/view_list_pelanggan', $data);
    }
}
