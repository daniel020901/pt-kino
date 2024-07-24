<?php  


include "../fungsi/koneksi.php";

  


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload xlx</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

    
</head>
<body>
 
<div style="text-align:center; width:500px;padding:15px;" >

    <form action="" method="POST" enctype="multipart/form-data" class="row-g-2" id="uploadForm" >
    <?php include("aksi.php") ?>
        <div class="col-auto">
        <input class="form-control" type="file" name="filexls" id="fileInput" >
        </div>

        <div class="col-auto p-2 " id="uploadButton" >
        <input type="submit" name="submit" class="btn btn-primary" value="UPLOAD FILE XLS/XLSX">
        </div>
        
    </form>
    <a href="tampilkan_data.php">
    <button id="showButton" style="display:none;">Tampilkan Data</button>
    <div id="data-table"></div>
    </a>
    <div id="message"></div>
    <div id="dataTable"></div>
    
    
   
</div>




</body>
</html>