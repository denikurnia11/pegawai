<?php

namespace App\Modules\User\Controllers;

use App\Controllers\BaseController;
use App\Modules\User\Models\JabatanModel;


class Jabatan extends BaseController
{
    public function index()
    {
        $jabatan = new JabatanModel();

        $data = [
            'jabatan' => $jabatan->getJabatan(),

        ];

        return view('App\Modules\User\Views\jabatan', $data);
    }
}
