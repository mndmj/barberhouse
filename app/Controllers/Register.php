<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use App\Models\ModelDetailPemilik;
use App\Models\ModelBB;
use App\Models\ModelUser;
use Exception;

class Register extends BaseController
{
    private $ModelAuth = null;
    private $ModelUser = null;
    private $ModelBB = null;
    private $ModelDetailPemilik = null;

    public function __construct()
    {
        $this->ModelAuth = new ModelAuth();
        $this->ModelUser = new ModelUser();
        $this->ModelBB = new ModelBB();
        $this->ModelDetailPemilik = new ModelDetailPemilik();
        helper('form');
        helper('text');
    }

    public function index()
    {
        $data = [
            'validation' => (session('errors')) ? session('errors') : \Config\Services::validation()
        ];
        return view('view_token', $data);
    }

    public function token()
    {
        if ($this->validate([
            'token' => [
                'label' => 'Token',
                'rules'  => 'required|min_length[6]|max_length[6]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'max_length' => '{field} harus 6 karakter.',
                    'min_length' => '{field} harus 6 karakter.',
                ]
            ],
        ])) {
            $token = $this->request->getPost('token');
            // $cek_token = $this->ModelAuth->token($token);
            if ($this->ModelAuth->token($token, session('regist'))) {
                session()->set('token', session('regist'));
                session()->remove('regist');
                return redirect()->to(base_url('register/biopemilik'));
            } else {
                session()->setFlashdata('peringatan', 'Token salah.');
                return redirect()->to(base_url('register'))->withInput()->with('error_input', true);
            }
        } else {
            // tidak valid
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to(base_url('register'));
        }
    }

    public function biopemilik()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Bio Pemilik',
            'validation' => (session('errors')) ? session('errors') : \Config\Services::validation()
        ];
        return view('view_bio_pemilik', $data);
    }

    public function savepemilik()
    {
        $valid = $this->validate([
            'nama_lengkap' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ]
            ],
            'telepon' => [
                'label' => 'No.Telepon',
                'rules'  => 'required|numeric|max_length[15]|is_unique[tbl_detail_pemilik.telepon]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'numeric' => '{field} hanya berisi angka.',
                    'is_unique' => '{field} sudah pernah digunakan.',
                    'max_length' => '{field} max 15 karakter.',
                ],
            ],
            'jk' => [
                'label' => 'Jenis Kelamin',
                'rules'  => 'required|in_list[Laki-laki,Perempuan]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'in_list' => '{field} tidak tersedia.',
                ],
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'max_size[foto,10240]|mime_in[foto,image/jpeg,image/png]|ext_in[foto,png,jpg,jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran {field} max 1 Mb.',
                ],
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => '{field} wajib diisi.',
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to(base_url('register/biopemilik'))->withInput();
        }
        $foto = $this->request->getFile('foto');
        $fotoName = $foto->getRandomName();
        $foto->move('assets/images/user/', $fotoName);
        if ($foto->hasMoved()) {
            $dtUser = $this->ModelUser->where('email', session('token'))->first();
            $dt = [
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'telepon' => $this->request->getPost('telepon'),
                'jk' => $this->request->getPost('jk'),
                'alamat' => $this->request->getPost('alamat'),
                'foto' => $fotoName,
                'id_user' => $dtUser['id_user']
            ];

            $modelDetailPemilik = new ModelDetailPemilik();
            if ($modelDetailPemilik->insert($dt)) {
                session()->set('bio', session('token'));
                session()->remove('token');
                return redirect()->to(base_url('register/biobb'));
            } else {
                unlink('assets/images/user/' . $fotoName);
                return redirect()->to(base_url('register/biopemilik'))->withInput();
            }
        } else {
            return redirect()->to(base_url('register/biopemilik'))->withInput();
        }
    }

    public function biobb()
    {
        $data = [
            'title' => 'Barberhouse',
            'subtitle' => 'Bio Barbershop',
            'validation' => (session('errors')) ? session('errors') : \Config\Services::validation(),
        ];
        return view('view_bio_bb', $data);
    }

    public function savebb()
    {
        $valid = $this->validate([
            'nama_bb' => [
                'label' => 'Nama Barbershop',
                'rules' => 'required',
                'errors' => [
                    'errors' => '{field} wajib diisi.',
                ]
            ],
            'latitude' => [
                'label' => 'Latitude',
                'rules' => 'required',
                'errors' => [
                    'errors' => '{field} wajib diisi.',
                ]
            ],
            'longitude' => [
                'label' => 'Longitude',
                'rules' => 'required',
                'errors' => [
                    'errors' => '{field} wajib diisi.',
                ]
            ],
            'alamat_bb' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'errors' => '{field} wajib diisi.',
                ]
            ],
            'ket_bb' => [
                'label' => 'Keterangan',
                'rules' => 'required',
                'errors' => [
                    'errors' => '{field} wajib diisi.',
                ]
            ],
        ]);
        if (!$valid) {
            session()->setFlashdata('errors', $this->validator);
            return redirect()->to(base_url('register/biobb'))->withInput();
        }
        $foto = $this->request->getFile('foto_bb');
        $fotoName = $foto->getRandomName();
        $foto->move('assets/images/barber/', $fotoName);
        if ($foto->hasMoved()) {
            $dtpemilik = $this->ModelUser->join('tbl_detail_pemilik', 'tbl_user.id_user=tbl_detail_pemilik.id_user')->where('email', session('bio'))->first();
            $dt = [
                'telepon_bb' => $this->request->getPost('telepon_bb'),
                'alamat_bb' => $this->request->getPost('alamat_bb'),
                'longitude' => $this->request->getPost('longitude'),
                'latitude' => $this->request->getPost('latitude'),
                'nama_bb' => $this->request->getPost('nama_bb'),
                'ket_bb' => $this->request->getPost('ket_bb'),
                'foto_bb' => $fotoName,
                'id_detail_pemilik' => $dtpemilik['id_detail_pemilik']
            ];
            $ModelBB = new ModelBB();
            if ($ModelBB->insert($dt)) {
                session()->remove('bio');
                session()->setFlashdata('success', 'Anda sudah dapat melakukan login.');
                return redirect()->to(base_url());
            } else {
                unlink('assets/images/barber/' . $fotoName);
                return redirect()->to(base_url('register/biobb'))->withInput();
            }
        } else {
            return redirect()->to(base_url('register/biobb'))->withInput();
        }
    }

    public function cancel()
    {
        if (session('regist')) {
            $this->ModelUser->delete("email='" . session('regist') . "'");
        }
        if (session('token')) {
            $this->ModelUser->delete("email='" . session('token') . "'");
        }
        if (session('bio')) {
            $dt = $this->ModelUser->where('email', session('bio'))->first();
            $data_pemilik = $this->ModelDetailPemilik->where('id_user', $dt['id_user'])->findAll();
            try {
                unlink('assets/images/user/' . $data_pemilik[0]['foto']);
            } catch (Exception $e) {
            }
            $this->ModelDetailPemilik->delete('id_user="' . $dt['id_user'] . '"');
            $this->ModelUser->delete('id_user="' . $dt['id_user'] . '"');
        }
        session()->remove('regist');
        session()->remove('token');
        session()->remove('bio');

        return redirect()->to(base_url());
    }
}
