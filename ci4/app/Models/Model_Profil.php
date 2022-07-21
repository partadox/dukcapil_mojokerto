<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Profil extends Model
{
    protected $table      = 'tb_profil';
    protected $primaryKey = 'profil_id';
    protected $allowedFields = ['profil_variabel', 'profil_value'];

}
