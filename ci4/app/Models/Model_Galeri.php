<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Galeri extends Model
{
    protected $table      = 'tb_galeri';
    protected $primaryKey = 'galeri_id';
    protected $allowedFields = ['galeri_nama', 'galeri_slug', 'galeri_create_dt', 'galeri_create_tm', 'galeri_modified_dt',  'galeri_modified_tm', 'galeri_modified_author', 'galeri_sampul', 'galeri_creator'];

    //backend
    public function list()
    {
        return $this->table('tb_galeri')
            ->orderBy('galeri_id', 'DESC')
            ->get()->getResultArray();
    }
    public function list_top3()
    {
        return $this->table('tb_galeri')
            ->orderBy('galeri_id', 'DESC')
            ->limit(3)
            ->get()->getResultArray();
    }
    public function listjoin()
    {
        return $this->table('tb_galeri')
            ->select('*')
            ->join('tb_galeri_foto', 'tb_galeri_foto.foto_galeri_id = tb_galeri.galeri_id', 'left')
            ->get()->getResultArray();
    }

    public function jumlahfoto()
    {
        return $this->table('tb_galeri')
            ->select('*')
            ->selectCount('tb_galeri_foto.foto_galeri_id', 'jumlah_foto')
            ->join('tb_galeri_foto', 'tb_galeri_foto.foto_galeri_id = tb_galeri.galeri_id', 'left')
            ->groupBy('tb_galeri.galeri_id')
            ->orderBy('tb_galeri.galeri_id', 'asc')
            ->get()->getResultArray();
    }

    //frontend
    // public function detail_gallery($id)
    // {
    //     return $this->table('tb_galeri')
    //         ->join('user', 'user.user_id = gallery.user_id')
    //         ->where('galeri_id', $id)
    //         ->get()->getRow();
    // }

    public function cek_single_galeri($galeri_slug)
    {
        return $this->table('tb_galeri')
            ->where('galeri_slug', $galeri_slug)
            ->countAllResults();
    }

    public function single_galeri($galeri_slug)
    {
        return $this->table('tb_galeri')
            ->where('galeri_slug', $galeri_slug)
            ->get()->getRow();
    }

}
