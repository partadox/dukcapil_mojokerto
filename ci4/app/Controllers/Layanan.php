<?php

namespace App\Controllers;

use Config\Services;

class Layanan extends BaseController
{

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            $data = [
                'title' => 'Halaman Layanan'
            ];
            return view('auth/layanan/index', $data);
        }
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Layanan',
                'list' => $this->layanan->list()


            ];
            $msg = [
                'data' => view('auth/layanan/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title'         => 'Tambah layanan',
                'list_kategori' => $this->layanan_kategori->list(),
            ];
            $msg = [
                'data' => view('auth/layanan/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'layanan_kategori' => [
                    'label' => 'Kategori Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih',
                    ]
                ],
                'layanan_subkategori' => [
                    'label' => 'Subkategori Layanan',
                    'rules' => 'required|is_unique[tb_layanan.layanan_subkategori]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus berbeda dengan subkategori layanan yang sudah ada!',
                    ]
                ],
                'layanan_deskripsi' => [
                    'label' => 'Deskripsi Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'layanan_kategori'     => $validation->getError('layanan_kategori'),
                        'layanan_subkategori'  => $validation->getError('layanan_subkategori'),
                        'layanan_deskripsi'    => $validation->getError('layanan_deskripsi'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama             = session()->get('nama');
                $layanan_subkategori   = $this->request->getVar('layanan_subkategori');

                $simpandata = [
                    'layanan_kategori'       => $this->request->getVar('layanan_kategori'),
                    'layanan_subkategori'    => $layanan_subkategori,
                    'layanan_slug'           => $this->request->getVar('layanan_slug'),
                    'layanan_deskripsi'      => $this->request->getVar('layanan_deskripsi'),
                ];

                $this->layanan->insert($simpandata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Buat Data Layanan Baru - ' . $layanan_subkategori,
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
            $layanan_id  = $this->request->getVar('layanan_id');
            $list        =  $this->layanan->find($layanan_id);
            $data = [
                'title'                 => 'Edit Layanan',
                'list_kategori'         => $this->layanan_kategori->list(),
                'layanan_id'            => $layanan_id ,
                'layanan_kategori'      => $list['layanan_kategori'],
                'layanan_subkategori'   => $list['layanan_subkategori'],
                'layanan_deskripsi'     => $list['layanan_deskripsi'],
            ];
            $msg = [
                'sukses' => view('auth/layanan/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'layanan_kategori' => [
                    'label' => 'Kategori Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih',
                    ]
                ],
                'layanan_subkategori' => [
                    'label' => 'Subkategori Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'layanan_deskripsi' => [
                    'label' => 'Deskripsi Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'layanan_kategori'     => $validation->getError('layanan_kategori'),
                        'layanan_subkategori'  => $validation->getError('layanan_subkategori'),
                        'layanan_deskripsi'    => $validation->getError('layanan_deskripsi'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama              = session()->get('nama');
                $layanan_subkategori    = $this->request->getVar('layanan_subkategori');

                $updatedata = [
                    'layanan_kategori'       => $this->request->getVar('layanan_kategori'),
                    'layanan_subkategori'    => $layanan_subkategori,
                    'layanan_slug'           => $this->request->getVar('layanan_slug'),
                    'layanan_deskripsi'      => $this->request->getVar('layanan_deskripsi'),
                ];

                $layanan_id = $this->request->getVar('layanan_id');
                $this->layanan->update($layanan_id, $updatedata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data layanan - ' . $layanan_subkategori,
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

            $layanan_id = $this->request->getVar('layanan_id');
            //check
            $cekdata = $this->layanan->find($layanan_id);

            // Data Log START
            $date                = date("Y-m-d");
            $time                = date("H:i:s");
            $user_nama           = session()->get('nama');
            $layanan_subkategori = $cekdata['layanan_subkategori'];

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus layanan ' . $layanan_subkategori,
           ];
           $this->log->insert($log);
           // Data Log END

            $this->layanan->delete($layanan_id);

            $msg = [
                'sukses' => 'Data layanan Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $layanan_id = $this->request->getVar('layanan_id');
            $jmldata = count($layanan_id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->layanan->find($layanan_id[$i]);

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
                $layanan_subkategori = $cekdata['layanan_subkategori'];
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Hapus layanan ' . $layanan_subkategori,
               ];
               $this->log->insert($log);
               // Data Log END

                $this->layanan->delete($layanan_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data layanan Berhasil Dihapus"
            ];
            echo json_encode($msg);
        }
    }


    //Layanan Kategori
    public function kategori()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            $data = [
                'title' => 'Halaman Atur Kategori Layanan'
            ];
            return view('auth/layanan_kategori/index', $data);
        }
    }

    public function kategori_getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Atur Kategori Layanan',
                'list' => $this->layanan_kategori->list()


            ];
            $msg = [
                'data' => view('auth/layanan_kategori/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function kategori_formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Kategori Layanan',
            ];
            $msg = [
                'data' => view('auth/layanan_kategori/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function kategori_simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'LK_nama' => [
                    'label' => 'Nama Kategori Layanan',
                    'rules' => 'required|is_unique[tb_layanan_kategori.LK_nama]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus berbeda dengan nama kategori layanan yang sudah ada!',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'LK_nama'  => $validation->getError('LK_nama'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama      = session()->get('nama');
                $LK_nama        = $this->request->getVar('LK_nama');

                $simpandata = [
                    'LK_nama'          => $LK_nama,
                    'LK_slug'          => $this->request->getVar('LK_slug'),
                ];

                $this->layanan_kategori->insert($simpandata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Buat Kategori Layanan Baru - ' . $LK_nama,
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
            $LK_id  = $this->request->getVar('LK_id');
            $list       =  $this->layanan_kategori->find($LK_id);
            $data = [
                'title'         => 'Edit Kategori Layanan',
                'LK_id'         => $list['LK_id'],
                'LK_nama'       => $list['LK_nama'],
            ];
            $msg = [
                'sukses' => view('auth/layanan_kategori/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function kategori_update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'LK_nama' => [
                    'label' => 'Nama Kategori Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'LK_nama'  => $validation->getError('LK_nama'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama      = session()->get('nama');
                $LK_nama   = $this->request->getVar('LK_nama');

                $updatedata = [
                    'LK_nama'          => $LK_nama,
                    'LK_slug'          => $this->request->getVar('LK_slug'),
                ];

                $LK_id = $this->request->getVar('LK_id');
                $this->layanan_kategori->update($LK_id, $updatedata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data Kategori Layanan - ' . $LK_nama,
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

            $LK_id = $this->request->getVar('LK_id');
            //check
            $cekdata = $this->layanan_kategori->find($LK_id);

            // Data Log START
            $date         = date("Y-m-d");
            $time         = date("H:i:s");
            $user_nama    = session()->get('nama');
            $LK_nama = $cekdata['LK_nama'];

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus Kategori Layanan ' . $LK_nama,
           ];
           $this->log->insert($log);
           // Data Log END

            $this->layanan_kategori->delete($LK_id);

            $msg = [
                'sukses' => 'Data layanan Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

}
