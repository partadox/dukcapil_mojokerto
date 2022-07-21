<?php

namespace App\Controllers;

use Config\Services;

class Informasi extends BaseController
{

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('home/not_found');
        } else {

            $nomor_telepon          = $this->informasi->find(1);
            $email                  = $this->informasi->find(2);
            $alamat                 = $this->informasi->find(3);
            $facebook               = $this->informasi->find(4);
            $twitter                = $this->informasi->find(5);
            $instagram              = $this->informasi->find(6);
            $youtube                = $this->informasi->find(7);
            $jam_senin_kamis        = $this->informasi->find(8);
            $jam_jumat              = $this->informasi->find(9);
            $jam_sabtu_minggu       = $this->informasi->find(10);
            $wa_akta                = $this->informasi->find(11);
            $wa_ktp                 = $this->informasi->find(12);
            $wa_pengaduan           = $this->informasi->find(13);
            $jp_jenkel              = $this->informasi->find(14);
            $jp_wajib_ktp_jenkel    = $this->informasi->find(15);
            $jp_kepemilikan_kk      = $this->informasi->find(16);

            $data = [
                'title'                 => 'Data Informasi Dispendukcapil Kota Mojokerto',
                'nomor_telepon'         => $nomor_telepon['informasi_value'],
                'email'                 => $email['informasi_value'],
                'alamat'                => $alamat['informasi_value'],
                'facebook'              => $facebook['informasi_value'],
                'twitter'               => $twitter['informasi_value'],
                'instagram'             => $instagram['informasi_value'],
                'youtube'               => $youtube['informasi_value'],
                'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
                'jam_jumat'             => $jam_jumat['informasi_value'],
                'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
                'wa_akta'               => $wa_akta['informasi_value'],
                'wa_ktp'                => $wa_ktp['informasi_value'],
                'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
                'jp_jenkel'             => $jp_jenkel['informasi_value'],
                'jp_wajib_ktp_jenkel'   => $jp_wajib_ktp_jenkel['informasi_value'],
                'jp_kepemilikan_kk'     => $jp_kepemilikan_kk['informasi_value'],
            ];
            return view('auth/informasi/index', $data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nomor_telepon' => [
                    'label' => 'Nomor Telepon',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'facebook' => [
                    'label' => 'Link Facebook',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'twitter' => [
                    'label' => 'Link Twitter',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'instagram' => [
                    'label' => 'Link Instagram',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'youtube' => [
                    'label' => 'Link Youtube',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jam_senin_kamis' => [
                    'label' => 'Jam Pelayanan Senin - Kamis',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jam_jumat' => [
                    'label' => 'Jam Pelayanan Jumat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jam_sabtu_minggu' => [
                    'label' => 'Jam Pelayanan Sabtu - Minggu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'wa_akta' => [
                    'label' => 'Kontak WA Pelayanan Akta',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'wa_ktp' => [
                    'label' => 'Kontak WA Pelayanan KTP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'wa_pengaduan' => [
                    'label' => 'Kontak WA Pelayanan Pengaduan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jp_jenkel' => [
                    'label' => 'Jumlah Penduduk Berdasar Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jp_wajib_ktp_jenkel' => [
                    'label' => 'Jumlah Penduduk Wajib KTP berdasarkan Jenis Kelami',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jp_kepemilikan_kk' => [
                    'label' => 'Jumlah Kepemilikan Kartu Keluarga (KK)',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nomor_telepon'     => $validation->getError('nomor_telepon'),
                        'email'             => $validation->getError('email'),
                        'alamat'            => $validation->getError('alamat'),
                        'facebook'          => $validation->getError('facebook'),
                        'twitter'           => $validation->getError('twitter'),
                        'instagram'         => $validation->getError('instagram'),
                        'youtube'           => $validation->getError('youtube'),
                        'jam_senin_kamis'   => $validation->getError('jam_senin_kamis'),
                        'jam_jumat'         => $validation->getError('jam_jumat'),
                        'jam_sabtu_minggu'  => $validation->getError('jam_sabtu_minggu'),
                        'wa_akta'           => $validation->getError('wa_akta'),
                        'wa_ktp'            => $validation->getError('wa_ktp'),
                        'wa_pengaduan'      => $validation->getError('wa_pengaduan'),
                        'jp_jenkel'         => $validation->getError('jp_jenkel'),
                        'jp_wajib_ktp_jenkel'=> $validation->getError('jp_wajib_ktp_jenkel'),
                        'jp_kepemilikan_kk' => $validation->getError('jp_kepemilikan_kk'),
                    ]
                ];
            } else {

                //Get Datetime now
                $date        = date("Y-m-d");
                $time        = date("H:i:s");
                //Get nama User
                $user_nama   = session()->get('nama');

                $update1 = [ 'informasi_value' => $this->request->getVar('nomor_telepon')];
                $update2 = [ 'informasi_value' => $this->request->getVar('email')];
                $update3 = [ 'informasi_value' => $this->request->getVar('alamat')];
                $update4 = [ 'informasi_value' => $this->request->getVar('facebook')];
                $update5 = [ 'informasi_value' => $this->request->getVar('twitter')];
                $update6 = [ 'informasi_value' => $this->request->getVar('instagram')];
                $update7 = [ 'informasi_value' => $this->request->getVar('youtube')];
                $update8 = [ 'informasi_value' => $this->request->getVar('jam_senin_kamis')];
                $update9 = [ 'informasi_value' => $this->request->getVar('jam_jumat')];
                $update10 = [ 'informasi_value' => $this->request->getVar('jam_sabtu_minggu')];
                $update11 = [ 'informasi_value' => $this->request->getVar('wa_akta')];
                $update12 = [ 'informasi_value' => $this->request->getVar('wa_ktp')];
                $update13 = [ 'informasi_value' => $this->request->getVar('wa_pengaduan')];
                $update14 = [ 'informasi_value' => $this->request->getVar('jp_jenkel')];
                $update15 = [ 'informasi_value' => $this->request->getVar('jp_wajib_ktp_jenkel')];
                $update16 = [ 'informasi_value' => $this->request->getVar('jp_kepemilikan_kk')];
                $this->informasi->update(1, $update1);
                $this->informasi->update(2, $update2);
                $this->informasi->update(3, $update3);
                $this->informasi->update(4, $update4);
                $this->informasi->update(5, $update5);
                $this->informasi->update(6, $update6);
                $this->informasi->update(7, $update7);
                $this->informasi->update(8, $update8);
                $this->informasi->update(9, $update9);
                $this->informasi->update(10, $update10);
                $this->informasi->update(11, $update11);
                $this->informasi->update(12, $update12);
                $this->informasi->update(13, $update13);
                $this->informasi->update(14, $update14);
                $this->informasi->update(15, $update15);
                $this->informasi->update(16, $update16);

                // Data Log START
                $log = [
                    'log_user'      => $user_nama,
                    'log_dt'        => $date,
                    'log_tm'        => $time,
                    'log_status'    => 'BERHASIL',
                    'log_aktivitas' => 'Edit Data informasi',
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'informasi'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }


}
