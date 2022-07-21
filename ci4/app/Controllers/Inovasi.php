<?php

namespace App\Controllers;

use Config\Services;

class Inovasi extends BaseController
{

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            $data = [
                'title' => 'Halaman Inovasi Layanan'
            ];
            return view('auth/inovasi/index', $data);
        }
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Inovasi Layanan',
                'list' => $this->inovasi->list()


            ];
            $msg = [
                'data' => view('auth/inovasi/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Inovasi',
            ];
            $msg = [
                'data' => view('auth/inovasi/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'inovasi_judul' => [
                    'label' => 'Judul inovasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'inovasi_isi' => [
                    'label' => 'Isi inovasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'inovasi_judul'  => $validation->getError('inovasi_judul'),
                        'inovasi_isi'    => $validation->getError('inovasi_isi'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama      = session()->get('nama');
                $inovasi_judul   = $this->request->getVar('inovasi_judul');

                $simpandata = [
                    'inovasi_judul'          => $inovasi_judul,
                    'inovasi_isi'            => $this->request->getVar('inovasi_isi'),
                ];

                $this->inovasi->insert($simpandata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Buat Inovasi Layanan Baru - ' . $inovasi_judul,
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
            $inovasi_id  = $this->request->getVar('inovasi_id');
            $list       =  $this->inovasi->find($inovasi_id);
            $data = [
                'title'         => 'Edit inovasi',
                'inovasi_id'     => $list['inovasi_id'],
                'inovasi_judul'  => $list['inovasi_judul'],
                'inovasi_isi'    => $list['inovasi_isi'],
            ];
            $msg = [
                'sukses' => view('auth/inovasi/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'inovasi_judul' => [
                    'label' => 'Judul inovasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'inovasi_isi' => [
                    'label' => 'Isi inovasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'inovasi_judul'  => $validation->getError('inovasi_judul'),
                        'inovasi_isi'    => $validation->getError('inovasi_isi'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama      = session()->get('nama');
                $inovasi_judul   = $this->request->getVar('inovasi_judul');

                $updatedata = [
                    'inovasi_judul'          => $inovasi_judul,
                    'inovasi_isi'            => $this->request->getVar('inovasi_isi'),
                ];

                $inovasi_id = $this->request->getVar('inovasi_id');
                $this->inovasi->update($inovasi_id, $updatedata);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data inovasi - ' . $inovasi_judul,
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

            $inovasi_id = $this->request->getVar('inovasi_id');
            //check
            $cekdata = $this->inovasi->find($inovasi_id);

            // Data Log START
            $date         = date("Y-m-d");
            $time         = date("H:i:s");
            $user_nama    = session()->get('nama');
            $inovasi_judul = $cekdata['inovasi_judul'];

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus inovasi ' . $inovasi_judul,
           ];
           $this->log->insert($log);
           // Data Log END

            $this->inovasi->delete($inovasi_id);

            $msg = [
                'sukses' => 'Data inovasi Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $inovasi_id = $this->request->getVar('inovasi_id');
            $jmldata = count($inovasi_id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->inovasi->find($inovasi_id[$i]);

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
                $inovasi_judul = $cekdata['inovasi_judul'];
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Hapus inovasi ' . $inovasi_judul,
               ];
               $this->log->insert($log);
               // Data Log END

                $this->inovasi->delete($inovasi_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data inovasi Berhasil Dihapus"
            ];
            echo json_encode($msg);
        }
    }

}
