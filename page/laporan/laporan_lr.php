<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Penjualan dan Pembelian
                            </h2>

                        </div>
                   <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                     <tr>
                                        <th>No</th>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Barang Pembelian * Harga * Jumlah = <b>Sub Total</b> </th>
                                        <th>Pengeluaran</th>
                                          <th>Pemasukan</th>
                                        
                                      
                                        
                                        
                                    </tr>
                                </thead>


                                 <tbody>
                                 <?php
                                    $no=1;


                                    $sql1 = $koneksi->query("select * from tb_transaksi ");
                                    while ($tampil1=$sql1->fetch_assoc()) {
                                      $kode = $tampil1['kode'];
                                      $pemasukan = $tampil1['pemasukan'];
                                        $pengeluaran = $tampil1['pengeluaran'];


                                   
                                      

                                  ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                           <td><?php echo $tampil1['kode'] ?> </td>
                                        <td><?php echo date('d F Y', strtotime( $tampil1['tanggal'])); ?> </td>
                                       
                                          <td>

                                            <ol>
                                                <?php


                                                if ($pemasukan>0) {
                                                     $queryListBarang = mysqli_query($koneksi,"SELECT * FROM `tb_penjualan`  where kode_penjualan='$kode' ");
                                     
                                                }else{
                                                     $queryListBarang = mysqli_query($koneksi,"SELECT * FROM `tb_pembelian`  where kode_pembelian='$kode' ");
                                     
                                                }


                                        while ($dataLB = mysqli_fetch_array($queryListBarang)) {
                                          $kode_barang = $dataLB['kode_barang'];
                                                 $sql2 = $koneksi->query("select * from tb_barang where kode_barang='$kode_barang' ");
                                                 $tampil2=$sql2->fetch_assoc();
                                    

                                                           echo "<li>" .$tampil2['nama_barang'].   " X " .$dataLB['jumlah'].   " " .$tampil2['satuan'].   " X Rp. " .number_format($tampil2['harga_jual']).",-  = X Rp. " .number_format($dataLB['total']).",-   </li>";
                                                        }
                                                     
                                                        ?>
                                            </ol>
                                        </td>

                                        <td><?php echo "Rp." .number_format( $pengeluaran); ?>,- </td>  

                                       
                                        <td><?php echo "Rp." .number_format( $pemasukan); ?>,- </td>   
                                      
                                     
                                        
                                        
                                    </tr>
                                    <?php
                                        $pemasukan2 = $pemasukan2+$tampil1['pemasukan'];
                                         $pengeluaran2 = $pengeluaran2+$tampil1['pengeluaran']; 
                                          
                                          $total_lr = $pemasukan2 - $pengeluaran2;
                                        } 
                                    ?>
                                 </tbody>
                                 <tr>
                                    <th style="text-align: center; font-size: 17px;" colspan="4">Total Penjualan</th>
                                    <td align="center" style="font-size: 15px;"  ><b><?php echo "Rp." .number_format($pengeluaran2) ; ?>,-</b></td>
                                     <td align="center" style="font-size: 15px;"  ><b><?php echo "Rp." .number_format($pemasukan2) ; ?>,-</b></td>
                                 
                                 </tr>
                                <tr>
                                    <th style="text-align: center; font-size: 17px;" colspan="4">Total Laba (+) / Rugi (-) </th>
                                    <td align="center" style="font-size: 15px;" colspan="3"><b><?php echo "Rp." .number_format($total_lr) ; ?>,-</b></td>
                                  
                                </tr>
                             </table>

                             <a href=""  class= "btn btn-success waves-effect" data-toggle="modal" data-target="#smallModal" target="blank"><i class="material-icons">print </i> Cetak Pdf</a> 

                             <a href="" onclick="self.history.back() " class= "btn btn-success waves-effect"><i class="material-icons">settings_backup_restore </i> Kembali</a> 
                             





                             


<div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Data Penjualan dan Pembelian</h4>
                        </div>


                        <div class="modal-body">

                         <form role="form" method="POST" action="laporan/labarugi/lap_lr_pdf.php" target="blank" >

                            <label for="nama">Dari Tanggal</label>
                              <div class="form-group">
                                  <div class="form-line">
                                      <input type="date" name="tgl1"  class="form-control" placeholder="Tanggal Awal" required="">
                                  </div>
                              </div>

                              <label for="nama">Sampai Tanggal</label>
                              <div class="form-group">
                                  <div class="form-line">
                                      <input type="date" name="tgl2"  class="form-control" placeholder="Tanggal Akhir" required="">
                                  </div>
                              </div>

                                    
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="cetak" class= "btn btn-success waves-effect" style="margin-top: px;"><i class="material-icons">print </i> Cetak per Periode</button>
                                            
                            <a href="./laporan/labarugi/lap_lr_pdf2.php?keluar=<?php echo $pengeluaran2; ?>&?masuk=<?php echo $pemasukan2; ?>" class="btn btn-primary waves-effect" target="blank" style="margin-top: px; margin-left: 5px;"><i class="fa fa-print"></i> Cetak Semua</a>

                            
                        </div>
                    </div>
                    </form>
                </div>
            </div>