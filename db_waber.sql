-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Agu 2024 pada 23.48
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_waber`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `profit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barang`, `nama_barang`, `satuan`, `harga_beli`, `stok`, `harga_jual`, `profit`) VALUES
('B001', 'SMART SPINNING BIKE  SEPEDA OLAHRAGA FITNESS SEPEDA BALAP ', 'Unit', 3500000, 7, 3650000, 150000),
('B002', 'SPINNING BIKE SEPEDA FITNESS INDOOR  SEPEDA STATIS', 'Unit', 2000000, 6, 2300000, 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `nama`, `alamat`, `telpon`, `email`, `poin`) VALUES
('P001', 'Umum', '-', '-', '-', 0),
('P002', 'AZ ZAHRA ARIESTA DETI', 'Jalan Khatib (Balanti)', '08xxxxxxxxx', 'azzahradeti@gmail.com', 0),
('P003', 'Apotek Tarandam', 'Jalan Tarandam, Padang Sumatera Barat', '-', '-', 0),
('P004', 'Apotek Medika', 'Jalan Minahasa Tee, Pangkep, Sulawesi Selatan', '08xxxxxxxxx', '-', 0),
('P005', 'Alif Octrio', 'Jalan pegambiran ', '08xxxxxxxxx', 'alif@gmail.com', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id` int(9) NOT NULL,
  `kode_pembelian` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_supp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id`, `kode_pembelian`, `kode_barang`, `jumlah`, `harga`, `total`, `tanggal`, `nama_supp`) VALUES
(119, 'PB-292323', 'B002', 2, 2000000, 4000000, '2024-08-18', 'Yudi Hartono'),
(120, 'PB-34372', 'B002', 10, 2000000, 20000000, '2024-08-18', 'Yudi Hartono');

--
-- Trigger `tb_pembelian`
--
DELIMITER $$
CREATE TRIGGER `beli_barang` AFTER INSERT ON `tb_pembelian` FOR EACH ROW BEGIN
 INSERT INTO tb_barang SET
 kode_barang = NEW.kode_barang, stok=New.jumlah
 ON DUPLICATE KEY UPDATE stok=stok+New.jumlah;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id` int(11) NOT NULL,
  `kode_penjualan` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id`, `kode_penjualan`, `kode_barang`, `jumlah`, `total`, `tanggal_penjualan`, `nama_pembeli`) VALUES
(226, 'PJ-38233326', 'B001', 2, 7300000, '2024-08-18', 'selvi'),
(227, 'PJ-37320', 'B002', 2, 4600000, '2024-08-18', 'wahyu'),
(228, 'PJ-32223232', 'B002', 2, 4600000, '2024-08-18', 'ujang'),
(229, 'PJ-26524323', 'B001', 1, 3650000, '2024-08-18', 'ujang'),
(230, 'PJ-26524323', 'B002', 2, 4600000, '2024-08-18', 'ujang');

--
-- Trigger `tb_penjualan`
--
DELIMITER $$
CREATE TRIGGER `jual_barang` AFTER INSERT ON `tb_penjualan` FOR EACH ROW BEGIN
 UPDATE tb_barang
 SET stok= stok- NEW.jumlah
 WHERE
 kode_barang = NEW.kode_barang;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan_tmp`
--

CREATE TABLE `tb_penjualan_tmp` (
  `kode_penjualan` varchar(50) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_penjualan_tmp`
--

INSERT INTO `tb_penjualan_tmp` (`kode_penjualan`, `bayar`, `kembali`) VALUES
('PJ-800002', 25000, 0),
('PJ-36230', 700000, 51000),
('PJ-80353', 22000, 0),
('PJ-3022032', 675000, 0),
('PJ-50203322', 45000, 4000),
('PJ-23330023', 60000, 2000),
('PJ-3393620', 110000, 4000),
('PJ-33233723', 140000, 0),
('PJ-7220333', 280000, 0),
('PJ-2322800', 290000, 6000),
('PJ-93227', 300000, 50000),
('PJ-232220', 125000, 0),
('PJ-232220', 125000, 0),
('PJ-392220', 500000, 5000),
('PJ-00324020', 310000, 5000),
('PJ-222222', 250000, 25000),
('PJ-3702232', 4800000, 4694000),
('PJ-2328', 20000, 8000),
('PJ-282033', 4000000, 350000),
('PJ-2203229', 4000000, 350000),
('PJ-38233326', 12200000, 4900000),
('PJ-37320', 5000000, 400000),
('PJ-32223232', 5000000, 400000),
('PJ-26524323', 8300000, 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`id`, `satuan`) VALUES
(6, 'Pcs'),
(11, 'Unit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supp` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supp`, `nama`, `alamat`, `telpon`, `email`) VALUES
('S002', 'Yudi Hartono', 'Jakarta Barat', '0871263126', 'totalfitness@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tmp_pembelian`
--

CREATE TABLE `tb_tmp_pembelian` (
  `id` int(11) NOT NULL,
  `kode_pembelian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tmp_penjualan`
--

CREATE TABLE `tb_tmp_penjualan` (
  `id` int(11) NOT NULL,
  `kode_penjualan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `kode_transaksi` varchar(25) NOT NULL,
  `kode_penjualan` varchar(50) NOT NULL,
  `kode_pembelian` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`kode_transaksi`, `kode_penjualan`, `kode_pembelian`, `tanggal`, `total`, `nama`) VALUES
('P001', 'PJ-38233326', '-', '2024-08-18', 7300000, 'selvi'),
('P002', '-', 'PB-292323', '2024-08-18', 4000000, 'Yudi Hartono'),
('P003', '-', 'PB-34372', '2024-08-18', 20000000, 'Yudi Hartono'),
('P004', 'PJ-37320', '-', '2024-08-18', 4600000, 'wahyu'),
('P005', 'PJ-32223232', '-', '2024-08-18', 4600000, 'ujang'),
('P006', 'PJ-26524323', '-', '2024-08-18', 8250000, 'ujang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pass` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `user_id`, `nama`, `email`, `pass`, `level`, `status`, `foto`) VALUES
(3, 'kasir', 'Rima', 'kasir@gmail.com', 'kasir', 'kasir', 'Aktif', '-'),
(2, 'admin', 'Ryan', 'onryanilhamramadhan@gmail.com', 'admin', 'admin', 'Aktif', '-'),
(5, 'pimpinan', 'Didi Waber', 'didiwaber@gmail.com', 'pimpinan', 'pimpinan', 'Aktif', '-'),
(11, 'totalfitness', 'Yudi Hartono', 'totalfitness@gmail.com', '12345', 'supplier', 'Aktif', '-');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supp`);

--
-- Indeks untuk tabel `tb_tmp_pembelian`
--
ALTER TABLE `tb_tmp_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tmp_penjualan`
--
ALTER TABLE `tb_tmp_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
