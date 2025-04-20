<?php 

		$id = $_GET['id'];

		$sql = $koneksi->query("delete from tb_satuan where id='$id'");

		if ($sql) {

            ?>
              <script>
                  alert("Data Berhasil dihapus  <?php echo $id; ?>");
                  window.location.href="?page=satuan";
              </script>

            <?php
          }

 ?>