<?php

namespace App\Controllers;

class Galeri extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            $data = [
                'title' => 'Menu Pengaturan Galeri'
            ];
            return view('auth/galeri/index', $data);
        }
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title'          => 'Galeri',
                'list'           => $this->galeri->list(),
                'jumlahfoto'     => $this->galeri->jumlahfoto(),
            ];
            $msg = [
                'data' => view('auth/galeri/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Galeri',
            ];
            $msg = [
                'data' => view('auth/galeri/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'galeri_nama' => [
                    'label' => 'Nama Galeri',
                    'rules' => 'required|is_unique[tb_galeri.galeri_nama]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus berbeda dengan nama galeri yang sudah ada!',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'galeri_nama'  => $validation->getError('galeri_nama'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama  = session()->get('nama');

                $galeri_nama = $this->request->getVar('galeri_nama');

                $simpandata = [
                    'galeri_nama'           => $galeri_nama,
                    'galeri_slug'           => $this->request->getVar('galeri_slug'),
                    'galeri_sampul'         => 'default.png',
                    'galeri_create_dt'      => $date,
                    'galeri_create_tm'      => $time,
                    'galeri_modified_dt'    => $date,
                    'galeri_modified_tm'    => $time,
                    'galeri_modified_author'=> $user_nama,
                    'galeri_creator'        => $user_nama,
                ];

                $this->galeri->insert($simpandata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Buat Galeri Baru - ' . $galeri_nama,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => 'Galeri Baru Berhasil Dibuat'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $galeri_id = $this->request->getVar('galeri_id');
            $list =  $this->galeri->find($galeri_id);
            $data = [
                'title'          => 'Edit galeri',
                'galeri_id'     => $list['galeri_id'],
                'galeri_nama'   => $list['galeri_nama'],
            ];
            $msg = [
                'sukses' => view('auth/galeri/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'galeri_nama' => [
                    'label' => 'Nama Galeri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'galeri_nama'  => $validation->getError('galeri_nama'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama  = session()->get('nama');

                $galeri_nama = $this->request->getVar('galeri_nama');

                $updatedata = [
                    'galeri_nama'           => $galeri_nama,
                    'galeri_slug'           => $this->request->getVar('galeri_slug'),
                    'galeri_modified_dt'    => $date,
                    'galeri_modified_tm'    => $time,
                    'galeri_modified_author'=> $user_nama,
                ];

                $galeri_id = $this->request->getVar('galeri_id');
                $this->galeri->update($galeri_id, $updatedata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data Galeri - ' . $galeri_nama,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => 'Galeri Berhasil Diedit'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $galeri_id = $this->request->getVar('galeri_id');
            //check
            $cekdata = $this->galeri->find($galeri_id);
            $fotolama = $cekdata['galeri_sampul'];
            if ($fotolama != 'default.png') {
                unlink('img/sampul/' . $fotolama);
                unlink('img/sampul/thumb/' . 'thumb_' . $fotolama);
            }

            $cekfoto = $this->galeri_foto->hapusfoto($galeri_id);
            foreach ($cekfoto as $cekfoto) {
                $oldfoto  = $cekfoto['nama_foto'];
                unlink('img/foto/' . $oldfoto);
                unlink('img/foto/thumb/' . 'thumb_' . $oldfoto);
            }

            // Data Log START
            $date        = date("Y-m-d");
            $time        = date("H:i:s");
            $user_nama   = session()->get('nama');
            $galeri_nama = $cekdata['galeri_nama'];

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus Galeri ' . $galeri_nama,
           ];
           $this->log->insert($log);
           // Data Log END

            $this->galeri->delete($galeri_id);
            $this->galeri_foto->hapusket($galeri_id);

            $msg = [
                'sukses' => 'Galeri Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $galeri_id = $this->request->getVar('galeri_id');
            $jmldata = count($galeri_id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->galeri->find($galeri_id[$i]);
                $fotolama = $cekdata['galeri_sampul'];
                if ($fotolama != 'default.png') {
                    unlink('img/sampul/' . $fotolama);
                    unlink('img/sampul/thumb/' . 'thumb_' . $fotolama);
                }

                $cekfoto = $this->galeri_foto->hapusfoto($galeri_id[$i]);
                foreach ($cekfoto as $cekfoto) {
                    $oldfoto  = $cekfoto['nama_foto'];
                    unlink('img/foto/' . $oldfoto);
                    unlink('img/foto/thumb/' . 'thumb_' . $oldfoto);
                }

                // Data Log START
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                $user_nama   = session()->get('nama');
                $galeri_nama = $cekdata['galeri_nama'];

                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Hapus Galeri ' . $galeri_nama,
                ];
                $this->log->insert($log);
                // Data Log END

                $this->galeri->delete($galeri_id[$i]);
                $this->galeri_foto->hapusket($galeri_id[$i]);

            }

            $msg = [
                'sukses' => "$jmldata Galeri Berhasil Dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function formupload()
    {
        if ($this->request->isAJAX()) {
            $galeri_id = $this->request->getVar('galeri_id');
            $list =  $this->galeri->find($galeri_id);
            $data = [
                'title'     => 'Upload Sampul galeri',
                'list'      => $list,
                'galeri_id' => $galeri_id
            ];
            $msg = [
                'sukses' => view('auth/galeri/upload', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function doupload()
    {
        if ($this->request->isAJAX()) {

            $galeri_id = $this->request->getVar('galeri_id');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'galeri_sampul' => [
                    'label' => 'Upload Sampul',
                    'rules' => 'uploaded[galeri_sampul]|mime_in[galeri_sampul,image/png,image/jpg,image/jpeg]|is_image[galeri_sampul]',
                    'errors' => [
                        'uploaded' => 'Masukkan gambar',
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'galeri_sampul' => $validation->getError('galeri_sampul')
                    ]
                ];
            } else {

                //check
                $cekdata = $this->galeri->find($galeri_id);
                $fotolama = $cekdata['galeri_sampul'];
                if ($fotolama != 'default.png') {
                    unlink('img/sampul/' . $fotolama);
                    unlink('img/sampul/thumb/' . 'thumb_' . $fotolama);
                }

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");

                $filegambar = $this->request->getFile('galeri_sampul');
                $nama_filegambar = $date . '_' . $time . '_' . $filegambar->getName();

                $updatedata = [
                    'galeri_sampul' => $nama_filegambar,
                ];

                $this->galeri->update($galeri_id, $updatedata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->fit(800, 533, 'center')
                    ->save('img/sampul/thumb/' . 'thumb_' .  $nama_filegambar);
                $filegambar->move('img/sampul', $nama_filegambar);

                // Data Log START
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                $user_nama   = session()->get('nama');
                $galeri_nama = $cekdata['galeri_nama'];

                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Sampul Galeri ' . $galeri_nama,
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

    public function formfoto()
    {
        if ($this->request->isAJAX()) {
            $galeri_id = $this->request->getVar('galeri_id');
            $foto = $this->galeri_foto->list($galeri_id);
            $list =  $this->galeri->find($galeri_id);
            $data = [
                'title' => 'Galeri -  ' . $list['galeri_nama'],
                'foto'  => $foto,
                'list'  => $list,
                'galeri_id' => $galeri_id
            ];
            $msg = [
                'sukses' => view('auth/galeri/foto', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function uploadfoto()
    {
        if ($this->request->isAJAX()) {

            $galeri_id = $this->request->getVar('galeri_id');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'foto_keterangan' => [
                    'label' => 'Keterangan Foto',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'foto_nama' => [
                    'label' => 'Upload Foto',
                    'rules' => 'uploaded[foto_nama]|mime_in[foto_nama,image/png,image/jpg,image/jpeg]|is_image[foto_nama]',
                    'errors' => [
                        'uploaded' => 'Masukkan foto!',
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'foto_keterangan'   => $validation->getError('foto_keterangan'),
                        'foto_nama'         => $validation->getError('foto_nama')
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");
                $tm          = date("H:i:s");
                $user_nama   = session()->get('nama');

                $filegambar = $this->request->getFile('foto_nama');
                $nama_filegambar = $date . '_' . $time . '_' . $filegambar->getName();

                $foto_keterangan = $this->request->getVar('foto_keterangan');

                $insertdata = [
                    'foto_keterangan'   => $foto_keterangan,
                    'foto_nama'         => $nama_filegambar,
                    'foto_galeri_id'    => $galeri_id,
                ];

                $this->galeri_foto->insert($insertdata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->fit(800, 533, 'center')
                    ->save('img/foto/thumb/' . 'thumb_' . $nama_filegambar);
                $filegambar->move('img/foto', $nama_filegambar);

                $updatedata = [
                    'galeri_modified_dt'    => $date,
                    'galeri_modified_tm'    => $tm,
                    'galeri_modified_author'=> $user_nama,
                ];
                $this->galeri->update($galeri_id, $updatedata);

                // Data Log START
                $cekdata     = $this->galeri->find($galeri_id);
                $galeri_nama = $cekdata['galeri_nama'];

                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $tm,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Tambah Foto, Ket: ' . $foto_keterangan . ' Pada Galeri ' . $galeri_nama ,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => 'Foto Berhasil Ditambahkan Ke Galeri!'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapusfoto()
    {
        if ($this->request->isAJAX()) {

            $foto_id = $this->request->getVar('foto_id');
            //check
            $cekdata = $this->galeri_foto->find($foto_id);
            $fotolama = $cekdata['foto_nama'];
            if ($fotolama != 'default.png') {
                unlink('img/foto/' . $fotolama);
                unlink('img/foto/thumb/' . 'thumb_' . $fotolama);
            }

            //Get Datetime now
            $date        = date("Y-m-d");
            $time        = date("H-i-s");
            $tm          = date("H:i:s");
            $user_nama   = session()->get('nama');
            $galeri_id   = $cekdata['foto_galeri_id'];
            $cekdata2    = $this->galeri->find($galeri_id);
            $galeri_nama = $cekdata2['galeri_nama'];

            $updatedata = [
                'galeri_modified_dt'    => $date,
                'galeri_modified_tm'    => $tm,
                'galeri_modified_author'=> $user_nama,
            ];
            $this->galeri->update($galeri_id, $updatedata);

            // Data Log START
            $log = [
                'log_user'      => $user_nama,
                'log_dt'        => $date,
                'log_tm'        => $tm,
                'log_status'    => 'BERHASIL',
                'log_aktivitas' => 'Hapus foto, Ket: ' . $cekdata['foto_keterangan'] . ' Pada Galeri ' . $galeri_nama ,
            ];
            $this->log->insert($log);
            // Data Log END

            $this->galeri_foto->delete($foto_id);

            $msg = [
                'sukses' => 'Foto Dalam Galeri Berhasil Dihapus!'
            ];

            echo json_encode($msg);
        }
    }

}
