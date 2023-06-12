<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAntrian;

class BeliItem extends BaseController
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
            'subtitle' => 'Beli Item',
            'antrian' => $this->db->table('tbl_antrian')
                ->join('tbl_user', 'tbl_antrian.id_user = tbl_user.id_user', 'left')
                ->join('tbl_detail_pelanggan', 'tbl_antrian.id_user = tbl_detail_pelanggan.id_user', 'left')
                ->where('id_bb', session('data_user')['id_bb'])
                ->having('date(tgl_antrian)', date('Y-m-d'))->get()->getResultArray(),
        ];
        return view('admin/view_transaksi', $data);
    }
}
