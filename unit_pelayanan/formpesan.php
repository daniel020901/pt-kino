<?php  
    include "../fungsi/koneksi.php";
    $error = "";


?>

<section class="content">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Form Permintaan Barang</h3>
                </div>

                <!-- FORM PERMINTAAN -->
                <form method="post" id="tes"  action="add-proses.php" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="nama_brg" class="a col-sm-3 control-label">Unit Pelayanan</label>
                            <div class="col-sm-3">
                                <input type="text" readonly value="<?= $_SESSION['username']; ?>" class="form-control" name="unit">
                            </div>
                        </div>
                        <!-- Input Jenis Barang -->
                         <div class="form-group">
                            <label for="jenis_barang" class=" col-sm-3 control-label">Jenis Barang</label>
                            <div class="col-sm-5">
                                <input type="text" id="jenis_barang" required="isikan dulu" class="form-control" name="jenis_barang">
                            </div>
                        </div>

                        <!-- Input nama barang -->
                        <div class="form-group">
                            <label  for="nama_brg" class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-5">
                            <input type="text" id="nama_brg" required="isikan dulu" class="form-control" name="nama_barang">
                            </div>
                        </div>

                        <!-- Input kode barang -->
                        <div class="form-group">
                            <label  for="nama_brg" class="col-sm-3 control-label">Kode Barang</label>
                            <div class="col-sm-5">
                            <input type="text" id="nama_brg" required="isikan dulu" class="form-control" name="kode_brg">
                            </div>
                        </div>

                        <!-- Input keterangan -->
                        <div class="form-group">
                            <label  for="keterangan" class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-5">
                            <textarea name="keterangan" class="form-control" rows="5" id="Keterangan"></textarea>
                            </div>
                        </div>

                        <!-- Input jumlah -->
                         <div class="form-group">
                            <label for="stok" class=" col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-3">
                                <input id="jumlah" type="number" onkeyup="sendAjax()" class="form-control" name="jumlah" required>                                
                            </div>
                            <span class="col-sm-7"> <?php echo $error; ?></span>
                        </div>                         
                        
                        <!-- Input aksi -->
                        <div class="form-group">
                            <input type="submit" id="simpan" name="simpan" class="btn btn-primary col-sm-offset-3 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal" id="resetButton">       
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Permintaan Hari Ini</h3>
                </div>
                
                    <table class="table table-responsive">
                        <tr>
                            <th>No</th>
                            <th>Jenis Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Kode Barang</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                        <tr>
                        <?php 
                            $sekarang  = date("Y-m-d");
                            $queryTampil = mysqli_query($koneksi, "SELECT * FROM sementara WHERE tgl_permintaan = '$sekarang' AND sementara.unit='$_SESSION[username]' "  );
                            $no = 1;
                            if(mysqli_num_rows($queryTampil) > 0) {
                                while($row = mysqli_fetch_assoc($queryTampil)):
                         ?>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['jenis_barang']; ?></td>
                            <td><?php echo $row['nama_barang']; ?></td>
                            <td><?php echo $row['jumlah']; ?> </td>
                            <td><?php echo $row['kode_brg'] ?></td>                    
                            <td><?php echo $row['keterangan'] ?></td>                    
                            <td><a href="hapusps.php?id=<?php echo $row['id_sementara']; ?>" class="btn btn-danger">Hapus</a></td>
                        </tr>
                    <?php $no++; endwhile; } 
                    else { echo "<tr><td>Tidak ada permintaan barang hari ini</td></tr>"; } ?>
                    </table>    
                <div class="box-body">
                    <a class="btn btn-success" href="pesan.php" >Minta Barang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // $(document).ready(function(){
    //     $("#jenis_brg").change(function(){
    //         var jenis = $(this).val();
    //         var dataString = 'jenis='+jenis;
    //         $.ajax({
    //             type:"POST",
    //             url:"getdata.php",
    //             data:dataString,
    //             success:function(html){
    //                 $("#nama_brg").html(html);                    
    //             }
    //         });
    //     });

    //     $("#nama_brg").change(function(){
    //         var kode = $(this).val();
    //         var dataString = 'kode='+kode;
    //         $.ajax({
    //             type:"POST",
    //             url:"getkode.php",
    //             data:dataString,
    //             success:function(html){
    //                 $("#stok").val(html);        
    //             }
    //         });
    //     });
				       
    // });
    document.getElementById('resetButton').addEventListener('click', function() {
    window.location.href = 'index.php';
});
	
	 function cek_stok(){
                var jumlah = $("#jumlah").val();                
                var kode_brg = $("#nama_brg").val();   
                $.ajax({
                    url: 'cekstok.php',
                    data:"jumlah="+jumlah+"&kode_brg="+kode_brg,
                    dataType:'json',
                }).success(function (data) {                                      
                                      
                   
                        if(data.hasil == 1){                            
                            $("#tes").submit(function(e){
                                e.preventDefault();
                                alert(data.pesan);
                            });
                        }
                        
                   

                });
            }

   function sendAjax() {
    setTimeout(
        function() {
            var jumlah = $("#jumlah").val();                
                var kode_brg = $("#nama_brg").val();   
                $.ajax({
                    url: 'cekstok.php',
                    data:"jumlah="+jumlah+"&kode_brg="+kode_brg,
                    dataType:'json',
                }).success(function (data) {                                      
                        if(data.hasil == 1){                            
                                alert(data.pesan);
                                $("#jumlah").val("");
                        }
                });
        }, 1000);
}
</script>