<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    public function totalMenu()
    {
        return $this->db->table('tbl_menu')->countAllResults();;
    }
}
