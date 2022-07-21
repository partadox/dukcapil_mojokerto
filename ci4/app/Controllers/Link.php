<?php

namespace App\Controllers;

use Config\Services;

class Link extends BaseController
{

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            $data = [
                'title' => 'Menu Pengaturan Link Terkait'
            ];
            return view('auth/link/index', $data);
        }
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Link Terkait',
                'list' => $this->link->list(),
            ];
            $msg = [
                'data' => view('auth/link/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Link',
            ];
            $msg = [
                'data' => view('auth/link/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'link_nama' => [
                    'label' => 'Nama Link Terkait',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'link_url' => [
                    'label' => 'URL Link Terkait',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'link_status' => [
                    'label' => 'Link Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'link_nama'      => $validation->getError('link_nama'),
                        'link_url'       => $validation->getError('link_url'),
                        'link_status'    => $validation->getError('link_status'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama          = session()->get('nama');
                $link_nama          = $this->request->getVar('link_nama');  

                $simpandata = [
                    'link_nama'                 => $link_nama,
                    'link_url'                  => $this->request->getVar('link_url'),
                    'link_status'               => $this->request->getVar('link_status'),
                    'link_gambar'               => 'default.png',
                ];

                $this->link->insert($simpandata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Buat Link Terkait Baru - ' . $link_nama,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => 'Data Berhasil Disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $link_id        = $this->request->getVar('link_id');
            $list           =  $this->link->find($link_id);
            $data = [
                'title'             => 'Edit Link Terkait',
                'link_id'           => $list['link_id'],
                'link_nama'         => $list['link_nama'],
                'link_url'          => $list['link_url'],
                'link_status'       => $list['link_status'],
            ];
            $msg = [
                'sukses' => view('auth/link/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'link_nama' => [
                    'label' => 'Nama Link Terkait',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'link_url' => [
                    'label' => 'URL Link Terkait',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'link_status' => [
                    'label' => 'Link Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'link_nama'      => $validation->getError('link_nama'),
                        'link_url'       => $validation->getError('link_url'),
                        'link_status'    => $validation->getError('link_status'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama              = session()->get('nama');
                $link_nama              = $this->request->getVar('link_nama');

                $updatedata = [
                    'link_nama'                 => $link_nama,
                    'link_url'                  => $this->request->getVar('link_url'),
                    'link_status'               => $this->request->getVar('link_status'),
                ];

                $link_id = $this->request->getVar('link_id');
                $this->link->update($link_id, $updatedata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data Link Terkait - ' . $link_nama,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => 'Data Berhasil Diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formupload()
    {
        if ($this->request->isAJAX()) {
            $link_id = $this->request->getVar('link_id');
            $list =  $this->link->find($link_id);
            $data = [
                'title'     => 'Upload Sampul link',
                'list'      => $list,
                'link_id'   => $link_id
            ];
            $msg = [
                'sukses' => view('auth/link/upload', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function doupload()
    {
        if ($this->request->isAJAX()) {

            $link_id = $this->request->getVar('link_id');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'link_gambar' => [
                    'label' => 'Upload Gambar Banner',
                    'rules' => 'uploaded[link_gambar]|mime_in[link_gambar,image/png,image/jpg,image/jpeg]|is_image[link_gambar]',
                    'errors' => [
                        'uploaded' => 'Masukkan gambar',
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'link_gambar' => $validation->getError('link_gambar')
                    ]
                ];
            } else {

                //check
                $cekdata = $this->link->find($link_id);
                $fotolama = $cekdata['link_gambar'];
                if ($fotolama != 'default.png') {
                    unlink('img/link/' . $fotolama);
                    unlink('img/link/thumb/' . 'thumb_' . $fotolama);
                }

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");

                $filegambar = $this->request->getFile('link_gambar');
                $nama_filegambar = $date . '_' . $time . '_' . $filegambar->getName();

                $updatedata = [
                    'link_gambar' => $nama_filegambar,
                ];

                $this->link->update($link_id, $updatedata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->fit(280, 100, 'center')
                    ->save('img/link/thumb/' . 'thumb_' .  $nama_filegambar);
                $filegambar->move('img/link', $nama_filegambar);

                // Data Log START
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                $user_nama   = session()->get('nama');
                $link_nama = $cekdata['link_nama'];

                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Sampul Link ' . $link_nama,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => 'Gambar Berhasil Diupload!'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $link_id = $this->request->getVar('link_id');
            //check
            $cekdata = $this->link->find($link_id);
            $gambarlama = $cekdata['link_gambar'];
            if ($gambarlama != 'default.png') {
                unlink('img/link/' . $gambarlama);
                unlink('img/link/thumb/' . 'thumb_' . $gambarlama);
            }

            // Data Log START
            $date               = date("Y-m-d");
            $time               = date("H:i:s");
            $user_nama          = session()->get('nama');
            $link_nama          = $cekdata['link_nama'];

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus Link Terkait ' . $link_nama,
           ];
           $this->log->insert($log);
           // Data Log END

            $this->link->delete($link_id);

            $msg = [
                'sukses' => 'Data Link Terkait Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $link_id = $this->request->getVar('link_id');
            $jmldata = count($link_id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->link->find($link_id[$i]);
                $gambarlama = $cekdata['link_gambar'];
                if ($gambarlama != 'default.png') {
                    unlink('img/link/' . $gambarlama);
                    unlink('img/link/thumb/' . 'thumb_' . $gambarlama);
                }

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
                $link_nama    = $cekdata['link_nama'];
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Hapus Link Terkait ' . $link_nama,
               ];
               $this->log->insert($log);
               // Data Log END

                $this->link->delete($link_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data Link Terkait Berhasil Dihapus"
            ];
            echo json_encode($msg);
        }
    }

    

}
