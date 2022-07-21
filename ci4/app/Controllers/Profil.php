<?php

namespace App\Controllers;

use Config\Services;

class Profil extends BaseController
{

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {
            
        $sambutan_isi			= $this->profil->find(1);
		$sambutan_nama			= $this->profil->find(2);
		$sambutan_jabatan		= $this->profil->find(3);
		$sambutan_foto			= $this->profil->find(4);
        $visi					= $this->profil->find(5);
		$misi 					= $this->profil->find(6);
        $struktur_organisasi 	= $this->profil->find(7);
        $tupoksi_deskripsi 	    = $this->profil->find(8);
        $tupoksi_pdf 	        = $this->profil->find(9);
        $kualitas_deskripsi 	= $this->profil->find(10);
		$kualitas_pdf 			= $this->profil->find(11);

            $data = [
            'title'                 => 'Data Halaman Profil Web Dispendukcapil Kota Mojokerto',
            'sambutan_isi'			=> $sambutan_isi['profil_value'],
			'sambutan_nama'			=> $sambutan_nama['profil_value'],
			'sambutan_jabatan'		=> $sambutan_jabatan['profil_value'],
			'sambutan_foto'			=> $sambutan_foto['profil_value'],
            'visi'					=> $visi['profil_value'],
			'misi'					=> $misi['profil_value'],
            'struktur_organisasi'	=> $struktur_organisasi['profil_value'],
            'tupoksi_deskripsi'     => $tupoksi_deskripsi['profil_value'],
            'tupoksi_pdf'           => $tupoksi_pdf['profil_value'],
            'kualitas_deskripsi'	=> $kualitas_deskripsi['profil_value'],
			'kualitas_pdf'			=> $kualitas_pdf['profil_value'],
            ];
            return view('auth/profil/index', $data);
        }
    }

    public function update_sambutan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'sambutan_nama' => [
                    'label' => 'Nama Pemberi Sambutan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'sambutan_jabatan' => [
                    'label' => 'Jabatan Pemberi Sambutan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'sambutan_isi' => [
                    'label' => 'Isi Sambutan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'sambutan_nama'     => $validation->getError('sambutan_nama'),
                        'sambutan_jabatan'  => $validation->getError('sambutan_jabatan'),
                        'sambutan_isi'      => $validation->getError('sambutan_isi'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama   = session()->get('nama');

                $update1 = [ 'profil_value' => $this->request->getVar('sambutan_nama')];
                $update2 = [ 'profil_value' => $this->request->getVar('sambutan_jabatan')];
                $update3 = [ 'profil_value' => $this->request->getVar('sambutan_isi')];
                $this->profil->update(2, $update1);
                $this->profil->update(3, $update2);
                $this->profil->update(1, $update3);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data Profil Sambutan Kepala Dinas',
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'profil'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function sambutan_formfoto()
    {
        if ($this->request->isAJAX()) {
            $data_profi_sambutan = $this->profil->find(4); 
            $sambutan_foto       = $data_profi_sambutan['profil_value'];
            $data = [
                'title'             => 'Upload Foto Pemberi Sambutan',
                'sambutan_foto'     => $sambutan_foto,
            ];
            $msg = [
                'sukses' => view('auth/profil/upload', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function sambutan_foto_upload()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'sambutan_foto' => [
                    'label' => 'Upload Sampul Berita',
                    'rules' => 'uploaded[sambutan_foto]|mime_in[sambutan_foto,image/png,image/jpg,image/jpeg]|is_image[sambutan_foto]',
                    'errors' => [
                        'uploaded' => 'Masukkan Gambar',
                        'mime_in' => 'Harus Gambar!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'sambutan_foto' => $validation->getError('sambutan_foto')
                    ]
                ];
            } else {

                //check
                $fotolama = $this->request->getVar('sambutan_foto_lama');
                unlink('img/profil/' . $fotolama);

                $filegambar = $this->request->getFile('sambutan_foto');

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");
                $nama_filegambar = $date . '_' . $time . '_' . $filegambar->getName();

                $updatedata = [
                    'profil_value' => $nama_filegambar
                ];

                $this->profil->update(4, $updatedata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->fit(350, 350, 'center')
                    ->save('img/profil/' . $nama_filegambar);

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Edit Profil - Foto Pemberi Sambutan',
               ];
               $this->log->insert($log);
               // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'profil'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function update_visi_misi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'visi' => [
                    'label' => 'Visi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'misi' => [
                    'label' => 'Misi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'visi'     => $validation->getError('visi'),
                        'misi'  => $validation->getError('misi'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama   = session()->get('nama');

                $update1 = [ 'profil_value' => $this->request->getVar('visi')];
                $update2 = [ 'profil_value' => $this->request->getVar('misi')];
                $this->profil->update(5, $update1);
                $this->profil->update(6, $update2);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Visi / Misi',
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'profil'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function struktur_organisasi_upload()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'struktur_organisasi' => [
                    'label' => 'Upload Struktur Organisasi',
                    'rules' => 'uploaded[struktur_organisasi]|mime_in[struktur_organisasi,image/png,image/jpg,image/jpeg]|is_image[struktur_organisasi]',
                    'errors' => [
                        'uploaded' => 'Masukkan Gambar',
                        'mime_in' => 'Harus Gambar!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'struktur_organisasi' => $validation->getError('struktur_organisasi')
                    ]
                ];
            } else {

                //check
                $fotolama = $this->request->getVar('struktur_organisasi_lama');
                unlink('img/profil/' . $fotolama);

                $filegambar = $this->request->getFile('struktur_organisasi');

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");
                $nama_filegambar = $date . '_' . $time . '_' . $filegambar->getName();

                $updatedata = [
                    'profil_value' => $nama_filegambar
                ];

                $this->profil->update(7, $updatedata);

                $filegambar->move('img/profil/', $nama_filegambar);

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Edit Profil - Gambar Struktur Organisasi',
               ];
               $this->log->insert($log);
               // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'profil'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function update_tupoksi_deskripsi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'tupoksi_deskripsi' => [
                    'label' => 'Deskripsi Tupoksi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tupoksi_deskripsi'     => $validation->getError('tupoksi_deskripsi'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama   = session()->get('nama');

                $update1 = [ 'profil_value' => $this->request->getVar('tupoksi_deskripsi')];
                $this->profil->update(8, $update1);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Profil - Tupoksi Deskripsi',
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'profil'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function tupoksi_formpdf()
    {
        if ($this->request->isAJAX()) {
            $data_tupoksi = $this->profil->find(9); 
            $tupoksi_pdf  = $data_tupoksi['profil_value'];
            $data = [
                'title'             => 'Upload File PDF Peraturan Terkait Tupoksi',
                'tupoksi_pdf'       => $tupoksi_pdf,
            ];
            $msg = [
                'sukses' => view('auth/profil/upload_pdf', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function tupoksi_upload()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'tupoksi_pdf' => [
                    'label' => 'Upload Sampul Berita',
                    'rules' => 'uploaded[tupoksi_pdf]|ext_in[tupoksi_pdf,pdf]',
                    'errors' => [
                        'uploaded' => 'Masukkan File PDF',
                        'ext_in' => 'Harus PDF!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tupoksi_pdf' => $validation->getError('tupoksi_pdf')
                    ]
                ];
            } else {

                //check
                $tupoksi_pdf_lama = $this->request->getVar('tupoksi_pdf_lama');
                unlink('doc/profil/' . $tupoksi_pdf_lama);

                $filepdf = $this->request->getFile('tupoksi_pdf');

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");
                $nama_filepdf = $date . '_' . $time . '_' . $filepdf->getName();

                $updatedata = [
                    'profil_value' => $nama_filepdf
                ];

                $this->profil->update(9, $updatedata);

                $filepdf->move('doc/profil/', $nama_filepdf);

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Edit Profil - PDF Peraturan Tupoksi',
               ];
               $this->log->insert($log);
               // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'profil'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function update_kualitas_deskripsi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kualitas_deskripsi' => [
                    'label' => 'Deskripsi kualitas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kualitas_deskripsi'     => $validation->getError('kualitas_deskripsi'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama   = session()->get('nama');

                $update1 = [ 'profil_value' => $this->request->getVar('kualitas_deskripsi')];
                $this->profil->update(10, $update1);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Profil - Kualitas Deskripsi',
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'profil'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function kualitas_formpdf()
    {
        if ($this->request->isAJAX()) {
            $data_kualitas = $this->profil->find(11); 
            $kualitas_pdf  = $data_kualitas['profil_value'];
            $data = [
                'title'             => 'Upload File PDF Terkait Kualitas Mutu',
                'kualitas_pdf'       => $kualitas_pdf,
            ];
            $msg = [
                'sukses' => view('auth/profil/upload_pdf_kualitas', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function kualitas_upload()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'kualitas_pdf' => [
                    'label' => 'Upload Sampul Berita',
                    'rules' => 'uploaded[kualitas_pdf]|ext_in[kualitas_pdf,pdf]',
                    'errors' => [
                        'uploaded' => 'Masukkan File PDF Kualitas Mutu',
                        'ext_in' => 'Harus PDF!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kualitas_pdf' => $validation->getError('kualitas_pdf')
                    ]
                ];
            } else {

                //check
                $kualitas_pdf_lama = $this->request->getVar('kualitas_pdf_lama');
                unlink('doc/profil/' . $kualitas_pdf_lama);

                $filepdf = $this->request->getFile('kualitas_pdf');

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H-i-s");
                $nama_filepdf = $date . '_' . $time . '_' . $filepdf->getName();

                $updatedata = [
                    'profil_value' => $nama_filepdf
                ];

                $this->profil->update(11, $updatedata);

                $filepdf->move('doc/profil/', $nama_filepdf);

                // Data Log START
                $date         = date("Y-m-d");
                $time         = date("H:i:s");
                $user_nama    = session()->get('nama');
    
               $log = [
                   'log_user'      => $user_nama,
                   'log_dt'        => $date,
                   'log_tm'        => $time,
                   'log_status'    => 'BERHASIL',
                   'log_aktivitas' => 'Edit Profil - PDF Peraturan Kualitas Mutu',
               ];
               $this->log->insert($log);
               // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'profil'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

}
