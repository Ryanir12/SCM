<?php 
    $kode_barang = $_GET['kode_barang'];
    $kd_pb = $_GET['kd_pj1'];
	$id = $_GET['id'];
	$harga_beli= $_GET['harga_beli'];
    $tgl_jual2 = $_GET['tgl_jual2'];
   

		

    $sql2 = $koneksi->query("update tb_pembelian set jumlah=(jumlah - 1) where id='$id'");
    $sql = $koneksi->query("update tb_pembelian set total=(total - $harga_beli) where id='$id'");
     $sql3 = $koneksi->query("update tb_barang set stok=(stok - 1) where kode_barang='$kode_barang'");


       $sql_barang3 = $koneksi->query("select * from tb_dstok where kode_barang='$kode_barang'   and tanggal='$tgl_jual2' ");
      $data_barang3=$sql_barang3->fetch_assoc();
      $id2       = $data_barang3['id'];
      $tanggal2       = $data_barang3['tanggal'];
           
         if($tanggal2 != $tgl_jual2){
           $sql = $koneksi->query("insert into tb_dstok values('','$barcode', '$nama','$satuan','$tgl_jual', '$jumlah', 'Stok Tersedia')");
    
         }else{
         $sql_barang3 = $koneksi->query("update tb_dstok set stok=(stok - 1) where id='$id2'   ");

      }





		if ($sql2) {

            ?>
              <script>
                  
                  window.location.href="?page=pembelian&invoice=<?php echo $kd_pb; ?>";
              </script>

            <?php
          }

 ?>