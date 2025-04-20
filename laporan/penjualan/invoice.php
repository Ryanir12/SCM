<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$koneksi = new mysqli  ("localhost","root","","db_supplay");
$content ='

<style type="text/css">
	
	.tabel{border-collapse: collapse;}
	.tabel th{padding: 8px 5px;  background-color:  #cccccc;  }
	.tabel td{padding: 8px 5px;     }
</style>


';

	
        
		$kode = $_GET['kode'];

         $sql = $koneksi->query("select* from tb_transaksi where kode='$kode'");
         $data = $sql->fetch_assoc();
        $tanggal = $data['tanggal'];
      

       


          $sql2 = $koneksi->query("select* from tb_penjualan where kode_penjualan='$kode'");
         $data2 = $sql2->fetch_assoc();
           $id_customer = $data2['id_customer'];


            $sql3 = $koneksi->query("select* from tb_customer where id_customer='$id_customer'");
         $data3 = $sql3->fetch_assoc();
         $nama1 = $data3['nama'];







        $id = $_GET['iduser'];

         $sql_u = $koneksi->query("select* from tb_user where id='$id'");
       $data_u = $sql_u->fetch_assoc();

       $nama = $data_u['nama'];
       

    $content .= '
<page><br>
	<a style="text-decoration: none; font-size:16px; color: black; margin-left:295px; ">CV SPARTINDO UTAMA</a><br>
    <a style="text-decoration: none; color:  black; font-size:16px; margin-left:250px; text-align:center;">PERDAGANGAN UMUM, SPARE PART</a><br>
     <a style="text-decoration: none; color:  black; font-size:16px; margin-left:280px; text-align:center;">MECANICAL & ELECTRICAL</a><br>
     <a style="text-decoration: none; color:  black; font-size:12px; margin-left:245px; text-align:center;">Jl. Keruing No.10 Padang (25162) SUMATERA BARAT</a><br>
      <a style="text-decoration: none; color:  black; font-size:12px; margin-left:285px; text-align:center;">Telp. (0751)778054 - Fax. (0751)778054  </a><br>
       <a style="text-decoration: none; color:  black; font-size:12px; margin-left:270px; text-align:center;">E-MAIL :  SPARTINDOUTAMA@GMAIL.COM  </a><br><hr><br>

   <a style="text-decoration: none; color:  black; font-size:16px; margin-left:300px; text-align:center;"><u><b>Detail Pembelian Barang</b> </u></a><br><br><br>
   
<a style="text-decoration: none; color:  black; font-size:16px; margin-left:10px; text-align:justify; ">Nomor Transaksi :  <b>'.$kode. '</b> </a><br>
<a style="text-decoration: none; color:  black; font-size:16px; margin-left:10px; text-align:justify; ">Tanggal Transaksi :  <b>'.$tanggal. '</b> </a><br>
<a style="text-decoration: none; color:  black; font-size:16px; margin-left:10px; text-align:justify; ">Nama Pembeli :  <b>'.$nama1. '</b> </a><br>
<a style="text-decoration: none; color:  black; font-size:16px; margin-left:10px; text-align:justify; ">Nama Kasir :  <b>'.$nama. '</b> </a><br><br><br>

<a style="text-decoration: none; color:  black; font-size:16px; margin-left:35px; text-align:justify; ">Berikut nama alat yang dibeli oleh pembeli Sdr/i  <b>'.$nama1. '</b> : </a><br><br>
  



    <table border="1px" class="tabel" align="center">
    	
    		<tr>
    			<th>No</th>
                 <th style="width:15%;" >Kode Barang </th>
                <th style="width:25%;" >Nama Barang </th>
                  <th style="width:15%;" >Harga Satuan Barang </th>
                <th style="width:10%;">Jumlah Beli</th>
                <th style="width:15%;">Sub Total</th>
               
                
              
             
               
    		</tr>';

  		
   		
        		$no = 1;

        		  $sql2 = $koneksi->query("select* from tb_penjualan where kode_penjualan='$kode'");
        		while ($data2=$sql2->fetch_assoc()) {
        	          
                 
                    $kode_barang = $data2['kode_barang'];
                     $sql3 = $koneksi->query("select* from tb_barang where kode_barang='$kode_barang'");
                    $data3 = $sql3->fetch_assoc();




    	
    		$content .='

    		<tr>
    			<td>'.$no++.' </td>
		    			   
                         <td style="width:15%;"> '.$kode_barang.' </td> 
                        <td style="width:25%;"> '.$data3['nama_barang'].' </td>
                         <td align="right width:15%;">Rp.  '.number_format( $data3['harga_jual']).",-".' </td>
                            <td style="width:10%; text-align:center;"> '.$data2['jumlah'].' '.$data3['satuan'].' </td>
                            
                         <td align="right width:15%;">Rp.  '.number_format( $data2['total']).",-".' </td>
                       
                    
		    		
		    			
    		</tr>

    		';	
    		   

                       

               $totalharga = $totalharga + $data2['total'];
              
    		}
    		$content .='

                <tr>
                    <th style="text-align: center; font-size: 17px; width:60%;" colspan="5">Total Pembayaran </th>
                    <td style="font-size: 17px;"><b>Rp.'.number_format($totalharga).',-</b></td>
                   
                </tr>

            ';  


$content .=' 

     </table>

<br><br><br>
<a style="text-decoration: none; color:  black; font-size:16px; margin-left:35px; text-align:justify; ">Berikut detail alat yang akan diambil pada gudang dan diserahkan kepada pembeli Sdr/i  <b>'.$nama1. '</b> : </a><br><br>
 

    <table border="1px" class="tabel" align="center">
      
        <tr>
          <th>No</th>
           <th style="width:15%;" >Kode Barang </th>
                <th style="width:25%;" >Nama Barang </th>
                  <th style="width:15%; text-align:center;" >Tanggal Masuk Barang</th>
                <th style="width:25%; text-align:center;">Jumlah Pengambilan Barang digudang</th>
                      
               
        </tr>';
          
            $no = 1;

              $sql2 = $koneksi->query("select* from detail_penjualan where kode_penjualan='$kode' order by kode_barang asc");
            while ($data2=$sql2->fetch_assoc()) {
                    
                 
                    $kode_barang = $data2['kode_barang'];


                     $sql3 = $koneksi->query("select* from tb_barang where kode_barang='$kode_barang'");
                    $data3 = $sql3->fetch_assoc();


                      $sql4 = $koneksi->query("select* from tb_dstok where kode_barang='$kode_barang'");
                    $data4 = $sql4->fetch_assoc();
                    $tanggal2 = $data4['tanggal']; 

      
        $content .='

        <tr>
          <td>'.$no++.' </td>
              
                           <td style="width:15%;"> '.$kode_barang.' </td>
                        <td style="width:25%;"> '.$data3['nama_barang'].' </td>
                         <td style="width:15%; text-align:center;"> '.$data4['tanggal'].' </td>
                            <td style="width:25%; text-align:center; "> '.$data2['jumlah'].' '.$data3['satuan'].' </td>
                            
                     
                                           
              
        </tr>

        ';  
                               

              
        }
       


$content .='  
    </table>

    
<br><br>

    <br>
    <br>
    <br>
    <a style="text-decoration: none; font-size:16px; color: black; margin-left:35px; "> Padang, '.date('d / M / Y').' </a><br>
    <a style="text-decoration: none; font-size:15px; color: black; margin-left:35px; "> Penanggung Jawab </a> <br> 
    <br>
    <br>
    <br>
    <br>
  <a style="text-decoration: none; font-size:16px; color: black; margin-left:35px; "> ______________________</a><br>
    <a style="text-decoration: none; font-size:15px; color: black; margin-left:35px; "><b>('.$nama.')</b></a><br><br><br>
   

    
</page>';



    require_once('../../assets/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
?>
