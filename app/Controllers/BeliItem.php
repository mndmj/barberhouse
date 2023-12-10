<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAntrian;
use App\Models\ModelBB;
use App\Models\ModelDetailTransaksi;
use App\Models\ModelMenu;
use App\Models\ModelTransaksi;

class BeliItem extends BaseController
{
    private $db = null;
    private $ModelTransaksi = null;
    private $ModelDetailTransaksi = null;
    private $ModelBB = null;
    private $ModelMenu = null;

    function __construct()
    {
        $this->db = \config\Database::connect();
        $this->ModelTransaksi = new ModelTransaksi();
        $this->ModelDetailTransaksi = new ModelDetailTransaksi();
        $this->ModelBB = new ModelBB();
        $this->ModelMenu = new ModelMenu();
    }

    public function index()
    {
        $dtTransaksi = $this->ModelTransaksi->orderBy('id_transaksi', 'desc')->where('id_antrian is null')->where('id_bb', session('data_user')['id_bb'])->findAll();
        $i = 0;
        foreach ($dtTransaksi as $dt) {
            $tmpDetail = $this->ModelDetailTransaksi->where('id_transaksi', $dt['id_transaksi'])->findAll();
            $tmpItem = 0;
            $tmpHarga = 0;
            foreach ($tmpDetail as $detail) {
                $tmpItem += $detail['jumlah_dt'];
                $tmpHarga += $detail['jumlah_dt'] * $detail['harga_dt'];
            }
            $dtTransaksi[$i]['totalHarga'] = $tmpHarga;
            $dtTransaksi[$i]['totalItem'] = $tmpItem;
            $i++;
        }
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Beli Item',
            'dtTransaksi' => $dtTransaksi
        ];
        return view('admin/view_transaksi', $data);
    }

    public function keranjang($idTransaksi = null)
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Keranjang',
            'dtBarber' => $this->ModelBB->find(session('data_user')['id_bb']),
            'dtMenu' => $this->ModelMenu->where('id_bb', session('data_user')['id_bb'])->where('jenis_menu', 'Haircare')->findAll(),
            'keranjang' => (session('keranjangItem')) ? session('keranjangItem') : [],
            'isFinished' => false
        ];
        session()->remove('isFinished');
        if (!is_null($idTransaksi)) {
            $dtTransaksi = $this->ModelTransaksi->find($idTransaksi);
            if (empty($dtTransaksi)) {
                session()->setFlashdata('danger', 'Data transaksi tidak ditemukan');
                return $this->redirect();
            }
            session()->set('isFinished', true);
            session()->remove('keranjangItem');
            $dtDetailTransaksi = $this->ModelDetailTransaksi->select('nama_menu as nama, harga_dt as harga, jumlah_dt, tbl_menu.id_menu as pilih_menu')
                ->join('tbl_menu', 'tbl_menu.id_menu = tbl_detail_transaksi.id_menu')
                ->where('id_transaksi', $idTransaksi)->findAll();
            unset($data['dtMenu']);
            $data['keranjang'] = $dtDetailTransaksi;
            $data['dtTransaksi'] = $dtTransaksi;
            $data['isFinished'] = true;
        }
        return view('admin/view_beli', $data);
    }

    public function addItem()
    {
        if (session('isFinished')) {
            session()->setFlashdata('danger', 'Akses ditolak');
            return $this->redirect();
        }
        if (!session('keranjangItem')) {
            session()->set('keranjangItem', []);
            $keranjang = [];
        } else {
            $keranjang = session('keranjangItem');
        }
        if (!$this->validate([
            'pilih_menu' => 'required|is_natural_no_zero',
            'jumlah_dt' => 'required|is_natural_no_zero'
        ])) {
            session()->setFlashdata('danger', 'Masukan data dengan valid');
            return $this->redirect();
        }
        $dtMenu = $this->ModelMenu->where('id_bb', session('data_user')['id_bb'])->where('id_menu', $this->request->getPost('pilih_menu'))->first();
        if (empty($dtMenu)) {
            session()->setFlashdata('danger', 'Data menu tidak ditemukan');
            return $this->redirect();
        }
        $tmpKeranjang = $keranjang;
        $tmpCountKeranjang = count($keranjang);
        if (count($keranjang) > 0) {
            $i = 0;
            $newMenu = true;
            foreach ($keranjang as $dt) {
                if ($dt['pilih_menu'] == $this->request->getPost('pilih_menu')) {
                    $newMenu = false;
                    break;
                }
                $i++;
            }
            if ($newMenu) {
                $tmp = [
                    'pilih_menu' => $this->request->getPost('pilih_menu'),
                    'jumlah_dt' => $this->request->getPost('jumlah_dt'),
                    'harga' => $dtMenu['harga_menu'],
                    'nama' => $dtMenu['nama_menu']
                ];
                array_push($keranjang, $tmp);
            } else {
                $tmp = [
                    'pilih_menu' => $this->request->getPost('pilih_menu'),
                    'jumlah_dt' => $this->request->getPost('jumlah_dt') + $keranjang[$i]['jumlah_dt'],
                    'harga' => $dtMenu['harga_menu'],
                    'nama' => $dtMenu['nama_menu']
                ];
                $keranjang[$i] = $tmp;
            }
            session()->set('keranjangItem', $keranjang);
        } else {
            $tmp = [
                'pilih_menu' => $this->request->getPost('pilih_menu'),
                'jumlah_dt' => $this->request->getPost('jumlah_dt'),
                'harga' => $dtMenu['harga_menu'],
                'nama' => $dtMenu['nama_menu']
            ];
            array_push($keranjang, $tmp);
            session()->set('keranjangItem', $keranjang);
            $newMenu = true;
        }
        if ($newMenu) {
            if (count($keranjang) > $tmpCountKeranjang) {
                session()->setFlashdata('success', 'Data keranjang berhasil ditambahkan');
                return $this->redirect();
            } else {
                session()->setFlashdata('danger', 'Data keranjang gagal ditambahkan');
                return $this->redirect();
            }
        } else {
            if ($tmpKeranjang[$i]['jumlah_dt'] != $keranjang[$i]['jumlah_dt']) {
                session()->setFlashdata('success', 'Data keranjang berhasil ditambahkan');
                return $this->redirect();
            } else {
                session()->setFlashdata('danger', 'Data keranjang gagal ditambahkan');
                return $this->redirect();
            }
        }
    }

    public function deleteItem($idMenu)
    {
        if (session('isFinished')) {
            session()->setFlashdata('danger', 'Akses ditolak');
            return $this->redirect();
        }
        if (!session('keranjangItem')) {
            session()->setFlashdata('danger', 'Data keranjang masih kosong');
            return $this->redirect();
        }
        $keranjang = session('keranjangItem');
        $tmpCount = count($keranjang);
        $i = 0;
        foreach ($keranjang as $key => $dt) {
            if ($i == 0) {
                $i = $key;
            }
            if ($dt['pilih_menu'] == $idMenu) {
                unset($keranjang[$i]);
                break;
            }
            $i++;
        }
        session()->set('keranjangItem', $keranjang);
        if (count($keranjang) < $tmpCount) {
            session()->setFlashdata('success', 'Data keranjang berhasil dihapus');
            return $this->redirect();
        } else {
            session()->setFlashdata('danger', 'Data keranjang gagal dihapus');
            return $this->redirect();
        }
    }

    public function finish()
    {
        if (session('isFinished')) {
            session()->setFlashdata('danger', 'Akses ditolak');
            return $this->redirect();
        }
        if (!session('keranjangItem')) {
            session()->setFlashdata('danger', 'Data keranjang masih kosong');
            return $this->redirect();
        }
        $data = [
            'id_bb' => session('data_user')['id_bb'],
            'tanggal_transaksi' => date("Y-m-d H:i:s")
        ];
        $this->ModelTransaksi->insert($data);
        $idTransaksi = $this->ModelTransaksi->orderBy('id_transaksi', 'desc')->first()['id_transaksi'];
        foreach (session('keranjangItem') as $dt) {
            $data = [
                'id_transaksi' => $idTransaksi,
                'id_menu' => $dt['pilih_menu'],
                'jumlah_dt' => $dt['jumlah_dt'],
                'harga_dt' => $dt['harga']
            ];
            $this->ModelDetailTransaksi->insert($data);
        }
        if (!empty($this->ModelTransaksi->find($idTransaksi)) && count($this->ModelDetailTransaksi->where('id_transaksi', $idTransaksi)->findAll()) > 0) {
            session()->setFlashdata('success', 'Transaksi berhasil disimpan');
            session()->remove('keranjangItem');
            return redirect()->to(base_url('beliitem'));
        }
        session()->setFlashdata('danger', 'Data transaksi gagal disimpan');
        return $this->redirect();
    }

    public function reset()
    {
        session()->remove('keranjangItem');
        session()->setFlashdata('success', 'Data keranjang berhasil direset');
        return $this->redirect();
    }
}
