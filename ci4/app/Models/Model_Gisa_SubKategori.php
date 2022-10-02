<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Gisa_SubKategori extends Model
{
    protected $table      = 'tb_gisa_subskategori';
    protected $primaryKey = 'GKS_id';
    protected $allowedFields = ['GKS_kategori_id','GKS_nama', 'GKS_slug'];

    public function list()
    {
        return $this->table('tb_gisa_subskategori')
            ->join('tb_gisa_kategori', 'tb_gisa_kategori.GK_id = tb_gisa_subskategori.GKS_kategori_id')
            ->orderBy('GKS_id', 'DESC')
            ->get()->getResultArray();
    }

    public function list_GK_id($GK_id)
    {
        return $this->table('tb_gisa_subskategori')
            ->where('GKS_kategori_id', $GK_id)
            ->get()->getResultArray();
    }

    public function cek_gisa_kategori($GK_id)
    {
        return $this->table('tb_gisa_subskategori')
            ->where('GKS_kategori_id', $GK_id)
            ->countAllResults();
    }

    public function cek_gisa_subkategori($GKS_slug)
    {
        return $this->table('tb_gisa_subskategori')
            ->where('GKS_slug', $GKS_slug)
            ->countAllResults();
    }

    public function gisa_kategori_id($GKS_slug)
    {
        return $this->table('tb_gisa_subskategori')
            ->select('GKS_id') 
            ->where('GKS_slug', $GKS_slug)
            ->get()->getUnbufferedRow();
    }

    

    public function single_gisa_kategori($GKS_slug)
    {
        return $this->table('tb_gisa_subskategori')
            ->where('GKS_slug', $GKS_slug)
            ->get()->getRow();
    }

}
