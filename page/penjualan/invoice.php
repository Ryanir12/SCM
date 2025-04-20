<script>
    window.print();
</script>




<?php

include "../../koneksi/koneksi.php";




$kode = $_GET['kode'];

$sql = $koneksi->query("select* from tb_transaksi where kode_penjualan='$kode'");
$data = $sql->fetch_assoc();
$tanggal = $data['tanggal'];
$kode_transaksi = $data['kode_transaksi'];



$sql5 = $koneksi->query("select* from tb_penjualan_tmp where kode_penjualan='$kode'");
$data5 = $sql5->fetch_assoc();
$bayar = $data5['bayar'];
$kembali = $data5['kembali'];






$sql2 = $koneksi->query("select* from tb_penjualan where kode_penjualan='$kode'");
$data2 = $sql2->fetch_assoc();

$nama1 = $data2['nama_pembeli'];








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
    <link rel="icon" href="../../favicon.ico" type="../../image/x-icon">

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
                        Invoice Penjualan Barang
                    </h2>
                </div>
                <br>


                <p align="left">Nomor Penjualan : <?php echo $kode; ?></p>
                <p align="left">Tanggal Transaksi : <?php echo $tanggal; ?></p>
                <p align="left">Nama Pembeli : <?php echo $nama1; ?></p>
                <p align="left">Nama Kasir : <?php echo $nama; ?></p>
                <br>

                <p align="left" style="mergin-left:20px; font-size:14px; ">Berikut nama barang yang dibeli oleh pembeli Sdr/i <b> <?php echo $nama1; ?></b> : </p>

                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="width:15%;">Kode Barang </th>
                            <th style="width:25%;">Nama Barang </th>
                            <th style="width:15%;">Harga Satuan Barang </th>
                            <th style="width:10%;">Jumlah</th>
                            <th style="width:15%;">Sub Total</th>




                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $no = 1;
                        $totalharga = 0;
                        $sql2 = $koneksi->query("select* from tb_penjualan where kode_penjualan='$kode'");
                        while ($data2 = $sql2->fetch_assoc()) {


                            $totalharga = $totalharga + $data2['total'];

                            $kode_barang = $data2['kode_barang'];
                            $sql3 = $koneksi->query("select* from tb_barang where kode_barang='$kode_barang'");
                            $data3 = $sql3->fetch_assoc();




                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $kode_barang ?> </td>
                                <td><?php echo $data3['nama_barang'] ?> </td>
                                <td><?php echo "Rp." . number_format($data3['harga_jual']); ?>,- </td>
                                <td><?php echo $data2['jumlah'] ?> <?php echo $data3['satuan'] ?> </td>




                                <td><?php echo "Rp." . number_format($data2['total']); ?>,- </td>




                            </tr>
                        <?php


                        }
                        ?>
                    </tbody>
                    <tr>
                        <th style="text-align: center; font-size: 17px;" colspan="5">Total Harga</th>
                        <td align="center" style="font-size: 15px;"><b><?php echo "Rp." . number_format($totalharga); ?>,-</b></td>

                    </tr>
                    <tr>
                        <th style="text-align: center; font-size: 17px;" colspan="5">Uang Bayar</th>
                        <td align="center" style="font-size: 15px;"><b><?php echo "Rp." . number_format($bayar); ?>,-</b></td>

                    </tr>
                    <tr>
                        <th style="text-align: center; font-size: 17px;" colspan="5">Kembali</th>
                        <td align="center" style="font-size: 15px;"><b><?php echo "Rp." . number_format($kembali); ?>,-</b></td>

                    </tr>
                </table>

                <br>
                <br>



                <table style="border-bottom:0px;" class="table">
                    <thead>
                        <tr>

                            <th style="width:50%;">Padang, <?php echo date('d F Y') ?> </th>
                            <th style="width:50%;"></th>




                        </tr>
                    </thead>


                    <tbody>
                        <tr>
                            <td>
                                Penanggung Jawab,
                            </td>
                            <td>
                                Pembeli,
                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                __________________________
                            </td>
                            <td>
                                __________________________
                            </td>

                        </tr>
                        <tr>
                            <td>
                                (<?php echo $nama; ?>)
                            </td>
                            <td>
                                (<?php echo $nama1 ?>)
                            </td>

                        </tr>

                    </tbody>

                </table>




























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