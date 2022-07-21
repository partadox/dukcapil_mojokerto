<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Pengumuman extends Model
{
    protected $table      = 'tb_pengumuman';
    protected $primaryKey = 'pengumuman_id';
    protected $allowedFields = ['pengumuman_judul', 'pengumuman_slug', 'pengumuman_isi', 'pengumuman_pin','pengumuman_status', 'pengumuman_create_dt', 'pengumuman_create_tm', 'pengumuman_creator', 'pengumuman_modified_dt', 'pengumuman_modified_tm', 'pengumuman_modified_author'];

    public function list()
    {
        return $this->table('tb_pengumuman')
            ->orderBy('pengumuman_id', 'DESC')
            ->get()->getResultArray();
    }

    public function list_top3()
    {
        return $this->table('tb_pengumuman')
            ->orderBy('pengumuman_id', 'DESC')
            ->where('pengumuman_status', 'PUBLISH')
            ->limit(3)
            ->get()->getResultArray();
    }

    public function cek_single_pengumuman($pengumuman_slug)
    {
        return $this->table('tb_pengumuman')
            ->where('pengumuman_slug', $pengumuman_slug)
            ->countAllResults();
    }

    public function single_pengumuman($pengumuman_slug)
    {
        return $this->table('tb_pengumuman')
            ->where('pengumuman_slug', $pengumuman_slug)
            ->get()->getRow();
    }

    public function pengumuman_pin()
    {
        return $this->table('tb_pengumuman')
            ->orderBy('pengumuman_id', 'DESC')
            ->where('pengumuman_status', 'PUBLISH')
            ->where('pengumuman_pin', 1)
            ->get()->getResultArray();
    }
}
