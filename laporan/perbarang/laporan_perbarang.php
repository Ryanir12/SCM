<?php
include "../../koneksi/koneksi.php";

// Mengambil data dari form POST
$nama_barang = $_POST['nama_barang'];
$nama_user = $_POST['nama']; // Menyimpan nama user yang melakukan cetak

// Mengatur header untuk pencetakan
header("Content-type: text/html; charset=utf-8");
header("Content-Disposition: inline; filename=laporan_perbarang_" . date('Ymd') . ".pdf");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Laporan Penjualan Per Barang</title>
    <!-- Favicon-->
    <link rel="icon" href="../../images/Fusionlabs_Logo.ico" type="image/x-icon">

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

    <!-- AdminBSB Themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <script>
        // Memanggil print dialog setelah halaman dimuat
        window.onload = function() {
            window.print();
        }
    </script>
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
                <div class="header mb-4" align="center">
                    <hr>
                    <h2>Laporan Penjualan Per Barang</h2>
                </div>
                <br>
                <div>
                    <p>Nama Barang: <?php echo htmlspecialchars($nama_barang); ?></p>
                    <p>Harga Beli:
                        <?php
                        $sql_harga = $koneksi->query("SELECT harga_beli FROM tb_barang WHERE nama_barang='$nama_barang'");
                        $data_harga = $sql_harga->fetch_assoc();
                        echo "Rp. " . number_format($data_harga['harga_beli']);
                        ?>
                    </p>
                    <p>Harga Jual:
                        <?php
                        $sql_jual = $koneksi->query("SELECT harga_jual FROM tb_barang WHERE nama_barang='$nama_barang'");
                        $data_jual = $sql_jual->fetch_assoc();
                        echo "Rp. " . number_format($data_jual['harga_jual']);
                        ?>
                    </p>
                    <p>Satuan:
                        <?php
                        $sql_satuan = $koneksi->query("SELECT satuan FROM tb_barang WHERE nama_barang='$nama_barang'");
                        $data_satuan = $sql_satuan->fetch_assoc();
                        echo htmlspecialchars($data_satuan['satuan']);
                        ?>
                    </p>
                </div>
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Penjualan</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $total_penjualan = 0;
                        $sql_penjualan = $koneksi->query("SELECT * FROM tb_penjualan JOIN tb_barang ON tb_penjualan.kode_barang = tb_barang.kode_barang WHERE tb_barang.nama_barang='$nama_barang'");
                        while ($data_penjualan = $sql_penjualan->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($data_penjualan['kode_penjualan']); ?></td>
                                <td><?php echo date('d F Y', strtotime($data_penjualan['tanggal_penjualan'])); ?></td>
                                <td><?php echo htmlspecialchars($data_penjualan['nama_pembeli']); ?></td>
                                <td><?php echo htmlspecialchars($data_penjualan['jumlah']) . " " . htmlspecialchars($data_satuan['satuan']); ?></td>
                                <td><?php echo "Rp. " . number_format($data_penjualan['total']); ?></td>
                            </tr>
                        <?php
                            $total_penjualan += $data_penjualan['total'];
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" style="text-align: center;">Total Penjualan</th>
                            <td align="center"><?php echo "Rp. " . number_format($total_penjualan); ?></td>
                        </tr>
                    </tfoot>
                </table>
                <br><br>
                <div class="header" align="left">
                    <h2>Padang, <?php echo date('d F Y'); ?></h2>
                    <h2>Penanggung Jawab,</h2>
                    <br><br><br>
                    <h2>________________________________</h2>
                    <h2><?php echo htmlspecialchars($nama_user); ?></h2>
                </div>
            </div>
        </div>
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