<script>
    window.print();
</script>





<?php include "../../koneksi/koneksi.php"; ?>

<?php 
	error_reporting(0);
    $kasir= $_GET['kasir'];
    $kd_pjl= $_GET['invoice']; 
?>
<div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Struk belanja</h4>
                        </div>


                        <div class="modal-body">

                        <table>
                            <tr>
                                <td>DANIEL STORE</td>
                            </tr>

                            <tr>
                                <td>Jalan M. Yunus No.7, Lubuk Lintah, Kec. Kuranji, Kota Padang</td>
                            </tr> 

                        </table>

                            <table>
                                
                                    
                                    <br> 
                                    <?php 



                                        $sql = $koneksi->query("select * from tb_pembelian where kode_pembelian='$kd_pjl'");
                                        $tampil2=$sql->fetch_assoc(); 

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
                                        <td>: &nbsp &nbsp <?php echo $kasir; ?></td>
                                        <td></td>
                                    </tr>
                                     <tr>
                                        <td>Nama Supplier &nbsp &nbsp</td>
                                        <td>: &nbsp &nbsp <?php echo $tampil2['nama_supp']; ?></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td><hr width="100%" color="red"></td>
                                       
                                    </tr>


                                    <?php 

                                        $sql = $koneksi->query("select * from tb_pembelian, tb_barang where tb_pembelian.kode_barang=tb_barang.kode_barang and kode_pembelian='$kd_pjl'");
                                        
                                        while ($tampil=$sql->fetch_assoc()) {
                                               

                                     ?>

                                     

                                    <tr>
                                    
                                        
                                        <td><?php echo $tampil['nama_barang']; ?></td>
                                        <td><?php echo "Rp." .number_format($tampil['harga']).',-'.'&nbsp'.'&nbsp'.'X'.'&nbsp'.'&nbsp'.$tampil['jumlah'].'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'; ?></td>

                                        
                                        
                                        <td><?php echo "Rp." .number_format($tampil['total']); ?>,-</td>
                                    </tr>

                                   <?php

                                       

                                        $total_bayar2 = $total_bayar2+$tampil['total'];

                                        } 

                                    ?> 

                                    <tr>
                                        <td><hr></td>
                                    </tr>

                                    <tr>
                                        <th  font-size: 17px;" colspan="2">Total</th>
                                        <td style="text-align: right;"><b> <?php echo "Rp." .number_format($total_bayar2); ?>,- </b></td>
                                    </tr>


                                    

                                     <tr>
                                        <td><hr></td>
                                    </tr>

                                    
                               
                            </table>

                            <table>
                                <tr>
                                    <td>Barang yang sudah dibeli tidak dapat dikembalikan kecuali ada perjanjian terima kasih</td>
                                </tr>
                            </table>
                        </div>
                        <br>
                       
                    </div>
                </div>
            </div>