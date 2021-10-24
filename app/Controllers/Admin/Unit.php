<?php

namespace App\Controllers\Admin;

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
    return view('admin/unit', $data);
  }

  public function tambah()
  {
    return view('admin/tambah_unit');
  }

  public function ubah($id_unitkerja)
  {
    $unit = new UnitModel();

    $data['unit'] = $unit->find($id_unitkerja);

    if (!$data['unit']) return redirect()->to('/admin/unit');

    return view('admin/edit_unit', $data);
  }

  public function edit($id_unitkerja)
  {
    $unit = new UnitModel();
    //Validasi
    if (!$this->validate([
      'nama_unitkerja' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama unit kerja harus diisi.'
        ]
      ],
      'dokumen' => [
        'rules' => 'ext_in[dokumen,pdf,docx]|max_size[dokumen,5120]',
        'errors' => [
          'ext_in' => 'File harus berextensi pdf atau word',
          'max_size' => 'File maksimal 5mb.',
        ]
      ],
    ])) {
      session()->setFlashData('error', \Config\Services::validation()->getErrors());
      return redirect()->to('/admin/unit/ubah/' . $id_unitkerja);
      // return redirect()->to(base_url() . '/unit/tambah')->withInput();
    }

    // Mengambil dokumen baru
    $fileDokumen = $this->request->getFile('dokumen');
    // Mengambil nama dokumen lama dari input hidden
    $dokumenLama = $this->request->getVar('dokumenLama');
    // Cek apakah mengupload dokumen
    if ($fileDokumen->getError() == 4) {
      $namaDokumen = $dokumenLama;
    } else {
      // Membuat nama random untuk dokumen
      $namaDokumen = $fileDokumen->getRandomName();
      // Move ke folder public/uploads
      $path = FCPATH . 'uploads';
      $fileDokumen->move($path, $namaDokumen);
      // Hapus dokumen lama di folder uploads
      unlink('uploads/' . $dokumenLama);
    }

    $unit->update($id_unitkerja, [
      'nama_unitkerja' => $this->request->getPost('nama_unitkerja'),
      'dokumen' => $namaDokumen
    ]);
    return redirect()->to('/admin/unit');
  }

  public function create()
  {
    $unit = new UnitModel();
    //Validasi
    if (!$this->validate([
      'nama_unitkerja' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama unit kerja harus diisi.'
        ]
      ],
      'dokumen' => [
        'rules' => 'uploaded[dokumen]|ext_in[dokumen,pdf,docx]|max_size[dokumen,5120]',
        'errors' => [
          'uploaded' => 'File harus diisi.',
          'ext_in' => 'File harus berextensi pdf atau word',
          'max_size' => 'File maksimal 5mb.',
        ]
      ],
    ])) {
      session()->setFlashData('error', \Config\Services::validation()->getErrors());
      return redirect()->to('/admin/unit/tambah');
      // return redirect()->to(base_url() . '/unit/tambah')->withInput();
    }

    // Mengambil Dokumen
    $fileDokumen = $this->request->getFile('dokumen');
    // Membuat nama random untuk Dokumennya
    $namaDokumen = $fileDokumen->getRandomName();
    // Move ke folder public/uploads
    $path = FCPATH . 'uploads';
    $fileDokumen->move($path, $namaDokumen);

    $unit->save([
      'nama_unitkerja' => $this->request->getPost('nama_unitkerja'),
      'dokumen' => $namaDokumen
    ]);
    return redirect()->to('/admin/unit');
  }

  public function delete($id_unitkerja)
  {
    $unit = new UnitModel();

    $unit->delete($id_unitkerja);

    return redirect()->to('/admin/unit');
  }
}
