<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAntrian extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_antrian';
    protected $primaryKey       = 'id_antrian';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_antrian', 'id_user', 'id_bb', 'no_antrian', 'status_antrian', 'tgl_antrian'];

    public function getAntrian($id_bb)
    {
        $dtAntrianNow = $this->select("no_antrian")
            ->where('status_antrian', 'Diproses')
            ->where('id_bb', $id_bb)
            ->where('date(tgl_antrian)', date("Y-m-d"))
            ->orderBy('id_antrian', 'desc')
            ->first();
        if (empty($dtAntrianNow)) {
            $dtAntrianSelesai = $this->select("no_antrian")
                ->where('status_antrian', 'Selesai')
                ->where('id_bb', $id_bb)
                ->where('date(tgl_antrian)', date("Y-m-d"))
                ->orderBy('id_antrian', 'desc')
                ->first();
            if (empty($dtAntrianSelesai)) {
                $dtAntrianNow = 0;
            } else {
                $dtAntrianNow = $dtAntrianSelesai['no_antrian'];
            }
        } else {
            $dtAntrianNow = $dtAntrianNow['no_antrian'];
        }
        $dtLastAntran = $this->select("no_antrian")
            ->where('id_bb', $id_bb)
            ->where('date(tgl_antrian)', date("Y-m-d"))
            ->orderBy('id_antrian', 'desc')
            ->first();
        if (empty($dtLastAntran)) {
            $dtLastAntran = 0;
        } else {
            $dtLastAntran = $dtLastAntran['no_antrian'];
        }
        return [
            'antrian_sekarang' => $dtAntrianNow,
            'antrian_total' => $dtLastAntran
        ];
    }
}
