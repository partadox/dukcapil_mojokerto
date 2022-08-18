<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Gisa_Kategori extends Model
{
    protected $table      = 'tb_gisa_kategori';
    protected $primaryKey = 'GK_id';
    protected $allowedFields = ['GK_nama', 'GK_slug'];

    public function list()
    {
        return $this->table('tb_gisa_kategori')
            ->orderBy('GK_id', 'DESC')
            ->get()->getResultArray();
    }

    public function gisa_kategori_id($GK_slug)
    {
        return $this->table('tb_gisa_kategori')
            ->select('GK_id') 
            ->where('GK_slug', $GK_slug)
            ->get()->getUnbufferedRow();
    }

    public function cek_gisa_kategori($GK_slug)
    {
        return $this->table('tb_gisa_kategori')
            ->where('GK_slug', $GK_slug)
            ->countAllResults();
    }

    public function single_gisa_kategori($GK_slug)
    {
        return $this->table('tb_gisa_kategori')
            ->where('GK_slug', $GK_slug)
            ->get()->getRow();
    }

}
