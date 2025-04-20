<?php

    $page = $_GET['page'];
    $aksi = $_GET['aksi'];

    if ($page == "barang") {
        if ($aksi == "") {
          include "page/barang/barang.php";
        }

         if ($aksi == "tambah") {
          include "page/barang/tambah.php";
        }

        if ($aksi == "ubah") {
          include "page/barang/ubah.php";
        }

         if ($aksi == "hapus") {
          include "page/barang/hapus.php";
        }
         if ($aksi == "detail") {
          include "page/barang/d_barang.php";
        }

    } 

 if ($page == "barangsupp") {
        if ($aksi == "") {
          include "page/barangsupp/barang.php";
        }

         

    } 
if ($page == "history") {
        if ($aksi == "") {
          include "page/history/laporan_beli.php";
        }

        if ($aksi == "cetak") {
          include "page/history/cetak.php";
        }

         

    } 




if ($page == "satuan") {
        if ($aksi == "") {
          include "page/satuan/satuan.php";
        }

         if ($aksi == "tambah") {
          include "page/satuan/tambah.php";
        }

        if ($aksi == "ubah") {
          include "page/satuan/ubah.php";
        }

         if ($aksi == "hapus") {
          include "page/satuan/hapus.php";
        }
        

    } 




if ($page == "analisa") {
        if ($aksi == "") {
          include "page/analisa/analisa.php";
        }

         if ($aksi == "tambah") {
          include "page/analisa/tambah.php";
        }

        if ($aksi == "ubah") {
          include "page/analisa/ubah.php";
        }

         if ($aksi == "hapus") {
          include "page/analisa/hapus.php";
        }
        

    } 









    if ($page == "supplier") {
        if ($aksi == "") {
          include "page/supplier/supplier.php";
        }

         if ($aksi == "tambah") {
          include "page/supplier/tambah.php";
        }

        if ($aksi == "ubah") {
          include "page/supplier/ubah.php";
        }

         if ($aksi == "hapus") {
          include "page/supplier/hapus.php";
        }

    }

     if ($page == "pelanggan") {
        if ($aksi == "") {
          include "page/pelanggan/pelanggan.php";
        }

         if ($aksi == "tambah") {
          include "page/pelanggan/tambah.php";
        }

        if ($aksi == "ubah") {
          include "page/pelanggan/ubah.php";
        }

         if ($aksi == "hapus") {
          include "page/pelanggan/hapus.php";
        }
        if ($aksi == "cetak") {
          include "page/pelanggan/cetak.php";
        }
         if ($aksi == "reset") {
          include "page/pelanggan/reset.php";
        }

    }


     



    if ($page == "pengguna") {
        if ($aksi == "") {
            include "page/pengguna/pengguna.php";
          }

        if ($aksi == "tambah") {
            include "page/pengguna/tambah.php";
          }

        if ($aksi == "ubah") {
          include "page/pengguna/edit.php";
        }

        if ($aksi == "hapus") {
          include "page/pengguna/hapus.php";
        }

        if ($aksi == "blokir") {
          include "page/pengguna/blokir.php";
        }

        if ($aksi == "aktif") {
          include "page/pengguna/aktif.php";
        }

    }if ($page == "penjualan") {
        if ($aksi == "") {
            include "page/penjualan/penjualan.php";
          }

         if ($aksi == "hapus") {
            include "page/penjualan/hapus.php";
          } 

           if ($aksi == "tambah") {
            include "page/penjualan/tambah.php";
          } 

          if ($aksi == "kurang") {
            include "page/penjualan/kurang.php";
          } 

          if ($aksi == "cetak") {
            include "page/penjualan/cetak.php";
          }  
            if ($aksi == "tambahotomatis") {
            include "page/penjualan/tambahotomatis.php";
          }  
    }

    if ($page == "pembelian") {
        if ($aksi == "") {
            include "page/pembelian/pembelian.php";
          }
           if ($aksi == "tambah") {
            include "page/pembelian/tambah.php";
          } 

          if ($aksi == "kurang") {
            include "page/pembelian/kurang.php";
          } 
         if ($aksi == "hapus") {
            include "page/pembelian/hapus.php";
          } 

          if ($aksi == "cetak") {
            include "page/pembelian/cetak.php";
          }  
    }  if ($page == "profile") {
            if ($aksi == "") {
            include "profile.php";
          }if ($aksi == "ubah") {
            include "ubah_password.php";
          }

    }if ($page == "laporan_jual") {
            if ($aksi == "") {
            include "page/laporan/laporan_jual.php";
          }

    }if ($page == "laporan_beli") {
            if ($aksi == "") {
            include "page/laporan/laporan_beli.php";
          }
     }if ($page == "laporan_lr") {
            if ($aksi == "") {
            include "page/laporan/laporan_lr.php";
          }

          } else if ($page == "") {
              include "home.php";
          }            
         


 ?>
