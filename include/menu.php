<div class="menu">
    <ul class="list">
        <li style="margin-top: 5px; background-color:   #e9e9e9;" class="header">MAIN NAVIGATION</li>
        <li>
            <a href="index.php">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>
        <?php if ($_SESSION['admin']) { ?>





            <li>

                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">description</i>
                    <span>Master</span>
                </a>
                <ul class="ml-menu">

                    <li>
                        <a href="?page=satuan">
                            <i class="material-icons">note_add</i>
                            <span>Satuan Barang</span>
                        </a>
                    </li>


                    <li>
                        <a href="?page=barang">
                            <i class="material-icons">view_module</i>
                            <span>Barang</span>
                        </a>
                    </li>


                    <li>
                        <a href="?page=supplier">
                            <i class="material-icons">person</i>
                            <span>Supplier</span>
                        </a>
                    </li>
                    <!--
                     <li>
                        <a href="?page=pelanggan">
                           <i class="material-icons">supervisor_account</i>
                            <span>Pelanggan</span>
                        </a>
                    </li>    
                    -->



                    <li>
                        <a href="?page=pengguna">
                            <i class="material-icons">perm_identity</i>
                            <span>pengguna</span>
                        </a>
                    </li>

                </ul>
            </li>








            <li>

                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">book</i>
                    <span>Transaksi</span>
                </a>
                <ul class="ml-menu">


                    <?php





                    $sql8 = $koneksi->query("select * from tb_tmp_penjualan where id='1' ");
                    $data8 = $sql8->fetch_assoc();
                    $id_penjualan = $data8['id'];




                    if ($id_penjualan == 1) {
                        $kode_penjualan = $data8['kode_penjualan'];
                    } else {
                        $kode_penjualan = $finalcode;
                    }


                    ?>



                    <li>


                        <a href="?page=penjualan&invoice=<?php echo $kode_penjualan; ?>">
                            <i class="material-icons">shopping_cart</i>
                            <span>Penjualan</span>
                        </a>
                    </li>

                    <?php





                    $sql9 = $koneksi->query("select * from tb_tmp_pembelian where id='1' ");
                    $data9 = $sql9->fetch_assoc();
                    $id_pembelian = $data9['id'];




                    if ($id_pembelian == 1) {
                        $kode_pembelian = $data9['kode_pembelian'];
                    } else {
                        $kode_pembelian = $finalcodep;
                    }


                    ?>

                    <li>
                        <a href="?page=pembelian&invoice=<?php echo "$kode_pembelian"; ?>">
                            <i class="material-icons">add_shopping_cart</i>
                            <span>Pembelian</span>
                        </a>
                    </li>

                </ul>
            </li>



            <li>

                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">print</i>
                    <span>Laporan</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="?page=laporan_jual">
                            <i class="material-icons">assessment</i>
                            <span>Penjualan</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=laporan_beli">
                            <i class="material-icons">assignment_turned_in</i>
                            <span>Pembelian</span>
                        </a>
                    </li>





                    <li>
                        <a target="_BLANK" href="page/barang/cetakbarang.php?kode=<?php echo $kode_barang; ?>&iduser=<?php echo $data_u['id']; ?>">
                            <i class="material-icons">view_module</i>
                            <span>Stok Barang</span>
                        </a>
                    </li>
                    <!--
                 <li>
                    <a target="_BLANK" href="page/barang/cetakfifo.php?kode=<?php echo $kode_barang; ?>&iduser=<?php echo $data_u['id']; ?>" >
                    <i class="material-icons">done</i>
                    <span>Stok barang dengan Metode FIFO</span>
                    </a>
                </li>
             


                 <li>
                    <a href="?page=laporan_lr">
                    <i class="material-icons">credit_card</i>
                    <span>Laba Rugi</span>
                    </a>
                </li>
-->

                </ul>
            </li>






        <?php } ?>











        <?php if ($_SESSION['pimpinan']) { ?>



            <li>

                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">print</i>
                    <span>Laporan</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="?page=laporan_jual">
                            <i class="material-icons">assessment</i>
                            <span>Penjualan</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=laporan_beli">
                            <i class="material-icons">assignment_turned_in</i>
                            <span>Pembelian</span>
                        </a>
                    </li>






                    <li>
                        <a target="_BLANK" href="page/barang/cetakbarang.php?kode=<?php echo $kode_barang; ?>&iduser=<?php echo $data_u['id']; ?>">
                            <i class="material-icons">view_module</i>
                            <span>Stok Barang</span>
                        </a>
                    </li>
                    <!--
                 <li>
                    <a target="_BLANK" href="page/barang/cetakfifo.php?kode=<?php echo $kode_barang; ?>&iduser=<?php echo $data_u['id']; ?>" >
                    <i class="material-icons">done</i>
                    <span>Stok barang dengan Metode FIFO</span>
                    </a>
                </li>
               


                 <li>
                    <a href="?page=laporan_lr">
                    <i class="material-icons">credit_card</i>
                    <span>Laba Rugi</span>
                    </a>
                </li>
-->

                </ul>
            </li>


        <?php } ?>




        <?php if ($_SESSION['supplier']) { ?>





            <li>
                <a href="?page=barangsupp">
                    <i class="material-icons">view_module</i>
                    <span>Stok Barang</span>
                </a>
            </li>











            <li>
                <a href="?page=history">
                    <i class="material-icons">assignment_turned_in</i>
                    <span>History Penjualan</span>
                </a>
            </li>






        <?php } ?>


        <?php if ($_SESSION['kasir']) { ?>








            <?php





            $sql8 = $koneksi->query("select * from tb_tmp_penjualan where id='1' ");
            $data8 = $sql8->fetch_assoc();
            $id_penjualan = $data8['id'];




            if ($id_penjualan == 1) {
                $kode_penjualan = $data8['kode_penjualan'];
            } else {
                $kode_penjualan = $finalcode;
            }


            ?>



            <li>


                <a href="?page=penjualan&invoice=<?php echo $kode_penjualan; ?>">
                    <i class="material-icons">shopping_cart</i>
                    <span>Penjualan</span>
                </a>
            </li>


            <li>

                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">print</i>
                    <span>Laporan</span>
                </a>
                <ul class="ml-menu">



                    <li>
                        <a href="?page=laporan_jual">
                            <i class="material-icons">assessment</i>
                            <span>Penjualan Barang</span>
                        </a>
                    </li>





                    <li>
                        <a target="_BLANK" href="page/barang/cetakbarang.php?kode=<?php echo $kode_barang; ?>&iduser=<?php echo $data_u['id']; ?>">
                            <i class="material-icons">view_module</i>
                            <span>Stok Barang</span>
                        </a>
                    </li>
                    <!--
                 <li>
                    <a target="_BLANK" href="page/barang/cetakfifo.php?kode=<?php echo $kode_barang; ?>&iduser=<?php echo $data_u['id']; ?>" >
                    <i class="material-icons">done</i>
                    <span>Stok barang dengan Metode FIFO</span>
                    </a>
                </li>
               


                 <li>
                    <a href="?page=laporan_lr">
                    <i class="material-icons">credit_card</i>
                    <span>Laba Rugi</span>
                    </a>
                </li>
-->

                </ul>
            </li>


        <?php } ?>












        <li class="active">


        </li>






    </ul>
</div>