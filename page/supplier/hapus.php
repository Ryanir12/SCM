<?php 

	$id= $_GET['id'];

	$sql = $koneksi->query("delete from tb_supplier where id_supp='$id'");

	
if ($sql) {

            ?>
              <script>
                  alert("Data Berhasil dihapus  ");
                  window.location.href="?page=supplier";
              </script>

            <?php
          }


 ?>