<?php

namespace App\Controllers;

class Berita extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            $data = [
                'title' => 'Menu Pengaturan Berita'
            ];
            return view('auth/berita/index', $data);
        }
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Berita',
                'list' => $this->berita->list()


            ];
            $msg = [
                'data' => view('auth/berita/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Berita',
            ];
            $msg = [
                'data' => view('auth/berita/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'berita_judul' => [
                    'label' => 'Judul berita',
                    'rules' => 'required|is_unique[tb_berita.berita_judul]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus berbeda dengan judul berita yang sudah ada!',
                    ]
                ],
                'berita_isi' => [
                    'label' => 'Isi Berita',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'berita_pin' => [
                    'label' => 'Status Disematkan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'berita_status' => [
                    'label' => 'Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'berita_judul'  => $validation->getError('berita_judul'),
                        'berita_isi'    => $validation->getError('berita_isi'),
                        'berita_pin'    => $validation->getError('berita_pin'),
                        'berita_status' => $validation->getError('berita_status'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama      = session()->get('nama');
                $berita_judul   = $this->request->getVar('berita_judul');

                $simpandata = [
                    'berita_judul'          => $berita_judul,
                    'berita_slug'           => $this->request->getVar('berita_slug'),
                    'berita_isi'            => $this->request->getVar('berita_isi'),
                    'berita_pin'            => $this->request->getVar('berita_pin'),
                    'berita_status'         => $this->request->getVar('berita_status'),
                    'berita_sampul'         => 'default.png',
                    'berita_create_dt'      => $date,
                    'berita_modified_dt'    => $date,
                    'berita_create_tm'      => $time,
                    'berita_modified_tm'    => $time,
                    'berita_creator'        => $user_nama,
                    'berita_modified_author'=> $user_nama,
                ];

                $this->berita->insert($simpandata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Buat Berita Baru - ' . $berita_judul,
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
            $berita_id  = $this->request->getVar('berita_id');
            $list       =  $this->berita->find($berita_id);
            $data = [
                'title'         => 'Edit Berita',
                'berita_id'     => $list['berita_id'],
                'berita_judul'  => $list['berita_judul'],
                'berita_isi'    => $list['berita_isi'],
                'berita_pin'    => $list['berita_pin'],
                'berita_status' => $list['berita_status'],
            ];
            $msg = [
                'sukses' => view('auth/berita/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'berita_judul' => [
                    'label' => 'Judul berita',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'berita_isi' => [
                    'label' => 'Isi Berita',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'berita_pin' => [
                    'label' => 'Status Disematkan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'berita_status' => [
                    'label' => 'Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'berita_judul'  => $validation->getError('berita_judul'),
                        'berita_isi'    => $validation->getError('berita_isi'),
                        'berita_pin'    => $validation->getError('berita_pin'),
                        'berita_status' => $validation->getError('berita_status'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama      = session()->get('nama');
                $berita_judul   = $this->request->getVar('berita_judul');

                $updatedata = [
                    'berita_judul'          => $berita_judul,
                    'berita_slug'           => $this->request->getVar('berita_slug'),
                    'berita_isi'            => $this->request->getVar('berita_isi'),
                    'berita_pin'            => $this->request->getVar('berita_pin'),
                    'berita_status'         => $this->request->getVar('berita_status'),
                    'berita_modified_dt'    => $date,
                    'berita_modified_tm'    => $time,
                    'berita_modified_author'=> $user_nama,
                ];

                $berita_id = $this->request->getVar('berita_id');
                $this->berita->update($berita_id, $updatedata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data Berita - ' . $berita_judul,
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

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $berita_id = $this->request->getVar('berita_id');
            //check
            $cekdata = $this->berita->find($berita_id);
            $fotolama = $cekdata['berita_sampul'];
            if ($fotolama != 'default.png') {
                unlink('img/berita/' . $fotolama);
                unlink('img/berita/thumb/' . 'thumb_' . $fotolama);
            }

            // Data Log START
            $date         = date("Y-m-d");
            $time         = date("H:i:s");
            $user_nama    = session()->get('nama');
            $berita_judul = $cekdata['berita_judul'];

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus Berita ' . $berita_judul,
           ];
           $this->log->insert($log);
           // Data Log END

            $this->berita->delete($berita_id);

            $msg = [
                'sukses' => 'Data Berita Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $berita_id = $this->request->getVar('berita_id');
            $jmldata = count($berita_id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->berita->find($berita_id[$i]);
                $fotolama = $cekdata['berita_sampul'];
                if ($fotolama != 'default.png') {
                    unlink('img/berita/' . $fotolama);
                    unlink('img/berita/thumb/' . 'thumb_' . $fotolama);
                }

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
                $berita_judul = $cekdata['berita_judul'];
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Hapus Berita ' . $berita_judul,
               ];
               $this->log->insert($log);
               // Data Log END

                $this->berita->delete($berita_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data Berita Berhasil Dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function formupload()
    {
        if ($this->request->isAJAX()) {
            $berita_id = $this->request->getVar('berita_id');
            $list =  $this->berita->find($berita_id);
            $data = [
                'title'     => 'Upload Sampul Berita',
                'list'      => $list,
                'berita_id' => $berita_id
            ];
            $msg = [
                'sukses' => view('auth/berita/upload', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function doupload()
    {
        if ($this->request->isAJAX()) {

            $berita_id = $this->request->getVar('berita_id');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'berita_sampul' => [
                    'label' => 'Upload Sampul Berita',
                    'rules' => 'uploaded[berita_sampul]|mime_in[berita_sampul,image/png,image/jpg,image/jpeg]|is_image[berita_sampul]',
                    'errors' => [
                        'uploaded' => 'Masukkan Gambar',
                        'mime_in' => 'Harus Gambar!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'berita_sampul' => $validation->getError('berita_sampul')
                    ]
                ];
            } else {

                //check
                $cekdata = $this->berita->find($berita_id);
                $fotolama = $cekdata['berita_sampul'];
                if ($fotolama != 'default.png') {
                    unlink('img/berita/' . $fotolama);
                    unlink('img/berita/thumb/' . 'thumb_' . $fotolama);
                }

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");

                $filegambar = $this->request->getFile('berita_sampul');
                $nama_filegambar = $date . '_' . $time . '_' . $filegambar->getName();

                $updatedata = [
                    'berita_sampul' => $nama_filegambar
                ];

                $this->berita->update($berita_id, $updatedata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->fit(250, 250, 'center')
                    ->save('img/berita/thumb/' . 'thumb_' .  $nama_filegambar);
                $filegambar->move('img/berita', $nama_filegambar);

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
                $berita_judul = $cekdata['berita_judul'];
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Edit Sampul Berita ' . $berita_judul,
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

}
