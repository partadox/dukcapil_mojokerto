<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Visitor extends Model
{
    protected $table      = 'tb_visitor';
    protected $primaryKey = 'visitor_id';
    protected $allowedFields = ['visitor_ip', 'visitor_dt', 'visitor_tm'];

    public function cek_visitor($dt, $ip)
    {
        return $this->table('tb_visitor')
            ->where('visitor_ip ', $ip)
            ->where('visitor_dt ', $dt)
            ->countAllResults();
    }

    public function count_visitor()
    {
        return $this->table('tb_visitor')
            ->select('visitor_dt as tanggal, COUNT(visitor_ip) as total')
            ->groupBy('visitor_dt')
            ->get()->getResultArray();
    }

    public function count_visitor_bulan_ini()
    {
        return $this->table('tb_visitor')
            ->select('COUNT(*) as total, SUM(DATE_FORMAT(visitor_dt, "%Y-%m-01") = DATE_FORMAT(CURRENT_DATE(), "%Y-%m-01")) AS bulanini')
            ->get()->getResultArray();
    }

    public function count_visitor_tahun_ini()
    {
        return $this->table('tb_visitor')
            ->select('visitor_dt')
            ->where('YEAR(visitor_dt) = YEAR(CURDATE())')
            ->countAllResults();
    }

    public function count_visitor_hari_ini()
    {
        return $this->table('tb_visitor')
            ->select('visitor_dt')
            ->where('visitor_dt = CURDATE()')
            ->countAllResults();
    }

}
