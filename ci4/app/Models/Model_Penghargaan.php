<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Penghargaan extends Model
{
    protected $table      = 'tb_penghargaan';
    protected $primaryKey = 'penghargaan_id';
    protected $allowedFields = ['penghargaan_nama', 'penghargaan_gambar','penghargaan_deskripsi', 'penghargaan_pin', 'penghargaan_slug'];

    public function list()
    {
        return $this->table('tb_penghargaan')
            ->orderBy('penghargaan_id', 'DESC')
            ->get()->getResultArray();
    }

    public function penghargaan_pin()
    {
        return $this->table('tb_penghargaan')
            ->orderBy('penghargaan_id', 'DESC')
            ->where('penghargaan_pin', 1)
            ->get()->getResultArray();
    }

    public function cek_single_penghargaan($penghargaan_slug)
    {
        return $this->table('tb_penghargaan')
            ->where('penghargaan_slug', $penghargaan_slug)
            ->countAllResults();
    }

    public function single_penghargaan($penghargaan_slug)
    {
        return $this->table('tb_penghargaan')
            ->where('penghargaan_slug', $penghargaan_slug)
            ->get()->getRow();
    }

}
