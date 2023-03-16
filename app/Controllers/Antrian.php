<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAntrian;

class Antrian extends BaseController
{
    private $db = null;
    private $ModelAntrian = null;

    function __construct()
    {
        $this->db = \config\Database::connect();
        $this->ModelAntrian = new ModelAntrian();
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
        // ambil seluruh data per hari
        $data_antrian = $this->ModelAntrian->where('id_bb', session('data_user')['id_bb'])
            ->having('date(tgl_antrian)', date('Y-m-d'))
            ->findAll();

        // hitung seluruh data & tambah antrian baru
        $antrian_baru = count($data_antrian) + 1;

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
}
