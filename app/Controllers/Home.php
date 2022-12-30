<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => (session('errors')) ? session('errors') : \Config\Services::validation()
        ];
        return view('view_home', $data);
    }
}
