<?php

namespace App\Controllers;

class Login extends BaseController
{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (session('login')) {
            session()->setFlashdata('pesan_gagal', 'Anda sudah login!');
            return redirect()->to('auth/dashboard');
        }
        $data = [
            'site_key' => getenv('recaptchaKey'),
            'title' => 'Login'
        ];
        return view('auth/login', $data);
    }

    public function validasi()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi!'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi!'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password')
                    ]
                ];
            } else {

                //cek user
                $query_cekuser = $this->db->query("SELECT * FROM user WHERE username='$username'");

                $result = $query_cekuser->getResult();

                $secret = getenv('recaptchaSecret');
                $credential = array(
                    'secret' => $secret,
                    'response' => $recaptchaResponse
                );

                $verify = curl_init();
                curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                curl_setopt($verify, CURLOPT_POST, true);
                curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
                curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($verify);

                $status = json_decode($response, true);

                
                if (count($result) > 0) {
                    $row = $query_cekuser->getRow();
                    $password_user = $row->password;

                    if (password_verify($password, $password_user) && $status["success"]  ) {
                        if ($row->active == 1) {
                            $simpan_session = [
                                'login' => true,
                                'user_id' => $row->user_id,
                                'username' => $username,
                                'nama'  => $row->nama,
                                'level' => $row->level,
                            ];

                            $this->session->set($simpan_session);

                            $msg = [
                                'sukses' => [
                                    'link' => 'auth/dashboard'
                                ]
                            ];
                        } else {
                            $msg = [
                                'eror' => [
                                    'respon' => 'User tidak aktif!',
                                    'link'   => 'portal'
                                ]
                            ];
                        }
                    } else {
                        $msg = [
                            'eror' => [
                                'respon' => 'Username atau Password Salah, Harap Centang Captcha.',
                                'link'   => 'portal'
                            ]
                        ];
                    }
                } else {
                    $msg = [
                        'eror' => [
                            'respon' => 'Username atau Password Salah, Harap Centang Captcha.',
                            'link'   => 'portal'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    public function logout()
    {
        // $this->session->destroy();
        // return redirect()->to('/login');
        if ($this->request->isAJAX()) {

            $this->session->destroy();

            $data = [
                'respond'   => 'success',
                'message'   => 'Anda berhasil logout!'
            ];

            echo json_encode($data);
        }
    }
}
