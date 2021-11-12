<?php

namespace App\Modules\Admin\Controllers;

use App\Controllers\BaseController;
use App\Modules\Admin\Models\UserModel;


class User extends BaseController
{
    public function index()
    {
        $user = new UserModel();

        $data = [
            'user' => $user->findAll()
        ];

        return view('App\Modules\Admin\Views\user', $data);
    }

    public function tambah()
    {
        $data = [
            'validasi' => \Config\Services::validation()
        ];

        return view('App\Modules\Admin\Views\tambah_user', $data);
    }

    public function ubah($id)
    {
        $user = new UserModel();

        $data = [
            'user' => $user->find($id),
            'validasi' => \Config\Services::validation()
        ];
        return view('App\Modules\Admin\Views\edit_user', $data);
    }

    public function edit($id)
    {
        // dd($this->request->getVar());
        $user = new UserModel();
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
            ]
        ])) {
            return redirect()->to(base_url() . '/admin/user/ubah/' . $id)->withInput();
        }

        $user->update($id, [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')),
            'role' => $this->request->getVar('role')
        ]);

        return redirect()->to('/admin/user');
    }

    public function create()
    {
        $user = new UserModel();
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
            ]

        ])) {
            return redirect()->to(base_url() . '/admin/user/tambah')->withInput();
        }


        $user->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')),
            'role' => $this->request->getVar('role')
        ]);

        return redirect()->to('/admin/user');
    }

    public function delete($id)
    {
        $user = new UserModel();

        $user->delete($id);

        return redirect()->to('/admin/user');
    }
}
