<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;

include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header kolom
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'Tanggal Permintaan');
$sheet->setCellValue('C1', 'Unit Pelayanan');
$sheet->setCellValue('D1', 'Kode Barang');
$sheet->setCellValue('E1', 'Nama Barang');
$sheet->setCellValue('F1', 'Jenis Barang');
$sheet->setCellValue('G1', 'Jumlah');
$sheet->setCellValue('H1', 'Keterangan');

// Bolding header
$headerRange = 'A1:H1';
$spreadsheet->getActiveSheet()->getStyle($headerRange)->getFont()->setBold(true);

// Ambil data dari database
$query = mysqli_query($koneksi, "SELECT * FROM permintaan");
$i = 2; // mulai dari baris ke-2
$no = 1;

while ($data = mysqli_fetch_array($query)) {
    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, tanggal_indo($data['tgl_permintaan']));
    $sheet->setCellValue('C' . $i, $data['unit']);
    $sheet->setCellValue('D' . $i, $data['kode_brg']);
    $sheet->setCellValue('E' . $i, $data['nama_barang']);
    $sheet->setCellValue('F' . $i, $data['jenis_barang']);
    $sheet->setCellValue('G' . $i, $data['jumlah']);
    $sheet->setCellValue('H' . $i, $data['keterangan']);
    $i++;
    $no++;
}

// Menerapkan border pada tabel
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
];

$sheet->getStyle('A1:H' . ($i - 1))->applyFromArray($styleArray);

// Buat file Excel dan simpan
$writer = new Xlsx($spreadsheet);
$filename = 'laporan_permintaan_barang.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $filename .'"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>
