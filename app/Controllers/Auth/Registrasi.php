<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Registrasi extends BaseController
{
    public function index()
    {
        $data = [
            'validasi' => \Config\Services::validation()
        ];
        return view('auth/registrasi', $data);
    }

    public function create()
    {
        $userModel = new UserModel();
        //Validasi
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email harus diisi.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.'
                ]
            ],
            'cpassword' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.'
                ]
            ],

        ])) {
            return redirect()->to(base_url() . '/auth/registrasi')->withInput();
        }
        // Cek confirm password
        $pass = $this->request->getVar('password');
        $cpass = $this->request->getVar('cpassword');
        if ($pass !== $cpass) {
            session()->setFlashdata('pesan', 'Confirm password tidak valid.');
            return redirect()->to(base_url() . '/auth/registrasi');
        }
        $userModel->save([
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => md5($pass)
        ]);
        session()->setFlashdata('pesan', 'Akun berhasil dibuat.');
        return redirect()->to(base_url() . '/auth/login');
    }
}
