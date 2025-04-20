<?php $kd_pjl = $_GET['invoice'];
date_default_timezone_set('Asia/Jakarta');

?>

<form method="POST">

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">
                <div class="header">
                    <h2>
                        Data Penjualan Barang

                    </h2>

                </div>


                <div class="body">

                    <div class="row clearfix">

                        <div class="col-sm-2">
                            <p style="color:black;  font-weight:bold;">Kode Penjualan :</p>

                        </div>

                        <div class="col-sm-4">

                            <input type="text" name="invoice" readonly="" class="form-control" style=" background-color: #e7e3e9; text-size:16px; font-weight:bold; font-style:italic; " value="<?php echo $_GET['invoice']; ?>" />
                        </div>


                        <div class="col-sm-2">
                            <p style="color:black;  font-weight:bold;">Tanggal Penjualan :</p>

                        </div>

                        <div class="col-sm-4">

                            <input type="text" name="tanggalsekarang" readonly="" class="form-control" style=" background-color: #e7e3e9; text-size:16px; font-weight:bold; font-style:italic; " value="<?php echo date("j F Y, G:i"); ?>" />
                        </div>



                    </div>




                </div>


            </div>
        </div>





        <div class="col-sm-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4><i class="material-icons">search</i> Cari Barang</h4>
                </div>
                <div class="panel-body">
                    <form method="POST">
                        <div class="col-sm-12">
                            <a href="" style=" width:100%;  height:35px; " class="btn btn-info waves-effect" data-toggle="modal" data-target="#smallModal" target="blank"><i class="material-icons">list </i> Lihat List Barang</a>

                        </div>
                </div>
            </div>
        </div>


        <div class="col-sm-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4><i class="material-icons">done</i> Hasi Pencarian Barang</h4>
                </div>
                <div class="panel-body">




                    <input type="hidden" name="kode" required="" readonly="" style="width:160px; background-color: #e7e3e9; text-align:left; font-style:italic; color:black; text-size:17px; font-weight:bold; " class="form-control" placeholder="Kode Barang" value="<?php echo $_GET['kode']; ?>" />





                    <div class="col-sm-3">

                        <input type="text" name="nama" required="" readonly="" style="width:160px;background-color: #e7e3e9;  text-align:left; font-style:italic; color:black; text-size:17px; font-weight:bold; " class="form-control" placeholder="Nama Barang" value="<?php echo $_GET['nama']; ?>" />
                    </div>


                    <input type="hidden" name="stok" required="" readonly="" style="width:160px; background-color: white;  text-align:left; font-style:italic; color:black; text-size:17px; font-weight:bold; " class="form-control" style="background-color: white;" placeholder="Stok Barang" value="<?php echo $_GET['stok']; ?>" />



                    <div class="col-sm-3">

                        <input type="number" name="jumlah" required="" class="form-control" style="text-align:center; width:100%;   font-weight:bold;  " placeholder="Jumlah Beli" />
                    </div>

                    <div class="col-sm-3">

                        <input type="text" name="satuan" required="" readonly="" style="width:160px;background-color: #e7e3e9;  text-align:left; font-style:italic; color:black; text-size:17px; font-weight:bold; " class="form-control" placeholder="Satuan Barang" value="<?php echo $_GET['satuan']; ?>" />
                    </div>




                    <div class="col-sm-3">


                        <input type="submit" name="simpan" value="Tambahkan" class="btn btn-info m-t-9 waves-effect">


                    </div>

                </div>
            </div>
        </div>
</form>








<div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">List Data Barang </h4>
            </div>

            <div class="modal-body table-responsive">

                <table class="table table-bordered table-striped  table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Stok Barang</th>







                            <th>Aksi</th>

                            <!--  
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Profit</th>
                                    
                                        <th width="25%" >Aksi</th>
                                          -->
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("select * from tb_barang  ");
                        while ($tampil = $sql->fetch_assoc()) {






                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>


                                <td><?php echo $tampil['nama_barang'] ?> </td>

                                <td><?php echo "Rp." . number_format($tampil['harga_jual']); ?>,- </td>
                                <td>



                                    <?php


                                    $stok = $tampil['stok'];
                                    $satuan = $tampil['satuan'];

                                    if (($stok <= 10) && ($stok >= 1)) {

                                        echo "<b><font color='orange'> $stok  $satuan </b> ";
                                    } else  if ($stok > 10) {
                                        echo "<b><font color='green'> $stok  $satuan</>";
                                    } else  if ($stok <= 0) {
                                        echo "<b><font color='red'> $stok  $satuan</>";
                                    }

                                    ?>


                                </td>


                                <!-- 
                                        <td><?php echo $tampil['harga_beli'] ?> </td>
                                        <td><?php echo $tampil['harga_jual'] ?> </td>
                                        <td><?php echo $tampil['profit'] ?> </td>
                                                                              <td>

                                          <a onclick="return confirm('Yakin Akan Menghapus Data ini...???') "  href="?page=barang&aksi=hapus&id=<?php echo $tampil['kode_barang']; ?>" class= "btn btn-danger waves-effect"><i class="material-icons">delete </i> Hapus</a>
                                          
                                          <a href="?page=barang&aksi=ubah&id=<?php echo $tampil['kode_barang']; ?>" class= "btn btn-info waves-effect"><i class="material-icons">mode_edit </i> Edit</a>

                                           <a href="?page=barang&aksi=detail&id=<?php echo $tampil['kode_barang']; ?>" class= "btn btn-success waves-effect"><i class="material-icons">list </i> Detail</a>

                                        </td>
                                          -->
                                <?php
                                $jumlah = $_POST['jumlah'];

                                ?>


                                <td>


                                    <a href="?page=penjualan&kode=<?php echo $tampil['kode_barang']; ?>&nama=<?php echo $tampil['nama_barang']; ?>&satuan=<?php echo $tampil['satuan']; ?>&invoice=<?php echo $_GET['invoice']; ?>&stok=<?php echo $tampil['stok']; ?>" class="btn btn-primary waves-effect"><i class="material-icons">add </i> Pilih</a>

                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>







            </div>


        </div>


    </div>
</div>

<div class="col-sm-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><i class="material-icons">list</i> Data Barang Keluar</h4>
        </div>
        <div class="panel-body">
            <form method="POST">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="body table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th></th>
                                            <th>Jumlah</th>
                                            <th style="text-align: right;">Total </th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $no = 1;
                                        $sql = $koneksi->query("select * from tb_penjualan, tb_barang where tb_penjualan.kode_barang=tb_barang.kode_barang and kode_penjualan='$kd_pjl'");
                                        while ($data = $sql->fetch_assoc()) {



                                        ?>

                                            <tr>
                                                <th><?php echo $no++; ?></th>
                                                <td><?php echo $data['nama_barang']; ?></td>
                                                <td><?php echo $data['harga_jual']; ?></td>
                                                <td>X</td>
                                                <td><?php echo $data['jumlah']; ?> <?php echo $data['satuan']; ?></td>
                                                <td align="right"><?php echo "Rp." . number_format($data['total']); ?>,-</td>
                                                <td>





                                                    <!--
                                             <a href="?page=penjualan&aksi=kurang&id=<?php echo $data['id']; ?>&kd_pj=<?php echo $data['kode_penjualan']; ?>&harga_jual=<?php echo $data['harga_jual']; ?>&kode_barang=<?php echo $data['kode_barang']; ?>" class= "btn btn-success waves-effect"><i class="material-icons">remove </i></a>   

                                             <a href="?page=penjualan&aksi=tambah&id=<?php echo $data['id']; ?>&kd_pj=<?php echo $data['kode_penjualan']; ?>&harga_jual=<?php echo $data['harga_jual']; ?>&kode_barang=<?php echo $data['kode_barang']; ?>" class= "btn btn-success waves-effect"><i class="material-icons">add </i></a> 
                                                
                                                -->
                                                    <a onclick="return confirm('Yakin Akan Membatalkan Belanjaan ini...???') " href="?page=penjualan&aksi=hapus&id=<?php echo $data['id']; ?>&kd_pj=<?php echo $data['kode_penjualan']; ?>&kode_barang=<?php echo $data['kode_barang']; ?>&jumlah=<?php echo $data['jumlah']; ?>" class="btn btn-danger waves-effect"><i class="material-icons">clear </i> Cancel</a>


                                                </td>
                                            </tr>

                                        <?php

                                            $total_bayar = $total_bayar + $data['total'];
                                        }


                                        ?>

                                    </tbody>



                                    <!--
//Entri Nama Pelanggan
-->

                                    <tr>


                                        <th style="text-align: right; font-size: 17px;" colspan="5">Pelanggan</th>
                                        <td style="text-align: right;"> <input type="text" name="pelanggan" placeholder="Isi Nama Pelanggan" required="" style=" width:80%; text-align:left; background-color: #e7e3e9; text-size:16px; font-weight:bold; font-style:italic; " value="<?php echo $_GET['namapl']; ?>" />

                                        </td>

                                        <!--        
                                                     <td>

                                            <a href=""  style=" width:60%;  height:35px; " class= "btn btn-warning waves-effect" data-toggle="modal" data-target="#smallModal2" target="blank"><i class="material-icons">list </i> Lihat List Pelanggan</a> 


                                        </td>
                                        -->

                                    </tr>





                                    <tr>
                                        <th style="text-align: right; font-size: 17px;" colspan="5">Total</th>
                                        <td style="text-align: right;"><b style="font-size:18px;"><?php echo  "Rp." . number_format($total_bayar, 2, ",", ".");  ?> </b> <input type="hidden" name="total_bayar" id="total_bayar" placeholder="Total Bayar" onkeyup="sum();" style="font-size: 14px; text-align: right; background-color: #e7e3e9;" value="<?php echo $total_bayar ?>" readonly=""> </td>
                                    </tr>

                                    <tr>
                                        <th style="text-align: right; font-size: 17px;" colspan="5"> Tunai</th>
                                        <td style="text-align: right;"><b> <input type="number" name="bayar" placeholder="Uang Pembayaran" id="bayar" onkeyup="sum();" required="" style="font-size: 14px; text-align: right;"> </b></td>
                                    </tr>

                                    <tr>
                                        <th style="text-align: right; font-size: 17px;" colspan="5"> Kembali</th>
                                        <td style="text-align: right;"><b> <input type="number" name="kembali" placeholder="Uang Kembali" readonly="" id="kembali" required="" style="font-size: 14px; text-align: right; background-color: #e7e3e9;"> </b></td>

                                        <td>

                                            <input onclick="return confirm('Apakah transaksi ini sudah selesai...???') " type="submit" name="simpan2" value="Simpan" ata-toggle="modal" data-target="#defaultModal" class="btn btn-info waves-effect m-r-20">

                                            <!-- <a href="" class="btn btn-warning waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal" target="blank">Cetak Struk</a> -->

                                        </td>
                                    </tr>

                                </table>
            </form>

        </div>
    </div>
</div>






<script>
    $(function() {
        $("#barcode").change(function() {
            var barcode = $("#barcode").val();
            $.ajax({
                url: 'page/penjualan/getbarang.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'barcode': barcode
                },

                success: function(barang) {
                    $("#nama_barang").val(barang['nama_barang']);
                    $("#harga_jual").val(barang['harga_jual']);

                }
            });
        });
    });
</script>




<div class="modal fade" id="smallModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">List Data Pelanggan </h4>
            </div>

            <div class="modal-body table-responsive">

                <table class="table table-bordered table-striped  table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>No</th>


                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Nomor HP</th>




                            <th>Aksi</th>

                            <!--  
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Profit</th>
                                    
                                        <th width="25%" >Aksi</th>
                                          -->
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $no = 1;
                        $sql2 = $koneksi->query("select * from tb_customer  ");
                        while ($tampil2 = $sql2->fetch_assoc()) {


                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>


                                <td><?php echo $tampil2['nama'] ?> </td>
                                <td><?php echo $tampil2['alamat'] ?> </td>
                                <td><?php echo $tampil2['telpon'] ?> </td>




                                <td>


                                    <a href="?page=penjualan&namapl=<?php echo $tampil2['nama']; ?>&invoice=<?php echo $_GET['invoice']; ?>" class="btn btn-success waves-effect"><i class="material-icons">add </i> Pilih</a>

                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>







            </div>


        </div>


    </div>
    </form>
</div>














<?php

if (isset($_POST['simpan'])) {
    date_default_timezone_set('Asia/Jakarta');

    $tgl_jual = date("Y-m-d");

    $barcode = $_POST['kode'];


    // MENCARI HARGA BARANG
    $sql_barang2 = $koneksi->query("select * from tb_barang where kode_barang = '$barcode'");
    $data_barang2 = $sql_barang2->fetch_assoc();

    $harga_jual       = $data_barang2['harga_jual'];






    $jumlah = $_POST['jumlah'];
    $stoks = $_POST['stok'];



    $kode_pj = $_POST['invoice'];




    if ($jumlah <= 0) {

?>
        <script>
            alert("Jumlah pembelian tidak kecil sama dari Nol");

            window.location.href = "?page=penjualan&invoice=<?php echo $kode_pj; ?>";
        </script>

    <?php



    }




    // 1. MEMPERIKSA APAKAH JUMLAH PEMBELIAN TIDAK MELEBIHI STOK BARANG


    // JIKA PERNYATAAN 1 BENAR MAKA AKAN MENAMPILKAN PESAN


    elseif ($jumlah > $stoks) {

    ?>
        <script>
            alert("Jumlah pembelian lebih banyak dari stok barang yang ada, Transaksi Tidak Dapat Dilakukan / Kurangi jumlah pembelian barang / Silakan Tambah Stok Barang Terlebih Dahulu  ");

            window.location.href = "?page=penjualan&invoice=<?php echo $kode_pj; ?>";
        </script>

        <?php



    } else {








        // JIKA PERNYATAAN 1 SALAH LAKUKAN TAHAP SELANJUTNYA



        // 2. MENCARI DATA APAKAH BARANG TELAH ADA PADA TRANSAKSI UNTUK KODE PENJUALAN SEKARANG
        $sql8 = $koneksi->query("select * from tb_penjualan where kode_penjualan='$kode_pj' and kode_barang='$barcode' ");
        while ($data8 = $sql8->fetch_assoc()) {
            $jml_barangrs = $sql8->num_rows;
        }


        // JIKA PERNYATAAAN 2 ADA MAKA AKAN DILAKUKAN PROSES PENYIMPANAN SEPERTI DIBAWAH, YAITU MENAMBAH JUMLAH PEMBELIAN PADA TABEL TB_PENJUALAN 2
        if ($jml_barangrs == 1) {
            $sql = $koneksi->query("update  tb_penjualan set jumlah=(jumlah + $jumlah )  where kode_barang='$barcode' and kode_penjualan='$kode_pj' ");



            $sql_barang4 = $koneksi->query("select * from tb_penjualan where kode_barang = '$barcode' and kode_penjualan='$kode_pj' ");
            $data_barang4 = $sql_barang4->fetch_assoc();

            $jumlahbeli = $data_barang4['jumlah'];

            $totalseluruh = $jumlahbeli * $harga_jual;


            $sql11 = $koneksi->query("update  tb_penjualan set total='$totalseluruh'  where kode_barang='$barcode' and kode_penjualan='$kode_pj' ");





            $sql4 = $koneksi->query("update  tb_barang set stok=(stok - $jumlah )  where kode_barang='$barcode'  ");



            if ($sql4) {

        ?>
                <script>
                    window.location.href = "?page=penjualan&invoice=<?php echo $kode_pj; ?>";
                </script>

                <?php
            }
        } else {


            // JIKA PERNYATAAN 2 SALAH MAKA AKAN DILAKUKAN TAHAP PERTAMA PENYIMPANAN PEMBELIAN YAITU MENYIMPAN SEMUA DATA PADA TB_PENJUALAN_2

            $total = $jumlah * $harga_jual;

            $sql_barang = $koneksi->query("select * from tb_barang where kode_barang = '$barcode'");
            while ($data_barang = $sql_barang->fetch_assoc()) {
                $sisa = $data_barang['stok'];

                if ($sisa == 0) {
                ?>
                    <script type="text/javascript">
                        alert("Stok Barang Habis, Transaksi Tidak Dapat Dilakukan, Silakan Tambah Stok Barang Terlebih Dahulu ");
                        window.location.href = "?page=penjualan&invoice=<?php echo $_GET['invoice']; ?>";
                    </script>
                    <?php
                } else {




                    $sql = $koneksi->query("insert into tb_penjualan (kode_penjualan,  kode_barang, jumlah, total, tanggal_penjualan) values('$kode_pj', '$barcode', '$jumlah', '$total', '$tgl_jual')");
                    $sql17 = $koneksi->query("insert into tb_tmp_penjualan (id,  kode_penjualan) values('1', '$kode_pj')");



                    //CARI DATA DI detail_penjualan












                    if ($sql) {

                    ?>
                        <script>
                            window.location.href = "?page=penjualan&invoice=<?php echo $kode_pj; ?>";
                        </script>

<?php
                    }
                }
            }
        }
    }
}


?>
















<?php

if (isset($_POST['simpan2'])) {

    $sql = $koneksi->query("select kode_transaksi from tb_transaksi order by kode_transaksi desc");

    $data = $sql->fetch_assoc();

    $kode_transaksi = $data['kode_transaksi'];

    $urut = substr($kode_transaksi, 1, 3);
    $tambah = (int) $urut + 1;


    if (strlen($tambah) == 1) {
        $format = "P" . "00" . $tambah;
    } else if (strlen($tambah) == 2) {
        $format = "P" . "0" . $tambah;
    } else {
        $format = "P" . $tambah;
    }



    date_default_timezone_set('Asia/Jakarta');

    $tgl_jual_tr = date("Y-m-d");
    $tunai = $_POST['bayar'];
    $kembali = $_POST['kembali'];

    $pelanggan = $_POST['pelanggan'];

    $koneksi->query("insert into tb_penjualan_tmp (kode_penjualan, bayar, kembali)values('$kd_pjl', '$tunai', '$kembali')");
    $koneksi->query("insert into tb_transaksi (kode_transaksi,kode_penjualan, kode_pembelian,tanggal,total, nama)values('$format','$kd_pjl','-','$tgl_jual_tr','$total_bayar','$pelanggan' )");




    $koneksi->query("update tb_penjualan set nama_pembeli='$pelanggan' where kode_penjualan='$_GET[invoice]'");
    $sql17 = $koneksi->query("delete from tb_tmp_penjualan where id='1' ");
}

?>





<script>
    function sum() {
        var total_bayar = document.getElementById('total_bayar').value;
        var bayar = document.getElementById('bayar').value;
        var result = parseInt(bayar) - parseInt(total_bayar);
        if (!isNaN(result)) {
            document.getElementById('kembali').value = result;
        }
    }
</script>


<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Struk Penjualan</h4>
            </div>


            <div class="modal-body">

                <table>
                    <tr>
                        <td>Waber Sport</td>
                    </tr>

                    <tr>
                        <td>Toko Alat Olah Raga</td>
                    </tr>

                </table>

                <table>


                    <br>
                    <?php

                    if ($_SESSION['admin']) {
                        $user_l = $_SESSION['admin'];
                    } else if ($_SESSION['kasir']) {
                        $user_l = $_SESSION['kasir'];
                    } else if ($_SESSION['pimpinan']) {
                        $user_l = $_SESSION['pimpinan'];
                    } else if ($_SESSION['gudang']) {
                        $user_l = $_SESSION['gudang'];
                    }


                    $sql_u = $koneksi->query("select* from tb_user where id='$user_l'");
                    $data_u = $sql_u->fetch_assoc();


                    $sql = $koneksi->query("select * from tb_penjualan  where  
                                                
                                                  kode_penjualan='$kd_pjl'");
                    $tampil2 = $sql->fetch_assoc();

                    ?>

                    <tr>
                        <td>No Penjualan &nbsp &nbsp</td>
                        <td>: &nbsp &nbsp<?php echo $tampil2['kode_penjualan']; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Pelanggan &nbsp &nbsp</td>
                        <td>: &nbsp &nbsp<?php echo $tampil2['nama_pembeli']; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tanggal &nbsp &nbsp</td>
                        <td>: &nbsp &nbsp <?php echo $tampil2['tanggal_penjualan']; ?></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Kasir &nbsp &nbsp</td>
                        <td>: &nbsp &nbsp <?php echo $data_u['nama']; ?></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>
                            <hr width="100%" color="red">
                        </td>
                    </tr>


                    <?php

                    $sql = $koneksi->query("select * from tb_penjualan, tb_penjualan_tmp, tb_barang
                                                             where tb_penjualan.kode_penjualan=tb_penjualan_tmp.kode_penjualan
                                                             and tb_penjualan.kode_barang=tb_barang.kode_barang
                                                              and tb_penjualan.kode_penjualan='$kd_pjl'");

                    while ($tampil = $sql->fetch_assoc()) {


                    ?>



                        <tr>


                            <td><?php echo $tampil['nama_barang']; ?></td>
                            <td><?php echo "Rp." . number_format($tampil['harga_jual']) . ',-' . '&nbsp' . '&nbsp' . 'X' . '&nbsp' . '&nbsp' . $tampil['jumlah'] . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp'; ?></td>



                            <td><?php echo "Rp." . number_format($tampil['total']); ?>,-</td>
                        </tr>

                    <?php

                        $bayar = $tampil['bayar'];
                        $kembali_byr = $tampil['kembali'];

                        $total_bayar2 = $total_bayar2 + $tampil['total'];
                    }

                    ?>

                    <tr>
                        <td>
                            <hr>
                        </td>
                    </tr>

                    <tr>
                        <th font-size: 17px;" colspan="2">Total</th>
                        <td style="text-align: right;"><b> <?php echo "Rp." . number_format($total_bayar2); ?>,- </b></td>
                    </tr>


                    <tr>
                        <th font-size: 17px;" colspan="2">Tunai</th>
                        <td style="text-align: right;"><b> <?php echo "Rp." . number_format($bayar); ?>,- </b></td>
                    </tr>

                    <tr>
                        <td>
                            <hr>
                        </td>
                    </tr>

                    <tr>
                        <th font-size: 17px;" colspan="2">Kembali</th>
                        <td style="text-align: right;"><b> <?php echo "Rp." . number_format($kembali_byr); ?>,- </b></td>
                    </tr>

                    <tr>
                        <td>
                            <hr>
                        </td>
                    </tr>



                </table>

                <table>
                    <tr>
                        <td>Barang yang sudah dibeli tidak dapat dikembalikan</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <a href="page/penjualan/invoice.php?kode=<?php echo $kd_pjl; ?>&iduser=<?php echo $data_u['id']; ?>" target="blank" class="btn btn-warning waves-effect"><i class="material-icons">print </i>Cetak Struk</a>



                <a href="?page=penjualan&invoice=<?php echo "$finalcode"; ?>" class="btn btn-info waves-effect">Selesai</a>

            </div>
        </div>
    </div>
</div>