<?php  

	include "../fungsi/koneksi.php";

	if(isset($_POST['simpan'])) {

		$unit = $_POST['unit'];
		$nama_barang = $_POST['nama_barang'];
		$kode_brg = $_POST['kode_brg'];
		$jumlah = $_POST['jumlah'];		
		$tgl_pemesanan = date('Y-m-d');
		$jenis_barang = $_POST['jenis_barang'];
		$keterangan = $_POST['keterangan'];

		$query = "INSERT into sementara (nama_barang,unit, kode_brg,  jumlah, tgl_permintaan, jenis_barang, keterangan ) VALUES 
										('$nama_barang','$unit', '$kode_brg', '$jumlah', '$tgl_pemesanan', '$jenis_barang', '$keterangan')

			";
		$hasil = mysqli_query($koneksi, $query);
		if ($hasil) {
			header("location:index.php?p=formpesan");
		} else {
			die("ada kesalahan : " . mysqli_error($koneksi));
		}
	}
?>