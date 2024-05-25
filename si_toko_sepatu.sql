-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Bulan Mei 2024 pada 15.50
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_toko_sepatu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `ID_BARANG` int(11) NOT NULL,
  `NAMA_BARANG` varchar(20) NOT NULL,
  `HARGA` int(11) NOT NULL,
  `STOK` int(11) NOT NULL,
  `ID_SUPLIER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `NAMA_BARANG`, `HARGA`, `STOK`, `ID_SUPLIER`) VALUES
(1, 'Sepatu Air Jordan', 2000000, 10, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID_PEMBAYARAN` int(11) NOT NULL,
  `TOTAL_BAYAR` int(11) NOT NULL,
  `KEMBALIAN` int(11) NOT NULL,
  `ID_TRANSAKSI` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`ID_PEMBAYARAN`, `TOTAL_BAYAR`, `KEMBALIAN`, `ID_TRANSAKSI`, `created_at`, `updated_at`) VALUES
(2, 2500000, 500000, 1, '2024-05-24 14:56:32', '2024-05-24 14:56:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `ID_PEMBELI` int(11) NOT NULL,
  `NAMA_PEMBELI` varchar(30) NOT NULL,
  `JK` enum('laki-laki','perempuan') NOT NULL,
  `NO_TLP` char(12) NOT NULL,
  `ALAMAT` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`ID_PEMBELI`, `NAMA_PEMBELI`, `JK`, `NO_TLP`, `ALAMAT`) VALUES
(2, 'Tono', 'laki-laki', '08126548927', 'Malang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `ID_PENGGUNA` int(11) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `NAMA` varchar(255) NOT NULL,
  `ALAMAT` varchar(255) NOT NULL,
  `NO_TELP` varchar(255) NOT NULL,
  `ROLE` enum('kasir','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`ID_PENGGUNA`, `EMAIL`, `USERNAME`, `PASSWORD`, `NAMA`, `ALAMAT`, `NO_TELP`, `ROLE`) VALUES
(1, 'admin@mail.com', 'admin', '$2y$10$DgNKD6KOa8qXsnqlHZOZ3eLMfWzKMYnHcRVM5J5V8XSrUe4iivC8K', 'Rudi', 'Malang', '08673822121212', 'admin'),
(2, 'kasir@mail.com', 'kasir', '$2y$10$DgNKD6KOa8qXsnqlHZOZ3eLMfWzKMYnHcRVM5J5V8XSrUe4iivC8K', 'Reyhan', 'Malang', '086738264472', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplier`
--

CREATE TABLE `suplier` (
  `ID_SUPLIER` int(11) NOT NULL,
  `NAMA_SUPLIER` varchar(30) NOT NULL,
  `NO_TLP` char(12) NOT NULL,
  `ALAMAT` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suplier`
--

INSERT INTO `suplier` (`ID_SUPLIER`, `NAMA_SUPLIER`, `NO_TLP`, `ALAMAT`) VALUES
(1, 'PT BRSHOES', '019275237892', 'Kab. Mojokerto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_TRANSAKSI` int(11) NOT NULL,
  `ID_BARANG` int(11) NOT NULL,
  `ID_PEMBELI` int(11) NOT NULL,
  `ID_PENGGUNA` int(11) NOT NULL,
  `KETERANGAN` varchar(100) NOT NULL,
  `STATUS` enum('belum_bayar','sudah_bayar') NOT NULL DEFAULT 'belum_bayar',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`ID_TRANSAKSI`, `ID_BARANG`, `ID_PEMBELI`, `ID_PENGGUNA`, `KETERANGAN`, `STATUS`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'warna gold', 'sudah_bayar', '2024-05-24 14:14:47', '2024-05-24 14:56:32');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`),
  ADD KEY `ID_SUPLIER` (`ID_SUPLIER`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_PEMBAYARAN`),
  ADD KEY `ID_TRANSAKSI` (`ID_TRANSAKSI`);

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`ID_PEMBELI`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`ID_PENGGUNA`);

--
-- Indeks untuk tabel `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`ID_SUPLIER`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_TRANSAKSI`),
  ADD KEY `ID_BARANG` (`ID_BARANG`),
  ADD KEY `ID_PEMBELI` (`ID_PEMBELI`),
  ADD KEY `ID_PENGGUNA` (`ID_PENGGUNA`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `ID_BARANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `ID_PEMBAYARAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `ID_PEMBELI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `ID_PENGGUNA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `suplier`
--
ALTER TABLE `suplier`
  MODIFY `ID_SUPLIER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_TRANSAKSI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`ID_SUPLIER`) REFERENCES `suplier` (`ID_SUPLIER`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`ID_TRANSAKSI`) REFERENCES `transaksi` (`ID_TRANSAKSI`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`ID_PEMBELI`) REFERENCES `pembeli` (`ID_PEMBELI`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`ID_PENGGUNA`) REFERENCES `pengguna` (`ID_PENGGUNA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
