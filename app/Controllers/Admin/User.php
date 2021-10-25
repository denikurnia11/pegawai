<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;


class User extends BaseController
{
    public function index()
    {
        $user = new UserModel();

        $data = [
            'user' => $user->paginate(5, 'user'),
            'pager' => $user->pager
        ];

        return view('admin/user', $data);
    }

    public function tambah()
    {
        $data = [
            'validasi' => \Config\Services::validation()
        ];

        return view('admin/tambah_user', $data);
    }

    public function ubah($id)
    {
        $user = new UserModel();

        $data = [
            'user' => $user->find($id),
            'validasi' => \Config\Services::validation()
        ];
        return view('admin/edit_user', $data);
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
