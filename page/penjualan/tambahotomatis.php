<?php

 $koneksi = new mysqli("localhost","root","","db_supplay");


$barcode= $_GET['kode'];
$kode_pj= $_GET['invoice'];

$stok= $_GET['stok'];


  $tgl_jual = date("Y-m-d");
        
       
         
         

         $sql_barang2 = $koneksi->query("select * from tb_barang where kode_barang = '$barcode'");
         $data_barang2=$sql_barang2->fetch_assoc();

         $harga_jual       = $data_barang2['harga_jual'];

       




        $jumlah = 1;
     
        
        $total = $jumlah * $harga_jual;

        $sql_barang = $koneksi->query("select * from tb_barang where kode_barang = '$barcode'");
        while ($data_barang = $sql_barang->fetch_assoc()) {
            $sisa = $data_barang['stok'];

            if ($sisa == 0) {
                ?>
                    <script type="text/javascript">
                        alert("Stok Barang Habis, Transaksi Tidak Dapat Dilakukan, Silakan Tambah Stok Barang Terlebih Dahulu ");
                        window.location.href="?page=penjualan&invoice=<?php echo $_GET['invoice']; ?>";
                    </script>
                <?php
            }else{
        


 $sql8 = $koneksi->query("select * from tb_penjualan where kode_penjualan='$kode_pj' and kode_barang='$barcode' ");
    while($data8=$sql8->fetch_assoc()){
       $jml_barangrs=$sql8->num_rows; 
}


// JIKA PERNYATAAAN 2 ADA MAKA AKAN DILAKUKAN PROSES PENYIMPANAN SEPERTI DIBAWAH, YAITU MENAMBAH JUMLAH PEMBELIAN PADA TABEL TB_PENJUALAN 2
 if ($jml_barangrs == 1) {
   $sql = $koneksi->query("update  tb_penjualan set jumlah=(jumlah + $jumlah )  where kode_barang='$barcode' and kode_penjualan='$kode_pj' ");
  
        

        $sql_barang4 = $koneksi->query("select * from tb_penjualan where kode_barang = '$barcode' and kode_penjualan='$kode_pj' ");
         $data_barang4=$sql_barang4->fetch_assoc();
        
         $jumlahbeli = $data_barang4['jumlah'];

         $totalseluruh = ($jumlahbeli+1) * $harga_jual;

     
       $sql11 = $koneksi->query("update  tb_penjualan set total='$totalseluruh'  where kode_barang='$barcode' and kode_penjualan='$kode_pj' ");
     




    $sql4 =$koneksi->query("update  tb_barang set stok=(stok - 1 )  where kode_barang='$barcode'  ");
      
      $ulangi2 = 0;   

      $jumlah = 1;

      while ( $ulangi2 < $jumlah  ) {


         $sql_barang3 = $koneksi->query("select * from tb_dstok where kode_barang='$barcode'  and ket='Stok Tersedia' ");
         $data_barang3=$sql_barang3->fetch_assoc();
          $id       = $data_barang3['id'];


   //MENYIMPAN DATA PADA TABEL D_DSTOK    
          $sqldstok = $koneksi->query("select * from detail_penjualan where kode_penjualan='$kode_pj' and id_dstok='$id' ");
            $datadstok=$sqldstok->fetch_assoc();
            $jml_barangdstok=$sqldstok->num_rows; 
            $idtabeldstok = $datadstok['id'];
            
         if ($jml_barangdstok == 1) {
            $sql_barang13 = $koneksi->query("update detail_penjualan set jumlah=(jumlah + 1) where id='$idtabeldstok'");
        }else{

           $sql13 = $koneksi->query("insert into detail_penjualan (id,  kode_penjualan, id_dstok, kode_barang, jumlah) values('', '$kode_pj', '$id', '$barcode', '1')");

        }  
 
       
//MENGURANGI STOK DI TABEL BARANG
         $sql_barang3 = $koneksi->query("update tb_dstok set stok=(stok - 1) where id='$id'   ");

           $sql_barang5 = $koneksi->query("select * from tb_dstok where id='$id'  ");
            $data_barang5=$sql_barang5->fetch_assoc();
           $stok       = $data_barang5['stok'];

         if ($stok == 0 ){
               $sql_barang5 = $koneksi->query("update tb_dstok set ket='Tidak Tersedia' where id='$id' ");

         }else if($stok > 0 ){
               $sql_barang5 = $koneksi->query("update tb_dstok set ket='Stok Tersedia' where id='$id' ");

         }

        
          
         }
          $ulangi2++;
       

    }



    
    }





  }

    

		if ($sql_barang3) {

            ?>
              <script>
                
                  window.location.href="?page=penjualan&invoice=<?php echo $kode_pj; ?>";
              </script>

            <?php
          }

 ?>