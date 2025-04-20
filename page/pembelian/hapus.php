<?php 
    
    $kd_pb = $_GET['kd_pj1'];
	$id = $_GET['id'];
    $kode_barang = $_GET['kode_barang'];
    $jumlah = $_GET['jumlah'];

     $tgl_jual2 = $_GET['tgl_jual2'];



		$sql = $koneksi->query("delete from tb_pembelian where id='$id'");

    $sql2 = $koneksi->query("update tb_barang set stok=(stok - $jumlah) where kode_barang='$kode_barang'");

      $sql_barang3 = $koneksi->query("select * from tb_dstok where kode_barang='$kode_barang'  and tanggal='$tgl_jual2' ");
      $data_barang3=$sql_barang3->fetch_assoc();
      $id2       = $data_barang3['id'];
      $tanggal2       = $data_barang3['tanggal'];
           
         if($tanggal2 != $tgl_jual2){
           $sql = $koneksi->query("insert into tb_dstok values('','$barcode', '$nama','$satuan','$tgl_jual', '$jumlah', 'Stok Tersedia')");
    
         }else{
         $sql_barang3 = $koneksi->query("update tb_dstok set stok=(stok - $jumlah) where id='$id2'   ");

      }






		if ($sql) {

            ?>
              <script>
                  alert("Data Berhasil dihapus  <?php echo $kode; ?>");
                  window.location.href="?page=pembelian&invoice=<?php echo $kd_pb; ?>";
              </script>

            <?php
          }

 ?>