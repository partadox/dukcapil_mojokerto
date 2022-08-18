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

    public function update()
    {
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
                $cek_password = $this->request->getVar('password');
                if($cek_password == ''){
                    $update_data = [
                        'username'     => $this->request->getVar('username'),
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'active'       => $this->request->getVar('active'),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
                } else{
                    $update_data = [
                        'username'     => $this->request->getVar('username'),
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'active'       => $this->request->getVar('active'),
                        'password'     => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
                }

                $msg = [
                    'sukses' => [
                        'link' => 'user_peserta'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus()
    {
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
