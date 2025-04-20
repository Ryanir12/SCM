<?php
$tgl_jual = date("Y-m-d");
$total_pj = 0;
$total_profit = 0;

// Menggunakan prepared statement untuk keamanan
$stmt = $koneksi->prepare("
    SELECT tb_penjualan.total, tb_barang.profit, tb_penjualan.jumlah 
    FROM tb_penjualan 
    JOIN tb_barang ON tb_penjualan.kode_barang = tb_barang.kode_barang 
    WHERE tanggal_penjualan = ?
");
$stmt->bind_param("s", $tgl_jual);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $profit = $row['profit'] * $row['jumlah'];
    $total_pj += $row['total'];
    $total_profit += $profit;
}

$stmt->close();

// Dapatkan jumlah barang
$sql2 = $koneksi->query("SELECT COUNT(*) AS jml_barang FROM tb_barang");
$data2 = $sql2->fetch_assoc();
$jml_barang = $data2['jml_barang'];

// Dapatkan jumlah stok menipis
$sql3 = $koneksi->query("SELECT COUNT(*) AS stok_menipis FROM tb_barang WHERE stok <= 10");
$data3 = $sql3->fetch_assoc();
$stok_menipis = $data3['stok_menipis'];
?>





<style type="text/css">
    .petak1 {
        height: auto;
        width: auto;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
        padding-bottom: auto;

        background-color: #ffebcd;
        border: 1px solid #8fbc8f;
    }

    .img {
        margin-top: 10px;
        margin-left: -10%;
        height: 50%;
        width: 30%;
        border-radius: 5px;
    }


    .kolom .deskripsi {
        margin-top: 10px;
        padding: 5px 20px;
        font-size: 25px;
        font-family: 'sans-serif';
        font-weight: bold;
    }

    section {
        margin: auto;
        display: flex;
        margin-bottom: 50px;
    }

    p {
        font-family: sans-serif;
        font-size: 18px;
        padding: 5px 20px 15px 20px;

    }

    h2 {
        font-family: 'sans-serif';
        font-size: 40px;
        padding: 5px 20px;

    }

    a.tbl-hijau {
        background-color: greenyellow;
        border-radius: 20px;
        color: #fff;
        margin-top: 50px;
        padding: 15px 20px 15px 20px;
        cursor: pointer;
        font-weight: bold;
    }

    a.tbl-hijau:hover {
        background-color: deepskyblue;
        color: #fff;
        text-decoration: none;
    }
</style>





<div class="container-fluid">


    <?php if ($_SESSION['supplier']) { ?>




        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <?php if ($_SESSION['admin']) { ?>
                            <a href="?page=barang">
                                <i class="material-icons">view_module</i>
                            </a>
                        <?php } ?>

                        <i class="material-icons">view_module</i>
                    </div>
                    <div class="content">
                        <div class="text">Total Barang</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $jml_barang . '&nbsp' . "Qty"; ?></div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <?php if ($_SESSION['admin']) { ?>
                            <a href="?page=barang">
                                <i class="material-icons">error_outline</i>
                            </a>
                        <?php } ?>
                        <i class="material-icons">error_outline</i>
                    </div>
                    <div class="content">
                        <div class="text" style="font-size:12px;">Stok Barang Menipis</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo number_format($stok_menipis); ?> Qty</div>

                    </div>
                </div>
            </div>




        <?php } else {

        ?>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <?php if ($_SESSION['admin']) { ?>
                                <a href="?page=barang">
                                    <i class="material-icons">view_module</i>
                                </a>
                            <?php } ?>

                            <i class="material-icons">view_module</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Barang</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $jml_barang . '&nbsp' . "Qty"; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <?php if ($_SESSION['pimpinan']) { ?>
                                <a href="?page=laporan_jual">
                                    <i class="material-icons">shopping_cart</i>
                                </a>
                            <?php } ?>
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">Penjualan Hari ini</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo "Rp." . number_format($total_pj); ?>,-</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">

                            <?php if ($_SESSION['pimpinan']) { ?>
                                <a href="?page=laporan_lr">
                                    <i class="material-icons">attach_money</i>
                                </a>
                            <?php } ?>

                            <i class="material-icons">attach_money</i>
                        </div>
                        <div class="content">
                            <div class="text">Profit Hari ini</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php echo "Rp." . number_format($total_profit); ?>,-</div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <?php if ($_SESSION['admin']) { ?>
                                <a href="?page=barang">
                                    <i class="material-icons">error_outline</i>
                                </a>
                            <?php } ?>
                            <i class="material-icons">error_outline</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:12px;">Stok Barang Menipis</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo number_format($stok_menipis); ?> Qty</div>

                        </div>
                    </div>
                </div>






            <?php } ?>