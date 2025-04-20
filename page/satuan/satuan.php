<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Satuan
                </h2>

            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th width="5%">No</th>



                            <th>Satuan </th>

                            <th width="40%">Aksi</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("select * from tb_satuan");
                        while ($tampil = $sql->fetch_assoc()) {


                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>


                                <td><?php echo $tampil['satuan'] ?> </td>

                                <td>

                                    <a onclick="return confirm('Yakin Akan Menghapus Data ini...???') " href="?page=satuan&aksi=hapus&id=<?php echo $tampil['id']; ?>" class="btn btn-danger waves-effect"><i class="material-icons">delete </i> Hapus</a>

                                    <a href="?page=satuan&aksi=ubah&id=<?php echo $tampil['id']; ?>" class="btn btn-success waves-effect"><i class="material-icons">mode_edit </i> Edit</a>


                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <a href="?page=satuan&aksi=tambah" class="btn btn-success waves-effect"><i class="material-icons">enhanced_encryption </i> Tambah</a>

                <a href="" onclick="self.history.back() " class="btn btn-info waves-effect"><i class="material-icons">settings_backup_restore </i> Kembali</a>