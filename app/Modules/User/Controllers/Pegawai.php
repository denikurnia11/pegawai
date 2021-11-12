<?php

namespace App\Modules\User\Controllers;

use App\Controllers\BaseController;
use App\Modules\User\Models\PegawaiModel;


class Pegawai extends BaseController
{
    public function index()
    {
        $pegawai = new PegawaiModel();

        $data = [
            'pegawai' => $pegawai->getPegawai(),

        ];

        return view('App\Modules\User\Views\pegawai', $data);
    }
}
