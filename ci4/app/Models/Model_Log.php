<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Log extends Model
{
    protected $table      = 'tb_log';
    protected $primaryKey = 'log_id';
    protected $allowedFields = ['log_user', 'log_aktivitas', 'log_status', 'log_dt', 'log_tm'];

    //backend
    public function list()
    {
        return $this->table('tb_log')
            ->orderBy('log_id', 'DESC')
            ->get()->getResultArray();
    }
   
}
