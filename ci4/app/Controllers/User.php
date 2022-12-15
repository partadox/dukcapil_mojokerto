<?php

namespace App\Controllers;

use Config\Services;

class User extends BaseController
{

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            $data = [
                'title' => 'Halaman User Management'
            ];
            return view('auth/user/index', $data);
        }
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'IKM',
                'list'  => $this->user->list()


            ];
            $msg = [
                'data' => view('auth/user/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'   => 'Form Input User Baru',
            ];
            $msg = [
                'data' => view('auth/user/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if (!session()->get('user_id')) {
            $msg = [
                'eror' => [
                    'link' => 'eror',
                    'code' => '401',
                ]
            ];
            echo json_encode($msg);
        }  else {
            if ($this->request->isAJAX()) {
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'username' => [
                        'label' => 'Username',
                        'rules' => 'required|is_unique[user.username]',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => 'sudah ada yang menggunakan {field} ini',
                        ]
                    ],
                    'nama' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'password' => [
                        'label' => 'Password',
                        'rules' => 'trim|required|min_length[8]|regex_match[/^((?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})$/]',
                        'errors' => [
                            'required'                      => '{field} tidak boleh kosong',
                            'min_length'                    => '{field} minimal harus 8 karakter',
                            'regex_match'                   => '{field} password harus kombinasi dari huruf kecil, huruf kapital, angka, dan simbol'
                        ]
                    ],
                    'active' => [
                        'label' => 'active',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ]
                ]);
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'username'  => $validation->getError('username'),
                            'nama'      => $validation->getError('nama'),
                            'password'  => $validation->getError('password'),
                            'active'    => $validation->getError('active'),   
                        ]
                    ];
                } else {
                    $password = $this->request->getVar('password');
                    $simpandata = [
                        'username'     => $this->request->getVar('username'),
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'password'     => (password_hash($password, PASSWORD_BCRYPT)),
                        'active'       => $this->request->getVar('active'),
                        'level'     => 2,
                    ];
    
                    $this->user->insert($simpandata);
    
                    $msg = [
                        'sukses' => [
                            'link' => 'user'
                        ]
                    ];
                }
                echo json_encode($msg);
            }
        }
        
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Form Edit User',
                'user_id'    => $user['user_id'],
                'username'   => $user['username'],
                'nama'       => $user['nama'],
                'active'     => $user['active'],
            ];
            $msg = [
                'sukses' => view('auth/user/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formedit_pass()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Form Edit Password',
                'user_id'    => $user['user_id'],
            ];
            $msg = [
                'sukses' => view('auth/user/edit_pass', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if (!session()->get('user_id')) {
            $msg = [
                'eror' => [
                    'link' => 'eror',
                    'code' => '401',
                ]
            ];
            echo json_encode($msg);
        } else {
            if ($this->request->isAJAX()) {
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'username' => [
                        'label' => 'Username',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                            'is_unique' => 'sudah ada yang menggunakan {field} ini',
                        ]
                    ],
                    'nama' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'active' => [
                        'label' => 'active',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ]
                ]);
                if (!$valid) {
                        $msg = [
                            'error' => [
                                'username'  => $validation->getError('username'),
                                'nama'      => $validation->getError('nama'),
                                'active'    => $validation->getError('active'),   
                            ]
                        ];
                } else {
    
                    $update_data = [
                        'username'     => $this->request->getVar('username'),
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'active'       => $this->request->getVar('active'),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
    
                    $msg = [
                        'sukses' => [
                            'link' => 'user_peserta'
                        ]
                    ];
                }
                echo json_encode($msg);
            }
        }
        
        
    }

    public function update_pass()
    {
        if (!session()->get('user_id')) {
            $msg = [
                'eror' => [
                    'link' => 'eror',
                    'code' => '401',
                ]
            ];
            echo json_encode($msg);
        } else {
            if ($this->request->isAJAX()) {
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'password' => [
                        'label' => 'Password',
                        'rules' => 'trim|required|min_length[8]|regex_match[/^((?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})$/]',
                        'errors' => [
                            'required'                      => '{field} tidak boleh kosong',
                            'min_length'                    => '{field} minimal harus 8 karakter',
                            'regex_match'                   => '{field} password harus kombinasi dari huruf kecil, huruf kapital, angka, dan simbol'
                        ]
                    ]
                ]);
                if (!$valid) {
                        $msg = [
                            'error' => [
                                'password'  => $validation->getError('password'),
                            ]
                        ];
                } else {
    
                    $password = $this->request->getVar('password');
                    $update_data = [
                        'password'     => (password_hash($password, PASSWORD_BCRYPT)),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
    
                    $msg = [
                        'sukses' => [
                            'link' => 'user_peserta'
                        ]
                    ];
                }
                echo json_encode($msg);
            }
        }
        
        
    }

    public function hapus()
    {
        if (!session()->get('user_id')) {
            $msg = [
                'eror' => [
                    'link' => 'eror',
                    'code' => '401',
                ]
            ];
            echo json_encode($msg);
        } else {
            if ($this->request->isAJAX()) {

                $user_id = $this->request->getVar('user_id');
    
                $this->user->delete($user_id);
    
                $msg = [
                    'sukses' => [
                        'link' => 'user'
                    ]
                ];
                echo json_encode($msg);
            }
        }
        
        
    }

}
