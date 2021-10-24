<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JabatanModel;
use App\Models\UnitModel;

class Jabatan extends BaseController
{
  public function index()
  {
    $jabatan = new JabatanModel();

    $data = [
      'jabatan' => $jabatan->getJabatan(),
      'pager' => $jabatan->pager
    ];

    return view('admin/jabatan', $data);
  }

  public function tambah()
  {
    $unit = new UnitModel();

    $data['unit'] = $unit->findAll();

    return view('admin/tambah_jabatan', $data);
  }

  public function ubah($id_jabatan)
  {
    $jabatan = new JabatanModel();
    $unit = new UnitModel();

    $data['jabatan'] = $jabatan->find($id_jabatan);
    $data['unit'] = $unit->findAll();

    return view('admin/edit_jabatan', $data);
  }

  public function edit($id_jabatan)
  {
    $jabatanModel = new JabatanModel();

    $jabatanModel->update($id_jabatan, [
      'nama_jabatan' => $this->request->getPost('nama_jabatan'),
      'id_unitkerja' => $this->request->getPost('id_unitkerja')
    ]);

    return redirect()->to('/admin/jabatan');
  }

  public function create()
  {
    $jabatan = new JabatanModel();

    $jabatan->save([
      'nama_jabatan' => $this->request->getPost('nama_jabatan'),
      'id_unitkerja' => $this->request->getPost('id_unitkerja')
    ]);

    return redirect()->to('/admin/jabatan');
  }

  public function delete($id_jabatan)
  {
    $jabatan = new JabatanModel();

    $jabatan->delete($id_jabatan);

    return redirect()->to('/admin/jabatan');
  }
}
