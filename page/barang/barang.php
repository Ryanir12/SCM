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
                            <th>Satuan</th>
                            <th>Keterangan</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Profit</th>
                            <th width="18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("SELECT * FROM tb_barang");
                        while ($tampil = $sql->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $tampil['kode_barang']; ?></td>
                                <td><?php echo $tampil['nama_barang']; ?></td>
                                <td>
                                    <?php
                                    $stok = $tampil['stok'];

                                    if (($stok <= 10) && ($stok >= 1)) {
                                        echo "<b><font color='orange'>$stok</font></b>";
                                    } elseif ($stok > 10) {
                                        echo "<b><font color='green'>$stok</font></b>";
                                    } elseif ($stok <= 0) {
                                        echo "<b><font color='red'>$stok</font></b>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $tampil['satuan']; ?></td>
                                <td>
                                    <?php
                                    $stok = $tampil['stok'];

                                    if (($stok <= 10) && ($stok >= 1)) {
                                        echo "<b><font color='orange'>Stok Menipis</font></b>";
                                    } elseif ($stok > 10) {
                                        echo "<b><font color='green'>Persediaan Cukup</font></b>";
                                    } elseif ($stok <= 0) {
                                        echo "<b><font color='red'>Stok Habis</font></b>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo "Rp." . number_format($tampil['harga_beli']); ?>,-</td>
                                <td><?php echo "Rp." . number_format($tampil['harga_jual']); ?>,-</td>
                                <td><?php echo "Rp." . number_format($tampil['profit']); ?>,-</td>
                                <td>
                                    <a onclick="return confirm('Yakin Akan Menghapus Data ini?')" href="?page=barang&aksi=hapus&id=<?php echo $tampil['kode_barang']; ?>" class="btn btn-danger waves-effect">
                                        <i class="material-icons">delete</i> Hapus
                                    </a>
                                    <a href="?page=barang&aksi=ubah&id=<?php echo $tampil['kode_barang']; ?>" class="btn btn-info waves-effect">
                                        <i class="material-icons">mode_edit</i> Edit
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


                <a href="?page=barang&aksi=tambah" class="btn btn-success waves-effect"><i class="material-icons">enhanced_encryption </i> Tambah</a>

                <a href="page/barang/cetakbarang.php?kode=<?php echo $kode_barang; ?>&iduser=<?php echo $data_u['id']; ?>"" class= " btn btn-warning waves-effect" target="blank"><i class="material-icons">print </i> Cetak Pdf</a>


                <a href="" onclick="self.history.back() " class="btn btn-info waves-effect"><i class="material-icons">settings_backup_restore </i> Kembali</a>