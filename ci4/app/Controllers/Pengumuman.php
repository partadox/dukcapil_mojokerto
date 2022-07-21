<?php

namespace App\Controllers;

use Config\Services;

class Pengumuman extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Menu Pengaturan Pengumuman'
        ];
        return view('auth/pengumuman/index', $data);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title'     => 'Pengumuman',
                'list'      => $this->pengumuman->list(),
            ];
            $msg = [
                'data' => view('auth/pengumuman/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Pengumuman',
            ];
            $msg = [
                'data' => view('auth/pengumuman/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pengumuman_judul' => [
                    'label' => 'Judul pengumuman',
                    'rules' => 'required|is_unique[tb_pengumuman.pengumuman_judul]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus berbeda dengan judul pengumuman yang sudah ada!',
                    ]
                ],
                'pengumuman_isi' => [
                    'label' => 'Isi pengumuman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pengumuman_pin' => [
                    'label' => 'Status Disematkan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pengumuman_status' => [
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
                        'pengumuman_judul'  => $validation->getError('pengumuman_judul'),
                        'pengumuman_isi'    => $validation->getError('pengumuman_isi'),
                        'pengumuman_pin'    => $validation->getError('pengumuman_pin'),
                        'pengumuman_status' => $validation->getError('pengumuman_status'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama      = session()->get('nama');
                $pengumuman_judul   = $this->request->getVar('pengumuman_judul');

                $simpandata = [
                    'pengumuman_judul'          => $pengumuman_judul,
                    'pengumuman_slug'           => $this->request->getVar('pengumuman_slug'),
                    'pengumuman_isi'            => $this->request->getVar('pengumuman_isi'),
                    'pengumuman_pin'            => $this->request->getVar('pengumuman_pin'),
                    'pengumuman_status'         => $this->request->getVar('pengumuman_status'),
                    'pengumuman_create_dt'      => $date,
                    'pengumuman_modified_dt'    => $date,
                    'pengumuman_create_tm'      => $time,
                    'pengumuman_modified_tm'    => $time,
                    'pengumuman_creator'        => $user_nama,
                    'pengumuman_modified_author'=> $user_nama,
                ];

                $this->pengumuman->insert($simpandata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Buat pengumuman Baru - ' . $pengumuman_judul,
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
            $pengumuman_id  = $this->request->getVar('pengumuman_id');
            $list           =  $this->pengumuman->find($pengumuman_id);
            $data = [
                'title'         => 'Edit Pengumuman',
                'pengumuman_id'     => $list['pengumuman_id'],
                'pengumuman_judul'  => $list['pengumuman_judul'],
                'pengumuman_isi'    => $list['pengumuman_isi'],
                'pengumuman_pin'    => $list['pengumuman_pin'],
                'pengumuman_status' => $list['pengumuman_status'],
            ];
            $msg = [
                'sukses' => view('auth/pengumuman/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pengumuman_judul' => [
                    'label' => 'Judul pengumuman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pengumuman_isi' => [
                    'label' => 'Isi pengumuman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pengumuman_pin' => [
                    'label' => 'Status Disematkan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pengumuman_status' => [
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
                        'pengumuman_judul'  => $validation->getError('pengumuman_judul'),
                        'pengumuman_isi'    => $validation->getError('pengumuman_isi'),
                        'pengumuman_pin'    => $validation->getError('pengumuman_pin'),
                        'pengumuman_status' => $validation->getError('pengumuman_status'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama          = session()->get('nama');
                $pengumuman_judul   = $this->request->getVar('pengumuman_judul');

                $updatedata = [
                    'pengumuman_judul'          => $pengumuman_judul,
                    'pengumuman_slug'           => $this->request->getVar('pengumuman_slug'),
                    'pengumuman_isi'            => $this->request->getVar('pengumuman_isi'),
                    'pengumuman_pin'            => $this->request->getVar('pengumuman_pin'),
                    'pengumuman_status'         => $this->request->getVar('pengumuman_status'),
                    'pengumuman_modified_dt'    => $date,
                    'pengumuman_modified_tm'    => $time,
                    'pengumuman_modified_author'=> $user_nama,
                ];

                $pengumuman_id = $this->request->getVar('pengumuman_id');
                $this->pengumuman->update($pengumuman_id, $updatedata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data pengumuman - ' . $pengumuman_judul,
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

            $pengumuman_id = $this->request->getVar('pengumuman_id');
            //check
            $cekdata = $this->pengumuman->find($pengumuman_id);
            // $fotolama = $cekdata['pengumuman_sampul'];
            // if ($fotolama != 'default.png') {
            //     unlink('img/pengumuman/' . $fotolama);
            //     unlink('img/pengumuman/thumb/' . 'thumb_' . $fotolama);
            // }

            // Data Log START
            $date               = date("Y-m-d");
            $time               = date("H:i:s");
            $user_nama          = session()->get('nama');
            $pengumuman_judul = $cekdata['pengumuman_judul'];

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus Pengumuman ' . $pengumuman_judul,
           ];
           $this->log->insert($log);
           // Data Log END

            $this->pengumuman->delete($pengumuman_id);

            $msg = [
                'sukses' => 'Data Pengumuman Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $pengumuman_id = $this->request->getVar('pengumuman_id');
            $jmldata = count($pengumuman_id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->pengumuman->find($pengumuman_id[$i]);

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
                $pengumuman_judul = $cekdata['pengumuman_judul'];
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Hapus Pengumuman ' . $pengumuman_judul,
               ];
               $this->log->insert($log);
               // Data Log END

                $this->pengumuman->delete($pengumuman_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data Pengumuman Berhasil Dihapus"
            ];
            echo json_encode($msg);
        }
    }

    

}
