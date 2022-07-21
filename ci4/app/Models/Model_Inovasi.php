<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Inovasi extends Model
{
    protected $table      = 'tb_inovasi';
    protected $primaryKey = 'inovasi_id';
    protected $allowedFields = ['inovasi_judul', 'inovasi_isi'];

    public function list()
    {
        return $this->table('tb_inovasi')
            ->orderBy('inovasi_id', 'DESC')
            ->get()->getResultArray();
    }

}
