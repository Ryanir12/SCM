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




          <!-- Vertical Layout -->
          <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="header">
                          <h2>
                              Tambah Satuan
                          </h2>

                      </div>
                      <div class="body">
                          <form method="post">

                                                      


                              <label for="nama">Nama Satuan</label>
                              <div class="form-group">
                                  <div class="form-line">
                                      <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Satuan Barang" required="">
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
         
          $nama = $_POST['nama'];
          
         

          $sql = $koneksi->query("insert into tb_satuan values('', '$nama')");

          if ($sql == true) {
              ?>
              <script>
                  alert("Data Satuan Barang Berhasil disimpan  <?php echo $nama; ?>");
                  window.location.href="?page=satuan";
              </script>

            <?php


          }elseif ($sql == false) {
              
            ?>
              <script>
                  alert("ID Satuan Barang  <?php echo $nama; ?> Sudah ada");
                  window.location.href="?page=satuan";
              </script>

            <?php


          }

      }

 ?>
