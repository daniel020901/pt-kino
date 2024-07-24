 
<?php 
  
    $page = isset($_GET['p']) ? $_GET['p'] : "";

    if ($page == 'material') {
        include_once "material.php";
    } else if ($page=="") {
        include_once "main.php";
    } else if ($page=="datapesanan") {
        include_once "datapesanan.php";
    } else if ($page=="editpesan") {
        include_once "editpesan.php";
    } else if ($page=="tidaksetuju") {
        include_once "tidaksetuju.php";
    } else if ($page=="disetujui") {
        include_once "disetujui.php";
    } else if($page == "detil"){
        include_once "detilpesan.php";
    } else if($page == "user"){
        include_once "user.php";
    } else if ($page=="hapususer") {
        include_once "hapususer.php";
    } else if ($page=="edituser") {
        include_once "edituser.php";
    } else if ($page=="tambahuser") {
        include_once "tambahuser.php";
    } else if ($page=="hapuspersetujuan") {
        include_once "hapuspersetujuan.php";
    } else if ($page=="formKaryawan") {
        include_once "formKaryawan.php";
    } else if ($page=="tampilanKaryawan") {
        include_once "tampilanKaryawan.php";
    }
 ?>
 
