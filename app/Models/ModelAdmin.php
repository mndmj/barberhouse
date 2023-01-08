<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    public function totalMenu($id_bb)
    {
        return $this->db->table('tbl_menu')->where('id_bb', $id_bb)->countAllResults(); 
    }
}
