<script>
    window.print();
</script>




<?php

include "../../koneksi/koneksi.php";
$nama = $_POST['nama'];
$tahun = $_POST['tahun'];

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
    <style>
        .center-header {
            text-align: center;
        }

        .header {
            margin-bottom: 20px;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .card {
                width: 100%;
                margin: 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12px;
            }

            th,
            td {
                padding: 5px;

            }



            .center-header {
                text-align: center;
            }

            .header {
                margin-bottom: 20px;
            }

        }
    </style>
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
                        Laporan Tahunan Pembelian Barang

                    </h2>
                    <h2 align="center">
                        Tahun : <?php echo $tahun; ?>
                    </h2>

                </div>
                <br>

                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Kode Barang</th>
                            <th rowspan="2">Nama Barang</th>
                            <th colspan="12" class="center-header">Bulan</th>
                            <th rowspan="2">Total</th>
                        </tr>
                        <tr>
                            <th class="center-header">Jan</th>
                            <th class="center-header">Feb</th>
                            <th class="center-header">Mar</th>
                            <th class="center-header">Apr</th>
                            <th class="center-header">May</th>
                            <th class="center-header">Jun</th>
                            <th class="center-header">Jul</th>
                            <th class="center-header">Aug</th>
                            <th class="center-header">Sep</th>
                            <th class="center-header">Oct</th>
                            <th class="center-header">Nov</th>
                            <th class="center-header">Dec</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $tahun = '2024'; // Ganti dengan tahun yang sesuai
                        $pengeluaran = 0;

                        // Ambil data barang
                        $sqlBarang = $koneksi->query("SELECT DISTINCT kode_barang FROM tb_pembelian WHERE YEAR(tanggal)='$tahun'");
                        while ($barang = $sqlBarang->fetch_assoc()) {
                            $kode_barang = $barang['kode_barang'];

                            // Ambil nama barang
                            $sqlNamaBarang = $koneksi->query("SELECT nama_barang FROM tb_barang WHERE kode_barang='$kode_barang'");
                            $namaBarang = $sqlNamaBarang->fetch_assoc()['nama_barang'];

                            // Inisialisasi jumlah per bulan dan total
                            $jumlahPerBulan = array_fill(1, 12, 0);
                            $totalPenjualan = 0;

                            // Ambil data pembelian per barang
                            $sqlPembelian = $koneksi->query("SELECT * FROM tb_pembelian WHERE kode_barang='$kode_barang' AND YEAR(tanggal)='$tahun'");
                            while ($dataPembelian = $sqlPembelian->fetch_assoc()) {
                                $bulan = date('n', strtotime($dataPembelian['tanggal']));
                                $jumlahPerBulan[$bulan] += $dataPembelian['jumlah'];
                                $totalPenjualan += $dataPembelian['jumlah'];
                            }
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $kode_barang; ?></td>
                                <td><?php echo $namaBarang; ?></td>
                                <?php for ($bulan = 1; $bulan <= 12; $bulan++) { ?>
                                    <td><?php echo $jumlahPerBulan[$bulan] > 0 ? $jumlahPerBulan[$bulan] : '-'; ?></td>
                                <?php } ?>
                                <td><?php echo $totalPenjualan; ?></td>
                            </tr>
                        <?php
                            $pengeluaran += $totalPenjualan;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align: center; font-size: 17px;" colspan="15">Total Pembelian</th>
                            <td align="center" style="font-size: 15px;"><b><?php echo $pengeluaran; ?></b></td>
                        </tr>
                    </tfoot>
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