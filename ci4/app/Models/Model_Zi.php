<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Zi extends Model
{
    protected $table      = 'tb_zi';
    protected $primaryKey = 'zi_id';
    protected $allowedFields = ['zi_nama', 'zi_file'];

    public function list()
    {
        return $this->table('tb_zi')
            ->orderBy('zi_id', 'DESC')
            ->get()->getResultArray();
    }

}
