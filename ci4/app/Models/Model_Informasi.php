<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Informasi extends Model
{
    protected $table      = 'tb_informasi';
    protected $primaryKey = 'informasi_id';
    protected $allowedFields = ['informasi_variabel', 'informasi_value'];

    public function list()
    {
        return $this->table('tb_informasi')
            ->orderBy('informasi_id', 'DESC')
            ->get()->getResultArray();
    }
}
