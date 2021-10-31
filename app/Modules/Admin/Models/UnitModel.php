<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
  protected $table      = 'unit_kerja';
  protected $primaryKey = 'id_unitkerja';

  protected $allowedFields = ['nama_unitkerja', 'dokumen'];
}
