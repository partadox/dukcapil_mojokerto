<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Galeri_Foto extends Model
{
    protected $table      = 'tb_galeri_foto';
    protected $primaryKey = 'foto_id';
    protected $allowedFields = ['foto_keterangan', 'foto_nama', 'foto_galeri_id'];

    //backend
    public function list($galeri_id)
    {
        return $this->table('tb_galeri_foto')
            ->where('foto_galeri_id', $galeri_id)
            ->orderBy('foto_id', 'DESC')
            ->get()->getResultArray();
    }

    public function hapusfoto($galeri_id)
    {
        return $this->table('tb_galeri_foto')
            ->where('foto_galeri_id', $galeri_id)
            ->get()->getResultArray();
    }

    public function hapusket($galeri_id)
    {
        return $this->table('tb_galeri_foto')
            ->where('foto_galeri_id', $galeri_id)
            ->delete();
    }

    // public function detail_foto($id)
    // {
    //     return $this->table('tb_galeri_foto')
    //         ->where('foto_galeri_id', $id)
    //         ->orderBy('foto_id', 'ASC')
    //         ->get()->getResultArray();
    // }

    public function single_galeri($galeri_id)
    {
        return $this->table('tb_galeri')
            ->where('foto_galeri_id', $galeri_id)
            ->orderBy('foto_id', 'ASC')
            ->get()->getResultArray();
    }
}
