<script>
    window.print();
</script>




<?php

include "../../koneksi/koneksi.php";




$kode = $_GET['kode'];








$id = $_GET['iduser'];

$sql_u = $koneksi->query("select* from tb_user where id='$id'");
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
                        Laporan Data Barang
                    </h2>

                </div>
                <br>


                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>

                            <th>Nama Barang</th>

                            <th>Stok</th>
                            <th>Keterangan</th>
                            <th>Harga </th>






                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $no = 1;

                        $sql = $koneksi->query("select * from tb_barang");
                        while ($tampil = $sql->fetch_assoc()) {





                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $tampil['kode_barang'] ?> </td>

                                <td><?php echo $tampil['nama_barang'] ?> </td>

                                <td>



                                    <?php
                                    $satuan = $tampil['satuan'];

                                    $stok = $tampil['stok'];

                                    if (($stok <= 10) && ($stok >= 1)) {

                                        echo "<b><font color='orange'> $stok $satuan</b> ";
                                    } else  if ($stok > 10) {
                                        echo "<b><font color='green'> $stok $satuan</>";
                                    } else  if ($stok <= 0) {
                                        echo "<b><font color='red'> $stok $satuan</>";
                                    }

                                    ?>


                                </td>
                                <td>


                                    <?php


                                    $stok = $tampil['stok'];

                                    if (($stok <= 10) && ($stok >= 1)) {

                                        echo "<b><font color='orange'> Stok Menipis</b> ";
                                    } else if ($stok > 10) {
                                        echo "<b><font color='green'>Persediaan Cukup</>";
                                    } else if ($stok < 0) {
                                        echo "<b><font color='red'>Stok Habis</>";
                                    }

                                    ?>


                                </td>
                                <td><?php echo "Rp." . number_format($tampil['harga_beli']); ?>,- </td>



                            </tr>
                        <?php


                        }
                        ?>
                    </tbody>

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