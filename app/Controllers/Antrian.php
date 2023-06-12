<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAntrian;
use App\Models\ModelDetailTransaksi;
use App\Models\ModelMenu;
use App\Models\ModelTransaksi;


class Antrian extends BaseController
{
    private $db = null;
    private $ModelAntrian = null;
    private $ModelMenu = null;
    private $ModelTransaksi = null;
    private $ModelDetailTransaksi = null;

    function __construct()
    {
        $this->db = \config\Database::connect();
        $this->ModelAntrian = new ModelAntrian();
        $this->ModelMenu = new ModelMenu();
        $this->ModelTransaksi = new ModelTransaksi();
        $this->ModelDetailTransaksi = new ModelDetailTransaksi();
    }

    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Antrian',
            'antrian' => $this->db->table('tbl_antrian')
                ->join('tbl_user', 'tbl_antrian.id_user = tbl_user.id_user', 'left')
                ->join('tbl_detail_pelanggan', 'tbl_antrian.id_user = tbl_detail_pelanggan.id_user', 'left')
                ->where('id_bb', session('data_user')['id_bb'])
                ->having('date(tgl_antrian)', date('Y-m-d'))->get()->getResultArray(),
        ];
        return view('admin/view_antrian', $data);
    }

    public function tambah_antrian()
    {
        // ambil data terbaru
        $data_antrian = $this->ModelAntrian->where('id_bb', session('data_user')['id_bb'])
            ->orderBy('id_antrian', 'desc')
            ->having('date(tgl_antrian)', date('Y-m-d'))
            ->first();

        // Tambah no antrian baru
        if (empty($data_antrian)) {
            $antrian_baru = 1;
        } else {
            $antrian_baru = $data_antrian['no_antrian'] + 1;
        }

        $data = [
            'id_bb' => session('data_user')['id_bb'],
            'no_antrian' => $antrian_baru,
            'status_antrian' => 'Menunggu',
            'tgl_antrian' => date('Y-m-d H:i:s')
        ];

        if ($this->ModelAntrian->insert($data)) {
            return redirect()->to(base_url('antrian'))->with('success', 'Antrian berhasil ditambahkan');
        } else {
            return redirect()->to(base_url('antrian'))->with('danger', 'Antrian gagal ditambahkan');
        }
    }

    public function ubah_status_antrian()
    {
        $valid = $this->validate([
            'id_antrian' => [
                'label' => 'id antrian',
                'rules' => 'required|is_natural_no_zero',
                // 'errors' => ''
            ]
        ]);

        if (!$valid) {
            return redirect()->to(base_url('antrian'))->with('danger', 'Data tidak sesuai');
        }

        $data['status_antrian'] = 'Diproses';

        if ($this->ModelAntrian->update($this->request->getPost('id_antrian'), $data)) {
            return redirect()->to(base_url('antrian'))->with('success', 'Status antrian berhasil diubah');
        } else {
            return redirect()->to(base_url('antrian'))->with('danger', 'Status antrian gagal diubah');
        }
    }

    public function detail_keranjang()
    {
        if (!session('id_antrian')) {
            session()->set('id_antrian', $this->request->uri->getSegment('3'));
        }
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Keranjang',
            'antrian' => $this->db->table('tbl_antrian')
                // ->join('tbl_antrian', 'tbl_antrian.id_antrian = tbl_transaksi.id_antrian')
                ->join('tbl_detail_pelanggan', 'tbl_detail_pelanggan.id_user = tbl_antrian.id_user', 'left')
                ->where('tbl_antrian.id_antrian', $this->request->uri->getSegment('3'))
                ->get()->getResultArray()[0],
            'bb' => $this->db->table('tbl_bb')->where('id_bb', session('data_user')['id_bb'])->get()->getResultArray()[0],
            'menu' => $this->ModelMenu->where('id_bb', session('data_user')['id_bb'])->findAll(),
            'keranjang' => $this->ModelDetailTransaksi
                ->join('tbl_menu', 'tbl_menu.id_menu=tbl_detail_transaksi.id_menu')
                ->join('tbl_transaksi', 'tbl_transaksi.id_transaksi=tbl_detail_transaksi.id_transaksi')
                ->where('id_antrian', session('id_antrian'))->findAll(),
        ];
        return view('admin/view_detail_antrian', $data);
    }

    public function tambah_keranjang()
    {
        if (!$this->validate([
            'pilih_menu' => [
                'label' => 'Menu',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_natural_no_zero' => '{field} tidak valid'
                ]
            ],
            'jumlah_dt' => [
                'label' => 'Jumlah',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_natural_no_zero' => '{field} tidak valid'
                ]
            ],
        ])) {
            return redirect()->to(base_url('antrian/detail_keranjang') . '/' . session('id_antrian'))->with('danger', 'Data tidak sesuai');
        }
        $dtAntrian = $this->ModelAntrian->find(session('id_antrian'));
        if (empty($dtAntrian)) {
            session()->setFlashdata('danger', 'Data antrian tidak valid');
            return $this->redirect();
        }
        if ($dtAntrian['status_antrian'] != 'Diproses') {
            session()->setFlashdata('danger', 'Data harus dalam status diproses');
            return $this->redirect();
        }
        $cek_menu = $this->ModelMenu->find($this->request->getPost('pilih_menu'));
        if (empty($cek_menu)) {
            return redirect()->to(base_url('antrian/detail_keranjang') . '/' . session('id_antrian'))->with('danger', 'Data tidak ada');
        }
        $cek_data_transaksi = $this->ModelTransaksi->where('id_antrian', session('id_antrian'))->first();
        if (empty($cek_data_transaksi)) {
            $data = [
                'id_antrian' => session('id_antrian'),
                'id_bb' => session('data_user')['id_bb'],
                'tanggal_transaksi' => date('Y-m-d H:i:s')
            ];
            if ($this->ModelTransaksi->insert($data)) {
                $cek_data_transaksi = $this->ModelTransaksi->where('id_antrian', session('id_antrian'))->first();
            }
        }

        $cek_data_keranjang = $this->ModelDetailTransaksi->where('id_menu', $cek_menu['id_menu'])->where('id_transaksi', $cek_data_transaksi['id_transaksi'])->first();

        if (empty($cek_data_keranjang)) {
            $data = [
                'id_menu' => $cek_menu['id_menu'],
                'id_transaksi' => $cek_data_transaksi['id_transaksi'],
                'jumlah_dt' => $this->request->getPost('jumlah_dt'),
                'harga_dt' => $cek_menu['harga_menu'],
            ];

            if ($this->ModelDetailTransaksi->insert($data)) {
                return redirect()->to(base_url('antrian/detail_keranjang') . '/' . session('id_antrian'))->with('success', 'Data berhasil dimasukkan');
            }
        } else {
            $data['jumlah_dt'] = $cek_data_keranjang['jumlah_dt'] + $this->request->getPost('jumlah_dt');
            if ($this->ModelDetailTransaksi->update($cek_data_keranjang['id_dt'], $data)) {
                return redirect()->to(base_url('antrian/detail_keranjang') . '/' . session('id_antrian'))->with('success', 'Data berhasil dimasukkan');
            }
        }
    }

    public function hapus_keranjang()
    {
        // Chek pengiriman data id detail transaksi melalui url
        if (!$this->request->uri->getSegment(3)) {
            return redirect()->to(base_url('antrian/detail_keranjang') . '/' . session('id_antrian'))->with('danger', 'Data tidak valid');
        }
        $idAntrian = session('id_antrian');
        $idKeranjang = $this->request->uri->getSegment(3);
        // Chek data keranjang
        $dtKeranjang = $this->ModelDetailTransaksi
            ->join('tbl_transaksi', 'tbl_transaksi.id_transaksi=tbl_detail_transaksi.id_transaksi')
            ->join('tbl_antrian', 'tbl_transaksi.id_antrian=tbl_antrian.id_antrian')
            ->where('tbl_antrian.id_antrian', $idAntrian)
            ->where('id_dt', $idKeranjang)
            ->first();
        if (empty($dtKeranjang)) {
            return redirect()->to(base_url('antrian/detail_keranjang') . '/' . session('id_antrian'))->with('danger', 'Data tidak valid');
        }
        // Hapus data keranjang
        if ($this->ModelDetailTransaksi->delete($idKeranjang)) {
            return redirect()->to(base_url('antrian/detail_keranjang') . '/' . session('id_antrian'))->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->to(base_url('antrian/detail_keranjang') . '/' . session('id_antrian'))->with('danger', 'Data gagal dihapus');
        }
    }

    public function Batal($idAntrian)
    {
        $dtAntrian = $this->ModelAntrian->where('id_bb', session('data_user')['id_bb'])->where('id_antrian', $idAntrian)->first();
        if (empty($dtAntrian)) {
            session()->setFlashdata('danger', 'Data antrian tidak valid');
            return $this->redirect();
        }
        if ($dtAntrian['status_antrian'] != 'Diproses') {
            session()->setFlashdata('danger', 'Data antrian harus dalam status diproses');
            return $this->redirect();
        }
        if ($this->ModelAntrian->delete($idAntrian)) {
            session()->setFlashdata('success', 'Data antrian ' . $dtAntrian['no_antrian'] . ' berhasil dihapus');
        } else {
            session()->setFlashdata('success', 'Data antrian ' . $dtAntrian['no_antrian'] . ' berhasil dihapus');
        }
        return $this->redirect();
    }

    public function Selesai($idAntrian)
    {
        $dtAntrian = $this->ModelAntrian->where('id_bb', session('data_user')['id_bb'])->where('id_antrian', $idAntrian)->first();
        if (empty($dtAntrian)) {
            session()->setFlashdata('danger', 'Data antrian tidak valid');
            return $this->redirect();
        }
        if ($dtAntrian['status_antrian'] != 'Diproses') {
            session()->setFlashdata('danger', 'Data antrian harus dalam status diproses');
            return $this->redirect();
        }
        $dtTransaksi = $this->ModelTransaksi->where('id_antrian', $idAntrian)->first();
        if (empty($dtTransaksi)) {
            session()->setFlashdata('danger', 'Data transaksi tidak boleh kosong');
            return $this->redirect();
        }
        $dtDetailTransaksi = $this->ModelDetailTransaksi->where('id_transaksi', $dtTransaksi['id_transaksi'])->findAll();
        if (count($dtDetailTransaksi) == 0) {
            session()->setFlashdata('danger', 'Data transaksi tidak boleh kosong');
            return $this->redirect();
        }
        $data = [
            'status_antrian' => 'Selesai'
        ];
        if ($this->ModelAntrian->update($idAntrian, $data)) {
            session()->setFlashdata('success', 'Antrian ' . $dtAntrian['no_antrian'] . ' berhasil diselesaikan');
        } else {
            session()->setFlashdata('danger', 'Antrian ' . $dtAntrian['no_antrian'] . ' gagal diselesaikan');
        }
        return $this->redirect();
    }
}
