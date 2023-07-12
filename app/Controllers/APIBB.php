<?php

namespace App\Controllers;

use App\Models\ModelBB;
use CodeIgniter\RESTful\ResourceController;

class APIBB extends ResourceController
{
    private $ModelBB = null;

    public function __construct()
    {
        $this->ModelBB = new ModelBB();
    }

    public function index()
    {
        return view('errors/html/error_404');
    }

    public function getDataBB()
    {
        return $this->respond(
            $this->ModelBB
                ->select('id_bb,nama_bb,foto_bb,alamat_bb,telepon_bb,latitude,longitude,jam_buka,jam_tutup,ket_bb')
                ->findAll()
        );
    }
}
