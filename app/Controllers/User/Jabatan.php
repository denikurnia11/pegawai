<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\JabatanModel;


class Jabatan extends BaseController
{
    public function index()
    {
        $jabatan = new JabatanModel();

        $data = [
            'jabatan' => $jabatan->getJabatan(),
            'pager' => $jabatan->pager
        ];

        return view('user/jabatan', $data);
    }
}
