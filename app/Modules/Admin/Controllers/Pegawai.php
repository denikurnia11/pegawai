<?php

namespace App\Modules\Admin\Controllers;

use App\Controllers\BaseController;
use App\Modules\Admin\Models\JabatanModel;
use App\Modules\Admin\Models\PegawaiModel;
use App\Modules\Admin\Models\UnitModel;

class Pegawai extends BaseController
{
  public function index()
  {
    $pegawai = new PegawaiModel();

    $data = [
      'pegawai' => $pegawai->getPegawai(),
    ];

    return view('App\Modules\Admin\Views\pegawai', $data);
  }

  public function tambah()
  {
    $unit = new UnitModel();
    $jabatan = new JabatanModel();
    $data = [
      'jabatan' => $jabatan->findAll(),
      'unit' => $unit->findAll(),
      'validasi' => \Config\Services::validation()
    ];

    return view('App\Modules\Admin\Views\tambah_pegawai', $data);
  }

  public function ubah($nip)
  {
    $pegawai = new PegawaiModel();
    $jabatan = new JabatanModel();
    $unit = new UnitModel();
    $data = [
      'pegawai' => $pegawai->find($nip),
      'jabatan' => $jabatan->findAll(),
      'unit' => $unit->findAll(),
      'validasi' => \Config\Services::validation()
    ];
    return view('App\Modules\Admin\Views\edit_pegawai', $data);
  }

  public function edit($id_jabatan)
  {
    $pegawaiModel = new PegawaiModel();
    //Validasi
    if (!$this->validate([
      'nama_pegawai' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama pegawai harus diisi.'
        ]
      ],
      'foto' => [
        'rules' => 'ext_in[foto,png,jpg]|max_size[foto,5120]',
        'errors' => [
          'ext_in' => 'File harus berextensi jpg atau png',
          'max_size' => 'File maksimal 5mb.',
        ]
      ],
    ])) {
      return redirect()->to(base_url() . '/admin/pegawai/ubah/' . $id_jabatan)->withInput();
    }

    // Mengambil foto baru
    $fileFoto = $this->request->getFile('foto');
    // Mengambil nama foto lama dari input hidden
    $fotoLama = $this->request->getVar('fotoLama');
    // Cek apakah mengupload foto
    if ($fileFoto->getError() == 4) {
      $namaFoto = $fotoLama;
    } else {
      // Membuat nama random untuk fotonya
      $namaFoto = $fileFoto->getRandomName();
      // Move ke folder public/img
      $path = FCPATH . 'uploads';
      $fileFoto->move($path, $namaFoto);
      // Hapus foto lama di folder img
      unlink('uploads/' . $fotoLama);
    }

    $pegawaiModel->update($id_jabatan, [
      'nama_pegawai' => $this->request->getPost('nama_pegawai'),
      'id_jabatan' => $this->request->getPost('id_jabatan'),
      'id_unitkerja' => $this->request->getPost('id_unitkerja'),
      'foto' => $namaFoto
    ]);

    return redirect()->to('/admin/pegawai');
  }

  public function create()
  {
    $pegawai = new PegawaiModel();
    //Validasi
    if (!$this->validate([
      'nama_pegawai' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama pegawai harus diisi.'
        ]
      ],
      'foto' => [
        'rules' => 'uploaded[foto]|ext_in[foto,png,jpg]|max_size[foto,5120]',
        'errors' => [
          'uploaded' => 'Foto harus diisi.',
          'ext_in' => 'File harus berextensi jpg atau png',
          'max_size' => 'File maksimal 5mb.',
        ]
      ],
    ])) {
      return redirect()->to(base_url() . '/admin/pegawai/tambah')->withInput();
    }

    // Mengambil foto
    $fileFoto = $this->request->getFile('foto');
    // Membuat nama random untuk fotonya
    $namaFoto = $fileFoto->getRandomName();
    // Move ke folder public/uploads/foto
    $path = FCPATH . 'uploads';
    $fileFoto->move($path, $namaFoto);

    $pegawai->save([
      'nama_pegawai' => $this->request->getPost('nama_pegawai'),
      'id_jabatan' => $this->request->getPost('id_jabatan'),
      'id_unitkerja' => $this->request->getPost('id_unitkerja'),
      'foto' => $namaFoto
    ]);

    return redirect()->to('/admin/pegawai');
  }

  public function delete($nip)
  {
    $pegawai = new PegawaiModel();

    $pegawai->delete($nip);

    return redirect()->to('/admin/pegawai');
  }
}
