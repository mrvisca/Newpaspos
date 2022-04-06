-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2021 pada 03.20
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paspos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `branch`
--

CREATE TABLE `branch` (
  `id` int(100) NOT NULL,
  `id_brand` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nowa` bigint(100) NOT NULL COMMENT 'ex: 6281xxxxxx',
  `provinsi` varchar(100) NOT NULL,
  `kota` int(100) NOT NULL,
  `btn1` int(3) NOT NULL DEFAULT 1 COMMENT '1=Mengaktifkan tombol bayar dan selesai, 0=Nonaktif tombol',
  `btn2` int(3) NOT NULL DEFAULT 1 COMMENT '1=Mengaktifkan tombol bayar, 0=Nonaktif tombol',
  `btn3` int(3) NOT NULL DEFAULT 1 COMMENT '1=Mengaktifkan tombol pesan, 0=Nonaktif tombol',
  `presentase` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand`
--

CREATE TABLE `brand` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `maxbranch` int(100) NOT NULL DEFAULT 1,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nohp` bigint(25) NOT NULL,
  `paket` varchar(100) NOT NULL DEFAULT 'platinum',
  `masa_aktif` date NOT NULL DEFAULT '2112-07-22',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `Provinsi` varchar(100) NOT NULL,
  `Kota` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `verifikasi` int(11) NOT NULL DEFAULT 0,
  `trial` int(11) NOT NULL DEFAULT 1 COMMENT '1:trial; 0:paid;',
  `referal_id` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `brand`
--

INSERT INTO `brand` (`id`, `nama`, `maxbranch`, `user`, `pass`, `nohp`, `paket`, `masa_aktif`, `created_at`, `Provinsi`, `Kota`, `email`, `verifikasi`, `trial`, `referal_id`) VALUES
(1, 'Visca Corporation', 10, 'mrvisca', '$2y$10$ulQT9rOomPXx/CYieaVD2.3BW.LC6GxRz0fLfoTyP/MIr6.8.PD3K', 6282140466335, 'platinum', '2112-07-22', '2021-12-09 10:02:01', 'DKI Jakarta', 'Jakarta Utara', 'bimasaktiputra95@gmail.com', 0, 0, ''),
(2, 'Sippo Sapi Group', 10, 'sipposapi', '$2y$10$6MPQ7aABxGmXCFkL/ktF0Or.OA8ByYWJsxOzyWO9FYKn1PrhsuyhW', 85682766255524, 'platinum', '2112-07-22', '2021-12-09 10:07:23', 'Nusa Tenggara Barat', 'Dompu', 'sipposapi@mail.com', 0, 1, ''),
(3, 'Dodo Kencana Group', 10, 'dodosapi', '$2y$10$sE5wGwdhCD8eCmqRX40qfu3alXXhsaZ7Dk9yKOildzfbsYux34352', 6282140466335, 'platinum', '2112-07-22', '2021-12-09 10:07:23', 'DKI Jakarta', 'Jakarta Utara', 'dodogrup@mail.com', 0, 2, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_stock`
--

CREATE TABLE `daftar_stock` (
  `id` bigint(255) NOT NULL,
  `id_brand` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `employee`
--

CREATE TABLE `employee` (
  `id` bigint(255) NOT NULL,
  `id_brand` int(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `id_branch` varchar(100) NOT NULL,
  `fea_kasir` int(10) NOT NULL DEFAULT 0 COMMENT '0 (dis) atau 1 (en)',
  `fea_menu` int(10) NOT NULL DEFAULT 0 COMMENT '0 (dis) atau 1 (en)',
  `fea_pegawai` int(10) NOT NULL DEFAULT 0 COMMENT '0 (dis) atau 1 (en)',
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fitur`
--

CREATE TABLE `fitur` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `parent` varchar(100) NOT NULL,
  `kode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fitur_akses`
--

CREATE TABLE `fitur_akses` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_fitur` int(11) NOT NULL,
  `id_branch` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(100) NOT NULL,
  `id_item` int(100) NOT NULL,
  `id_daftar_stock` int(100) NOT NULL,
  `jumlah` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `id` bigint(200) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `harga_beli` int(100) NOT NULL DEFAULT 0,
  `deskripsi` text NOT NULL,
  `id_stock` varchar(100) NOT NULL,
  `need_stock` varchar(100) NOT NULL,
  `id_branch` int(100) NOT NULL COMMENT '0 = semua',
  `id_brand` int(100) NOT NULL,
  `id_katagori` int(100) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_branch`
--

CREATE TABLE `item_branch` (
  `id` int(100) NOT NULL,
  `id_item` int(100) NOT NULL,
  `id_branch` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `id` int(11) NOT NULL,
  `id_pegawai` bigint(30) NOT NULL,
  `shift` int(11) NOT NULL,
  `awal` time NOT NULL,
  `akhir` time NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_branch` int(11) NOT NULL,
  `id_rek_pembayaran` int(11) NOT NULL,
  `saldo` bigint(20) NOT NULL,
  `saldo_akhir` bigint(20) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status_kasir` int(3) NOT NULL COMMENT '1=sedang bertugas, 0=selesai tugas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `katagori`
--

CREATE TABLE `katagori` (
  `id` bigint(100) NOT NULL,
  `id_brand` bigint(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `katagori_transaksi`
--

CREATE TABLE `katagori_transaksi` (
  `id` int(100) NOT NULL,
  `id_brand` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL COMMENT '1: operasional, 2:non operasional'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nohp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_brand` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint(255) NOT NULL,
  `id_item` int(100) NOT NULL,
  `tanggal` datetime NOT NULL COMMENT 'nanti dihapus',
  `katagori` varchar(100) NOT NULL COMMENT 'nanti dihapus',
  `harga_satuan` int(100) NOT NULL,
  `jml_beli` int(100) NOT NULL,
  `total` int(100) NOT NULL COMMENT 'nanti dihapus',
  `id_pelanggan` int(100) NOT NULL,
  `id_branch` int(100) NOT NULL,
  `id_brand` int(100) NOT NULL,
  `nama_item` text NOT NULL COMMENT 'Ketika menu yang berkaitan dihapus, data ini tidak akan terhapus',
  `id_katagori` int(100) NOT NULL,
  `id_pesanan` int(100) NOT NULL,
  `pelayanan` int(10) NOT NULL DEFAULT 0 COMMENT '0: blm, 1:sudah',
  `harga_beli` bigint(100) NOT NULL DEFAULT 0,
  `kasir` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(100) NOT NULL,
  `tanggal` datetime NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `diskon` int(100) NOT NULL COMMENT 'persen',
  `potongan` int(100) NOT NULL,
  `pajak` int(100) NOT NULL COMMENT 'persen',
  `status` int(10) NOT NULL COMMENT '1: lunas, 0: blm',
  `id_brand` int(100) NOT NULL,
  `id_branch` int(100) NOT NULL,
  `id_pelanggan` varchar(150) NOT NULL,
  `pelayanan` int(100) NOT NULL DEFAULT 0 COMMENT '0: blm dilayani, 1: sudah dilayani',
  `no_order` int(100) NOT NULL,
  `catatan` text NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pembulatan` int(100) NOT NULL DEFAULT 0 COMMENT 'setelah lunas, ini baru ada nilainya',
  `dibayarkan` int(100) NOT NULL,
  `id_rek_pembayaran` int(100) NOT NULL,
  `deskripsi_ekstra` text NOT NULL,
  `nominal_ekstra` int(100) NOT NULL,
  `hpp` int(100) NOT NULL DEFAULT 0,
  `kasir` varchar(50) NOT NULL,
  `telepon` bigint(20) NOT NULL DEFAULT 0 COMMENT 'untuk pemesanan online',
  `id_meja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_shift` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_presensi` time NOT NULL,
  `batas_presensi` time NOT NULL,
  `status_kehadiran` varchar(100) NOT NULL COMMENT 'Presensi, Alpha, Izin',
  `toleransi` int(3) NOT NULL DEFAULT 0,
  `id_brand` int(11) NOT NULL,
  `id_branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rek_pembayaran`
--

CREATE TABLE `rek_pembayaran` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_branch` int(100) NOT NULL DEFAULT -1 COMMENT '-1 = semua',
  `id_brand` int(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE `reservasi` (
  `id` int(11) NOT NULL,
  `meja` varchar(200) NOT NULL,
  `kapasitas` int(11) NOT NULL DEFAULT 0,
  `id_brand` int(11) NOT NULL,
  `status_reservasi` int(3) NOT NULL DEFAULT 1 COMMENT 'jika 1=tersedia, jika 0=sudah tidak tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_kasir`
--

CREATE TABLE `setting_kasir` (
  `id` int(11) NOT NULL,
  `service_charge` int(11) NOT NULL DEFAULT 0,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `pajak` int(11) NOT NULL DEFAULT 0,
  `id_branch` int(11) NOT NULL DEFAULT 0,
  `id_brand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `shift_pegawai`
--

CREATE TABLE `shift_pegawai` (
  `id` int(11) NOT NULL,
  `shift` varchar(150) NOT NULL,
  `start_shift` time NOT NULL,
  `end_shift` time NOT NULL,
  `awal_presensi` time NOT NULL,
  `akhir_presensi` time NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_branch` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumin`
--

CREATE TABLE `sumin` (
  `id` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `sandi` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sumin`
--

INSERT INTO `sumin` (`id`, `id_brand`, `sandi`, `tanggal`) VALUES
(0, 1, 'newpaspos', '2021-12-09 09:12:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(100) NOT NULL,
  `id_branch` int(100) NOT NULL,
  `id_brand` int(100) NOT NULL,
  `id_katagori_transaksi` int(100) NOT NULL,
  `id_rek_pembayaran` int(100) NOT NULL,
  `debit` decimal(65,2) NOT NULL DEFAULT 0.00,
  `kredit` decimal(65,2) NOT NULL DEFAULT 0.00,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `update_stock`
--

CREATE TABLE `update_stock` (
  `id` int(100) NOT NULL,
  `tanggal` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `jumlah` bigint(20) NOT NULL,
  `ket` text NOT NULL,
  `id_daftar_stock` int(100) NOT NULL,
  `id_branch` int(100) NOT NULL,
  `id_employee` bigint(100) NOT NULL DEFAULT 0,
  `id_item` int(150) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `webconfig`
--

CREATE TABLE `webconfig` (
  `id` int(100) NOT NULL,
  `id_brand` int(100) NOT NULL,
  `namaweb` varchar(100) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `masa_aktif` date NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Indeks untuk tabel `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftar_stock`
--
ALTER TABLE `daftar_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_branch` (`id_branch`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Indeks untuk tabel `fitur`
--
ALTER TABLE `fitur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fitur_akses`
--
ALTER TABLE `fitur_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_branch` (`id_branch`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `id_katagori` (`id_katagori`);

--
-- Indeks untuk tabel `item_branch`
--
ALTER TABLE `item_branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_branch` (`id_branch`);

--
-- Indeks untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `katagori`
--
ALTER TABLE `katagori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `branch` (`branch`);

--
-- Indeks untuk tabel `katagori_transaksi`
--
ALTER TABLE `katagori_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_branch` (`id_branch`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `id_katagori` (`id_katagori`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `id_branch` (`id_branch`),
  ADD KEY `id_rek_pembayaran` (`id_rek_pembayaran`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rek_pembayaran`
--
ALTER TABLE `rek_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `setting_kasir`
--
ALTER TABLE `setting_kasir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `shift_pegawai`
--
ALTER TABLE `shift_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sumin`
--
ALTER TABLE `sumin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_branch` (`id_branch`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `id_katagori_transaksi` (`id_katagori_transaksi`),
  ADD KEY `id_rek_pembayaran` (`id_rek_pembayaran`);

--
-- Indeks untuk tabel `update_stock`
--
ALTER TABLE `update_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `webconfig`
--
ALTER TABLE `webconfig`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `daftar_stock`
--
ALTER TABLE `daftar_stock`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fitur`
--
ALTER TABLE `fitur`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fitur_akses`
--
ALTER TABLE `fitur_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `item`
--
ALTER TABLE `item`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `item_branch`
--
ALTER TABLE `item_branch`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `katagori`
--
ALTER TABLE `katagori`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `katagori_transaksi`
--
ALTER TABLE `katagori_transaksi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rek_pembayaran`
--
ALTER TABLE `rek_pembayaran`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
