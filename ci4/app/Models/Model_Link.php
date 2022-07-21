<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Link extends Model
{
    protected $table      = 'tb_link';
    protected $primaryKey = 'link_id';
    protected $allowedFields = ['link_nama', 'link_gambar', 'link_url', 'link_status'];

    public function list()
    {
        return $this->table('tb_link')
            ->orderBy('link_id', 'DESC')
            ->get()->getResultArray();
    }
}
