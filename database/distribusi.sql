-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Mar 2019 pada 22.48
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `distribusi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `courier`
--

CREATE TABLE IF NOT EXISTS `courier` (
  `no_peg` int(20) NOT NULL,
  `nm_courier` varchar(30) NOT NULL,
  `crew` varchar(5) NOT NULL,
  `telp_cour` varchar(12) NOT NULL,
  `alamat_cour` varchar(200) NOT NULL,
  `reg_date` date NOT NULL,
  PRIMARY KEY (`no_peg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `courier`
--

INSERT INTO `courier` (`no_peg`, `nm_courier`, `crew`, `telp_cour`, `alamat_cour`, `reg_date`) VALUES
(180878, 'Budi surjono', 'D', '087837524288', 'Tangerag--Banten', '2018-04-07'),
(1907098, 'Indra', 'C', '087687579656', 'Tangerang banten', '2018-04-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dest_plant`
--

CREATE TABLE IF NOT EXISTS `dest_plant` (
  `whn_dest` varchar(11) NOT NULL,
  `nm_dest_plant` varchar(20) NOT NULL,
  `telp_dest` varchar(12) NOT NULL,
  `alamat_dest` varchar(200) NOT NULL,
  PRIMARY KEY (`whn_dest`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dest_plant`
--

INSERT INTO `dest_plant` (`whn_dest`, `nm_dest_plant`, `telp_dest`, `alamat_dest`) VALUES
('CGK2', 'Terminal 2', '0215502012', 'Internasional Airport Cengkareng'),
('CGK3', 'Terminal 3 Ultimate', '0215502344', 'Jakarta'),
('GH2', 'Hanggar 23', '0218631987', 'Soekarno hatta cengkareng');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_material`
--

CREATE TABLE IF NOT EXISTS `detail_material` (
  `no_dn` varchar(20) NOT NULL,
  `pn` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  KEY `no_dn` (`no_dn`),
  KEY `pn` (`pn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_material`
--

INSERT INTO `detail_material` (`no_dn`, `pn`, `jumlah`) VALUES
('81632387', '2980332100100', 1),
('81632305', '9EL402512', 1),
('81632305', '3289562-5', 1),
('81632354', '2758', 1),
('89876456', '9EL402512', 1),
('89876456', '2980332100100', 2),
('81584560', 'DR32221T', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_status`
--

CREATE TABLE IF NOT EXISTS `detail_status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `no_dn` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `time_stat` datetime NOT NULL,
  PRIMARY KEY (`id_status`),
  KEY `no_dn` (`no_dn`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `detail_status`
--

INSERT INTO `detail_status` (`id_status`, `no_dn`, `id`, `status`, `ket`, `time_stat`) VALUES
(6, '81632387', 2, 'In Transit', 'Packing material', '2018-08-23 22:39:06'),
(7, '81632387', 2, 'Shipment', 'on the way', '2018-08-23 22:46:13'),
(8, '81632305', 2, 'Shipment', 'dikirm', '2018-08-23 22:46:43'),
(9, '81632354', 2, 'Shipment', 'on proses', '2018-08-29 20:41:44'),
(10, '81584560', 2, 'Shipment', 'dikirim', '2018-10-13 13:22:14'),
(11, '81584560', 2, 'In Transit', 'dalam proses', '2018-10-20 18:55:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribusi`
--

CREATE TABLE IF NOT EXISTS `distribusi` (
  `no_dn` varchar(20) NOT NULL,
  `whn_org` varchar(11) NOT NULL,
  `whn_dest` varchar(11) NOT NULL,
  `datetime_ship` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `order_prio` varchar(20) NOT NULL,
  `no_peg` int(20) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`no_dn`),
  KEY `whn_org` (`whn_org`),
  KEY `whn_dest` (`whn_dest`),
  KEY `id` (`id`),
  KEY `no_peg` (`no_peg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `distribusi`
--

INSERT INTO `distribusi` (`no_dn`, `whn_org`, `whn_dest`, `datetime_ship`, `status`, `id`, `remarks`, `order_prio`, `no_peg`, `total`) VALUES
('81584560', 'GDC', 'GH2', '2018-10-13 13:18:40', 'Delivered', 2, 'prepare', 'AOG', 1907098, 7),
('81632305', 'GDC', 'CGK3', '2018-08-23 22:39:15', 'Delivered', 2, 'perepare', 'IOR', 180878, 2),
('81632354', 'GDC', 'CGK3', '2018-08-29 20:40:16', 'Delivered', 2, 'send', 'IOR', 1907098, 1),
('81632387', 'GDC', 'GH2', '2018-08-23 22:37:05', 'Delivered', 2, 'prepare to plant', 'AOG', 1907098, 1),
('89876456', 'GH2', 'CGK3', '2018-08-30 19:23:44', 'Intransit', 2, 'packing', 'AOG', 1907098, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `pn` varchar(50) NOT NULL,
  `nm_part` varchar(100) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`pn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `material`
--

INSERT INTO `material` (`pn`, `nm_part`, `sn`, `jenis`, `batch`) VALUES
('17BCM6920-ALTS', 'FIRE GLOVES', '', 'exp', 989787),
('2758', 'BATTERY', 'C07129', 'Big Part', 199789),
('2980332100100', 'FAUCET ASSY', '', 'exp', 1897678),
('3289562-5', 'PRECOOLER CONTROL', '12503', 'Big Part', 127868),
('441921-4', 'FUEL CONTROL UNIT', 'CUC1I654', 'Big Part', 675678),
('9EL402512', 'LENS', '', 'exp', 177899),
('BAC3048', 'Packing', '', 'exp', 111345),
('DR32221T', 'TIRE MAIN WHEEL ATR', '', 'Big Part', 1786533);

-- --------------------------------------------------------

--
-- Struktur dari tabel `origin_plant`
--

CREATE TABLE IF NOT EXISTS `origin_plant` (
  `whn_org` varchar(11) NOT NULL,
  `nm_org_palnt` varchar(20) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  PRIMARY KEY (`whn_org`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `origin_plant`
--

INSERT INTO `origin_plant` (`whn_org`, `nm_org_palnt`, `telp`, `alamat`) VALUES
('GAH4', 'Hanggar 4', '0215502099', 'Internasional Airport'),
('GDC', 'Central Store ', '0218315876', 'Soekarno Hatta Cengkareng jaka'),
('GH2', 'Hanggar 2', '0215502100', 'Cengkareng');

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_distribusi`
--

CREATE TABLE IF NOT EXISTS `receive_distribusi` (
  `id_receive` int(11) NOT NULL AUTO_INCREMENT,
  `no_dn` varchar(20) NOT NULL,
  `datetime_receive` datetime NOT NULL,
  `id` int(11) NOT NULL,
  `ket_receive` varchar(100) NOT NULL,
  PRIMARY KEY (`id_receive`),
  KEY `no_dn` (`no_dn`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data untuk tabel `receive_distribusi`
--

INSERT INTO `receive_distribusi` (`id_receive`, `no_dn`, `datetime_receive`, `id`, `ket_receive`) VALUES
(16, '81632387', '2018-08-23 22:50:11', 21, 'On Hand by produksi/tatang/TBS'),
(17, '81632305', '2018-08-23 22:51:11', 21, 'ok'),
(18, '81632354', '2018-08-30 19:27:40', 22, 'ok'),
(19, '81584560', '2018-10-20 19:06:48', 21, 'sudah diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblsementara`
--

CREATE TABLE IF NOT EXISTS `tblsementara` (
  `pn` varchar(50) NOT NULL,
  `nm_part` varchar(100) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  KEY `pn` (`pn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblsementara`
--

INSERT INTO `tblsementara` (`pn`, `nm_part`, `sn`, `jumlah`) VALUES
('2758', 'BATTERY', 'C07129', 1),
('17BCM6920-ALTS', 'FIRE GLOVES', '', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nm_lengkap` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat_user` varchar(120) NOT NULL,
  `crew` varchar(30) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nm_lengkap`, `email`, `telp`, `alamat_user`, `crew`, `level`) VALUES
(1, 'oong', 'MTIzNDU=', 'Administrator', 'oong@y.com', '09078675675', 'Tangerang', 'B', 1),
(2, 'julian', 'MTIzNDU=', 'Oong fernanda', 'julian@y.com', '09078675675', 'tangerng', 'C', 2),
(21, 'Yusri', 'MTIz', 'Yursil aji pamungkas', 'yus@y.com', '079879889765', 'Jakarta raya', 'A', 3),
(22, 'oong1', 'ZUxPV1RSTQ==', 'Oong julian fernanda', 'o@gmail.com', '098768556789', 'jakarta', 'A', 3),
(23, 'eri01', 'TlVrVm5vMg==', 'eri sukeiri', 'erisukaeri.mas@gmail.com', '087676541234', 'Tangerabng', 'B', 2),
(24, 'admin', 'dHBBeExUZg==', 'administrator swift', 'oong.julian@yahoo.co.id', '082281803400', 'tangerang banten', 'C', 2);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_material`
--
ALTER TABLE `detail_material`
  ADD CONSTRAINT `detail_material_ibfk_1` FOREIGN KEY (`no_dn`) REFERENCES `distribusi` (`no_dn`),
  ADD CONSTRAINT `detail_material_ibfk_2` FOREIGN KEY (`pn`) REFERENCES `material` (`pn`);

--
-- Ketidakleluasaan untuk tabel `detail_status`
--
ALTER TABLE `detail_status`
  ADD CONSTRAINT `detail_status_ibfk_1` FOREIGN KEY (`no_dn`) REFERENCES `distribusi` (`no_dn`),
  ADD CONSTRAINT `detail_status_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `distribusi`
--
ALTER TABLE `distribusi`
  ADD CONSTRAINT `distribusi_ibfk_1` FOREIGN KEY (`whn_org`) REFERENCES `origin_plant` (`whn_org`),
  ADD CONSTRAINT `distribusi_ibfk_2` FOREIGN KEY (`whn_dest`) REFERENCES `dest_plant` (`whn_dest`),
  ADD CONSTRAINT `distribusi_ibfk_3` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `distribusi_ibfk_4` FOREIGN KEY (`no_peg`) REFERENCES `courier` (`no_peg`);

--
-- Ketidakleluasaan untuk tabel `receive_distribusi`
--
ALTER TABLE `receive_distribusi`
  ADD CONSTRAINT `receive_distribusi_ibfk_1` FOREIGN KEY (`no_dn`) REFERENCES `distribusi` (`no_dn`),
  ADD CONSTRAINT `receive_distribusi_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `tblsementara`
--
ALTER TABLE `tblsementara`
  ADD CONSTRAINT `tblsementara_ibfk_1` FOREIGN KEY (`pn`) REFERENCES `material` (`pn`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
