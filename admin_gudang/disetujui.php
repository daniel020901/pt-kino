
<?php  
    include "../fungsi/koneksi.php";
	include "../fungsi/fungsi.php";

    if (isset($_GET['aksi']) && isset($_GET['id'])) {
        //die($id = $_GET['id']);
        $id = $_GET['id'];
        echo $id;

       if ($_GET['aksi'] == 'hapus') {
            header("location:?p=hapuspersetujuan&id=$id");
        } 
    }

    
    $query = mysqli_query($koneksi, "SELECT * FROM permintaan WHERE status=1 ORDER BY tgl_permintaan DESC "); 

    
?>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Persetujuan Permintaan Barang</h3>
                </div>    
                <div class="box-body"> 
                    <!-- Cetk Download/Print PDF8 -->
				<a href="downloadpdf.php" target="_blank" style="margin:10px 0px 10px 10px;" class="btn btn-success"> Download PDF</i></a>
				<a href="export_excel.php" target="_blank" style="margin:10px 0px 10px 0px;" class="btn btn-success"> Download Excel</i></a>
				<a href="cetak.php" target="_blank" style="margin:10px 0px 10px 0px;" class="btn btn-success"><i style="margin-right:5px;" class='fa fa-print'></i>Print PDF</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" id="datapesanan">
                            <thead  > 
                                <tr>
                                    <th>No</th> 
									<th>Tanggal Permintaan</th>
                                    <th>Unit Pelayanan</th>                                                                
                                    <th>Nama Barang</th>
									<th>Jenis Barang</th>
                                    <th>Jumlah</th>                                                           
                                    <th>Keterangan</th>                                                           
                                    <th>Status</th>                                    
                                    <th>Aksi</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $no =1 ;
                                        if (mysqli_num_rows($query)) {
                                            while($row=mysqli_fetch_assoc($query)):

                                     ?>
                                        <td> <?= $no; ?> </td>   
										<td> <?= tanggal_indo($row['tgl_permintaan']); ?> </td>										
                                        <td> <?= $row['unit']; ?> </td>
                                        <td> <?= $row['nama_barang']; ?> </td> 
										<td> <?= $row['jenis_barang']; ?> </td>										
                                        <td> <?= $row['jumlah']; ?> </td>
                                        <td> <?= $row['keterangan']; ?> </td>
                                        <td > <?php
                                                if ($row['status'] == 0){
                                                    echo '<span class=text-warning>Belum Disetujui</span>';
                                                } elseif ($row['status'] == 1) {
                                                    echo '<span class=text-primary>Telah Disetujui</span>';
                                                } else {
                                                    echo '<span class=text-danger>Tidak Disetujui</span>';
                                                }
                                               ?> 
                                         </td>   
                                         <td>
                                            <a  href="?p=disetujui&aksi=hapus&id=<?= $row['id_permintaan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Hapus'><button   class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus ?')">Hapus</button></span></a>            
                                         </td>  
                                                                                                                                   
                            </tr>
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Belum ada permintaan disetujui</td></tr>" . mysqli_error($koneksi);} ?>
                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>



</section>


