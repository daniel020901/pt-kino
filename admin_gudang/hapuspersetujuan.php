<?php
	include "../fungsi/koneksi.php";

	if(isset($_GET['id'])){
		$id=$_GET['id'];
		
	    $query = mysqli_query($koneksi,"delete from permintaan where id_permintaan='$id'");
	    if ($query) {
	    	header("location:index.php?p=disetujui");
	    } else {
	    	echo 'gagal';
	    }
	
	}
?>