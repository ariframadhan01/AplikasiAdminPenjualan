-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Agu 2019 pada 07.57
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_pembelian`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cfpro`(`gjl` VARCHAR(30))
BEGIN
set @sql = concat("select KDgejala, NMgejala from tbgejala where tbgejala.KDgejala in (" , gjl , ")");
PREPARE eksekusi from @sql;
execute eksekusi;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `filterdata`(`gjl` VARCHAR(30))
BEGIN
set @sql = concat("(" , gjl , ")");
SELECT @sql;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE IF NOT EXISTS `bahan` (
  `id_bahan` int(23) NOT NULL,
  `nama_bahan` varchar(100) DEFAULT NULL,
  `stok` mediumint(20) DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL,
  `id_kat` int(5) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `id_kat`) VALUES
(4, 'Kain 200 Cm', 1212, 'cm', 1),
(5, 'Kain 180 Cm', 2000, 'cm', 1),
(6, 'Kain 160 Cm', 3000, 'cm', 1),
(7, 'Invisible zipper', 2300, 'pcs', 2),
(8, 'Coil zipper', 1048, 'pcs', 2),
(9, 'Plastic zipper', 3200, 'pcs', 2),
(10, 'Foam T 6 180 x 200 cm', 2000, 'cm', 3),
(11, 'Foam T 6 180 x 150 cm', 3412, 'cm', 3),
(12, 'Foam T 8 180 x 120 cm', 2000, 'cm', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan`
--

CREATE TABLE IF NOT EXISTS `data_penjualan` (
  `id` int(11) NOT NULL,
  `tggl_transaksi` date NOT NULL,
  `lembar` int(11) NOT NULL,
  `id_produk` varchar(2) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_penjualan`
--

INSERT INTO `data_penjualan` (`id`, `tggl_transaksi`, `lembar`, `id_produk`, `ket`) VALUES
(5, '2014-10-23', 392190, 'A', ''),
(6, '2015-10-23', 382450, 'A', ''),
(7, '2016-10-23', 367585, 'A', ''),
(8, '2017-07-23', 419800, 'A', ''),
(9, '2014-10-23', 405255, 'B', ''),
(10, '2015-10-23', 437775, 'B', ''),
(11, '2016-10-23', 522925, 'B', ''),
(12, '2017-07-23', 428855, 'B', ''),
(13, '2014-10-23', 610830, 'C', ''),
(14, '2015-10-23', 527250, 'C', ''),
(15, '2016-10-23', 609405, 'C', ''),
(16, '2017-07-23', 549815, 'C', ''),
(17, '2014-10-23', 284480, 'D', ''),
(18, '2015-10-23', 285270, 'D', ''),
(19, '2016-10-23', 341915, 'D', ''),
(20, '2017-07-23', 335440, 'D', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_produk`
--

CREATE TABLE IF NOT EXISTS `data_produk` (
  `id_produk` varchar(2) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `harga` int(100) NOT NULL,
  `stock` int(100) NOT NULL,
  `keterangan` text NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_produk`
--

INSERT INTO `data_produk` (`id_produk`, `nama_produk`, `harga`, `stock`, `keterangan`, `img`) VALUES
('A', 'Karpet Gambar Bunga', 50000, 200, 'karpet', 'dream.png'),
('B', 'Karpet Gambar Kartun', 50000, 300, 'karpet', 'dream.png'),
('C', 'Karpet Gambar Sport', 50000, 304, 'karpet', 'dream.png'),
('D', 'Karpet Gambar Vektor', 50000, 350, 'karpet', 'dream.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `jml_kary` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`jml_kary`) VALUES
(1400);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_bahan`
--

CREATE TABLE IF NOT EXISTS `kategori_bahan` (
  `id_kat` int(4) DEFAULT NULL,
  `nama_kat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_transaksi` int(10) NOT NULL,
  `tgl_trans` date DEFAULT NULL,
  `id_produk` varchar(2) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `ket` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2404 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_transaksi`, `tgl_trans`, `id_produk`, `qty`, `customer`, `ket`) VALUES
(2045, '2018-01-03', 'D', 565, 'Didin', ''),
(2046, '2018-01-03', 'C', 405, 'Didin', ''),
(2047, '2018-01-03', 'A', 486, 'Didin', ''),
(2048, '2018-01-03', 'C', 507, 'Yunus', ''),
(2049, '2018-01-03', 'D', 126, 'Yunus', ''),
(2050, '2018-01-03', 'A', 147, 'Joni', ''),
(2051, '2018-01-03', 'B', 172, 'Joni', ''),
(2052, '2018-01-03', 'C', 328, 'Joni', ''),
(2053, '2018-01-03', 'H', 247, 'Joni', ''),
(2054, '2018-01-03', 'I', 219, 'Joni', ''),
(2055, '2018-01-04', 'C', 427, 'Suripto', ''),
(2056, '2018-01-04', 'F', 422, 'Suripto', ''),
(2057, '2018-01-04', 'D', 315, 'Suripto', ''),
(2058, '2018-01-04', 'D', 445, 'Joni', ''),
(2059, '2018-01-04', 'C', 302, 'Joni', ''),
(2060, '2018-01-04', 'G', 231, 'Joni', ''),
(2061, '2018-01-04', 'I', 394, 'Joni', ''),
(2062, '2018-01-08', 'D', 491, 'Halim', ''),
(2063, '2018-01-09', 'E', 693, 'Halim', ''),
(2064, '2018-01-10', 'H', 274, 'Halim', ''),
(2065, '2018-01-11', 'E', 502, 'Yunus', ''),
(2066, '2018-01-12', 'D', 549, 'Yunus', ''),
(2067, '2018-01-13', 'B', 615, 'Yunus', ''),
(2068, '2018-01-11', 'C', 641, 'Halim', ''),
(2069, '2018-01-11', 'C', 353, 'Halim', ''),
(2070, '2018-01-11', 'I', 412, 'Halim', ''),
(2071, '2018-01-11', 'G', 316, 'Halim', ''),
(2072, '2018-01-11', 'F', 457, 'Halim', ''),
(2073, '2018-01-11', 'C', 216, 'Didin', ''),
(2074, '2018-01-11', 'D', 272, 'Didin', ''),
(2075, '2018-01-11', 'E', 230, 'Didin', ''),
(2076, '2018-01-11', 'G', 367, 'Didin', ''),
(2077, '2018-01-11', 'H', 215, 'Didin', ''),
(2078, '2018-01-12', 'C', 449, 'Suripto', ''),
(2079, '2018-01-12', 'D', 620, 'Suripto', ''),
(2080, '2018-01-12', 'H', 443, 'Suripto', ''),
(2081, '2018-01-13', 'C', 498, 'yunus', ''),
(2082, '2018-01-13', 'D', 495, 'yunus', ''),
(2083, '2018-01-13', 'H', 492, 'yunus', ''),
(2084, '2018-01-14', 'C', 489, 'Halim', ''),
(2085, '2018-01-14', 'D', 486, 'Halim', ''),
(2086, '2018-01-14', 'H', 483, 'Halim', ''),
(2087, '2018-01-15', 'C', 480, 'Suripto', ''),
(2088, '2018-01-16', 'D', 477, 'Suripto', ''),
(2089, '2018-01-17', 'H', 474, 'Suripto', ''),
(2090, '2018-01-16', 'C', 471, 'Suripto', ''),
(2091, '2018-01-17', 'D', 468, 'Suripto', ''),
(2092, '2018-01-18', 'H', 465, 'Suripto', ''),
(2093, '2018-01-17', 'C', 462, 'Joni', ''),
(2094, '2018-01-18', 'D', 459, 'Joni', ''),
(2095, '2018-01-19', 'H', 456, 'Joni', ''),
(2096, '2018-02-03', 'D', 153, 'Didin', ''),
(2097, '2018-02-03', 'C', 713, 'Didin', ''),
(2098, '2018-02-03', 'A', 709, 'Didin', ''),
(2099, '2018-02-03', 'C', 521, 'Yunus', ''),
(2100, '2018-02-03', 'D', 330, 'Yunus', ''),
(2101, '2018-02-03', 'A', 242, 'Joni', ''),
(2102, '2018-02-03', 'B', 542, 'Joni', ''),
(2103, '2018-02-03', 'C', 271, 'Joni', ''),
(2104, '2018-02-03', 'H', 265, 'Joni', ''),
(2105, '2018-02-03', 'I', 732, 'Joni', ''),
(2106, '2018-02-04', 'C', 460, 'Suripto', ''),
(2107, '2018-02-04', 'F', 518, 'Suripto', ''),
(2108, '2018-02-04', 'D', 157, 'Suripto', ''),
(2109, '2018-02-04', 'D', 360, 'Joni', ''),
(2110, '2018-02-04', 'C', 474, 'Joni', ''),
(2111, '2018-02-04', 'G', 402, 'Joni', ''),
(2112, '2018-02-04', 'I', 334, 'Joni', ''),
(2113, '2018-02-04', 'D', 245, 'Halim', ''),
(2114, '2018-02-04', 'E', 160, 'Halim', ''),
(2115, '2018-02-04', 'H', 450, 'Halim', ''),
(2116, '2018-02-04', 'E', 625, 'Yunus', ''),
(2117, '2018-02-04', 'D', 702, 'Yunus', ''),
(2118, '2018-02-04', 'B', 646, 'Yunus', ''),
(2119, '2018-02-04', 'C', 603, 'Halim', ''),
(2120, '2018-02-04', 'C', 204, 'Halim', ''),
(2121, '2018-02-04', 'I', 636, 'Halim', ''),
(2122, '2018-02-04', 'G', 786, 'Halim', ''),
(2123, '2018-02-04', 'F', 206, 'Halim', ''),
(2124, '2018-02-04', 'C', 710, 'Didin', ''),
(2125, '2018-02-04', 'D', 421, 'Didin', ''),
(2126, '2018-02-04', 'E', 305, 'Didin', ''),
(2127, '2018-02-04', 'G', 638, 'Didin', ''),
(2128, '2018-02-04', 'H', 437, 'Didin', ''),
(2129, '2018-02-04', 'C', 404, 'Suripto', ''),
(2130, '2018-02-04', 'D', 707, 'Suripto', ''),
(2131, '2018-02-04', 'H', 589, 'Suripto', ''),
(2132, '2018-02-04', 'C', 631, 'yunus', ''),
(2133, '2018-02-04', 'D', 682, 'yunus', ''),
(2134, '2018-02-04', 'H', 643, 'yunus', ''),
(2135, '2018-02-04', 'C', 734, 'Halim', ''),
(2136, '2018-02-04', 'D', 202, 'Halim', ''),
(2137, '2018-02-04', 'H', 280, 'Halim', ''),
(2138, '2018-02-04', 'C', 280, 'Suripto', ''),
(2139, '2018-02-04', 'D', 227, 'Suripto', ''),
(2140, '2018-02-04', 'H', 773, 'Suripto', ''),
(2141, '2018-02-04', 'C', 333, 'Suripto', ''),
(2142, '2018-02-04', 'D', 109, 'Suripto', ''),
(2143, '2018-02-04', 'H', 450, 'Suripto', ''),
(2144, '2018-02-04', 'C', 729, 'Joni', ''),
(2145, '2018-02-04', 'D', 486, 'Joni', ''),
(2146, '2018-02-04', 'H', 339, 'Joni', ''),
(2147, '2018-03-03', 'D', 261, 'Didin', ''),
(2148, '2018-03-04', 'C', 161, 'Didin', ''),
(2149, '2018-03-05', 'A', 213, 'Didin', ''),
(2150, '2018-03-06', 'C', 275, 'Yunus', ''),
(2151, '2018-03-07', 'D', 270, 'Yunus', ''),
(2152, '2018-03-08', 'A', 162, 'Joni', ''),
(2153, '2018-03-09', 'B', 523, 'Joni', ''),
(2154, '2018-03-10', 'C', 522, 'Joni', ''),
(2155, '2018-03-11', 'H', 512, 'Joni', ''),
(2156, '2018-03-12', 'I', 228, 'Joni', ''),
(2157, '2018-03-13', 'C', 561, 'Suripto', ''),
(2158, '2018-03-14', 'F', 246, 'Suripto', ''),
(2159, '2018-03-15', 'D', 287, 'Suripto', ''),
(2160, '2018-03-16', 'D', 459, 'Joni', ''),
(2161, '2018-03-17', 'C', 318, 'Joni', ''),
(2162, '2018-03-18', 'G', 445, 'Joni', ''),
(2163, '2018-03-19', 'I', 119, 'Joni', ''),
(2164, '2018-03-20', 'D', 448, 'Halim', ''),
(2165, '2018-03-21', 'E', 514, 'Halim', ''),
(2166, '2018-03-22', 'H', 194, 'Halim', ''),
(2167, '2018-03-23', 'E', 275, 'Yunus', ''),
(2168, '2018-03-24', 'D', 492, 'Yunus', ''),
(2169, '2018-03-25', 'B', 399, 'Yunus', ''),
(2170, '2018-03-26', 'C', 310, 'Halim', ''),
(2171, '2018-03-27', 'C', 245, 'Halim', ''),
(2172, '2018-03-28', 'I', 461, 'Halim', ''),
(2173, '2018-03-29', 'G', 190, 'Halim', ''),
(2174, '2018-03-30', 'F', 179, 'Halim', ''),
(2175, '2018-03-31', 'C', 333, 'Didin', ''),
(2176, '2018-04-01', 'D', 327, 'Didin', ''),
(2177, '2018-04-02', 'E', 133, 'Didin', ''),
(2178, '2018-04-03', 'G', 217, 'Didin', ''),
(2179, '2018-04-04', 'H', 185, 'Didin', ''),
(2180, '2018-04-05', 'C', 186, 'Suripto', ''),
(2181, '2018-04-06', 'D', 400, 'Suripto', ''),
(2182, '2018-04-07', 'H', 555, 'Suripto', ''),
(2183, '2018-04-08', 'C', 201, 'yunus', ''),
(2184, '2018-04-09', 'D', 145, 'yunus', ''),
(2185, '2018-04-10', 'H', 554, 'yunus', ''),
(2186, '2018-04-11', 'C', 224, 'Halim', ''),
(2187, '2018-04-12', 'D', 547, 'Halim', ''),
(2188, '2018-04-13', 'H', 230, 'Halim', ''),
(2189, '2018-04-14', 'C', 226, 'Suripto', ''),
(2190, '2018-04-15', 'D', 179, 'Suripto', ''),
(2191, '2018-04-16', 'H', 493, 'Suripto', ''),
(2192, '2018-04-17', 'C', 194, 'Suripto', ''),
(2193, '2018-04-18', 'D', 318, 'Suripto', ''),
(2194, '2018-04-19', 'H', 308, 'Suripto', ''),
(2195, '2018-04-20', 'C', 120, 'Joni', ''),
(2196, '2018-04-21', 'D', 355, 'Joni', ''),
(2197, '2018-04-22', 'H', 341, 'Joni', ''),
(2198, '2018-04-03', 'D', 103, 'Didin', ''),
(2199, '2018-04-03', 'C', 147, 'Didin', ''),
(2200, '2018-04-03', 'A', 550, 'Didin', ''),
(2201, '2018-04-03', 'C', 164, 'Yunus', ''),
(2202, '2018-04-03', 'D', 270, 'Yunus', ''),
(2203, '2018-04-03', 'A', 285, 'Joni', ''),
(2204, '2018-04-03', 'B', 144, 'Joni', ''),
(2205, '2018-04-03', 'C', 390, 'Joni', ''),
(2206, '2018-04-03', 'H', 239, 'Joni', ''),
(2207, '2018-04-03', 'I', 200, 'Joni', ''),
(2208, '2018-04-03', 'C', 267, 'Suripto', ''),
(2209, '2018-04-03', 'F', 275, 'Suripto', ''),
(2210, '2018-04-03', 'D', 381, 'Suripto', ''),
(2211, '2018-04-03', 'D', 105, 'Joni', ''),
(2212, '2018-04-03', 'C', 242, 'Joni', ''),
(2213, '2018-04-03', 'G', 382, 'Joni', ''),
(2214, '2018-04-03', 'I', 480, 'Joni', ''),
(2215, '2018-04-03', 'D', 258, 'Halim', ''),
(2216, '2018-04-03', 'E', 301, 'Halim', ''),
(2217, '2018-04-03', 'H', 543, 'Halim', ''),
(2218, '2018-04-03', 'E', 520, 'Yunus', ''),
(2219, '2018-04-03', 'D', 358, 'Yunus', ''),
(2220, '2018-04-03', 'B', 455, 'Yunus', ''),
(2221, '2018-04-03', 'C', 541, 'Halim', ''),
(2222, '2018-04-03', 'C', 292, 'Halim', ''),
(2223, '2018-04-03', 'I', 180, 'Halim', ''),
(2224, '2018-04-03', 'G', 415, 'Halim', ''),
(2225, '2018-04-03', 'F', 362, 'Halim', ''),
(2226, '2018-04-03', 'C', 115, 'Didin', ''),
(2227, '2018-04-03', 'D', 558, 'Didin', ''),
(2228, '2018-04-03', 'E', 275, 'Didin', ''),
(2229, '2018-04-03', 'G', 415, 'Didin', ''),
(2230, '2018-04-03', 'H', 336, 'Didin', ''),
(2231, '2018-04-03', 'C', 226, 'Suripto', ''),
(2232, '2018-04-03', 'D', 264, 'Suripto', ''),
(2233, '2018-04-03', 'H', 102, 'Suripto', ''),
(2234, '2018-04-03', 'C', 259, 'yunus', ''),
(2235, '2018-04-03', 'D', 467, 'yunus', ''),
(2236, '2018-04-03', 'H', 391, 'yunus', ''),
(2237, '2018-04-03', 'C', 314, 'Halim', ''),
(2238, '2018-04-03', 'D', 551, 'Halim', ''),
(2239, '2018-04-03', 'H', 161, 'Halim', ''),
(2240, '2018-04-03', 'C', 374, 'Suripto', ''),
(2241, '2018-04-03', 'D', 106, 'Suripto', ''),
(2242, '2018-04-03', 'H', 424, 'Suripto', ''),
(2243, '2018-04-03', 'C', 212, 'Suripto', ''),
(2244, '2018-04-03', 'D', 386, 'Suripto', ''),
(2245, '2018-04-03', 'H', 118, 'Suripto', ''),
(2246, '2018-04-03', 'C', 205, 'Joni', ''),
(2247, '2018-04-03', 'D', 102, 'Joni', ''),
(2248, '2018-04-03', 'H', 123, 'Joni', ''),
(2249, '2018-05-03', 'D', 239, 'Didin', ''),
(2250, '2018-05-03', 'C', 167, 'Didin', ''),
(2251, '2018-05-03', 'A', 108, 'Didin', ''),
(2252, '2018-05-03', 'C', 331, 'Yunus', ''),
(2253, '2018-05-03', 'D', 494, 'Yunus', ''),
(2254, '2018-05-03', 'A', 416, 'Joni', ''),
(2255, '2018-05-03', 'B', 527, 'Joni', ''),
(2256, '2018-05-03', 'C', 110, 'Joni', ''),
(2257, '2018-05-03', 'H', 312, 'Joni', ''),
(2258, '2018-05-03', 'I', 466, 'Joni', ''),
(2259, '2018-05-03', 'C', 498, 'Suripto', ''),
(2260, '2018-05-03', 'F', 554, 'Suripto', ''),
(2261, '2018-05-03', 'D', 484, 'Suripto', ''),
(2262, '2018-05-03', 'D', 498, 'Joni', ''),
(2263, '2018-05-03', 'C', 128, 'Joni', ''),
(2264, '2018-05-03', 'G', 390, 'Joni', ''),
(2265, '2018-05-03', 'I', 336, 'Joni', ''),
(2266, '2018-05-03', 'D', 219, 'Halim', ''),
(2267, '2018-05-03', 'E', 264, 'Halim', ''),
(2268, '2018-05-03', 'H', 357, 'Halim', ''),
(2269, '2018-05-03', 'E', 140, 'Yunus', ''),
(2270, '2018-05-03', 'D', 511, 'Yunus', ''),
(2271, '2018-05-03', 'B', 240, 'Yunus', ''),
(2272, '2018-05-03', 'C', 436, 'Halim', ''),
(2273, '2018-05-03', 'C', 256, 'Halim', ''),
(2274, '2018-05-03', 'I', 486, 'Halim', ''),
(2275, '2018-05-03', 'G', 308, 'Halim', ''),
(2276, '2018-05-03', 'F', 221, 'Halim', ''),
(2277, '2018-05-03', 'C', 120, 'Didin', ''),
(2278, '2018-05-03', 'D', 455, 'Didin', ''),
(2279, '2018-05-03', 'E', 549, 'Didin', ''),
(2280, '2018-05-03', 'G', 294, 'Didin', ''),
(2281, '2018-05-03', 'H', 142, 'Didin', ''),
(2282, '2018-05-03', 'C', 177, 'Suripto', ''),
(2283, '2018-05-03', 'D', 137, 'Suripto', ''),
(2284, '2018-05-03', 'H', 434, 'Suripto', ''),
(2285, '2018-05-03', 'C', 203, 'yunus', ''),
(2286, '2018-05-03', 'D', 335, 'yunus', ''),
(2287, '2018-05-03', 'H', 262, 'yunus', ''),
(2288, '2018-05-03', 'C', 238, 'Halim', ''),
(2289, '2018-05-03', 'D', 235, 'Halim', ''),
(2290, '2018-05-03', 'H', 361, 'Halim', ''),
(2291, '2018-05-03', 'C', 426, 'Suripto', ''),
(2292, '2018-05-03', 'D', 316, 'Suripto', ''),
(2293, '2018-05-03', 'H', 240, 'Suripto', ''),
(2294, '2018-05-03', 'C', 274, 'Suripto', ''),
(2295, '2018-05-03', 'D', 318, 'Suripto', ''),
(2296, '2018-05-03', 'H', 523, 'Suripto', ''),
(2297, '2018-05-03', 'C', 241, 'Joni', ''),
(2298, '2018-05-03', 'D', 355, 'Joni', ''),
(2299, '2018-05-03', 'H', 188, 'Joni', ''),
(2300, '2018-06-03', 'D', 283, 'Didin', ''),
(2301, '2018-06-03', 'C', 503, 'Didin', ''),
(2302, '2018-06-03', 'A', 248, 'Didin', ''),
(2303, '2018-06-03', 'C', 428, 'Yunus', ''),
(2304, '2018-06-03', 'D', 551, 'Yunus', ''),
(2305, '2018-06-03', 'A', 217, 'Joni', ''),
(2306, '2018-06-03', 'B', 539, 'Joni', ''),
(2307, '2018-06-03', 'C', 554, 'Joni', ''),
(2308, '2018-06-03', 'H', 243, 'Joni', ''),
(2309, '2018-06-03', 'I', 413, 'Joni', ''),
(2310, '2018-06-03', 'C', 351, 'Suripto', ''),
(2311, '2018-06-03', 'F', 337, 'Suripto', ''),
(2312, '2018-06-03', 'D', 399, 'Suripto', ''),
(2313, '2018-06-03', 'D', 513, 'Joni', ''),
(2314, '2018-06-03', 'C', 277, 'Joni', ''),
(2315, '2018-06-03', 'G', 513, 'Joni', ''),
(2316, '2018-06-03', 'I', 189, 'Joni', ''),
(2317, '2018-06-03', 'D', 493, 'Halim', ''),
(2318, '2018-06-03', 'E', 447, 'Halim', ''),
(2319, '2018-06-03', 'H', 375, 'Halim', ''),
(2320, '2018-06-03', 'E', 243, 'Yunus', ''),
(2321, '2018-06-03', 'D', 195, 'Yunus', ''),
(2322, '2018-06-03', 'B', 398, 'Yunus', ''),
(2323, '2018-06-03', 'C', 421, 'Halim', ''),
(2324, '2018-06-03', 'C', 334, 'Halim', ''),
(2325, '2018-06-03', 'I', 259, 'Halim', ''),
(2326, '2018-06-03', 'G', 443, 'Halim', ''),
(2327, '2018-06-03', 'F', 321, 'Halim', ''),
(2328, '2018-06-03', 'C', 269, 'Didin', ''),
(2329, '2018-06-03', 'D', 186, 'Didin', ''),
(2330, '2018-06-03', 'E', 498, 'Didin', ''),
(2331, '2018-06-03', 'G', 500, 'Didin', ''),
(2332, '2018-06-03', 'H', 282, 'Didin', ''),
(2333, '2018-06-03', 'C', 310, 'Suripto', ''),
(2334, '2018-06-03', 'D', 174, 'Suripto', ''),
(2335, '2018-06-03', 'H', 529, 'Suripto', ''),
(2336, '2018-06-03', 'C', 448, 'yunus', ''),
(2337, '2018-06-03', 'D', 114, 'yunus', ''),
(2338, '2018-06-03', 'H', 360, 'yunus', ''),
(2339, '2018-06-03', 'C', 125, 'Halim', ''),
(2340, '2018-06-03', 'D', 399, 'Halim', ''),
(2341, '2018-06-03', 'H', 304, 'Halim', ''),
(2342, '2018-06-03', 'C', 479, 'Suripto', ''),
(2343, '2018-06-03', 'D', 286, 'Suripto', ''),
(2344, '2018-06-03', 'H', 431, 'Suripto', ''),
(2345, '2018-06-03', 'C', 127, 'Suripto', ''),
(2346, '2018-06-03', 'D', 518, 'Suripto', ''),
(2347, '2018-06-03', 'H', 405, 'Suripto', ''),
(2348, '2018-06-03', 'C', 349, 'Joni', ''),
(2349, '2018-06-03', 'D', 547, 'Joni', ''),
(2350, '2018-06-03', 'H', 495, 'Joni', ''),
(2402, '2018-07-14', 'A', 1000, 'andi', ''),
(2403, '2018-07-15', 'B', 200, 'vf', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peramalan`
--

CREATE TABLE IF NOT EXISTS `peramalan` (
  `id_peramalan` int(11) NOT NULL,
  `id_produk` varchar(5) DEFAULT NULL,
  `tahun` date NOT NULL,
  `penjualan` double DEFAULT NULL,
  `peramalan` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3257 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peramalan`
--

INSERT INTO `peramalan` (`id_peramalan`, `id_produk`, `tahun`, `penjualan`, `peramalan`) VALUES
(3237, 'A', '2014-00-00', 392190, 392190),
(3238, 'A', '2015-00-00', 382450, 392092.6),
(3239, 'A', '2016-00-00', 367585, 391768.63),
(3240, 'A', '2017-00-00', 419800, 391786.528),
(3241, 'A', '2018-00-00', 0, 392126.6),
(3242, 'B', '2014-00-00', 405255, 405255),
(3243, 'B', '2015-00-00', 437775, 406555.8),
(3244, 'B', '2016-00-00', 522925, 412043.08),
(3245, 'B', '2017-00-00', 428855, 416227.416),
(3246, 'B', '2018-00-00', 0, 453886.4),
(3247, 'C', '2014-00-00', 610830, 610830),
(3248, 'C', '2015-00-00', 527250, 607486.8),
(3249, 'C', '2016-00-00', 609405, 605423.88),
(3250, 'C', '2017-00-00', 549815, 601879.256),
(3251, 'C', '2018-00-00', 0, 569977.6),
(3252, 'D', '2014-00-00', 284480, 284480),
(3253, 'D', '2015-00-00', 285270, 284606.4),
(3254, 'D', '2016-00-00', 341915, 293821.28),
(3255, 'D', '2017-00-00', 335440, 303797.632),
(3256, 'D', '2018-00-00', 0, 343703);

-- --------------------------------------------------------

--
-- Struktur dari tabel `preorder`
--

CREATE TABLE IF NOT EXISTS `preorder` (
  `id_transaksi` int(10) NOT NULL,
  `tgl_trans` date DEFAULT NULL,
  `id_produk` varchar(2) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `preorder`
--

INSERT INTO `preorder` (`id_transaksi`, `tgl_trans`, `id_produk`, `qty`, `customer`, `ket`) VALUES
(1, '2018-07-13', 'A', 1000, 'cahya', 'ready');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` varchar(2) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `ukuran` varchar(20) DEFAULT NULL,
  `harga` int(100) NOT NULL,
  `stok` int(100) NOT NULL,
  `keterangan` text NOT NULL,
  `img` varchar(500) NOT NULL,
  `bahan_kain` int(5) DEFAULT NULL,
  `bahan_zipper` int(5) DEFAULT NULL,
  `bahan_foam` int(5) DEFAULT NULL,
  `waktu_produksi` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `ukuran`, `harga`, `stok`, `keterangan`, `img`, `bahan_kain`, `bahan_zipper`, `bahan_foam`, `waktu_produksi`) VALUES
('A', 'Kasur T 6 180 x 120 cm', '', 384000, 675, 'Kasur', 'Kasur-Busa-Super-BIG-FOAM-18-cm.jpg', 4, 7, 10, 2),
('B', 'Kasur T 6 180 x 150 cm', '', 20000, 172, 'Kasur', 'Kasur-Busa-Super-BIG-FOAM-18-cm.jpg', 4, 9, 11, 2),
('C', 'Kasur T 6 180 x 180 cm', '', 384000, 2122, 'Kasur', 'Kasur-Busa-Super-BIG-FOAM-18-cm.jpg', 4, 8, 11, 2),
('D', 'Kasur T 6 180 x 200 cm', '', 384000, 1580, 'Kasur', 'Kasur-Busa-Super-BIG-FOAM-18-cm.jpg', 5, 7, 12, 2),
('E', 'Kasur T 6 180 x 220 cm', '', 384000, 947, 'Kasur', 'Kasur-Busa-Super-BIG-FOAM-18-cm.jpg', 5, 7, 10, 3),
('F', 'Kasur T 8 180 x 120 cm', '', 384000, 1350, 'Kasur', 'Kasur-Busa-Super-BIG-FOAM-18-cm.jpg', 6, 8, 11, 3),
('G', 'Kasur T 8 180 x 180 cm', '', 384000, 696, 'Kasur', 'Kasur-Busa-Super-BIG-FOAM-18-cm.jpg', 6, 8, 11, 3),
('H', 'Kasur T 8 180 x 200 cm', '', 384000, 1085, 'Kasur', 'Kasur-Busa-Super-BIG-FOAM-18-cm.jpg', 4, 8, 12, 3),
('I', 'Kasur T 8 180 x 220 cm', '', 384000, 1072, 'Kasur', 'Kasur-Busa-Super-BIG-FOAM-18-cm.jpg', 5, 7, 10, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(23) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `nama`, `password`, `img`, `status`) VALUES
('admin', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin.jpg', 'admin'),
('manager', 'manager', '1d0258c2440a8d19e716292b231e3190', 'manager.jpg', 'manager'),
('mandor', 'mandor', '707d803707c87747c71b0e5513ef73a9', 'mandor.jpg', 'mandor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`id`), ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_transaksi`), ADD KEY `fk_produk` (`id_produk`);

--
-- Indexes for table `peramalan`
--
ALTER TABLE `peramalan`
  ADD PRIMARY KEY (`id_peramalan`), ADD KEY `fk_produk_p` (`id_produk`);

--
-- Indexes for table `preorder`
--
ALTER TABLE `preorder`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` int(23) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2404;
--
-- AUTO_INCREMENT for table `peramalan`
--
ALTER TABLE `peramalan`
  MODIFY `id_peramalan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3257;
--
-- AUTO_INCREMENT for table `preorder`
--
ALTER TABLE `preorder`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
ADD CONSTRAINT `data_penjualan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `data_produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
ADD CONSTRAINT `fk_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `peramalan`
--
ALTER TABLE `peramalan`
ADD CONSTRAINT `fk_produk_p` FOREIGN KEY (`id_produk`) REFERENCES `data_produk` (`id_produk`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
