<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Layanan extends Model
{
    protected $table      = 'tb_layanan';
    protected $primaryKey = 'layanan_id';
    protected $allowedFields = ['layanan_kategori', 'layanan_subkategori', 'layanan_slug','layanan_deskripsi'];

    public function list()
    {
        return $this->table('tb_layanan')
            ->join('tb_layanan_kategori', 'tb_layanan_kategori.LK_id = tb_layanan.layanan_kategori')
            ->orderBy('layanan_id', 'DESC')
            ->get()->getResultArray();
    }

    public function layanan_data($layanan_slug)
    {
        return $this->table('tb_layanan')
            ->where('layanan_slug', $layanan_slug)
            ->get()->getRow();
    }

    public function cek_layanan($layanan_slug)
    {
        return $this->table('tb_layanan')
            ->where('layanan_slug', $layanan_slug)
            ->countAllResults();
    }

    public function list_layanan_kategori($LK_id)
    {
        return $this->table('tb_layanan')
            ->where('layanan_kategori', $LK_id)
            ->get()->getResultArray();
    }

}
