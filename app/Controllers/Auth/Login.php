<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function cek()
    {
        $userModel = new UserModel();
        // Ambil data dari form
        $data = $this->request->getVar();
        // Ambil data user di database yang emailnya sama 
        $dataUser = $userModel->where('email', $data['email'])->first();

        if (!$dataUser) {
            // Jika Email tidak ditemukan, balikkan ke halaman login
            session()->setFlashdata('pesan', 'Email tidak ditemukan');
            return redirect()->to('/');
        }
        // Cek password
        // Jika salah arahkan lagi ke halaman login
        if (md5($data['password']) !== $dataUser['password']) {
            session()->setFlashdata('pesan', 'Password salah');
            return redirect()->to('/');
        } else {
            // Jika benar, arahkan user masuk ke aplikasi 
            $sessLogin = [
                'nama' => $dataUser['nama'],
                'role' => $dataUser['role']
            ];
            session()->set($sessLogin);
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
