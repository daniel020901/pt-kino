<?php  

	include "../fungsi/koneksi.php";

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$tanggal = date('Y-m-d');
		
		$query = mysqli_query($koneksi, "UPDATE permintaan SET status=1 WHERE id_permintaan='$id' ");				
	
		if($query) {
			header("location:index.php?p=datapesanan");
		} else {
			echo "ada yang salah" . mysqli_error($koneksi);
		}
	}


?>