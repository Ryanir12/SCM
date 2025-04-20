<script>
    window.print();
</script>

<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
if (@$_SESSION['admin'] || $_SESSION['kasir'] || $_SESSION['pimpinan'] || $_SESSION['supplier']) {
    include "koneksi/koneksi.php";
    include "include/kode_penjualan.php";
    include "include/kode_pembelian.php";


?>


    <?php

    include "../../koneksi/koneksi.php";

    ?>
    <?php
    if ($_SESSION['admin']) {
        $user_l = $_SESSION['admin'];
    } else if ($_SESSION['kasir']) {
        $user_l = $_SESSION['kasir'];
    } else if ($_SESSION['pimpinan']) {
        $user_l = $_SESSION['pimpinan'];
    } else if ($_SESSION['supplier']) {
        $user_l = $_SESSION['supplier'];
    }



    $sql_u = $koneksi->query("select* from tb_user where id='$user_l'");
    $data_u = $sql_u->fetch_assoc();
    $nama = $data_u['nama'];
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
                            Laporan Data Pembelian Barang
                        </h2>

                    </div>
                    <br>


                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Pembelian</th>
                                <th>Tanggal Transaksi</th>
                                <th>Barang Pembelian * Harga * Jumlah = <b>Sub Total</b> </th>
                                <th>Total</th>




                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            $no = 1;
                            $pengeluaran = 0;

                            $sql1 = $koneksi->query("select * from tb_transaksi where kode_penjualan='-' and nama='$nama' ");
                            while ($tampil1 = $sql1->fetch_assoc()) {
                                $kode = $tampil1['kode_pembelian'];






                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tampil1['kode_pembelian'] ?> </td>
                                    <td><?php echo date('d F Y', strtotime($tampil1['tanggal'])); ?> </td>

                                    <td>
                                        <ol>
                                            <?php

                                            $queryListBarang = mysqli_query($koneksi, "SELECT * FROM `tb_pembelian`  where kode_pembelian='$kode' ");
                                            while ($dataLB = mysqli_fetch_array($queryListBarang)) {
                                                $kode_barang = $dataLB['kode_barang'];
                                                $sql2 = $koneksi->query("select * from tb_barang where kode_barang='$kode_barang' ");
                                                $tampil2 = $sql2->fetch_assoc();


                                                echo "<li>" . $tampil2['nama_barang'] .   " X " . $dataLB['jumlah'] .   " " . $tampil2['satuan'] .   " X Rp. " . number_format($tampil2['harga_jual']) . ",-  = X Rp. " . number_format($dataLB['total']) . ",-   </li>";
                                            }

                                            ?>
                                        </ol>
                                    </td>




                                    <td><?php echo "Rp." . number_format($tampil1['total']); ?>,- </td>




                                </tr>
                            <?php

                                $pengeluaran = $pengeluaran + $tampil1['total'];
                            }
                            ?>
                        </tbody>
                        <tr>
                            <th style="text-align: center; font-size: 17px;" colspan="4">Total ReStok</th>
                            <td align="center" style="font-size: 15px;"><b><?php echo "Rp." . number_format($pengeluaran); ?>,-</b></td>

                        </tr>
                    </table>
                    <br>
                    <br>

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
<?php
} else {
    header("location:login.php");
}
?>