<?php

namespace App\Models;

use App\Controllers\Pegawai;
use CodeIgniter\Model;

class PegawaiModel extends Model
{
  protected $table      = 'pegawai';
  protected $primaryKey = 'nip';

  protected $allowedFields = ['nama_pegawai', 'id_jabatan', 'id_unitkerja', 'foto'];

  public function getPegawai()
  {
    return $this
      ->join('unit_kerja', 'pegawai.id_unitkerja = unit_kerja.id_unitkerja')
      ->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan')
      ->paginate(2, 'pegawai');
  }
}
