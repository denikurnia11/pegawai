<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;


class Pegawai extends BaseController
{
    public function index()
    {
        $pegawai = new PegawaiModel();

        $data = [
            'pegawai' => $pegawai->getPegawai(),
            'pager' => $pegawai->pager
        ];

        return view('user/pegawai', $data);
    }
}
