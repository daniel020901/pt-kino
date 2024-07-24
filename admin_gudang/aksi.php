<?php

require 'vendor/autoload.php';
include "../fungsi/koneksi.php";

$host = "localhost";
$user = "root";
$pass = "";
$db = "barang-kino";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (isset($_POST['submit'])) {
    $err = "";
    $ekstensi = "";
    $success = "";

    $file_name = $_FILES['filexls']['name']; // untuk mendapatkan nama file yang diupload
    $file_data = $_FILES['filexls']['tmp_name']; // untuk mendapatkan temporary data

    if (empty($file_name)) {
        $err .= "<li>Silahkan masukan file anda.</li>";
    } else {
        $ekstensi = pathinfo($file_name, PATHINFO_EXTENSION);
    }

    $ekstensi_allowed = array("xls", "xlsx");
    // peringatan apabila file tidak sesuai
    if (!in_array($ekstensi, $ekstensi_allowed)) {
        $err .= "<li>Silahkan masukan file tipe xls, atau xlsx. File yang kamu masukan <b>$file_name</b> punya tipe <b>$ekstensi</b></li>";
    }
    // mengambil isi file xls
    if (empty($err)) {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("$file_data");
        $spreadsheet = $reader->load($file_data);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $jumlahData = 0;
        for ($i = 1; $i < count($sheetData); $i++) {
            $nik_tapman = $sheetData[$i][0];
            $nik_sunfish = $sheetData[$i][1];
            $nama = $sheetData[$i][2];
            $kode = $sheetData[$i][3];
            $kode_plant = $sheetData[$i][4];
            $tanggal = $sheetData[$i][5];
            $break_out = $sheetData[$i][6];
            $break_in = $sheetData[$i][7];
            $keterangan = $sheetData[$i][8];
            $alat = $sheetData[$i][9];

            // Mengubah format tanggal dari dd/mm/yyyy ke yyyy-mm-dd
            $date = DateTime::createFromFormat('d/m/Y', $tanggal);
            if ($date) {
                $tanggal = $date->format('Y-m-d');
            } else {
                $err .= "<li>Format tanggal tidak valid pada baris " . ($i + 1) . ".</li>";
                continue;
            }

            // Menghitung durasi istirahat dalam menit
            $break_out_time = strtotime($break_out);
            $break_in_time = strtotime($break_in);
            $break_duration = ($break_in_time - $break_out_time) / 60; // dalam menit

            // Menambahkan durasi istirahat ke keterangan
            $keterangan .= " Durasi istirahat: " . round($break_duration) . " menit";

            // Cek apakah data sudah ada
            $sql_check = "SELECT * FROM tbl_data WHERE NIK_TAPMAN='$nik_tapman' AND NIK_SUNFISH='$nik_sunfish' AND TANGGAL='$tanggal'";
            $result = mysqli_query($koneksi, $sql_check);

            if (mysqli_num_rows($result) == 0) {
                $sql1 = "INSERT INTO tbl_data (NIK_TAPMAN, NIK_SUNFISH, NAMA, KODE, KODE_PLANT, TANGGAL, BREAK_OUT, BREAK_IN, KETERANGAN, ALAT) 
                         VALUES ('$nik_tapman', '$nik_sunfish', '$nama', '$kode', '$kode_plant', '$tanggal', '$break_out', '$break_in', '$keterangan', '$alat')";

                mysqli_query($koneksi, $sql1);
                $jumlahData++;
            } else {
                $err .= "<li>Data dengan NIK_TAPMAN $nik_tapman, NIK_SUNFISH $nik_sunfish pada tanggal $tanggal sudah ada.</li>";
            }
        }

        if ($jumlahData > 0) {
            $_SESSION['success'] = "$jumlahData data berhasil dimasukan";
        }
    }

    if (!empty($err)) {
        $_SESSION['err'] = $err;
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Input</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Proses Input Data</h2>
        <?php if (isset($_SESSION['err'])): ?>
            <div class="alert alert-danger">
                <ul><?php echo $_SESSION['err']; unset($_SESSION['err']); ?></ul>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-primary">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
