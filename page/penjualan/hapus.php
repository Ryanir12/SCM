<?php 
    
    $kd_pj = $_GET['kd_pj'];
     $kode_barang = $_GET['kode_barang'];

   


        






		$id = $_GET['id'];
    $kode_barang = $_GET['kode_barang'];
    $jumlah = $_GET['jumlah'];

		$sql = $koneksi->query("delete from tb_penjualan where id='$id'");

    $sql2 = $koneksi->query("update tb_barang set stok=(stok + $jumlah) where kode_barang='$kode_barang'");

		if ($sql) {

            ?>
              <script>
                  
                  window.location.href="?page=penjualan&invoice=<?php echo $kd_pj; ?>";
              </script>

            <?php
          }

 ?>