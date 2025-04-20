<script>
function sum() {
      var harga_beli = document.getElementById('harga_beli').value;
      var harga_jual = document.getElementById('harga_jual').value;
      var result =parseInt(harga_jual) - parseInt(harga_beli);
      if (!isNaN(result)) {
         document.getElementById('profit').value = result;
      }
}

</script>
<?php 

    $sql = $koneksi->query("select kode_barang from tb_barang order by kode_barang desc");

    $data = $sql->fetch_assoc();

    $kode_barang = $data['kode_barang'];

    $urut = substr($kode_barang, 1, 3);
    $tambah = (int) $urut+1;
    

    if(strlen($tambah) == 1){
      $format="B"."00".$tambah;
    }else if(strlen($tambah) == 2){
      $format="B"."0".$tambah;
    }else{
      $format="B".$tambah;
    }


 ?>



          <!-- Vertical Layout -->
          <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="header">
                          <h2>
                              Tambah Barang
                          </h2>

                      </div>
                      <div class="body">
                          <form method="post">

                            <label for="kode">Kode Barang</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly="" style="background-color: #e7e3e9;" name="kode" value="<?php echo $format ?>" id="kode"  class="form-control"  >
                                </div>
                            </div>

                          


                              <label for="nama">Nama Barang</label>
                              <div class="form-group">
                                  <div class="form-line">
                                      <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Barang" required="">
                                  </div>
                              </div>


                               <label for="alamat">Satuan Barang</label>
                              <div class="form-group">
                                <div class="form-line">
                                    <select name="satuan" class="form-control show-tick"  >
                                        <option value="">-- Pilih Jenis Satuan Barang --</option>
                                        
                                                <?php

                                                   $query = $koneksi->query("SELECT * FROM tb_satuan ORDER by id");
                                                    
                                                    while ($kategori=$query->fetch_assoc()) {
                                                        echo "<option value='$kategori[satuan]'>$kategori[satuan]</option>";
                                                    }
                         
                                                ?>
                                    </select>
                                </div>
                              <br>
                              



                              <label for="beli">Harga Beli</label>
                              <div class="form-group">
                                  <div class="form-line">
                                      <input type="number" name="beli" id="harga_beli" placeholder="Masukan harga beli" onkeyup="sum();" class="form-control" required="">
                                  </div>
                              </div>

                              <label for="jual">Harga Jual</label>
                              <div class="form-group">
                                  <div class="form-line">
                                      <input type="number" name="jual" id="harga_jual" placeholder="Masukan harga jual" onkeyup="sum();" class="form-control" required="">
                                  </div>
                              </div>

                              <label for="profit">Profit</label>
                              <div class="form-group">
                                  <div class="form-line">
                                      <input type="number" name="profit" value="0" readonly="" id="profit" style="background-color: #e7e3e9;" class="form-control" required="">
                                  </div>
                              </div>

                              <div>
                                 <input type="submit" name="simpan" value="Simpan" class="btn btn-primary waves-effect">
                                 <button  onclick="self.history.back() "  style="height:32px; text-align: center; padding-bottom: 12px" class= "btn btn-success waves-effect"> Kembali</button>
                              </div>


                          </form>
                      </div>
                  </div>
              </div>
          </div>


<?php


      if (isset($_POST['simpan'])) {
          $kode = $_POST['kode'];
          
          $nama = $_POST['nama'];
          $satuan = $_POST['satuan'];
          $beli = $_POST['beli'];
          $jual = $_POST['jual'];
          $profit = $_POST['profit'];
         

          $sql = $koneksi->query("insert into tb_barang values('$kode', '$nama','$satuan','$beli', '0', '$jual', '$profit')");

          if ($sql == true) {
              ?>
              <script>
                  alert("Data Barang Berhasil disimpan  <?php echo $kode; ?>");
                  window.location.href="?page=barang";
              </script>

            <?php


          }elseif ($sql == false) {
              
            ?>
              <script>
                  alert("Kode Barang  <?php echo $kode; ?> Sudah ada");
                  window.location.href="?page=barang";
              </script>

            <?php


          }

      }

 ?>
