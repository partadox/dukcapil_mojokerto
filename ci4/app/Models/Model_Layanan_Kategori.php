<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Layanan_Kategori extends Model
{
    protected $table      = 'tb_layanan_kategori';
    protected $primaryKey = 'LK_id';
    protected $allowedFields = ['LK_nama', 'LK_slug'];

    public function list()
    {
        return $this->table('tb_layanan_kategori')
            ->orderBy('LK_id', 'DESC')
            ->get()->getResultArray();
    }

    public function cek_layanan_kategori($LK_slug)
    {
        return $this->table('tb_layanan_kategori')
            ->where('LK_slug', $LK_slug)
            ->countAllResults();
    }

    public function single_layanan_kategori($LK_slug)
    {
        return $this->table('tb_layanan_kategori')
            ->where('LK_slug', $LK_slug)
            ->get()->getRow();
    }

}
