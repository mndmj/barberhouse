<?php

namespace App\Controllers;

use App\Models\ModelDetailPelanggan;
use App\Models\ModelUser;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class APIAccount extends ResourceController
{
    private $ModelUser = null;
    private $ModelDetailPelanggan = null;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelDetailPelanggan = new ModelDetailPelanggan();
        helper('text');
        helper('form');
    }

    public function index()
    {
        return view('errors/html/error_404');
    }

    public function getDataUser()
    {
        if (!$this->validate([
            'id_user' => 'required|is_natural_no_zero',
        ])) {
            $dt = [
                'success' => false,
                'msg' => "Data tidak valid",
                'data' => null
            ];
        } else {
            $data = $this->ModelUser->select('username, email, nama, jk, no_telp')
                ->join('tbl_detail_pelanggan', 'tbl_user.id_user = tbl_detail_pelanggan.id_user')
                ->where('tbl_user.id_user', $this->request->getPost('id_user'))
                ->first();
            if (empty($data)) {
                $dt = [
                    'success' => false,
                    'msg' => "Data tidak ditemukan",
                    'data' => null
                ];
            } else {
                $dt = [
                    'success' => true,
                    'msg' => "Data berhasil ditemukan",
                    'data' => $data
                ];
            }
        }
        return $this->respond($dt);
    }

    public function getbylogin()
    {
        if (!$this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
            ]
        ])) {
            $dt = [
                'success' => false,
                'msg' => "Data tidak valid"
            ];
        } else {
            $data = $this->ModelUser->select('tbl_user.id_user as id_user, username, email, nama, jk, no_telp')
                ->join('tbl_detail_pelanggan', 'tbl_user.id_user = tbl_detail_pelanggan.id_user')
                ->where('username', $this->request->getPost('username'))
                ->where('password', md5((string)$this->request->getPost('password')))
                ->first();
            if (empty($data)) {
                $dt = [
                    'success' => false,
                    'msg' => "Data akun tidak ditemukan"
                ];
            } else {
                $dt = [
                    'success' => true,
                    'msg' => "Data berhasil ditemukan",
                    'data' => $data
                ];
            }
        }
        return $this->respond($dt);
    }

    public function editProfile()
    {
        $id_user = $this->request->getPost('id_user');

        $dt_user = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'nama' => $this->request->getPost('nama'),
            'no_telp' => $this->request->getPost('no_telp'),
            'jk' => $this->request->getPost('jk'),
        ];
        // if ($this->validate([
        //     'password' => 'required',
        // ])) {
        //     $dt_user['password'] = md5((string)$this->request->getPost('password'));
        // }
        if ($this->ModelUser->update($id_user, $dt_user)) {
            $dt = [
                'success' => true,
                'msg' => "Data berhasil diedit"
            ];
        } else {
            $dt = [
                'success' => false,
                'msg' => "Data gagal diedit"
            ];
        }
        return $this->respond($dt);
    }

    public function login()
    {
        $valid = $this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
            ]
        ]);
        if (!$valid) {
            $dt = [
                'id_user' => 0,
                'success' => false,
                'nama' => null,
                'msg' => "Data tidak sesuai"
            ];
        } else {
            try {
                $dtUser = $this->ModelUser;
                $dtUser->where('username', $this->request->getPost('username'));
                $dtUser->where('password', md5($this->request->getPost('password')));
                $dtUser = $dtUser->where('id_role', '2')->findAll();
                if (count($dtUser) != 1) {
                    $dt = [
                        'id_user' => 0,
                        'success' => false,
                        'nama' => null,
                        'msg' => "Username atau password salah"
                    ];
                } else {
                    $dtUser = $dtUser[0];
                    $detailUser = $this->ModelDetailPelanggan;
                    $detailUser->where('id_user', $dtUser['id_user']);
                    $detailUser = $detailUser->first();
                    if (empty($detailUser)) {
                        $dt = [
                            'id_user' => 0,
                            'success' => false,
                            'nama' => null,
                            'msg' => "Ada masalah dengan data Anda"
                        ];
                    } else {
                        $dt = [
                            'id_user' => $dtUser['id_user'],
                            'success' => true,
                            'nama' => $detailUser['nama'],
                            'msg' => "Login berhasil"
                        ];
                    }
                }
            } catch (Exception $e) {
                $dt = [
                    'id_user' => 0,
                    'success' => false,
                    'nama' => null,
                    'msg' => "Sistem masih dalam perbaikan" . $e
                ];
            }
        }
        return $this->respond($dt);
    }

    public function register()
    {
        $token = random_string('alnum', 6);
        $mail = new PHPMailer(true);
        $dtUser = [
            'username' => $this->request->getPost('username'),
            'password' =>  md5((string)$this->request->getPost('password')),
            'email' => $this->request->getPost('email'),
            'id_role' => '2',
            'token' => $token,
        ];
        if ($this->ModelUser->insert($dtUser)) {
            $detailUser = [
                'nama' => $this->request->getPost('nama'),
                'telepon' => $this->request->getPost('telepon'),
                'jk' => $this->request->getPost('jk'),
                'id_user' => $this->ModelUser->orderBy('id_user', 'desc')->first()['id_user'],
            ];
            if ($this->ModelDetailPelanggan->insert($detailUser)) {
                $data = [
                    'success' => true,
                    'msg' => "Berhasil Registrasi"
                ];
            }
        }
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'sportcakra5@gmail.com'; // ubah dengan alamat email Anda
            $mail->Password   = 'amqqairiqqfkdiph'; // ubah dengan password email Anda
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->setFrom('sportcakra5@gmail.com', 'BARBERHOUSE'); // ubah dengan alamat email Anda
            $mail->addAddress($this->request->getPost('email'));
            $mail->addReplyTo('sportcakra5@gmail.com', 'BARBERHOUSE'); // ubah dengan alamat email Anda

            // Isi Email
            $mail->isHTML(true);
            $mail->Subject = 'Token Rahasia Barberhouse';
            $mail->Body    = 'Token pendaftaran ini digunakan untuk dapat login pada website Barberhouse sebagai Pemilik Barbershop <br> <b>' . $token . '</b>';
            $mail->send();
        } catch (Exception $e) {
        }
        return $this->respond($data);
    }

    public function validasitoken()
    {
        $valid = $this->validate([
            'token' => [
                'label' => 'Token',
                'rules' => 'required|alpha_numeric',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ],
        ]);
        if (!$valid) {
            $dt = [
                'success' => false,
                'msg' => "Data tidak sesuai"
            ];
        } else {
            try {
                $dtUser = $this->ModelUser;
                $dtUser->where('token', $this->request->getPost('token'));
                $dtUser->where('email', $this->request->getPost('email'));
                $dtUser = $dtUser->findAll();
                if (count($dtUser) != 1) {
                    $dt = [
                        'success' => false,
                        'msg' => "Token Anda salah"
                    ];
                } else {
                    $dtUser = $dtUser[0];
                    $data = [
                        'token' => null
                    ];
                    if ($this->ModelUser->update($dtUser['id_user'], $data)) {
                        $dt = [
                            'success' => true,
                            'msg' => "Akun anda berhasil diaktifkan"
                        ];
                    } else {
                        $dt = [
                            'success' => false,
                            'msg' => "Kesalahan sistem"
                        ];
                    }
                }
            } catch (Exception $e) {
                $dt = [
                    'success' => false,
                    'msg' => "Sistem masih dalam perbaikan" . $e
                ];
            }
        }
        return $this->respond($dt);
    }

    public function editprofil()
    {
        if (!$this->validate([
            'id_user' => 'required|is_natural_no_zero',
            'username' => 'required',
            'email' => 'required|valid_email',
            'nama' => 'required',
            'telepon' => 'required|numeric',
            'jk' => 'required|in_list[Laki-laki,Perempuan]',
        ])) {
            return $this->setError('Data tidak valid');
        }
        $dtUser = $this->ModelUser
            ->join('tbl_detail_pelanggan', 'tbl_user.id_user=tbl_detail_pelanggan.id_user')
            ->where('tbl_user.id_user', $this->request->getPost('id_user'))
            ->first();
        if (empty($dtUser)) {
            return $this->setError('Data akun tidak ditemukan');
        }
        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];
        if ($this->validate(['password' => 'required|max_length(16)'])) {
            $data['password'] = md5((string)$this->request->getPost('password'));
        }
        $this->ModelUser->update($dtUser['id_user'], $data);
        $afterUser = $this->ModelUser;
        foreach ($data as $key => $val) {
            $afterUser->where($key, $val);
        }
        $afterUser = $afterUser->first();
        if (empty($dtUser)) {
            return $this->setError('Data akun gagal di update');
        }
        $data = [
            'nama' => $this->request->getPost('nama'),
            'no_telp' => $this->request->getPost('telepon'),
            'jk' => $this->request->getPost('jk'),
        ];
        $this->ModelDetailPelanggan->update($dtUser['id_detail_pelanggan'], $data);
        $afterPelanggan = $this->ModelDetailPelanggan;
        foreach ($data as $key => $val) {
            $afterPelanggan->where($key, $val);
        }
        $afterPelanggan = $afterPelanggan->first();
        if (empty($afterPelanggan)) {
            return $this->setError('Data pelanggan gagal di update');
        }
        return $this->respond([
            'success' => true,
            'msg' => 'Data anda berhasil diubah'
        ]);
    }
}
