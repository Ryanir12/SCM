<script>
  window.print();
</script>




<?php

include "../../koneksi/koneksi.php";
$nama = $_POST['nama'];


$tahun = $_POST['tahun'];
$bulan = $_POST['bulan'];

if ($bulan == 1) {
  $namabulan = 'Januari';
} else  if ($bulan == 2) {
  $namabulan = 'Februari';
} else  if ($bulan == 3) {
  $namabulan = 'Maret';
} else  if ($bulan == 4) {
  $namabulan = 'April';
} else  if ($bulan == 5) {
  $namabulan = 'Mei';
} else  if ($bulan == 6) {
  $namabulan = 'Juni';
} else  if ($bulan == 7) {
  $namabulan = 'Juli';
} else  if ($bulan == 8) {
  $namabulan = 'Agustus';
} else  if ($bulan == 9) {
  $namabulan = 'September';
} else  if ($bulan == 10) {
  $namabulan = 'Oktober';
} else  if ($bulan == 11) {
  $namabulan = 'November';
} else  if ($bulan == 12) {
  $namabulan = 'Desember';
}


?>


<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Supply Chain Management</title>
  <!-- Favicon-->
  <link rel="icon" href="../../images/Fusionlabs_Logo.ico" type="../../image/x-icon">

  <!-- Google Fonts -->
  <link href="../../css/assets/satu.css" rel="stylesheet" type="text/css">
  <link href="../../css/assets/dua.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap Core Css -->
  <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Waves Effect Css -->
  <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

  <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

  <!-- Custom Css -->
  <link href="../../css/style.css" rel="stylesheet">

  <script src="../../plugins/jquery/jquery.min.js"></script>

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="../../css/themes/all-themes.css" rel="stylesheet" />
</head>

<body>


  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">

        <div style="margin-bottom:-20px;" class="header" align="center">
          <table>
            <thead>
              <tr>


                <td width="80%">
                  <div align="center">
                    <h1>FusionLabs.id</h1>
                    <h2>Batusangkar</h2>
                    <i>
                      <p>0822-8538-5590</p>
                    </i>

                  </div>
        </div>


        </td>
        </tr>

        </thead>

        </table>
      </div>


      <div class="body">
        <div class="header mb-4" align="center">
          <hr>

          <h2 align="Center">
            Laporan Pembelian Bulanan Barang
          </h2>

          <h2 align="center">
            Bulan : <?php echo $namabulan; ?> Tahun : <?php echo $tahun; ?>


          </h2>

        </div>
        <br>
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Pembelian</th>
              <th>Tanggal Transaksi</th>
              <th>Barang Pembelian</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Sub Total</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $pengeluaran2 = 0;
            $sql1 = $koneksi->query("SELECT * FROM tb_transaksi WHERE kode_penjualan='-' AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun'");
            while ($tampil1 = $sql1->fetch_assoc()) {
              $kode = $tampil1['kode_pembelian'];
            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $tampil1['kode_pembelian']; ?></td>
                <td><?php echo date('d F Y', strtotime($tampil1['tanggal'])); ?></td>
                <td>
                  <ol>
                    <?php
                    $queryListBarang = mysqli_query($koneksi, "SELECT * FROM tb_pembelian WHERE kode_pembelian='$kode'");
                    while ($dataLB = mysqli_fetch_array($queryListBarang)) {
                      $kode_barang = $dataLB['kode_barang'];
                      $sql2 = $koneksi->query("SELECT * FROM tb_barang WHERE kode_barang='$kode_barang'");
                      $tampil2 = $sql2->fetch_assoc();

                      // Menghitung subtotal per barang
                      $sub_total = $dataLB['jumlah'] * $tampil2['harga_beli'];
                    ?>
                      <li>
                        <?php echo $tampil2['nama_barang']; ?>
                        <br>Harga: Rp. <?php echo number_format($tampil2['harga_beli']); ?>,-
                        <br>Jumlah: <?php echo $dataLB['jumlah']; ?> <?php echo $tampil2['satuan']; ?>
                        <br>Sub Total: Rp. <?php echo number_format($sub_total); ?>,-
                      </li>
                    <?php
                    }
                    ?>
                  </ol>
                </td>
                <td>
                  <?php
                  // Menghitung harga per barang
                  $queryListBarang = mysqli_query($koneksi, "SELECT * FROM tb_pembelian WHERE kode_pembelian='$kode'");
                  $harga_total = 0;
                  while ($dataLB = mysqli_fetch_array($queryListBarang)) {
                    $kode_barang = $dataLB['kode_barang'];
                    $sql2 = $koneksi->query("SELECT * FROM tb_barang WHERE kode_barang='$kode_barang'");
                    $tampil2 = $sql2->fetch_assoc();
                    $harga_total += $tampil2['harga_beli'];
                  }
                  echo "Rp. " . number_format($harga_total); ?>,-
                </td>
                <td>
                  <?php
                  // Menghitung total per barang
                  $queryListBarang = mysqli_query($koneksi, "SELECT * FROM tb_pembelian WHERE kode_pembelian='$kode'");
                  $jumlah_total = 0;
                  while ($dataLB = mysqli_fetch_array($queryListBarang)) {
                    $jumlah_total += $dataLB['jumlah'];
                  }
                  echo $jumlah_total;
                  ?>
                </td>
                <td><?php echo "Rp. " . number_format($tampil1['total']); ?>,-</td>
              </tr>
            <?php
              $pengeluaran2 += $tampil1['total'];
            }
            ?>
          </tbody>
          <tr>
            <th style="text-align: center; font-size: 17px;" colspan="6">Total ReStok</th>
            <td align="center" style="font-size: 15px;"><b><?php echo "Rp." . number_format($pengeluaran2); ?>,-</b></td>
          </tr>
        </table>


        <br><br>
        <div class="header" align="left">
          <h2>Padang, <?php echo date('d F Y') ?></h2>
          <h2>Penanggung Jawab,</h2>
          <br><br><br>
          <h2>________________________________</h2>
          <h2><?php echo $nama; ?></h2>
        </div>

        <!-- Bootstrap Core Js -->
        <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Select Plugin Js -->
        <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

        <!-- Slimscroll Plugin Js -->
        <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="../../plugins/node-waves/waves.js"></script>

        <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>


        <!-- Custom Js -->
        <script src="../../js/admin.js"></script>
        <script src="../../js/pages/tables/jquery-datatable.js"></script>

        <!-- Demo Js -->
        <script src="../../js/demo.js"></script>

</body>

</html>