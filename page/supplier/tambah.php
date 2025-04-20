<?php 

		$sql = $koneksi->query("select id_supp from tb_supplier order by id_supp desc");

		$data = $sql->fetch_assoc();

		$id_supp = $data['id_supp'];

		$urut = substr($id_supp, 1, 3);
		$tambah = (int) $urut+1;
		

		if(strlen($tambah) == 1){
			$format="S"."00".$tambah;
		}else if(strlen($tambah) == 2){
			$format="S"."0".$tambah;
		}else{
			$format="S".$tambah;
		}


 ?>

 <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="header">
                          <h2>
                              Tambah Supplier
                          </h2>

                      </div>
                      <div class="body">
                          <form method="post">

                            <label for="kode">Kode Supplier</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="kode" id="kode" style="background-color: #e7e3e9;"  value="<?php echo $format ?>" class="form-control"  >
                                </div>
                            </div>


                             <label for="kode">Nama Supplier</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="nama" id="kode"  required=""  class="form-control"  >
                                </div>
                            </div>


                             <label for="kode">Alamat</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="alamat" id="kode"   required="" class="form-control"  >
                                </div>
                            </div>


                             <label for="kode">Telpon</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="telpon" id="kode"   required="" class="form-control"  >
                                </div>
                            </div>


                             <label for="kode">Email</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" name="email" id="kode"  class="form-control"  >
                                </div>
                            </div>



                             <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
			                <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
                        </form>



<?php 

	if (isset($_POST['simpan'])) {
		
		$kode = $_POST['kode'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$telpon = $_POST['telpon'];
		$email = $_POST['email'];
		


		$simpan = $koneksi->query("insert into tb_supplier (id_supp, nama, alamat, telpon, email)
									values('$kode', '$nama', '$alamat', '$telpon', '$email')");


       $simpan = $koneksi->query("insert into tb_user(user_id, nama, email, pass, level, status, foto) values('', '$nama', '$email', '', 'supplier', 'Aktif', '')");

      


		if ($simpan) {
			 ?>
              <script>
                  alert("Data Supplier Berhasil disimpan  <?php echo $kode; ?>");
                  window.location.href="?page=supplier";
              </script>

            <?php
		}

	}

 ?>

