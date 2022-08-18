<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Gisa extends Model
{
    protected $table      = 'tb_gisa';
    protected $primaryKey = 'gisa_id';
    protected $allowedFields = ['gisa_kategori', 'gisa_subkategori', 'gisa_slug','gisa_file'];

    public function list()
    {
        return $this->table('tb_gisa')
            ->join('tb_gisa_kategori', 'tb_gisa_kategori.GK_id = tb_gisa.gisa_kategori')
            ->orderBy('gisa_id', 'DESC')
            ->get()->getResultArray();
    }

    public function gisa_data($gisa_slug)
    {
        return $this->table('tb_gisa')
            ->where('gisa_slug', $gisa_slug)
            ->get()->getRow();
    }

    public function cek_gisa($GK_id)
    {
        return $this->table('tb_gisa')
            ->where('gisa_kategori', $GK_id)
            ->countAllResults();
    }

    public function list_GK_id($GK_id)
    {
        return $this->table('tb_gisa')
            ->where('gisa_kategori', $GK_id)
            ->get()->getResultArray();
    }

}
