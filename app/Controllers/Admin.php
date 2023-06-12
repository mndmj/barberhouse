<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;
use App\Models\ModelAdmin;

class Admin extends BaseController
{
    private $ModelUser = null;
    private $ModelAdmin = null;

    public function __construct()
    {
        helper('form');
        $this->ModelUser = new ModelUser();
        $this->ModelAdmin = new ModelAdmin();
    }

    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Dashboard Admin',
            'menu' => $this->ModelAdmin->totalMenu(session('data_user')['id_bb']),
            'antriOff' => $this->ModelAdmin->totalAntriOff(session('data_user')),
        ];
        return view('admin/view_dashboard', $data);
    }
}
