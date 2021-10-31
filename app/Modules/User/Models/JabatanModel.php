<?php

namespace App\Modules\User\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
  protected $table      = 'jabatan';
  protected $primaryKey = 'id_jabatan';

  protected $allowedFields = ['nama_jabatan', 'id_unitkerja'];

  public function getJabatan()
  {
    return $this->join('unit_kerja', 'jabatan.id_unitkerja = unit_kerja.id_unitkerja')->paginate(2, 'jabatan');
  }
}
