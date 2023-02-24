<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BB extends BaseController
{
    private $db = null;

    function __construct()
    {
        $this->db = \config\Database::connect();
    }
    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Informasi',
        ];
        return view('admin/view_bb', $data);
    }
}
