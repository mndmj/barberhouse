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
            ->where('role', '2')->where('token is null')->first();
        if (empty($dtPelanggan)) {
            return $this->setError("Data pengguna tidak ditemukan");
        }
        $dtAntrian = $this->ModelAntrian->where('id_user', $this->request->getPost('id_user'))
            ->where('date(tgl_antrian)', date("Y-m-d"))
            ->where('status_antrian != "Selesai"')
            ->first();
        if (empty($dtAntrian)) {
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
            ->where('role', '2')->where('token is null')->first();
        if (empty($dtPelanggan)) {
            return $this->setError("Data pengguna tidak ditemukan");
        }
        $dtAntrian = $this->ModelAntrian->where('id_user', $this->request->getPost('id_user'))
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
            'status_antrian' => $dtAntrian['status_antrian']
        ]);
    }
}
