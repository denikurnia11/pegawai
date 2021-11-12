<?php

namespace App\Modules\User\Controllers;

use App\Controllers\BaseController;
use App\Modules\User\Models\UnitModel;

class Unit extends BaseController
{
    public function index()
    {
        $unit = new UnitModel();
        $data = [
            'unit' => $unit->findAll()
        ];
        return view('App\Modules\User\Views\unit', $data);
    }
}
