<?php ob_start();
include "../fungsi/fungsi.php";
?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {
    width: 100%;
    border: none;
    color: black;
    padding: 10px;
    text-align: center;
  }
  table.page_footer {
    width: 100%;
    border: none;
    background-color: #3C8DBC;
    border-top: solid 1mm #AAAADD;
    padding: 10px;
    text-align: center;
    position: fixed;
    bottom: 0;
  }
  h1 {
    color: #000033;
    text-align: center;
  }
  h2 {
    color: #000055;
    text-align: center;
  }
  h3 {
    color: #000077;
    text-align: center;
  }
  .tabel2 {
    width: 100%;
    border-collapse: collapse;
    margin: 20px auto;
  }
  .tabel2 th, .tabel2 td {
    padding: 8px;
    border: 1px solid #959595;
    text-align: center;
  }
  .container {
    width: 100%;
    max-width: 1020px;
    margin: 0 auto;
    text-align: center;
  }
  .header-img {
    width: 100px;
    height: 100px;
  }
  .footer-info {
    width: 100%;
    text-align: center;
    margin-top: 20px;
  }
  .footer-info div {
    display: inline-block;
    width: 48%;
    vertical-align: top;
  }
  .footer-info div p {
    text-align: center;
  }
  .footer-info .left {
    text-align: left;
  }
  .footer-info .right {
    text-align: right;
  }
</style>
<div class="container">
  <h2><u>LAPORAN PERMINTAAN BARANG</u></h2>
  <table class="tabel2">
    <thead>
      <tr>
        <th>No.</th>
        <th>Tanggal Permintaan</th>
        <th>Unit Pelayanan</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Jenis Barang</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include "../fungsi/koneksi.php";
      $query = mysqli_query($koneksi, "SELECT * FROM permintaan");
      $i = 1;
      while ($data = mysqli_fetch_array($query)) {
      ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo tanggal_indo($data['tgl_permintaan']); ?></td>
          <td><?php echo $data['unit']; ?></td>
          <td><?php echo $data['kode_brg']; ?></td>
          <td><?php echo $data['nama_barang']; ?></td>
          <td><?php echo $data['jenis_barang']; ?></td>
          <td><?php echo $data['jumlah']; ?></td>
          <td><?php echo $data['keterangan']; ?></td>
        </tr>
      <?php
        $i++;
      }
      ?>
    </tbody>
  </table>
</div>
<?php
ob_end_flush();
?>
