<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    public function totalMenu($id_bb)
    {
        $menu = new ModelMenu();
        return count($menu->where('id_bb', session('data_user')['id_bb'])->findAll());
    }

    public function totalAntriOff($id_bb)
    {
        $antrian = new ModelAntrian();
        return count($antrian
            ->where('id_bb', session('data_user')['id_bb'])
            ->where('status_antrian', 'Menunggu')
            ->where('id_user is null')
            ->where('date(tgl_antrian)', date('Y-m-d'))
            ->findAll());
    }
    public function totalAntriOn($id_bb)
    {
        $antrian = new ModelAntrian();
        return count($antrian
            ->where('id_bb', session('data_user')['id_bb'])
            ->where('id_user is not null')
            ->where('date(tgl_antrian)', date('Y-m-d'))
            ->findAll());
    }
}
