<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAntrian;
use App\Models\ModelBB;
use App\Models\ModelUser;
use CodeIgniter\RESTful\ResourceController;

class APIAntrian extends ResourceController
{
    private $ModelAntrian = null;
    private $ModelUser = null;
    private $ModelBB = null;

    public function __construct()
    {
        $this->ModelAntrian = new ModelAntrian();
        $this->ModelUser = new ModelUser();
        $this->ModelBB = new ModelBB();
    }

    public function index()
    {
        return view('errors/html/error_404');
    }

    public function getantrianbybb()
    {
        if (!$this->validate([
            'id_bb' => 'required|is_natural_no_zero'
        ])) {
            return $this->setError("Data barber tidak valid");
        }
        $dtBB = $this->ModelBB->find($this->request->getPost('id_bb'));
        if (empty($dtBB)) {
            return $this->setError("Data barber tidak ditemukan");
        }
        return $this->respond($this->ModelAntrian->getAntrian($this->request->getPost('id_bb')));
    }

    public function isonqueue()
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
        if (!$this->ModelAntrian->isOnQueue($this->request->getPost('id_user'))) {
            $data = [
                'success' => false,
                'msg' => 'Anda tidak terdaftar dalam antrian.'
            ];
        } else {
            $data = [
                'success' => true,
                'msg' => 'Anda masih terdaftar dalam antrian.'
            ];
        }
        return $this->respond($data);
    }

    public function getmyantrian()
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
        $dtAntrian = $this->ModelAntrian
            ->join('tbl_bb', 'tbl_bb.id_bb = tbl_antrian.id_bb')
            ->where('id_user', $this->request->getPost('id_user'))
            ->where('date(tgl_antrian)', date("Y-m-d"))
            ->where('status_antrian != "Selesai"')
            ->first();
        if (empty($dtAntrian)) {
            return $this->setError("Anda tidak terdaftar antrian");
        }
        $dtAntrianByBB = $this->ModelAntrian->getAntrian($dtAntrian['id_bb']);
        return $this->respond([
            'antrian_sekarang' => $dtAntrianByBB['antrian_sekarang'],
            'antrian_saya' => $dtAntrian['no_antrian'],
            'status_antrian' => $dtAntrian['status_antrian'],
            'namaBB' => $dtAntrian['nama_bb']
        ]);
    }

    public function regist()
    {
        if (!$this->validate([
            'id_user' => 'required|is_natural_no_zero',
            'id_bb' => 'required|is_natural_no_zero'
        ])) {
            return $this->setError("Data pelanggan tidak valid");
        }
        $dtPelanggan = $this->ModelUser->where('id_user', $this->request->getPost('id_user'))
            ->where('id_role', '2')->where('token is null')->first();
        if (empty($dtPelanggan)) {
            return $this->setError("Data pengguna tidak ditemukan");
        }
        $dtBB = $this->ModelBB->where('id_bb', $this->request->getPost('id_bb'))->first();
        if (empty($dtBB)) {
            return $this->setError("Data barber tidak ditemukan");
        }
        if ($this->ModelAntrian->isOnQueue($this->request->getPost('id_user'))) {
            return $this->setError("Anda sudah terdaftar antrian sebelumnya. Pendaftaran antrian saat ini gagal.");
        }
        $lastAntrian = $this->ModelAntrian->where('id_bb', $this->request->getPostGet('id_bb'))
            ->where('date(tgl_antrian)', date("Y-m-d"))
            ->orderBy('id_antrian', 'desc')->first();
        if (empty($lastAntrian)) {
            $no_antrian = 1;
        } else {
            $no_antrian = $lastAntrian['no_antrian'] + 1;
        }
        $data = [
            'id_user' => $this->request->getPost('id_user'),
            'id_bb' => $this->request->getPost('id_bb'),
            'no_antrian' => $no_antrian,
            'status_antrian' => 'Menunggu',
            'tgl_antrian' => date("Y-m-d H:i:s")
        ];
        $this->ModelAntrian->insert($data);
        if ($this->ModelAntrian->isOnQueue($this->request->getPost('id_user'))) {
            $data = [
                'success' => true,
                'msg' => 'Anda berhasil mendaftar antrian dengan nomor antrian ' . $no_antrian
            ];
        } else {
            $data = [
                'success' => false,
                'msg' => 'Anda gagal mendaftar antrian karena kesalahan sistem. Silahkan coba lagi nanti'
            ];
        }
        return $this->respond($data);
    }
}
