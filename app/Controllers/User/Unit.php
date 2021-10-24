<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UnitModel;

class Unit extends BaseController
{
    public function index()
    {
        $unit = new UnitModel();
        $data = [
            'unit' => $unit->paginate(2, 'unit'),
            'pager' => $unit->pager
        ];
        return view('user/unit', $data);
    }
}
