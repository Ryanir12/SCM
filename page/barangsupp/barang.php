<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Data Barang
                            </h2>

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                    	<th>No</th>
                                        <th>Kode Barang</th>
                                        
                                        <th>Nama Barang</th>
                                     
                                        <th>Stok</th>
                                        <th>Keterangan</th>
                                        <th>Harga</th>
                                      
                                    </tr>
                                </thead>


                                 <tbody>
                                 <?php
                                 	$no=1;
                                 	$sql = $koneksi->query("select * from tb_barang");
                                 	while ($tampil=$sql->fetch_assoc()) {


                                  ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $tampil['kode_barang'] ?> </td>
                                         
                                        <td><?php echo $tampil['nama_barang'] ?> </td>
                                  
                                        <td>

                                            

                                            <?php 
                                                $satuan = $tampil['satuan'];

                                                $stok = $tampil['stok'];

                                                if (($stok<=10)&&($stok>=1)) {
                                                    
                                                    echo "<b><font color='orange'> $stok $satuan</b> ";
                                                } else  if ($stok>10) {
                                                     echo "<b><font color='green'> $stok $satuan</>";
                                                }else  if ($stok<=0) {
                                                     echo "<b><font color='red'> $stok $satuan</>";
                                                }
   
                                            ?> 

                                            
                                        </td>
                                        <td>

                                            

                                            <?php 
                                            

                                                $stok = $tampil['stok'];

                                                if (($stok<=10)&&($stok>=1)) {
                                                    
                                                    echo "<b><font color='orange'> Stok Menipis</b> ";
                                                } else if ($stok>10){
                                                     echo "<b><font color='green'>Persediaan Cukup</>";
                                                }else if ($stok<0){
                                                     echo "<b><font color='red'>Stok Habis</>";
                                                }
   
                                            ?> 

                                            
                                        </td>
                                          <td><?php echo "Rp." .number_format( $tampil['harga_beli']); ?>,- </td>   
                                     
                                    </tr>
                                    <?php } ?>
                                 </tbody>
                             </table>

                              <a href="page/barangsupp/cetakbarang.php?kode=<?php echo $kode_barang; ?>&iduser=<?php echo $data_u['id']; ?>"" class= "btn btn-primary waves-effect" target="blank"><i class="material-icons">print </i> Cetak Pdf</a>

                           
                             <a href="" onclick="self.history.back() " class= "btn btn-success waves-effect"><i class="material-icons">settings_backup_restore </i> Kembali</a>      
