<?php

namespace App\Controllers;

use Config\Services;

class Gisa extends BaseController
{

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            $data = [
                'title' => 'Halaman Lapak Gisa'
            ];
            return view('auth/gisa/index', $data);
        }
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Gisa',
                'list' => $this->gisa->list()


            ];
            $msg = [
                'data' => view('auth/gisa/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title'         => 'Tambah Gisa',
                'list_kategori' => $this->gisa_kategori->list(),
            ];
            $msg = [
                'data' => view('auth/gisa/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'gisa_kategori' => [
                    'label' => 'Kategori gisa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih',
                    ]
                ],
                'gisa_subkategori' => [
                    'label' => 'Subkategori gisa',
                    'rules' => 'required|is_unique[tb_gisa.gisa_subkategori]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus berbeda dengan subkategori gisa yang sudah ada!',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'gisa_kategori'     => $validation->getError('gisa_kategori'),
                        'gisa_subkategori'  => $validation->getError('gisa_subkategori'),
                    ]   
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama             = session()->get('nama');
                $gisa_subkategori      = $this->request->getVar('gisa_subkategori');

                $simpandata = [
                    'gisa_kategori'       => $this->request->getVar('gisa_kategori'),
                    'gisa_subkategori'    => $this->request->getVar('gisa_subkategori'),
                    'gisa_slug'           => $this->request->getVar('gisa_slug'),
                ];

                $this->gisa->insert($simpandata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Buat Data Gisa Baru - ' . $gisa_subkategori,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'sukses' => 'Data Berhasil Disimpan'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $gisa_id     = $this->request->getVar('gisa_id');
            $list        =  $this->gisa->find($gisa_id);
            $data = [
                'title'                 => 'Edit gisa',
                'list_kategori'         => $this->gisa_kategori->list(),
                'gisa_id'            => $gisa_id ,
                'gisa_kategori'      => $list['gisa_kategori'],
                'gisa_subkategori'   => $list['gisa_subkategori'],
            ];
            $msg = [
                'sukses' => view('auth/gisa/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'gisa_kategori' => [
                    'label' => 'Kategori gisa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih',
                    ]
                ],
                'gisa_subkategori' => [
                    'label' => 'Subkategori gisa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'gisa_kategori'     => $validation->getError('gisa_kategori'),
                        'gisa_subkategori'  => $validation->getError('gisa_subkategori'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama              = session()->get('nama');
                $gisa_subkategori    = $this->request->getVar('gisa_subkategori');

                $updatedata = [
                    'gisa_kategori'       => $this->request->getVar('gisa_kategori'),
                    'gisa_subkategori'    => $gisa_subkategori,
                    'gisa_slug'           => $this->request->getVar('gisa_slug'),
                ];

                $gisa_id = $this->request->getVar('gisa_id');
                $this->gisa->update($gisa_id, $updatedata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data gisa - ' . $gisa_subkategori,
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
            $gisa_id     = $this->request->getVar('gisa_id');
            $data = [
                'title'         => 'Tambah File Gisa',
                'gisa_id'       => $gisa_id ,
            ];

            $msg = [
                'sukses' => view('auth/gisa/upload', $data)
            ];
            echo json_encode($msg);
            
        }
    }

    public function gisa_upload()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'gisa_file' => [
                    'label' => 'Data File Gisa',
                    'rules' => 'uploaded[gisa_file]|ext_in[gisa_file,pdf]',
                    'errors' => [
                        'uploaded' => 'Masukkan File PDF',
                        'ext_in' => 'Harus PDF!'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'gisa_file' => $validation->getError('gisa_file')
                    ]
                ];
            } else {


                $filepdf     = $this->request->getFile('gisa_file');
                $gisa_id     = $this->request->getVar('gisa_id');
                $gisa_data   = $this->gisa->find($gisa_id);
                $file_lama   = $gisa_data['gisa_file'];

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");
                $nama_filepdf = $date . '_' . $time . '_' . $filepdf->getName();

                $data = [
                    'gisa_file' => $nama_filepdf
                ];

                $this->gisa->update($gisa_id, $data);

                if ($file_lama == NULL) {
                    $filepdf->move('doc/gisa/', $nama_filepdf);
                } else {
                    unlink('doc/gisa/' . $file_lama);
                    $filepdf->move('doc/gisa/', $nama_filepdf);
                }

                

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Tambah Data File Gisa',
               ];
               $this->log->insert($log);
               // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'gisa'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $gisa_id    = $this->request->getVar('gisa_id');
            //check
            $cekdata    = $this->gisa->find($gisa_id);
            $file_lama  = $cekdata['gisa_file'];

            // Data Log START
            $date                = date("Y-m-d");
            $time                = date("H:i:s");
            $user_nama           = session()->get('nama');
            $gisa_subkategori = $cekdata['gisa_subkategori'];

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus gisa ' . $gisa_subkategori,
           ];
           $this->log->insert($log);
           // Data Log END

            $this->gisa->delete($gisa_id);

            if ($file_lama != NULL) {
                unlink('doc/gisa/' . $file_lama);
            }

            $msg = [
                'sukses' => 'Data gisa Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }


    //gisa Kategori
    public function kategori()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            $data = [
                'title' => 'Halaman Atur Kategori gisa'
            ];
            return view('auth/gisa_kategori/index', $data);
        }
    }

    public function kategori_getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Atur Kategori gisa',
                'list' => $this->gisa_kategori->list()


            ];
            $msg = [
                'data' => view('auth/gisa_kategori/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function kategori_formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Kategori gisa',
            ];
            $msg = [
                'data' => view('auth/gisa_kategori/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function kategori_simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'GK_nama' => [
                    'label' => 'Nama Kategori gisa',
                    'rules' => 'required|is_unique[tb_gisa_kategori.GK_nama]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus berbeda dengan nama kategori gisa yang sudah ada!',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'GK_nama'  => $validation->getError('GK_nama'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama      = session()->get('nama');
                $GK_nama        = $this->request->getVar('GK_nama');

                $simpandata = [
                    'GK_nama'          => $GK_nama,
                    'GK_slug'          => $this->request->getVar('GK_slug'),
                ];

                $this->gisa_kategori->insert($simpandata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Buat Kategori gisa Baru - ' . $GK_nama,
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

    public function kategori_formedit()
    {
        if ($this->request->isAJAX()) {
            $GK_id  = $this->request->getVar('GK_id');
            $list       =  $this->gisa_kategori->find($GK_id);
            $data = [
                'title'         => 'Edit Kategori gisa',
                'GK_id'         => $list['GK_id'],
                'GK_nama'       => $list['GK_nama'],
            ];
            $msg = [
                'sukses' => view('auth/gisa_kategori/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function kategori_update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'GK_nama' => [
                    'label' => 'Nama Kategori gisa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'GK_nama'  => $validation->getError('GK_nama'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama      = session()->get('nama');
                $GK_nama   = $this->request->getVar('GK_nama');

                $updatedata = [
                    'GK_nama'          => $GK_nama,
                    'GK_slug'          => $this->request->getVar('GK_slug'),
                ];

                $GK_id = $this->request->getVar('GK_id');
                $this->gisa_kategori->update($GK_id, $updatedata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data Kategori gisa - ' . $GK_nama,
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

    public function kategori_hapus()
    {
        if ($this->request->isAJAX()) {

            $GK_id = $this->request->getVar('GK_id');
            //check
            $cekdata = $this->gisa_kategori->find($GK_id);

            // Data Log START
            $date         = date("Y-m-d");
            $time         = date("H:i:s");
            $user_nama    = session()->get('nama');
            $GK_nama = $cekdata['GK_nama'];

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus Kategori gisa ' . $GK_nama,
           ];
           $this->log->insert($log);
           // Data Log END

            $this->gisa_kategori->delete($GK_id);

            $msg = [
                'sukses' => 'Data gisa Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

}
