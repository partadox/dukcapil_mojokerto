<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        $tes = $this->visitor->count_visitor();
		$tes1 = json_encode($tes);
        $d1 = array();
        $d2 = array();
        foreach ($tes as $item) {
             $d1[]  = $item['tanggal'];
             $d2[]  = intval($item['total']);
          }

        $tes3               = $this->visitor->count_visitor_bulan_ini();
        $visitor_bulanini   = $tes3['0']['bulanini'];
        $visitor_total      = $tes3['0']['total'];
        $visitor_tahunini   = $this->visitor->count_visitor_tahun_ini();
        $visitor_hariini    = $this->visitor->count_visitor_hari_ini();

        $data = [
            'title'             => 'Admin - Dashboard',
            'visitor_hariini'   => $visitor_hariini,
            'visitor_bulanini'  => $visitor_bulanini,
            'visitor_tahunini'  => $visitor_tahunini,
            'visitor_total'     => $visitor_total,
            'berita'            => $this->berita->count_berita(),
            'galeri'            => $this->galeri->count_galeri(),
            'pengumuman'        => $this->pengumuman->count_pengumuman(),
            'd1'                => json_encode($d1),
            'd2'                => json_encode($d2)
        ];
        return view('auth/dashboard', $data);
        // var_dump(json_encode($d2));
    }
}
