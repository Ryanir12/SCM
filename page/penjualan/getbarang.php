<?php

 $koneksi = new mysqli("localhost","root","","db_supplay");
$barcode= $_POST['barcode'];
$query = $koneksi->query("SELECT * FROM tb_barang WHERE kode_barang='$barcode'");
$data = $query->fetch_assoc();

echo json_encode($data);
?>