<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Medfo extends Model
{
    protected $table      = 'tb_medfo';
    protected $primaryKey = 'medfo_id';
    protected $allowedFields = ['medfo_nama', 'medfo_isi'];

    public function list()
    {
        return $this->table('tb_medfo')
            ->orderBy('medfo_id', 'DESC')
            ->get()->getResultArray();
    }

    public function alur_adu()
    {
        return $this->table('tb_medfo')
            ->where('medfo_id', 1)
            ->get()->getRow();
    }

    public function ikm()
    {
        return $this->table('tb_medfo')
            ->where('medfo_id', 2)
            ->get()->getRow();
    }

}
