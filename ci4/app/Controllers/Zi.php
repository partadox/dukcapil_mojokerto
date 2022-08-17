<?php

namespace App\Controllers;

use Config\Services;

class Zi extends BaseController
{

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            
        $zona_integritas		= $this->profil->find(12);

            $data = [
            'title'                 => 'Data Halaman Zona Integritas Dispendukcapil Kota Mojokerto',
			'zona_integritas'		=> $zona_integritas['profil_value'],
            ];
            return view('auth/zi/index', $data);
        }
    }

    public function update_deskripsi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'zona_integritas' => [
                    'label' => 'Deskripsi Zona Integritas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'zona_integritas'     => $validation->getError('zona_integritas'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama   = session()->get('nama');

                $update1 = [ 'profil_value' => $this->request->getVar('zona_integritas')];

                $this->profil->update(12, $update1);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Deskripsi Zona Integritas',
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'zi'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title'     => 'Zona Integritas',
                'list'      => $this->zi->list(),
            ];
            $msg = [
                'data' => view('auth/zi/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah File Data Paparan ZI',
            ];
            $msg = [
                'data' => view('auth/zi/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function zi_upload()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'zi_file' => [
                    'label' => 'Data Paparan ZI',
                    'rules' => 'uploaded[zi_file]|ext_in[zi_file,pdf]',
                    'errors' => [
                        'uploaded' => 'Masukkan File PDF',
                        'ext_in' => 'Harus PDF!'
                    ]
                ],
                'zi_nama' => [
                    'label' => 'Nama Data Paparan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'zi_file' => $validation->getError('zi_file'),
                        'zi_nama' => $validation->getError('zi_nama')
                    ]
                ];
            } else {


                $filepdf = $this->request->getFile('zi_file');

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");
                $nama_filepdf = $date . '_' . $time . '_' . $filepdf->getName();

                $data = [
                    'zi_nama' => $this->request->getVar('zi_nama'),
                    'zi_file' => $nama_filepdf
                ];

                $this->zi->insert($data);

                $filepdf->move('doc/zi/', $nama_filepdf);

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Tambah Data Paparan Zona Integritas',
               ];
               $this->log->insert($log);
               // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'zi'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $zi_id      = $this->request->getVar('zi_id');
            $data_zi    = $this->zi->find($zi_id); 
            $nama_file  = $data_zi['zi_file'];

            // Data Log START
            $date               = date("Y-m-d");
            $time               = date("H:i:s");
            $user_nama          = session()->get('nama');

           $log = [
               'log_user'      => $user_nama,
               'log_dt'        => $date,
               'log_tm'        => $time,
               'log_status'    => 'BERHASIL',
               'log_aktivitas' => 'Hapus File Paparan Zona Integritas ',
           ];
           $this->log->insert($log);
           // Data Log END

            $this->zi->delete($zi_id);
            unlink('doc/zi/' . $nama_file);

            $msg = [
                'sukses' => 'Data File Paparan ZI Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

}
