<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Berita extends Model
{
    protected $table      = 'tb_berita';
    protected $primaryKey = 'berita_id';
    protected $allowedFields = ['berita_judul', 'berita_slug', 'berita_isi', 'berita_pin','berita_status', 'berita_sampul', 'berita_create_dt', 'berita_create_tm', 'berita_creator', 'berita_modified_dt', 'berita_modified_tm', 'berita_modified_author'];

    public function list()
    {
        return $this->table('tb_berita')
            ->orderBy('berita_id', 'DESC')
            ->get()->getResultArray();
    }

    public function list_top6()
    {
        return $this->table('tb_berita')
            ->orderBy('berita_id', 'DESC')
            ->where('berita_status', 'PUBLISH')
            ->limit(6)
            ->get()->getResultArray();
    }

    public function cek_single_berita($berita_slug)
    {
        return $this->table('tb_berita')
            ->where('berita_slug', $berita_slug)
            ->countAllResults();
    }

    public function single_berita($berita_slug)
    {
        return $this->table('tb_berita')
            ->where('berita_slug', $berita_slug)
            ->get()->getRow();
    }
    
    public function berita_pin()
    {
        return $this->table('tb_berita')
            ->orderBy('berita_id', 'DESC')
            ->where('berita_status', 'PUBLISH')
            ->where('berita_pin', 1)
            ->get()->getResultArray();
    }
    // public function published()
    // {
    //     return $this->table('berita')
    //         ->join('user', 'user.user_id = berita.user_id')
    //         ->join('kategori', 'kategori.kategori_id = berita.kategori_id')
    //         ->where('status', 'published')
    //         ->orderBy('berita_id', 'ASC')
    //         ->get()->getResultArray();
    // }

    // public function detail_berita($slug_berita)
    // {
    //     return $this->table('berita')
    //         ->join('user', 'user.user_id = berita.user_id')
    //         ->join('kategori', 'kategori.kategori_id = berita.kategori_id')
    //         ->where('slug_berita', $slug_berita)
    //         ->get()->getRow();
    // }
}
