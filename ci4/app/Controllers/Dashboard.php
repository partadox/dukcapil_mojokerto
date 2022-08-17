<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }
        // $staf = $this->staf->selectCount('staf_id')->first();
        $tes = $this->visitor->count_visitor();
		$tes1 = json_encode($tes);
        $d1 = array();
        $d2 = array();
        foreach ($tes as $item) {
             $d1[]  = $item['tanggal'];
             $d2[]  = intval($item['total']);
          }
        // var_dump($d1);
        $data = [
            'title' => 'Admin - Dashboard',
            'd1'  => json_encode($d1),
            'd2'  => json_encode($d2)
        ];
        return view('auth/dashboard', $data);
        // var_dump(json_encode($d2));
    }
}
