<?php

namespace App\Controllers;

use App\Models\ModelAntrian;
use App\Models\ModelBB;
use App\Models\ModelUser;
use CodeIgniter\RESTful\ResourceController;

class APIBB extends ResourceController
{
    private $ModelBB = null;
    private $ModelUser = null;
    private $ModelAntrian = null;

    public function __construct()
    {
        $this->ModelBB = new ModelBB();
        $this->ModelUser = new ModelUser();
        $this->ModelAntrian = new ModelAntrian();
    }

    public function index()
    {
        return view('errors/html/error_404');
    }

    public function getDataBB()
    {
        return $this->respond(
            $this->ModelBB
                ->select('id_bb, nama_bb, foto_bb, alamat_bb, telepon_bb, latitude, longitude, jam_buka, jam_tutup, ket_bb')
                ->findAll()
        );
    }

    public function get()
    {
        if (!$this->validate([
            'id_bb' => 'required|is_natural_no_zero'
        ])) {
            return $this->fail("Data tidak valid");
        }
        $dtBB = $this->ModelBB->select('id_bb, nama_bb, foto_bb, alamat_bb, telepon_bb, latitude, longitude, jam_buka, jam_tutup, ket_bb')
            ->find($this->request->getPost('id_bb'));
        if (empty($dtBB)) {
            return $this->fail("Data barber tidak ditemukan");
        }
        $dtBB['jam_buka'] = date("H:i", strtotime($dtBB['jam_buka']));
        $dtBB['jam_tutup'] = date("H:i", strtotime($dtBB['jam_tutup']));
        return $this->respond($dtBB);
    }

    public function search()
    {
        if (!$this->validate([
            'keyword' => 'required'
        ])) {
            return $this->fail("Data tidak valid");
        }
        $dtBarberByNama = $this->ModelBB->like('nama_bb', $this->request->getPost('keyword'))->findAll();
        $dtBarberByLoc = $this->ModelBB->like('alamat_bb', $this->request->getPost('keyword'))->findAll();
        return $this->respond(array_merge($dtBarberByNama, $dtBarberByLoc));
    }

    public function antrian()
    {
        $id_bb = $this->request->getPost('id_bb');
        $id_user = $this->request->getPost('id_user');

        $nama_user = $this->ModelUser->select('nama')->where('id_user', $id_user)->first()['nama'];
        //mengambil data antrian perhari
        $no = count($this->ModelAntrian->findAll());
        $data = [
            'status_antrian' => 'Menunggu',
            'id_user' => $id_user,
            'no_antrian' => ++$no,
            'nama' => $nama_user,
            'id_bb' => $id_bb,
        ];

        if ($this->ModelAntrian->insert($data)) {
            $data = [
                'success' => true,
                'msg' => "Berhasil tambah antrian, Nomor Antrian Anda $no"
            ];
        }
        return $this->respond($data);
    }

    public function jumlahAntrian()
    {
        //api untuk menghitung jumlah antrian
        $id_barber = $this->request->getPost('id_bb');
        $status = 'Menunggu';
        $no_antrian = $this->ModelAntrian
            ->where('statusantrian', $status)
            ->where('id_bb', $id_barber)
            ->countAllResults();
        $data = [
            'jumlah_antrian' => $no_antrian
        ];
        return $this->respond($data);
    }

    public function getAntrian()
    {
        // mengambil no antrian anda 
        $id_user = $this->request->getPost('id_user');
        $dtAntrian = $this->ModelAntrian->where('date(created_at)', date('Y-m-d'))
            ->where('id_user', $id_user)
            ->whereNotIn('status_antrian', ['Selesai'])
            ->first();
        if (!empty($dtAntrian)) {
            $data = [
                'no_antrian' => $dtAntrian['no_antrian'],
                'status_antrian' => $dtAntrian['status_antrian'],
                'id_bb' => $dtAntrian['id_bb'],
            ];
        } else {
            $data = null;
        }
        return $this->respond($data);
    }
}
