<?php

$kd_pjl = $_GET['invoice'];
date_default_timezone_set('Asia/Jakarta');
?>

<form method="POST">

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">
                <div class="header">
                    <h2>
                        Data ReStok Barang

                    </h2>

                </div>


                <div class="body">

                    <div class="row clearfix">

                        <div class="col-sm-2">
                            <p style="color:black;  font-weight:bold;">Kode ReStok :</p>

                        </div>

                        <div class="col-sm-4">

                            <input type="text" name="invoice" readonly="" class="form-control" style=" background-color: #e7e3e9; text-size:16px; font-weight:bold; font-style:italic; " value="<?php echo $_GET['invoice']; ?>" />
                        </div>


                        <div class="col-sm-2">
                            <p style="color:black;  font-weight:bold;">Tanggal ReStok :</p>

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

                        <input type="number" name="jumlah" required="" class="form-control" style="text-align:center; width:110%;   font-weight:bold;  " Placeholder="Jumlah Beli " />
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
                        $sql = $koneksi->query("select * from tb_barang ");
                        while ($tampil = $sql->fetch_assoc()) {

                            $kode_barang = $tampil['kode_barang'];







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


                                    <a href="?page=pembelian&kode=<?php echo $tampil['kode_barang']; ?>&satuan=<?php echo $tampil['satuan']; ?>&nama=<?php echo $tampil['nama_barang']; ?>&invoice=<?php echo $_GET['invoice']; ?>&stok=<?php echo $tampil['stok']; ?> " class="btn btn-success waves-effect"><i class="material-icons">add </i> Pilih</a>

                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>







            </div>


        </div>


    </div>
</div>








<?php

if (isset($_POST['simpan'])) {
    date_default_timezone_set('Asia/Jakarta');
    $tgl_jual = date("Y-m-d");
    $barcode = $_POST['kode'];
    $jumlah = $_POST['jumlah'];
    $kode_pj = $_POST['invoice'];





    $sql_barang2 = $koneksi->query("select * from tb_barang where kode_barang = '$barcode'");
    $data_barang2 = $sql_barang2->fetch_assoc();


    $harga_beli       = $data_barang2['harga_beli'];
    $nama       = $data_barang2['nama_barang'];
    $satuan       = $data_barang2['satuan'];

    $total = $jumlah * $harga_beli;




    $sql8 = $koneksi->query("select * from tb_pembelian where kode_pembelian='$kode_pj' and kode_barang='$barcode' ");
    while ($data8 = $sql8->fetch_assoc()) {
        $jml_barangrs = $sql8->num_rows;
    }



    if ($jumlah <= 0) {

?>
        <script>
            alert("Jumlah pembelian tidak kecil sama dari Nol");

            window.location.href = "?page=pembelian&invoice=<?php echo $kode_pj; ?>";
        </script>

        <?php



    } else











        // JIKA PERNYATAAAN 2 ADA MAKA AKAN DILAKUKAN PROSES PENYIMPANAN SEPERTI DIBAWAH, YAITU MENAMBAH JUMLAH PEMBELIAN PADA TABEL TB_PENJUALAN 2
        if ($jml_barangrs == 1) {



            $sql = $koneksi->query("update  tb_pembelian set jumlah=(jumlah + $jumlah )  where kode_barang='$barcode' and kode_pembelian='$kode_pj' ");



            $sql_barang4 = $koneksi->query("select * from tb_pembelian where kode_barang = '$barcode' and kode_pembelian='$kode_pj' ");
            $data_barang4 = $sql_barang4->fetch_assoc();

            $jumlahbeli = $data_barang4['jumlah'];

            $totalseluruh = $jumlahbeli * $harga_beli;


            $sql11 = $koneksi->query("update  tb_pembelian set total='$totalseluruh'  where kode_barang='$barcode' and kode_pembelian='$kode_pj' ");


            $sql4 = $koneksi->query("update  tb_barang set stok=(stok + $jumlah )  where kode_barang='$barcode'  ");









            if ($sql4) {

        ?>
            <script>
                window.location.href = "?page=pembelian&invoice=<?php echo $_GET['invoice']; ?>";
            </script>

        <?php
            }
        } else {




            $sql = $koneksi->query("insert into tb_pembelian (kode_pembelian, jumlah, harga,  total, kode_barang,  tanggal) values('$kode_pj', '$jumlah', '$harga_beli', '$total', '$barcode', '$tgl_jual')");
            $sql17 = $koneksi->query("insert into tb_tmp_pembelian (id,  kode_pembelian) values('1', '$kode_pj')");





            if ($sql17) {

        ?>
            <script>
                window.location.href = "?page=pembelian&invoice=<?php echo $_GET['invoice']; ?>";
            </script>

<?php
            }
        }
}


?>


<div class="col-sm-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><i class="material-icons">list</i> Data Barang ReStok</h4>
        </div>
        <div class="panel-body">










            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="body table-responsive">

                            <form method="POST">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>

                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th style="text-align: right;">Total </th>
                                            <th style="text-align: left;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $tgl_jual2 = date("Y-m-d");
                                        $no = 1;
                                        $sql = $koneksi->query("select * from tb_pembelian, tb_barang where tb_pembelian.kode_barang=tb_barang.kode_barang and kode_pembelian='$kd_pjl'");
                                        while ($data = $sql->fetch_assoc()) {



                                        ?>

                                            <tr>
                                                <th><?php echo $no++; ?></th>

                                                <td><?php echo $data['nama_barang']; ?></td>
                                                <td><?php echo $data['harga']; ?></td>
                                                <td><?php echo $data['jumlah']; ?> <?php echo $data['satuan']; ?></td>
                                                <td align="right"><?php echo "Rp." . number_format($data['total']); ?>,-</td>
                                                <td>

                                                    <!--
                                        <a href="?page=pembelian&aksi=kurang&id=<?php echo $data['id']; ?>&kd_pj1=<?php echo $data['kode_pembelian']; ?>&harga_beli=<?php echo $data['harga_beli']; ?>&kode_barang=<?php echo $data['kode_barang']; ?>&tgl_jual2=<?php echo $tgl_jual2 ?>" class= "btn btn-success waves-effect"><i class="material-icons">remove </i></a>   

                                             <a href="?page=pembelian&aksi=tambah&id=<?php echo $data['id']; ?>&kd_pj1=<?php echo $data['kode_pembelian']; ?>&harga_beli=<?php echo $data['harga_beli']; ?>&kode_barang=<?php echo $data['kode_barang']; ?>&tgl_jual2=<?php echo $tgl_jual2 ?>" class= "btn btn-success waves-effect"><i class="material-icons">add </i></a> 
                                              
                                        -->
                                                    <a onclick="return confirm('Yakin Akan Membatalkan Belanjaan ini...???') " href="?page=pembelian&aksi=hapus&id=<?php echo $data['id']; ?>&kd_pj1=<?php echo $data['kode_pembelian']; ?>&kode_barang=<?php echo $data['kode_barang']; ?>&jumlah=<?php echo $data['jumlah']; ?>&tgl_jual2=<?php echo $tgl_jual2 ?>" class="btn btn-danger waves-effect"><i class="material-icons">clear </i> Cancel</a>
                                                </td>
                                            </tr>

                                        <?php

                                            $total_bayar = $total_bayar + $data['total'];
                                        }


                                        ?>

                                    </tbody>

                                    <tr>


                                        <th style="text-align: right; font-size: 17px;" colspan="4">Supplier</th>
                                        <td style="text-align: right;"> <input type="text" readonly="" name="supplier" placeholder="Isi Nama Supplier" required="required" style=" width:80%; text-align:left; background-color: #e7e3e9; text-size:16px; font-weight:bold; font-style:italic; " value="<?php echo $_GET['namasp']; ?>" />

                                        </td>

                                        <td>

                                            <a href="" style=" width:60%;  height:35px; " class="btn btn-info waves-effect" data-toggle="modal" data-target="#smallModal2" target="blank"><i class="material-icons">list </i> Lihat List Supplier</a>


                                        </td>

                                    </tr>



                                    <tr>
                                        <th style="text-align: right; font-size: 17px;" colspan="4">Total</th>
                                        <td style="text-align: right;"><b style="font-size:18px;"><?php echo  "Rp." . number_format($total_bayar, 2, ",", ".");  ?> </b></td>
                                        <div>
                                            <td><input onclick="return confirm('Apakah transaksi ini sudah selesai...???') " type="submit" name="cetak_tr" id="cetak_tr" value="Simpan Transaksi" href="" class="btn btn-success m-r-20 waves-effect">
                                        </div>
                                        <!-- <a href="" class="btn btn-warning waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal" target="blank">Cetak Struk</td> -->
                                    </tr>

                                    <?php

                                    if (isset($_POST['cetak_tr'])) {
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
                                        $kode_pj = $_GET['invoice'];
                                        $supplier = $_POST['supplier'];

                                        $sql =    $koneksi->query("insert into tb_transaksi (kode_transaksi,kode_penjualan, kode_pembelian,tanggal,total, nama)values('$format','-','$kode_pj','$tgl_jual_tr','$total_bayar', '$supplier' )");

                                        $sql2 = $koneksi->query("update tb_pembelian set nama_supp='$supplier' where kode_pembelian='$kode_pj'");
                                        $sql17 = $koneksi->query("delete from tb_tmp_pembelian where id='1' ");
                                    }

                                    ?>



                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="smallModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">List Data Supplier </h4>
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
                        $sql2 = $koneksi->query("select * from tb_supplier  ");
                        while ($tampil2 = $sql2->fetch_assoc()) {


                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>


                                <td><?php echo $tampil2['nama'] ?> </td>
                                <td><?php echo $tampil2['alamat'] ?> </td>
                                <td><?php echo $tampil2['telpon'] ?> </td>




                                <td>


                                    <a href="?page=pembelian&namasp=<?php echo $tampil2['nama']; ?>&invoice=<?php echo $_GET['invoice']; ?>" class="btn btn-success waves-effect"><i class="material-icons">add </i> Pilih</a>

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
                <h4 class="modal-title" id="defaultModalLabel">Struk Pembelian</h4>
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


                    $sql = $koneksi->query("select * from tb_pembelian where kode_pembelian='$kd_pj'");
                    $tampil2 = $sql->fetch_assoc();

                    $sql = $koneksi->query("select * from tb_transaksi where kode_pembelian='$kd_pj1'");
                    $tampil4 = $sql->fetch_assoc();



                    $sql = $koneksi->query("select * from tb_pembelian  where  
                                                 kode_pembelian='$kd_pjl'");
                    $tampil2 = $sql->fetch_assoc();

                    ?>

                    <tr>
                        <td>No Penjualan &nbsp &nbsp</td>
                        <td>: &nbsp &nbsp<?php echo $tampil2['kode_pembelian']; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tanggal &nbsp &nbsp</td>
                        <td>: &nbsp &nbsp <?php echo $tampil2['tanggal']; ?></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Kasir &nbsp &nbsp</td>
                        <td>: &nbsp &nbsp <?php echo $data_u['nama']; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nama Supplier &nbsp &nbsp</td>
                        <td>: &nbsp &nbsp <?php echo $tampil2['nama_supp']; ?></td>
                        <td></td>
                    </tr>



                    <tr>
                        <td>
                            <hr width="100%" color="red">
                        </td>
                    </tr>


                    <?php

                    $sql = $koneksi->query("select * from tb_pembelian, tb_barang where tb_pembelian.kode_barang=tb_barang.kode_barang and kode_pembelian='$kd_pjl'");

                    while ($tampil = $sql->fetch_assoc()) {


                    ?>



                        <tr>


                            <td><?php echo $tampil['nama_barang']; ?></td>
                            <td><?php echo "Rp." . number_format($tampil['harga']) . ',-' . '&nbsp' . '&nbsp' . 'X' . '&nbsp' . '&nbsp' . $tampil['jumlah'] . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp' . '&nbsp'; ?></td>



                            <td><?php echo "Rp." . number_format($tampil['total']); ?>,-</td>
                        </tr>

                    <?php



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
                        <td>
                            <hr>
                        </td>
                    </tr>



                </table>

                <table>
                    <tr>
                        <td>Barang yang sudah dibeli tidak dapat dikembalikan kecuali ada perjanjian terima kasih</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <a href="page/pembelian/invoice.php?kode=<?php echo $kd_pjl; ?>&iduser=<?php echo $data_u['id']; ?>" target="blank" class="btn btn-link waves-effect"><i class="material-icons">print </i>Cetak</a>

                <a href="?page=pembelian&invoice=<?php echo "$finalcodep"; ?>" class="btn btn-info waves-effect">Selesai</a>


            </div>
        </div>
    </div>
</div>