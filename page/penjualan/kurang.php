<?php 
    $kode_barang = $_GET['kode_barang'];
    $kd_pj = $_GET['kd_pj'];
	$id = $_GET['id'];
	$harga_jual= $_GET['harga_jual'];
   

		

    $sql2 = $koneksi->query("update tb_penjualan set jumlah=(jumlah - 1) where id='$id'");
    $sql = $koneksi->query("update tb_penjualan set total=(total - $harga_jual) where id='$id'");
     $sql3 = $koneksi->query("update tb_barang set stok=(stok + 1) where kode_barang='$kode_barang'");


     $sql_barang3 = $koneksi->query("select * from tb_dstok where kode_barang='$kode_barang' and ket='Stok Tersedia'   ");
         $data_barang3=$sql_barang3->fetch_assoc();
          $id       = $data_barang3['id'];
       

         $sql_barang3 = $koneksi->query("update tb_dstok set stok=(stok + 1) where id='$id'  ");



         $sql_barang5 = $koneksi->query("select * from tb_dstok where id='$id'  ");
         $data_barang5=$sql_barang5->fetch_assoc();
          $stok       = $data_barang5['stok'];


         if ($stok == 0 ){
               $sql_barang5 = $koneksi->query("update tb_dstok set ket='Tidak Tersedia' where id='$id' ");

         }else if($stok >= 1 ){
               $sql_barang5 = $koneksi->query("update tb_dstok set ket='Stok Tersedia' where id='$id' ");

         }


		if ($sql2) {

            ?>
              <script>
                  
                  window.location.href="?page=penjualan&invoice=<?php echo $kd_pj; ?>";
              </script>

            <?php
          }

 ?>