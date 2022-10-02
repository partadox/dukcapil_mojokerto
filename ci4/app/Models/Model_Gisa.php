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
            ->join('tb_gisa_subskategori', 'tb_gisa_subskategori.GKS_id = tb_gisa.gisa_kategori')
            ->join('tb_gisa_kategori', 'tb_gisa_kategori.GK_id = tb_gisa_subskategori.GKS_kategori_id')
            ->orderBy('gisa_id', 'DESC')
            ->get()->getResultArray();
    }

    public function gisa_data($GK_id, $GKS_id, $gisa_slug)
    {
        return $this->table('tb_gisa')
            ->join('tb_gisa_subskategori', 'tb_gisa_subskategori.GKS_id = tb_gisa.gisa_kategori')
            ->join('tb_gisa_kategori', 'tb_gisa_kategori.GK_id = tb_gisa_subskategori.GKS_kategori_id')
            ->where('GK_id', $GK_id)
            ->where('GKS_id', $GKS_id)
            ->where('gisa_slug', $gisa_slug)
            ->get()->getRow();
    }

    public function cek_gisa($GKS_id)
    {
        return $this->table('tb_gisa')
            ->where('gisa_kategori', $GKS_id)
            ->countAllResults();
    }

    public function cek2_gisa($gisa_slug)
    {
        return $this->table('tb_gisa')
            ->where('gisa_slug', $gisa_slug)
            ->countAllResults();
    }

    public function list_GK_GKS($GK_id, $GKS_id)
    {
        return $this->table('tb_gisa')
            ->join('tb_gisa_subskategori', 'tb_gisa_subskategori.GKS_id = tb_gisa.gisa_kategori')
            ->join('tb_gisa_kategori', 'tb_gisa_kategori.GK_id = tb_gisa_subskategori.GKS_kategori_id')
            ->where('GK_id', $GK_id)
            ->where('GKS_id', $GKS_id)
            ->get()->getResultArray();
    }

    

}
