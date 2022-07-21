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

        $data = [
            'title' => 'Admin - Dashboard',
        ];
        return view('auth/dashboard', $data);
    }
}
