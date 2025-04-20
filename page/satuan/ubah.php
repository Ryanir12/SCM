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

		$id = $_GET ['id'];

		$sql2 = $koneksi->query("select * from tb_satuan where id = '$id'");

		$data = $sql2->fetch_assoc();

		


 ?>


          <!-- Vertical Layout -->
          <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="header">
                          <h2>
                              Ubah Data Satuan
                          </h2>

                      </div>
                      <div class="body">
                          <form method="post">

                            <label for="kode">ID Satuan Barang</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" readonly="" style="background-color: #e7e3e9;" name="id" id="id"  value="<?php echo $data ['id']; ?>" class="form-control"  >
                                </div>
                            </div>

                            

                              <label for="nama">Nama Satuan Barang</label>
                              <div class="form-group">
                                  <div class="form-line">
                                      <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data ['satuan']; ?>" >
                                  </div>
                              </div>


          
                              <div>
                                 <input type="submit" name="simpan" value="Simpan" class="btn btn-primary m-t-15 waves-effect">
                                 
                                 
                              </div>


                          </form>
                      </div>
                  </div>
              </div>
          </div>


<?php


      if (isset($_POST['simpan'])) {
          $id2 = $_POST['id'];
          $nama = $_POST['nama'];
         

          $sql = $koneksi->query("update  tb_satuan set satuan='$nama' where id='$id2'");

          if ($sql) {

            ?>
              <script>
                  alert("Data Satuan Barang Berhasil diubah  <?php echo $nama; ?>");
                  window.location.href="?page=satuan";
              </script>

            <?php
          }

      }

 ?>
