<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class Admin extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Dashboard Admin',
        ];
        return view('admin/view_dashboard', $data);
    }
}
