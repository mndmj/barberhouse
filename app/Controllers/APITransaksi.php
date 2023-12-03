<?php

namespace App\Controllers;

use App\Models\ModelAntrian;
use App\Models\ModelBB;
use App\Models\ModelDetailTransaksi;
use App\Models\ModelTransaksi;
use App\Models\ModelUser;
use CodeIgniter\RESTful\ResourceController;

class APITransaksi extends ResourceController
{
    private $ModelTransaksi = null;
    private $ModelDetailTransaksi = null;
    private $ModelAntrian = null;
    private $ModelUser = null;
    private $ModelBB = null;

    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
        $this->ModelDetailTransaksi = new ModelDetailTransaksi();
        $this->ModelAntrian = new ModelAntrian();
        $this->ModelUser = new ModelUser();
        $this->ModelBB = new ModelBB();
    }

    public function index()
    {
        return view('errors/html/error_404');
    }

    public function get()
    {
        if (!$this->validate([
            'id_user' => 'required|is_natural_no_zero'
        ])) {
            return $this->setError("Data pelanggan tidak valid");
        }
        $dtPelanggan = $this->ModelUser->where('id_user', $this->request->getPost('id_user'))
            ->where('id_role', '2')->where('token is null')->first();
        if (empty($dtPelanggan)) {
            return $this->setError("Data pengguna tidak ditemukan");
        }
        // Get data transaksi by id user on table antrian
        return $this->respond($this->ModelTransaksi
            ->select('tbl_transaksi.id_transaksi, tbl_antrian.id_antrian as id_antrian, nama_user as nama, no_antrian, date(tanggal_transaksi) as tanggal_transaksi')
            ->join('tbl_antrian', 'tbl_transaksi.id_antrian=tbl_antrian.id_antrian')
            ->join('tbl_user', 'tbl_antrian.id_user = tbl_user.id_user')
            ->join('tbl_detail_user', 'tbl_user.id_user = tbl_detail_user.id_user')
            ->where('tbl_antrian.id_user', $this->request->getPost('id_user'))
            ->findAll());
    }

    public function detailTransaksi()
    {
        if (!$this->validate([
            'id_user' => 'required|is_natural_no_zero'
        ])) {
            return $this->setError("Data pelanggan tidak valid");
        }
        $id_transaksi =  $this->request->getPost('id_transaksi');
        //pake id transaksi

        //kurang select
        $detail_transaksi = $this->ModelDetailTransaksi->select('jumlah_dt, harga_dt, nama_menu, id_transaksi')
            ->join('tbl_menu', 'id_menu.tbl_menu = id_menu.tbl_detail_transaksi')
            ->where('id_transaksi', $id_transaksi)->findAll();

        return $this->respond($detail_transaksi);
    }

    public function getdetail()
    {
        if (!$this->validate([
            'id_transaksi' => 'required|is_natural_no_zero'
        ])) {
            return $this->setError("Data pelanggan tidak valid");
        }
        return $this->respond($this->ModelDetailTransaksi->select('nama_menu, jenis_menu, jumlah_dt as qty, harga_dt as harga_menu')
            ->join('tbl_menu', 'tbl_detail_transaksi.id_menu = tbl_menu.id_menu')
            ->where('id_transaksi', $this->request->getPost('id_transaksi'))
            ->findAll());
    }
}
