<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Pembelian
                </h2>

            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pembelian</th>
                            <th>Tanggal Transaksi</th>
                            <th>Barang Pembelian</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th width="10%">Cetak</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $pengeluaran = 0;
                        $sql1 = $koneksi->query("SELECT * FROM tb_transaksi WHERE kode_penjualan='-'");

                        while ($tampil1 = $sql1->fetch_assoc()) {
                            $kode = $tampil1['kode_pembelian'];
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $tampil1['kode_pembelian']; ?></td>
                                <td><?php echo date('d F Y', strtotime($tampil1['tanggal'])); ?></td>

                                <?php
                                // Variabel untuk menampung data
                                $barang = '';
                                $harga = '';
                                $jumlah = '';
                                $total_sub = 0;

                                // Mengambil data barang
                                $queryListBarang = mysqli_query($koneksi, "SELECT * FROM tb_pembelian WHERE kode_pembelian='$kode'");
                                while ($dataLB = mysqli_fetch_array($queryListBarang)) {
                                    $kode_barang = $dataLB['kode_barang'];
                                    $sql2 = $koneksi->query("SELECT * FROM tb_barang WHERE kode_barang='$kode_barang'");
                                    $tampil2 = $sql2->fetch_assoc();

                                    // Menyusun data untuk setiap barang
                                    $barang .= $tampil2['nama_barang'] . "<br>";
                                    $harga .= "Rp. " . number_format($tampil2['harga_beli']) . "<br>";
                                    $jumlah .= $dataLB['jumlah'] . "<br>";
                                    $total_sub += $dataLB['total'];
                                }
                                ?>

                                <td><?php echo $barang; ?></td>
                                <td><?php echo $harga; ?></td>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo "Rp. " . number_format($tampil1['total']); ?></td>
                                <td>
                                    <a href="page/pembelian/invoice.php?kode=<?php echo $kode; ?>&iduser=<?php echo $data_u['id']; ?>" target="blank" class="btn btn-warning waves-effect"><i class="material-icons">print </i>Cetak Invoice</a>
                                </td>
                            </tr>
                        <?php
                            $pengeluaran += $tampil1['total'];
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align: center; font-size: 17px;" colspan="7">Total ReStok</th>
                            <td align="left" colspan="2" style="font-size: 15px;"><b><?php echo "Rp. " . number_format($pengeluaran); ?></b></td>
                        </tr>
                    </tfoot>
                </table>



                <a href="" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#smallModal" target="blank"><i class="material-icons">print </i> Laporan Harian</a>

                <a href="" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#smallModal2" target="blank"><i class="material-icons">print </i> Laporan Bulanan</a>

                <a href="" class="btn btn-warning waves-effect" data-toggle="modal" data-target="#smallModal3" target="blank"><i class="material-icons">print </i> Laporan Tahunan</a>


                <a href="./laporan/pembelian/lap_pembelian_pdf.php" class="btn btn-warning waves-effect" target="blank" style="margin-top: px; margin-left: 5px;"><i class="material-icons">print</i> Cetak Semua</a>

                <a href="" onclick="self.history.back() " class="btn btn-info waves-effect"><i class="material-icons">settings_backup_restore </i> Kembali</a>



                <?php
                if ($_SESSION['admin']) {
                    $user_l = $_SESSION['admin'];
                } else if ($_SESSION['kasir']) {
                    $user_l = $_SESSION['kasir'];
                } else if ($_SESSION['pimpinan']) {
                    $user_l = $_SESSION['pimpinan'];
                } else if ($_SESSION['gudang']) {
                    $user_l = $_SESSION['gudang'];
                }

                $sql_u = $koneksi->query("select* from tb_user where id='$user_l'");
                $data_u = $sql_u->fetch_assoc();

                $nama_user = $data_u['nama'];

                ?>



                <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="smallModalLabel">Laporan ReStok Barang</h4>
                            </div>


                            <div class="modal-body">

                                <form role="form" method="POST" action="laporan/pembelian/pembelian_harian.php" target="blank">



                                    <label for="nama">Tanggal</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" name="tgl1" class="form-control" placeholder="Tanggal Awal" required="">
                                        </div>
                                    </div>



                                    <input type="hidden" name="nama" value="<?php echo $nama_user; ?>" class="form-control" placeholder="Penanggung Jawab" required="">


                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="cetak" class="btn btn-primary waves-effect" style="margin-top: px;"><i class="material-icons">print </i> Cetak</button>



                            </div>
                        </div>
                        </form>
                    </div>
                </div>


                <div class="modal fade" id="smallModal2" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="smallModalLabel">Laporan ReStok Barang</h4>
                            </div>


                            <div class="modal-body">

                                <form role="form" method="POST" action="laporan/pembelian/pembelian_bulanan.php" target="blank">


                                    <label for="bulan">Periode Bulan</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select name="bulan" class="form-control show-tick " required="required">
                                                <option value="">Pilih Bulan</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>


                                            </select>
                                        </div>
                                    </div>

                                    <label for="tahun">Periode Tahun</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="tahun" class="form-control" placeholder="Periode Tahun" required="">

                                        </div>
                                    </div>



                                    <input type="hidden" name="nama" value="<?php echo $nama_user; ?>" class="form-control" placeholder="Penanggung Jawab" required="">


                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="cetak" class="btn btn-success waves-effect" style="margin-top: px;"><i class="material-icons">print </i> Cetak</button>



                            </div>
                        </div>
                        </form>
                    </div>
                </div>


                <div class="modal fade" id="smallModal3" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="smallModalLabel">Laporan ReStok Tahunan</h4>
                            </div>


                            <div class="modal-body">

                                <form role="form" method="POST" action="laporan/pembelian/pembelian_tahunan.php" target="blank">

                                    <label for="nama"> Tahun </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" name="tahun" class="form-control" placeholder="Masukan Tahun" required="">
                                        </div>
                                    </div>


                                    <input type="hidden" name="nama" value="<?php echo $nama_user; ?>" class="form-control" placeholder="Penanggung Jawab" required="">


                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="cetak" class="btn btn-success waves-effect" style="margin-top: px;"><i class="material-icons">print </i> Cetak</button>



                            </div>
                        </div>
                        </form>
                    </div>
                </div>