<?php

namespace App\Modules\Auth\Controllers;

use App\Controllers\BaseController;
use App\Modules\Auth\Models\UserModel;

class Registrasi extends BaseController
{
    public function index()
    {
        $data = [
            'validasi' => \Config\Services::validation()
        ];
        return view('App\Modules\Auth\Views\registrasi', $data);
    }

    public function create()
    {
        $userModel = new UserModel();
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
