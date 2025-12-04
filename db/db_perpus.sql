-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2025 at 01:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `bukuId` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `jumlah_halaman` int(11) DEFAULT NULL,
  `format` varchar(50) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `eISBN` varchar(50) DEFAULT NULL,
  `jumlah_buku` int(5) NOT NULL,
  `kategoriId` int(11) DEFAULT NULL,
  `id_subkategori` int(11) DEFAULT NULL,
  `rakId` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`bukuId`, `judul`, `penulis`, `jumlah_halaman`, `format`, `penerbit`, `tahun_terbit`, `eISBN`, `jumlah_buku`, `kategoriId`, `id_subkategori`, `rakId`, `gambar`, `sinopsis`) VALUES
(2, 'Dasar-Dasar Teknik Informatika', 'Novega Pratama Adiputra', 117, 'Cetak', 'Deepublish', '2020', '978-623-02-0819-5', 15, 2, 6, 3, 'dasar2teknik-informatika.jpg', 'Perkembangan di bidang TIK (Teknologi Informasi dan Komunikasi) saat ini sangat pesat dan berpengaruh signifikan terhadap pribadi maupun komunitas, segala aktivitas, kehidupan, cara kerja, metode perkuliahan, gaya hidup maupun cara berpikir. Adapun jenis-jenis TIK yang kita kenal selama ini adalah radio; televisi; telepon (fixed dan mobile); faksimile; electronic recording (audio dan video); komputer dengan segala peripherals seperti software, hardware, dan useware (program atau isi informasi); dan jaringan (lokal, wilayah, dan global/internet). Teknologi informasi merupakan suatu teknologi yang digunakan untuk mengolah data, termasuk memproses, mendapatkan, menyusun, menyimpan, memanipulasi data dalam berbagai cara untuk menghasilkan informasi yang berkualitas, yaitu informasi yang relevan, akurat, dan tepat waktu. Teknologi ini menggunakan seperangkat komputer untuk mengolah data dan sistem jaringan untuk menghubungkan satu komputer dengan komputer yang lainnya sesuai dengan kebutuhan dan teknologi telekomunikasi digunakan agar data dapat disebar dan diakses secara global. Perkembangan kinerja komputer diukur dengan kecepatan kerjanya. Walau demikian, ternyata kinerja komputer berbanding terbalik dengan ukurannya. Awalnya satu unit komputer harus berukuran satu rumah, sekarang menjadi semakin kecil. Perkembangan itu juga diiringi dengan perkembangan internet atau interconnected networks sebagai media penyampai informasi yang sangat efektif. TIK telah menjadi simbol gelombang perubahan. Perkembangan teknologi informasi memacu untuk memasuki era baru dalam kehidupan. Kehidupan seperti ini dikenal dengan e-life (electronic life), artinya kehidupan ini sudah dipengaruhi'),
(3, 'Pengantar Manajemen', 'Herry Krisnandi, S.E., M.M. , Dr. Suryono Efendi, S.E., M.B.A., M.M. , Dr. Ir. Edi Sugiono, S.E., M.M.', 228, 'Cetak', 'LPU-UNAS', '2019', ' 978-623-7273-01-1', 5, 1, 5, 1, 'pengantar-manajemen.png', 'Ilmu Manajemen, dari waktu ke waktu senantiasa berubah. Berubah\r\nbukan berarti pandangan dan paradigma lama tidak penting, akan tetapi\r\nberubah menuju kemajuan. Sebab dasar pijakan untuk menuju\r\nkemajuan itu sudah barang tentu dilahirkan oleh para ahli manajemen\r\nsebelumnya.\r\nSaat diminta untuk memberikan prakata untuk buku Pengantar\r\nManajemen ini,saya sungguh terharu, berbagai perasaan berkecamuk di\r\nhati. Betapa malu saya, sebagai seorang guru besar ilmu manajemen,\r\nbelum sempat juga menyumbangkan ilmu dan pemikiran bagi\r\nperadaban umat manusia, seperti halnya yang dilakukan oleh penulis\r\nini. Berbagai tulisan saya selama ini tercecer dimana-mana, dan belum\r\nsempat juga mengumpulkannya untuk sekedar dibuatkan sebuah buku\r\nkumpulan karangan.');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategoriId` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategoriId`, `nama_kategori`) VALUES
(1, 'Ilmu Sosial dan Humaniora'),
(2, 'Ilmu Sains dan Teknologi');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `rakId` int(11) NOT NULL,
  `nomor_rak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`rakId`, `nomor_rak`) VALUES
(1, 'Rak Ekonomi'),
(2, 'Rak Psikologi'),
(3, 'Rak Komputer');

-- --------------------------------------------------------

--
-- Table structure for table `subkategori`
--

CREATE TABLE `subkategori` (
  `id_subkategori` int(11) NOT NULL,
  `kategoriId` int(11) NOT NULL,
  `nama_subkategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subkategori`
--

INSERT INTO `subkategori` (`id_subkategori`, `kategoriId`, `nama_subkategori`) VALUES
(1, 1, 'Sosiologi'),
(2, 1, 'Psikologi'),
(3, 1, 'Hukum'),
(4, 1, 'Sejarah'),
(5, 1, 'Ekonomi'),
(6, 2, 'Komputer'),
(7, 2, 'Fisika'),
(8, 2, 'Kesehatan'),
(9, 2, 'Konstruksi'),
(10, 2, 'Geologi');

-- --------------------------------------------------------

--
-- Table structure for table `useracc`
--

CREATE TABLE `useracc` (
  `userId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` enum('guest','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useracc`
--

INSERT INTO `useracc` (`userId`, `name`, `username`, `email`, `password`, `phone`, `role`) VALUES
(1, 'ilhamzainuri', 'ilhamartar', 'artar010404@gmail.com', 'ilham', '085820664592', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`bukuId`),
  ADD KEY `kategoriId` (`kategoriId`,`id_subkategori`,`rakId`),
  ADD KEY `rakId` (`rakId`),
  ADD KEY `id_subkategori` (`id_subkategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriId`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`rakId`);

--
-- Indexes for table `subkategori`
--
ALTER TABLE `subkategori`
  ADD PRIMARY KEY (`id_subkategori`),
  ADD KEY `kategoriId` (`kategoriId`);

--
-- Indexes for table `useracc`
--
ALTER TABLE `useracc`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `bukuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategoriId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `rakId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subkategori`
--
ALTER TABLE `subkategori`
  MODIFY `id_subkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `useracc`
--
ALTER TABLE `useracc`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategoriId`) REFERENCES `kategori` (`kategoriId`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`rakId`) REFERENCES `rak` (`rakId`),
  ADD CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_subkategori`) REFERENCES `subkategori` (`id_subkategori`);

--
-- Constraints for table `subkategori`
--
ALTER TABLE `subkategori`
  ADD CONSTRAINT `subkategori_ibfk_1` FOREIGN KEY (`kategoriId`) REFERENCES `kategori` (`kategoriId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
