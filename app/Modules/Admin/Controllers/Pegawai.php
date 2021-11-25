<?php

namespace App\Modules\Admin\Controllers;

use App\Controllers\BaseController;
use App\Modules\Admin\Models\JabatanModel;
use App\Modules\Admin\Models\PegawaiModel;
use App\Modules\Admin\Models\UnitModel;
use FPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;


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

  public function cetakPdf()
  {
    $pegawai = new PegawaiModel();
    $pdf = new FPDF('p', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(200, 7, 'DAFTAR PEGAWAI', 0, 1, 'C');
    $pdf->Cell(10, 10, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 6, 'NO', 1, 0, 'C');
    $pdf->Cell(10, 6, 'NIP', 1, 0, 'C');
    $pdf->Cell(25, 6, 'NAMA ', 1, 0, 'C');
    $pdf->Cell(50, 6, 'Unit Kerja', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Jabatan', 1, 0, 'C');
    $pdf->Cell(50, 6, 'Foto', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(200, 6, '', 0, 1);

    $i = 1;
    $data = $pegawai->getPegawai();
    foreach ($data as $item) {
      $pdf->Cell(10, 30, $i++, 1, 0, 'C');
      $img = base_url('uploads/' . $item['foto']);
      $pdf->Cell(10, 30, $item['nip'], 1, 0, 'C');
      $pdf->Cell(25, 30, $item['nama_pegawai'], 1, 0, 'C');
      $pdf->Cell(50, 30, $item['nama_unitkerja'], 1, 0, 'C');
      $pdf->Cell(30, 30, $item['nama_jabatan'], 1, 0, 'C');
      $pdf->Cell(50, 30, $pdf->Image($img, $pdf->GetX(), $pdf->GetY(), 50, 30), 1, 1, 'C');
    }
    $response = service('response');
    $response->setHeader('Content-Type', 'application/pdf');
    $pdf->Output('D', 'Data Pegawai.pdf');
  }

  public function cetakExcel()
  {
    $pegawai = new PegawaiModel();
    $data = $pegawai->getPegawai();

    $spreadsheet = new Spreadsheet();
    // tulis header/nama kolom 
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'No')
      ->setCellValue('B1', 'NIP')
      ->setCellValue('C1', 'Nama')
      ->setCellValue('D1', 'Unit Kerja')
      ->setCellValue('E1', 'Jabatan')
      ->setCellValue('F1', 'Foto');

    $column = 2;
    // tulis data buku ke cell
    $i = 1;
    foreach ($data as $data) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $column, $i++)
        ->setCellValue('B' . $column, $data['nip'])
        ->setCellValue('C' . $column, $data['nama_pegawai'])
        ->setCellValue('D' . $column, $data['nama_unitkerja'])
        ->setCellValue('E' . $column, $data['nama_jabatan']);
      // Menambah foto
      $objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
      $objDrawing->setPath('uploads/' . $data['foto']);
      $objDrawing->setCoordinates('F' . $column);
      $objDrawing->setOffsetX(5);
      $objDrawing->setOffsetY(5);
      $objDrawing->setWidth(50);
      $objDrawing->setHeight(50);
      $objDrawing->setWorksheet($spreadsheet->getActiveSheet());
      // Mengatur row height
      $spreadsheet->getActiveSheet()->getRowDimension($column)->setRowHeight(50);
      $column++;
    }
    // tulis dalam format .xlsx
    $writer = new Xlsx($spreadsheet);
    $fileName = 'Data Pegawai';

    // Redirect hasil generate xlsx ke web client
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetakWord()
  {
    $pegawai = new PegawaiModel();
    $word = new PhpWord();
    $sect = $word->addSection();
    $title = array('size' => 16, 'bold' => true);
    $sect->addText("Data Pegawai", $title);
    $sect->addTextBreak(1);

    $styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80);
    $styleCell = array('valign' => 'center');
    $fontHeader = array('bold' => true);
    $noSpace = array('spaceAfter' => 0);
    $imgStyle = array('width' => 50, 'height' => 50);

    $word->addTableStyle('mytable', $styleTable);
    $table = $sect->addTable('mytable');
    $table->addRow();
    $table->addCell(500, $styleCell)->addText('NO', $fontHeader, $noSpace);
    $table->addCell(2000, $styleCell)->addText('NIP', $fontHeader, $noSpace);
    $table->addCell(2000, $styleCell)->addText('NAMA', $fontHeader, $noSpace);
    $table->addCell(2000, $styleCell)->addText('UNIT KERJA', $fontHeader, $noSpace);
    $table->addCell(2000, $styleCell)->addText('JABATAN', $fontHeader, $noSpace);
    $table->addCell(2000, $styleCell)->addText('FOTO', $fontHeader, $noSpace);


    $data = $pegawai->getPegawai();
    $i = 1;

    foreach ($data as $item) {
      $table->addRow();
      $table->addCell(500, $styleCell)->addText($i++, array(), $noSpace);
      $table->addCell(2000, $styleCell)->addText($item['nip'], array(), $noSpace);
      $table->addCell(2000, $styleCell)->addText($item['nama_pegawai'], array(), $noSpace);
      $table->addCell(2000, $styleCell)->addText($item['nama_unitkerja'], array(), $noSpace);
      $table->addCell(2000, $styleCell)->addText($item['nama_jabatan'], array(), $noSpace);
      $table->addCell(1000, $styleCell)->addImage('uploads/' . $item['foto'], $imgStyle);
    }

    $filename = "dataPegawai.docx";
    header('Content-Type: application/msword');
    header('Content-Disposition: attachment;filename="' . $filename . '"');

    $objWriter = IOFactory::createWriter($word, 'Word2007');
    $objWriter->save('php://output');
    exit;
  }
}
