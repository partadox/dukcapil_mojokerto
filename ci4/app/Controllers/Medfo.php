<?php

namespace App\Controllers;

use Config\Services;

class Medfo extends BaseController
{
    public function index()
    {
        return redirect()->to('home/not_found');
    }

    public function alur_adu()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            
            $alur_adu			    = $this->medfo->find(1);

            $data = [
            'title'                 => 'Data Halaman Alur Pengaduan Web Dispendukcapil Kota Mojokerto',
            'alur_adu'			    => $alur_adu['medfo_isi'],
            ];
            return view('auth/medfo/alur_adu', $data);
        }
    }

    public function update_alur_adu()
    {
        if ($this->request->isAJAX()) {
            
                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama   = session()->get('nama');

                $update = [ 'medfo_isi' => $this->request->getVar('alur_adu')];
                $this->medfo->update(1, $update);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data Alur Pengaduan Masyarakat',
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'alur_adu'
                    ]
                ];
            
            echo json_encode($msg);
        }
    }

    public function ikm()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            
            $ikm			        = $this->medfo->find(2);

            $data = [
            'title'                 => 'Data Halaman Indeks Kepuasan Masyarakat Dispendukcapil Kota Mojokerto',
            'ikm'			        => $ikm['medfo_isi'],
            ];
            return view('auth/medfo/ikm', $data);
        }
    }

    public function update_ikm()
    {
        if ($this->request->isAJAX()) {
            
                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama   = session()->get('nama');

                $update = [ 'medfo_isi' => $this->request->getVar('ikm')];
                $this->medfo->update(2, $update);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data Alur Pengaduan Masyarakat',
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'ikm'
                    ]
                ];
            
            echo json_encode($msg);
        }
    }

    public function penghargaan()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            $data = [
                'title' => 'Menu Penghargaan'
            ];
            return view('auth/penghargaan/index', $data);
        }
    }

    public function getdata_penghargaan()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Penghargaan',
                'list' => $this->penghargaan->list()


            ];
            $msg = [
                'data' => view('auth/penghargaan/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah_penghargaan()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Penghargaan',
            ];
            $msg = [
                'data' => view('auth/penghargaan/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_penghargaan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'penghargaan_nama' => [
                    'label' => 'Nama Penghargaan',
                    'rules' => 'required|is_unique[tb_penghargaan.penghargaan_nama]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus berbeda dengan penghargaan yang sudah ada!',
                    ]
                ],
                'penghargaan_deskripsi' => [
                    'label' => 'Isi penghargaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'penghargaan_pin' => [
                    'label' => 'Status Disematkan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'penghargaan_nama'      => $validation->getError('penghargaan_nama'),
                        'penghargaan_deskripsi' => $validation->getError('penghargaan_deskripsi'),
                        'penghargaan_pin'       => $validation->getError('penghargaan_pin'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama          = session()->get('nama');
                $penghargaan_nama   = $this->request->getVar('penghargaan_nama');

                $simpandata = [
                    'penghargaan_nama'          => $penghargaan_nama,
                    'penghargaan_slug'          => $this->request->getVar('penghargaan_slug'),
                    'penghargaan_deskripsi'     => $this->request->getVar('penghargaan_deskripsi'),
                    'penghargaan_pin'           => $this->request->getVar('penghargaan_pin'),
                    'penghargaan_gambar'        => 'default.png',
                ];

                $this->penghargaan->insert($simpandata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Buat Penghargaan Baru - ' . $penghargaan_nama,
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

    public function formedit_penghargaan()
    {
        if ($this->request->isAJAX()) {
            $penghargaan_id     = $this->request->getVar('penghargaan_id');
            $list               =  $this->penghargaan->find($penghargaan_id);
            $data = [
                'title'                 => 'Edit penghargaan',
                'penghargaan_id'        => $list['penghargaan_id'],
                'penghargaan_nama'      => $list['penghargaan_nama'],
                'penghargaan_deskripsi' => $list['penghargaan_deskripsi'],
                'penghargaan_pin'       => $list['penghargaan_pin'],
            ];
            $msg = [
                'sukses' => view('auth/penghargaan/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_penghargaan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'penghargaan_nama' => [
                    'label' => 'Nama Penghargaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'penghargaan_deskripsi' => [
                    'label' => 'Isi penghargaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'penghargaan_pin' => [
                    'label' => 'Status Disematkan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'penghargaan_nama'      => $validation->getError('penghargaan_nama'),
                        'penghargaan_deskripsi' => $validation->getError('penghargaan_deskripsi'),
                        'penghargaan_pin'       => $validation->getError('penghargaan_pin'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama           = session()->get('nama');
                $penghargaan_nama    = $this->request->getVar('penghargaan_nama');

                $updatedata = [
                    'penghargaan_nama'           => $penghargaan_nama,
                    'penghargaan_slug'           => $this->request->getVar('penghargaan_slug'),
                    'penghargaan_deskripsi'      => $this->request->getVar('penghargaan_deskripsi'),
                    'penghargaan_pin'            => $this->request->getVar('penghargaan_pin'),
                ];

                $penghargaan_id     = $this->request->getVar('penghargaan_id');
                $this->penghargaan->update($penghargaan_id, $updatedata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data penghargaan - ' . $penghargaan_nama,
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

    public function hapus_penghargaan()
    {
        if ($this->request->isAJAX()) {

            $penghargaan_id = $this->request->getVar('penghargaan_id');
            //check
            $cekdata = $this->penghargaan->find($penghargaan_id);
            $fotolama = $cekdata['penghargaan_gambar'];
            if ($fotolama != 'default.png') {
                unlink('img/penghargaan/' . $fotolama);
                unlink('img/penghargaan/thumb/' . 'thumb_' . $fotolama);
            }

            // Data Log START
            $date               = date("Y-m-d");
            $time               = date("H:i:s");
            $user_nama          = session()->get('nama');
            $penghargaan_nama   = $cekdata['penghargaan_nama'];

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus penghargaan ' . $penghargaan_nama,
           ];
           $this->log->insert($log);
           // Data Log END

            $this->penghargaan->delete($penghargaan_id);

            $msg = [
                'sukses' => 'Data Penghargaan Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function formupload_penghargaan()
    {
        if ($this->request->isAJAX()) {
            $penghargaan_id = $this->request->getVar('penghargaan_id');
            $list           =  $this->penghargaan->find($penghargaan_id);
            $data            = [
                'title'             => 'Upload Gambar Penghargaan',
                'list'              => $list,
                'penghargaan_id'    => $penghargaan_id
            ];
            $msg = [
                'sukses' => view('auth/penghargaan/upload', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function doupload_penghargaan()
    {
        if ($this->request->isAJAX()) {

            $penghargaan_id = $this->request->getVar('penghargaan_id');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'penghargaan_gambar' => [
                    'label' => 'Upload gambar penghargaan',
                    'rules' => 'uploaded[penghargaan_gambar]|mime_in[penghargaan_gambar,image/png,image/jpg,image/jpeg]|is_image[penghargaan_gambar]',
                    'errors' => [
                        'uploaded' => 'Masukkan Gambar',
                        'mime_in' => 'Harus Gambar!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'penghargaan_gambar' => $validation->getError('penghargaan_gambar')
                    ]
                ];
            } else {

                //check
                $cekdata = $this->penghargaan->find($penghargaan_id);
                $fotolama = $cekdata['penghargaan_gambar'];
                if ($fotolama != 'default.png') {
                    unlink('img/penghargaan/' . $fotolama);
                    unlink('img/penghargaan/thumb/' . 'thumb_' . $fotolama);
                }

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");

                $filegambar = $this->request->getFile('penghargaan_gambar');
                $nama_filegambar = $date . '_' . $time . '_' . $filegambar->getName();

                $updatedata = [
                    'penghargaan_gambar' => $nama_filegambar
                ];

                $this->penghargaan->update($penghargaan_id, $updatedata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->fit(250, 250, 'center')
                    ->save('img/penghargaan/thumb/' . 'thumb_' .  $nama_filegambar);
                $filegambar->move('img/penghargaan', $nama_filegambar);

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
                $penghargaan_nama = $cekdata['penghargaan_nama'];
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Edit Gambar Penghargaan ' . $penghargaan_nama,
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
