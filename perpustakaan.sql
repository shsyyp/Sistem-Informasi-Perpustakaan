-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: perpustakaan
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(350) DEFAULT NULL,
  `jk` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `username` varchar(350) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('e4ce3fdc-9465-11ee-a615-0a0027000010','Rina','Perempuan','Pustakawan','rina','$2y$10$3FMWta6U.gaMgBASqOiTHuBEmfYtrLodOQ38qgecqIU06IRDYuJqa',NULL,NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anggota` (
  `id` varchar(255) NOT NULL,
  `kode_anggota` varchar(30) DEFAULT NULL,
  `jenis_anggota` varchar(30) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `anggota_un` (`kode_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota`
--

LOCK TABLES `anggota` WRITE;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` VALUES ('975e6adb-9961-11ee-a615-0a0027000010','S-001','Siswa','Siswa A','Laki-laki',NULL,NULL),('a009e485-9961-11ee-a615-0a0027000010','S-002','Siswa','Siswa B','Perempuan',NULL,NULL),('ab197fff-9961-11ee-a615-0a0027000010','G-001','Guru','Guru A','Laki-laki',NULL,NULL),('b541cc7c-9961-11ee-a615-0a0027000010','U-001','Umum','Umum A','Perempuan',NULL,NULL);
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buku` (
  `id` varchar(255) NOT NULL,
  `judul` varchar(350) DEFAULT NULL,
  `pengarang` varchar(255) DEFAULT NULL,
  `th_terbit` varchar(10) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `isbn` varchar(30) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `gambar` varchar(350) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku`
--

LOCK TABLES `buku` WRITE;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` VALUES ('1ca45313-98d2-11ee-a615-0a0027000010','Buku 1','Penulis A','2003','Penerbit XYZ','001-234-567','Novel','Rak-A01','1702437070.png',NULL,NULL),('dd056967-9962-11ee-a615-0a0027000010','Buku 2','Penulis A','2023','Penerbit XYZ','123-321','Sains','Rak-B02','1702436029.png',NULL,NULL);
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eksemplar`
--

DROP TABLE IF EXISTS `eksemplar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eksemplar` (
  `id` varchar(255) NOT NULL,
  `buku_id` varchar(255) DEFAULT NULL,
  `kode_eksemplar` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `eksemplar_un` (`kode_eksemplar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eksemplar`
--

LOCK TABLES `eksemplar` WRITE;
/*!40000 ALTER TABLE `eksemplar` DISABLE KEYS */;
INSERT INTO `eksemplar` VALUES ('869d9307-99c6-11ee-8004-0a0027000010','dd056967-9962-11ee-a615-0a0027000010','BK2-001',NULL,NULL),('9fad5f61-98d3-11ee-a615-0a0027000010','1ca45313-98d2-11ee-a615-0a0027000010','BK1-001',NULL,NULL),('d3204785-995d-11ee-a615-0a0027000010','1ca45313-98d2-11ee-a615-0a0027000010','BK1-002',NULL,NULL),('e1a85f0b-995d-11ee-a615-0a0027000010','1ca45313-98d2-11ee-a615-0a0027000010','BK1-003',NULL,NULL);
/*!40000 ALTER TABLE `eksemplar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peminjaman` (
  `id` varchar(255) NOT NULL,
  `anggota_id` varchar(255) DEFAULT NULL,
  `eksemplar_id` varchar(255) DEFAULT NULL,
  `tanggal_pinjam` datetime DEFAULT NULL,
  `tanggal_kembali` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES ('78ed875b-9991-11ee-a615-0a0027000010','a009e485-9961-11ee-a615-0a0027000010','d3204785-995d-11ee-a615-0a0027000010','2023-12-12 15:27:00',NULL,'Pinjam',NULL,NULL),('8aa8b5cc-9966-11ee-a615-0a0027000010','975e6adb-9961-11ee-a615-0a0027000010','9fad5f61-98d3-11ee-a615-0a0027000010','2023-12-13 10:20:00',NULL,'Pinjam',NULL,NULL),('9c1a81b7-9990-11ee-a615-0a0027000010','ab197fff-9961-11ee-a615-0a0027000010','e1a85f0b-995d-11ee-a615-0a0027000010','2023-12-13 15:21:00','2023-12-13 21:48:00','Kembali',NULL,NULL),('e01c03a2-9966-11ee-a615-0a0027000010','a009e485-9961-11ee-a615-0a0027000010','d3204785-995d-11ee-a615-0a0027000010','2023-12-01 10:22:00','2023-12-12 10:22:00','Kembali',NULL,NULL);
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengunjung`
--

DROP TABLE IF EXISTS `pengunjung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengunjung` (
  `id` varchar(255) NOT NULL,
  `id_tamu` varchar(100) DEFAULT NULL,
  `jenis_pengunjung` varchar(30) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `asal` varchar(255) DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `waktu_kunjungan` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengunjung`
--

LOCK TABLES `pengunjung` WRITE;
/*!40000 ALTER TABLE `pengunjung` DISABLE KEYS */;
INSERT INTO `pengunjung` VALUES ('3cfc601f-9982-11ee-a615-0a0027000010','U-001','Umum','Tamu Undangan','Politeknik Caltex','Branchmarking','2023-12-13 06:38:25',NULL,NULL),('a94a01f1-9965-11ee-a615-0a0027000010','S-003','Siswa','Siswa C','Kelas 12 IPA A','Baca Buku','2023-12-13 10:16:00',NULL,NULL),('e300aec3-99c6-11ee-8004-0a0027000010','S-004','Siswa','Rina','12 IPA 1','Baca Buku','2023-12-13 14:49:58',NULL,NULL);
/*!40000 ALTER TABLE `pengunjung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'perpustakaan'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-13 22:01:26
