-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: 192.168.8.2    Database: db_cuti
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `absensi`
--

DROP TABLE IF EXISTS `absensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absensi` (
  `user_id` int(11) DEFAULT NULL,
  `tgl_dan_jam` datetime NOT NULL,
  `verifikasi` int(5) DEFAULT NULL,
  `lokasi` char(10) DEFAULT NULL,
  `jamnya` time DEFAULT NULL,
  PRIMARY KEY (`tgl_dan_jam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi`
--

LOCK TABLES `absensi` WRITE;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `absensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `absensi01`
--

DROP TABLE IF EXISTS `absensi01`;
/*!50001 DROP VIEW IF EXISTS `absensi01`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `absensi01` AS SELECT 
 1 AS `tanggal`,
 1 AS `user_id`,
 1 AS `Masuk`,
 1 AS `Keluar`,
 1 AS `tanggalmulai`,
 1 AS `tanggalakhir`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `absensi02`
--

DROP TABLE IF EXISTS `absensi02`;
/*!50001 DROP VIEW IF EXISTS `absensi02`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `absensi02` AS SELECT 
 1 AS `tanggal`,
 1 AS `user_id`,
 1 AS `Masuk`,
 1 AS `Keluar`,
 1 AS `jam_kerja`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `absensi03`
--

DROP TABLE IF EXISTS `absensi03`;
/*!50001 DROP VIEW IF EXISTS `absensi03`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `absensi03` AS SELECT 
 1 AS `user_id`,
 1 AS `username`,
 1 AS `JumMasukTdkTelat`,
 1 AS `tot_jam_kerja`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `absensi_kegiatan`
--

DROP TABLE IF EXISTS `absensi_kegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absensi_kegiatan` (
  `absensi_kegiatanid` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(30) NOT NULL,
  `kegiatanid` int(11) NOT NULL,
  `waktuscan` datetime NOT NULL,
  PRIMARY KEY (`absensi_kegiatanid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2475 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi_kegiatan`
--

LOCK TABLES `absensi_kegiatan` WRITE;
/*!40000 ALTER TABLE `absensi_kegiatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `absensi_kegiatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acara`
--

DROP TABLE IF EXISTS `acara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acara` (
  `acaraid` int(11) NOT NULL AUTO_INCREMENT,
  `acara` tinytext,
  `acara_singkat` tinytext,
  PRIMARY KEY (`acaraid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acara`
--

LOCK TABLES `acara` WRITE;
/*!40000 ALTER TABLE `acara` DISABLE KEYS */;
/*!40000 ALTER TABLE `acara` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checkinout`
--

DROP TABLE IF EXISTS `checkinout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `checkinout` (
  `USERID` int(11) NOT NULL,
  `CHECKTIME` datetime NOT NULL,
  PRIMARY KEY (`USERID`,`CHECKTIME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkinout`
--

LOCK TABLES `checkinout` WRITE;
/*!40000 ALTER TABLE `checkinout` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkinout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daterange_cuti`
--

DROP TABLE IF EXISTS `daterange_cuti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daterange_cuti` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `no_cuti` varchar(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `persetujuan` varchar(30) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=799 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daterange_cuti`
--

LOCK TABLES `daterange_cuti` WRITE;
/*!40000 ALTER TABLE `daterange_cuti` DISABLE KEYS */;
INSERT INTO `daterange_cuti` VALUES (772,'00018','adam','2020-08-21','Disetujui(Manager)',NULL),(773,'00019','998','2021-05-19','','w-7.png'),(774,'00020','998','2021-05-21','','w-7.png'),(775,'00021','222','2021-05-18','','w-7.png'),(776,'00022','998','2021-05-26','','w-7.png'),(777,'00023','998','2021-05-24','','w-7.png'),(778,'00024','998','2021-05-27','','w-7.png'),(779,'00024','998','2021-05-28','','w-7.png'),(780,'00025','222','2021-05-19','','w-7.png'),(781,'00025','222','2021-05-20','','w-7.png'),(782,'00026','222','2021-05-19','','countdown.JPG'),(783,'00026','222','2021-05-19','','countdown.JPG'),(784,'00026','222','2021-05-19','','employess_view_edit.JPG'),(785,'00026','222','2021-05-19','','file_sk.JPG'),(786,'00026','222','2021-05-18','','file_sk.JPG'),(787,'00027','222','2021-05-20','','change_pass.JPG'),(788,'00027','222','2021-05-19','','change_pass.JPG'),(789,'00027','222','2021-05-20','','change_pass.JPG'),(790,'00028','222','2021-05-19','','file_sk.JPG'),(791,'00026','222','2021-05-18','','file_sk.JPG'),(792,'00026','222','2021-05-19','','file_sk.JPG'),(793,'00027','998','2021-05-20','','file_sk.JPG'),(794,'00027','998','2021-05-18','','change_pass.JPG'),(795,'00028','991','2021-05-18','','detail_jobdesc.JPG'),(796,'00029','294','2021-05-18','','file_sk.JPG'),(797,'00030','222','2021-05-18','Disetujui(Direksi)','insert_menu_.JPG'),(798,'00031','222','2021-05-18','','karyawan_view_jobdesc.JPG');
/*!40000 ALTER TABLE `daterange_cuti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daterange_izin`
--

DROP TABLE IF EXISTS `daterange_izin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daterange_izin` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `no_izin` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `persetujuan` varchar(50) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_absen` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daterange_izin`
--

LOCK TABLES `daterange_izin` WRITE;
/*!40000 ALTER TABLE `daterange_izin` DISABLE KEYS */;
INSERT INTO `daterange_izin` VALUES (1,10,'294','2021-05-19','Sakit Tanpa Surat Dokter','','add_jobdesc_tampilan.JPG',NULL),(2,10,'294','2021-05-19','Sakit Dengan Surat Dokter','','add_jobdesc_tampilan.JPG',NULL),(3,10,'294','2021-05-19','Sakit Tanpa Surat Dokter','','add_jobdesc_tampilan.JPG',NULL),(4,10,'294','2021-05-19','Sakit Tanpa Surat Dokter','','add_jobdesc_tampilan.JPG',NULL),(5,10,'294','2021-05-19','Sakit Tanpa Surat Dokter','','add_jobdesc_tampilan.JPG',NULL),(6,10,'294','2021-05-19','Sakit Tanpa Surat Dokter','','akses.JPG',NULL),(7,10,'998','2021-05-20','Sakit Dengan Surat Dokter','','akses.JPG',NULL),(8,10,'998','2021-05-20','Sakit Dengan Surat Dokter','','akses.JPG',NULL),(9,10,'998','2021-05-21','Sakit Dengan Surat Dokter','','akses.JPG',NULL),(10,10,'998','2021-05-21','Sakit Dengan Surat Dokter','','akses.JPG',NULL),(11,31,'998','2021-05-24','Sakit Dengan Surat Dokter','','akses.JPG',NULL),(12,32,'998','2021-05-25','Dinas','','akses_menu.JPG',NULL),(13,0,'998','2021-05-25','Dinas','','akses_menu.JPG',NULL),(14,32,'998','2021-05-26','Dinas','','akses_menu.JPG',NULL),(15,32,'998','2021-05-27','Sakit Dengan Surat Dokter','','akses_menu.JPG',NULL),(16,32,'998','2021-05-27','Datang Telat Kurang Dari 2 Jam','','akses_menu.JPG',NULL),(17,32,'998','2021-05-17','Datang Telat Kurang Dari 2 Jam','','akses_menu.JPG',NULL),(18,32,'998','2021-05-19','Sakit Dengan Surat Dokter','','akses_menu.JPG',NULL),(19,32,'998','2021-05-19','Sakit Tanpa Surat Dokter','','akses_menu.JPG',NULL),(20,10,'998','2021-05-19','Sakit Dengan Surat Dokter','','ops_masterplan.JPG',NULL),(21,10,'998','2021-05-21','Sakit Dengan Surat Dokter','','ajax.JPG',NULL),(22,10,'998','2021-05-19','Datang Telat Kurang Dari 2 Jam','','ajax.JPG',NULL),(23,10,'998','2021-05-20','Sakit Dengan Surat Dokter','','alur_shp.JPG',NULL),(24,10,'998','2021-05-20','Dinas','','alur_shp.JPG',NULL),(25,10,'998','2021-05-21','Sakit Dengan Surat Dokter','','2.JPG',NULL),(26,10,'998','2021-05-20','Sakit Tanpa Surat Dokter','','ajax.JPG',NULL),(27,10,'998','2021-05-24','Sakit Tanpa Surat Dokter','','ajax.JPG',NULL),(28,10,'998','2021-05-24','Datang Telat Lebih Dari 2 Jam','','ajax.JPG',NULL),(29,33,'294','2021-05-19','Sakit Dengan Surat Dokter','','ajax.JPG',NULL),(30,34,'294','2021-05-24','Datang Telat Lebih Dari 2 Jam','','ajax.JPG',NULL),(31,35,'222','2021-05-19','Dinas','','ajax.JPG',NULL),(32,1,'222','2021-05-19','Sakit Dengan Surat Dokter','','ajax.JPG',NULL),(33,3,'294','2021-05-21','Dinas','','ajax.JPG',NULL),(34,4,'294','2021-05-24','Datang Telat Lebih Dari 2 Jam','','ajax.JPG',NULL),(35,5,'294','2021-05-19','Sakit Tanpa Surat Dokter','','ajax.JPG',NULL);
/*!40000 ALTER TABLE `daterange_izin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daterange_unpaid`
--

DROP TABLE IF EXISTS `daterange_unpaid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daterange_unpaid` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `no_unpaid` varchar(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daterange_unpaid`
--

LOCK TABLES `daterange_unpaid` WRITE;
/*!40000 ALTER TABLE `daterange_unpaid` DISABLE KEYS */;
/*!40000 ALTER TABLE `daterange_unpaid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `durasitugasdinas`
--

DROP TABLE IF EXISTS `durasitugasdinas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `durasitugasdinas` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `durasi` int(11) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `durasitugasdinas`
--

LOCK TABLES `durasitugasdinas` WRITE;
/*!40000 ALTER TABLE `durasitugasdinas` DISABLE KEYS */;
/*!40000 ALTER TABLE `durasitugasdinas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historydispensasi`
--

DROP TABLE IF EXISTS `historydispensasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historydispensasi` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlahcuti` int(11) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historydispensasi`
--

LOCK TABLES `historydispensasi` WRITE;
/*!40000 ALTER TABLE `historydispensasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `historydispensasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `itung_cuti`
--

DROP TABLE IF EXISTS `itung_cuti`;
/*!50001 DROP VIEW IF EXISTS `itung_cuti`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `itung_cuti` AS SELECT 
 1 AS `username`,
 1 AS `jmlcuti`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `itung_mangkir`
--

DROP TABLE IF EXISTS `itung_mangkir`;
/*!50001 DROP VIEW IF EXISTS `itung_mangkir`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `itung_mangkir` AS SELECT 
 1 AS `username`,
 1 AS `jmlmangkir`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `itung_sdsd`
--

DROP TABLE IF EXISTS `itung_sdsd`;
/*!50001 DROP VIEW IF EXISTS `itung_sdsd`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `itung_sdsd` AS SELECT 
 1 AS `username`,
 1 AS `jmlsdsd`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `itung_stsd`
--

DROP TABLE IF EXISTS `itung_stsd`;
/*!50001 DROP VIEW IF EXISTS `itung_stsd`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `itung_stsd` AS SELECT 
 1 AS `username`,
 1 AS `jmlstsd`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `itung_unpaid`
--

DROP TABLE IF EXISTS `itung_unpaid`;
/*!50001 DROP VIEW IF EXISTS `itung_unpaid`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `itung_unpaid` AS SELECT 
 1 AS `username`,
 1 AS `jmlunpaid`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `jammasukpulang`
--

DROP TABLE IF EXISTS `jammasukpulang`;
/*!50001 DROP VIEW IF EXISTS `jammasukpulang`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `jammasukpulang` AS SELECT 
 1 AS `user_id`,
 1 AS `tgl_dan_jam`,
 1 AS `verifikasi`,
 1 AS `lokasi`,
 1 AS `jamnya`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `kalender`
--

DROP TABLE IF EXISTS `kalender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kalender` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jenis` char(15) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tambahan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`num`,`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kalender`
--

LOCK TABLES `kalender` WRITE;
/*!40000 ALTER TABLE `kalender` DISABLE KEYS */;
INSERT INTO `kalender` VALUES (1,'2020-10-08','libur','libur nasional','-'),(40,'2020-08-21','L','Cuti Bersama Tahun Baru Hijriah','Y'),(41,'2020-10-28','L','Cuti Bersama Maulid Nabi','Y'),(42,'2020-10-30','L','Cuti Bersama Maulid Nabi','Y'),(43,'2020-10-29','L','Maulid Nabi','N'),(44,'2021-02-18','L','Test Tgl Merah 1','Y'),(48,'2021-08-11','L','Libur 1 Muharram',NULL),(50,'2021-08-13','L','Hari Libur',NULL),(51,'2021-10-20','L','Maulid Nabi','N'),(52,'2021-12-25','L','Hari Natal','N');
/*!40000 ALTER TABLE `kalender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kegiatan`
--

DROP TABLE IF EXISTS `kegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kegiatan` (
  `kegiatanid` int(11) NOT NULL AUTO_INCREMENT,
  `acaraid` int(11) DEFAULT NULL,
  `lokasiid` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `tema` tinytext,
  `pembicaraid` int(11) DEFAULT NULL,
  `absen_tutup` time DEFAULT NULL,
  PRIMARY KEY (`kegiatanid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kegiatan`
--

LOCK TABLES `kegiatan` WRITE;
/*!40000 ALTER TABLE `kegiatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kegiatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `koreksiabsen`
--

DROP TABLE IF EXISTS `koreksiabsen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `koreksiabsen` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `id_absen` int(11) NOT NULL,
  `usermanager` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jammasuk` datetime NOT NULL,
  `jamkeluar` datetime NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `koreksiabsen`
--

LOCK TABLES `koreksiabsen` WRITE;
/*!40000 ALTER TABLE `koreksiabsen` DISABLE KEYS */;
/*!40000 ALTER TABLE `koreksiabsen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lemburweekend`
--

DROP TABLE IF EXISTS `lemburweekend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lemburweekend` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `project` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `no_durasi` int(11) DEFAULT NULL,
  `manager` varchar(255) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lemburweekend`
--

LOCK TABLES `lemburweekend` WRITE;
/*!40000 ALTER TABLE `lemburweekend` DISABLE KEYS */;
/*!40000 ALTER TABLE `lemburweekend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lokasi`
--

DROP TABLE IF EXISTS `lokasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lokasi` (
  `lokasiid` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi` tinytext,
  `lokasi_singkat` tinytext,
  PRIMARY KEY (`lokasiid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lokasi`
--

LOCK TABLES `lokasi` WRITE;
/*!40000 ALTER TABLE `lokasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `lokasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matrixjabatan`
--

DROP TABLE IF EXISTS `matrixjabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrixjabatan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(20) NOT NULL,
  `rupiahlembur` int(11) NOT NULL,
  `rupiahpotongan` int(11) NOT NULL,
  `lemburweekend` int(11) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matrixjabatan`
--

LOCK TABLES `matrixjabatan` WRITE;
/*!40000 ALTER TABLE `matrixjabatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `matrixjabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matrixlembur`
--

DROP TABLE IF EXISTS `matrixlembur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrixlembur` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tipelembur` varchar(5) NOT NULL,
  `Office Support` int(20) NOT NULL,
  `Staff` int(20) NOT NULL,
  `Coordinator` int(20) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matrixlembur`
--

LOCK TABLES `matrixlembur` WRITE;
/*!40000 ALTER TABLE `matrixlembur` DISABLE KEYS */;
/*!40000 ALTER TABLE `matrixlembur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matrixpotongan`
--

DROP TABLE IF EXISTS `matrixpotongan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrixpotongan` (
  `no` int(11) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `rupiah` int(11) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matrixpotongan`
--

LOCK TABLES `matrixpotongan` WRITE;
/*!40000 ALTER TABLE `matrixpotongan` DISABLE KEYS */;
/*!40000 ALTER TABLE `matrixpotongan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `namalembur`
--

DROP TABLE IF EXISTS `namalembur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `namalembur` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `nolembur` varchar(5) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id_absen` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `divisi` varchar(50) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `namalembur`
--

LOCK TABLES `namalembur` WRITE;
/*!40000 ALTER TABLE `namalembur` DISABLE KEYS */;
/*!40000 ALTER TABLE `namalembur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembicara`
--

DROP TABLE IF EXISTS `pembicara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembicara` (
  `pembicaraid` int(11) NOT NULL AUTO_INCREMENT,
  `pembicara` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`pembicaraid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembicara`
--

LOCK TABLES `pembicara` WRITE;
/*!40000 ALTER TABLE `pembicara` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembicara` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pulangcepat`
--

DROP TABLE IF EXISTS `pulangcepat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulangcepat` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pulangcepat`
--

LOCK TABLES `pulangcepat` WRITE;
/*!40000 ALTER TABLE `pulangcepat` DISABLE KEYS */;
/*!40000 ALTER TABLE `pulangcepat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranking`
--

DROP TABLE IF EXISTS `ranking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ranking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `telat` int(10) DEFAULT NULL,
  `izin` int(10) DEFAULT NULL,
  `cuti` int(10) DEFAULT NULL,
  `unpaid` int(10) DEFAULT NULL,
  `rank` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranking`
--

LOCK TABLES `ranking` WRITE;
/*!40000 ALTER TABLE `ranking` DISABLE KEYS */;
/*!40000 ALTER TABLE `ranking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tanggal_mulaiakhir`
--

DROP TABLE IF EXISTS `tanggal_mulaiakhir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tanggal_mulaiakhir` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tanggalmulai` datetime DEFAULT NULL,
  `tanggalakhir` datetime DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanggal_mulaiakhir`
--

LOCK TABLES `tanggal_mulaiakhir` WRITE;
/*!40000 ALTER TABLE `tanggal_mulaiakhir` DISABLE KEYS */;
/*!40000 ALTER TABLE `tanggal_mulaiakhir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_izin`
--

DROP TABLE IF EXISTS `tb_izin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_izin` (
  `no` varchar(5) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `dari` date NOT NULL,
  `sampai` date NOT NULL,
  `jml_hari` decimal(8,2) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `gambar` text NOT NULL,
  `persetujuan` varchar(255) NOT NULL,
  `absensoho` varchar(50) NOT NULL,
  `absentebet` varchar(50) NOT NULL,
  `cutisebelum` decimal(8,2) DEFAULT NULL,
  `cutisesudah` decimal(8,2) DEFAULT NULL,
  `jamnya` time DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `absensi_kegiatanid` int(11) DEFAULT NULL,
  `kegiatanid` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_izin`
--

LOCK TABLES `tb_izin` WRITE;
/*!40000 ALTER TABLE `tb_izin` DISABLE KEYS */;
INSERT INTO `tb_izin` VALUES ('00001','222','Andre Andrian Imam','IT','2021-05-18','2021-05-19','2021-05-19',1.00,'Sakit Dengan Surat Dokter','ajax.JPG','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('00002','222','Andre Andrian Imam','IT','2021-05-18','2021-05-20','2021-05-20',0.50,'Pulang Lebih Cepat Lebih Dari 2 Jam','ajax.JPG','','','',0.75,0.75,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('00003','294','Dewi Aprillia','FIELD B1','2021-05-18','2021-05-21','2021-05-21',1.00,'Dinas','ajax.JPG','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('00004','294','Dewi Aprillia','FIELD B1','2021-05-18','2021-05-24','2021-05-24',0.50,'Datang Telat Lebih Dari 2 Jam','ajax.JPG','','','',0.75,0.75,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('00005','294','Dewi Aprillia','FIELD B1','2021-05-18','2021-05-19','2021-05-19',1.00,'Sakit Tanpa Surat Dokter','ajax.JPG','Tidak Disetujui(Direksi)','','',2.00,2.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('00006','017','Puji Astuti','DP','2021-05-24','2021-05-24','2021-05-24',0.50,'Pulang Lebih Cepat Lebih Dari 2 Jam','ktp_test.jpg','Tidak Disetujui(Manager)','','',1.00,1.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('00007','017','Puji Astuti','DP','2021-05-24','2021-05-25','2021-05-25',0.50,'Datang Telat Lebih Dari 2 Jam','contoh_alur.jpg','','','',0.50,0.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_izin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jumlahcuti`
--

DROP TABLE IF EXISTS `tb_jumlahcuti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_jumlahcuti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuti_diperoleh` int(11) DEFAULT NULL,
  `cuti_bersama` int(11) DEFAULT NULL,
  `cuti_perbulan` decimal(8,2) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `tgl_input` date NOT NULL,
  `skb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jumlahcuti`
--

LOCK TABLES `tb_jumlahcuti` WRITE;
/*!40000 ALTER TABLE `tb_jumlahcuti` DISABLE KEYS */;
INSERT INTO `tb_jumlahcuti` VALUES (4,15,4,0.92,2021,'2021-05-21','SKB_2021_1621589572.pdf'),(5,15,2,1.08,2021,'2021-05-24','SKB_2021_1621589714.pdf');
/*!40000 ALTER TABLE `tb_jumlahcuti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_lembur`
--

DROP TABLE IF EXISTS `tb_lembur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_lembur` (
  `no` varchar(5) NOT NULL,
  `manager` varchar(100) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `nama_lembur` varchar(500) NOT NULL,
  `pengajuan` date NOT NULL,
  `tanggal_lembur` date NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `project` varchar(100) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lembur`
--

LOCK TABLES `tb_lembur` WRITE;
/*!40000 ALTER TABLE `tb_lembur` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_lembur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_mangkir`
--

DROP TABLE IF EXISTS `tb_mangkir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_mangkir` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_absen` varchar(10) NOT NULL,
  `pemotongan` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mangkir`
--

LOCK TABLES `tb_mangkir` WRITE;
/*!40000 ALTER TABLE `tb_mangkir` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_mangkir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_mohoncuti`
--

DROP TABLE IF EXISTS `tb_mohoncuti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_mohoncuti` (
  `no_cuti` varchar(5) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `hak_akses` varchar(16) NOT NULL,
  `tgl` date DEFAULT NULL,
  `dari` date DEFAULT NULL,
  `sampai` date DEFAULT NULL,
  `jml_hari` decimal(8,2) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `saldo` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `persetujuan` varchar(30) NOT NULL,
  `gambar` text NOT NULL,
  `alasan` varchar(750) NOT NULL,
  `absensoho` varchar(50) NOT NULL,
  `absentebet` varchar(50) NOT NULL,
  `cutisebelum` decimal(8,2) DEFAULT NULL,
  `cutisesudah` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`no_cuti`),
  KEY `id_mohoncuti` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mohoncuti`
--

LOCK TABLES `tb_mohoncuti` WRITE;
/*!40000 ALTER TABLE `tb_mohoncuti` DISABLE KEYS */;
INSERT INTO `tb_mohoncuti` VALUES ('00001','991','Hengki','DP','Pegawai','2018-03-12','2018-03-09','2018-03-09',1.00,'Tahunan','','Serah terima pekerjaan: ATM Center Phytagoras dengan Asmalasari. \r\nAlasan Cuti: Ada Urusan keluarga. \r\nNB: Pengajuan sebelumnya hilang. ','Disetujui(Direksi)','IMG_20180308_173922_HDR.jpg','','','',NULL,NULL),('00002','Era','Eraninta Sembiring','RE B1','Manager','2018-03-12','2018-03-13','2018-03-15',3.00,'Cuti Kemat','Umum','','Disetujui(Direksi)','7f4af734-3864-4715-9e71-e31d40590750.jpg','','','',NULL,NULL),('00003','dedesoleman','Dede Soleman','IT','Manager','2018-03-13','2018-03-13','2018-03-13',1.00,'Tahunan','','Pulang ke tegal, nemenin istri ke rumah sakit','Disetujui(Manager)','1520914996073-256586147.jpg','','','',NULL,NULL),('00004','RetnoGumelar','Retno Gumelar','RE B2','Pegawai','2018-03-19','2018-03-23','2018-03-23',1.00,'Tahunan','','Acara keluarga','Disetujui(Manager)','cuti maret.jpg','','','',NULL,NULL),('00005','919','Roby Handoyo','IT','Manager','2018-03-20','2018-03-20','2018-03-20',1.00,'Tahunan','','Mengurus orang tua operasi','Disetujui(Direksi)','IMG_20180320_084154.jpg','','','',NULL,NULL),('00006','RetnoGumelar','Retno Gumelar','RE B2','Pegawai','2018-03-21','2018-03-22','2018-03-22',1.00,'Tahunan','','Acara Kelaurga','Disetujui(Manager)','cuti 22 maret.jpg','','','',NULL,NULL),('00007','hudi','M Hudi','Driver','Pegawai','2018-03-22','2018-03-23','2018-03-26',2.00,'Tahunan','','','Disetujui(Direksi)','','','','',NULL,NULL),('00008','157','Harianti UDC','checker','Pegawai','2018-03-23','2018-03-23','2018-03-23',1.00,'Tahunan','','Izin tidak masuk karena anak sakit','','20180321_111500.jpg','','','',NULL,NULL),('00010','dedesoleman','Dede Soleman','IT','Pegawai','2018-04-02','2018-04-02','2018-04-02',1.00,'Tahunan','','Cuti Nemenin Ibu di Rumah sakit','Disetujui(Manager)','IMG_20180402_093023.jpg','','','',NULL,NULL),('00011','Accounting','Dewi Marpaung','FINANCE','Manager','2018-04-03','2018-04-06','2018-04-06',1.00,'Tahunan','','Keperluan Pribadi','Disetujui(Direksi)','Cuti-Dewi.jpeg','','','',NULL,NULL),('00012','Melinda Fatmawati','Melinda Fatmawati','FINANCE','Pegawai','2018-04-03','2018-04-20','2018-04-23',2.00,'Tahunan','','Izin cuti untuk acara pernikahan saudara di luar kota.','Disetujui(Direksi)','Form Serah Terima Pekerjaan..jpg','','','',NULL,NULL),('00013','919','Roby Handoyo','IT','Manager','2018-04-04','2018-04-04','2018-04-04',1.00,'Tahunan','','Mengurus anak ke rumah sakit','Disetujui(Direksi)','IMG_20180404_090149_HDR.jpg','','','',NULL,NULL),('00014','Suci','Suci Indah Sari','UDC','Pegawai','2018-04-05','2018-04-06','2018-04-06',1.00,'Tahunan','','Ada keperluan ','','15229129496941321370443.jpg','','','',NULL,NULL),('00015','Amel','Amelia Yuli Revinda','FIELD B1','Pegawai','2018-04-10','2018-04-12','2018-04-13',2.00,'Tahunan','','Ambil sisa cuti 2016','Tidak Disetujui(Direksi)','15233510024211859496029.jpg','','','',NULL,NULL),('00016','971','Siti Yulianti','CKK','Pegawai','2018-04-11','2018-04-11','2018-04-11',1.00,'Tahunan','','Sakit kepala jadi tidak bisa kerja','','20180411_080833.jpg','','','',NULL,NULL),('00017','Amel','Amelia Yuli Revinda','FIELD B1','Pegawai','2018-04-12','2018-04-13','2018-04-16',2.00,'Tahunan','','ambil sisa cuti 2017','','Form Cuti Amelia.jpeg','','','',NULL,NULL),('00018','adam','Muhammad Adam Santoso','ITDP','Pegawai','2020-10-27','2020-08-21','2020-08-21',1.00,'Tahunan','','Cuti Bersama','','','','','',NULL,NULL),('00019','998','Hendra','DP','Manager','2021-05-17','2021-05-19','2021-05-19',1.00,'Tahunan','','Keperluan xxx','','w-7.png','','','',NULL,NULL),('00020','998','Hendra','DP','Manager','2021-05-17','2021-05-21','2021-05-21',1.00,'Tahun Lalu','','Test cuti tahun lalu 1','','w-7.png','','','',2.00,0.00),('00021','222','Andre Andrian Imam','IT','Pegawai','2021-05-17','2021-05-18','2021-05-18',1.00,'Tahunan','','Tes cuti tahunan','','w-7.png','','','',NULL,NULL),('00022','998','Hendra','DP','Manager','2021-05-17','2021-05-26','2021-05-26',1.00,'Tahun Lalu','','Tes cuti tahun lalu 2','','w-7.png','','','',1.00,0.00),('00023','998','Hendra','DP','Manager','2021-05-17','2021-05-24','2021-05-24',1.00,'Tahun Lalu','','Tes cuti tahun lalu 3','','w-7.png','','','',3.00,2.00),('00024','998','Hendra','DP','Manager','2021-05-17','2021-05-27','2021-05-28',2.00,'Tahun Lalu','','Tes cuti tahun lalu 4','','w-7.png','','','',3.00,1.00),('00025','222','Andre Andrian Imam','IT','Pegawai','2021-05-17','2021-05-19','2021-05-20',2.00,'Tahunan','','Tes cuti tahunan 2 hari','','w-7.png','','','',NULL,NULL),('00026','222','Andre Andrian Imam','IT','Pegawai','2021-05-17','2021-05-18','2021-05-19',2.00,'Tahunan','','Test cuti tahunan 11','','file_sk.JPG','','','',NULL,NULL),('00027','998','Hendra','DP','Manager','2021-05-17','2021-05-18','2021-05-18',1.00,'Tahunan','','Pengujian cuti tahunan','','change_pass.JPG','','','',1.75,0.75),('00028','991','Hengki','DP','Pegawai','2021-05-17','2021-05-18','2021-05-18',1.00,'Tahunan','','Test cuti tahunan','Tidak Disetujui(Manager)','detail_jobdesc.JPG','Kureng','','',2.00,2.00),('00030','222','Andre Andrian Imam','IT','Pegawai','2021-05-17','2021-05-18','2021-05-18',1.00,'Tahunan','','Pengujian permohonan cuti tahunan','Disetujui(Direksi)','insert_menu_.JPG','','','',1.75,0.75),('00031','222','Andre Andrian Imam','IT','Pegawai','2021-05-17','2021-05-18','2021-05-18',1.00,'Tahun Lalu','','TEST PERMOHONAN CUTI TAHUN LALU','Tidak Disetujui(Direksi)','karyawan_view_jobdesc.JPG','Kurang','','',2.00,2.00);
/*!40000 ALTER TABLE `tb_mohoncuti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pegawai`
--

DROP TABLE IF EXISTS `tb_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_pegawai` (
  `nip` varchar(50) NOT NULL DEFAULT '',
  `nama` varchar(64) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `jab` varchar(32) NOT NULL,
  `tmp_lhr` varchar(32) NOT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `gol_darah` varchar(2) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `status` varchar(2) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` varchar(512) NOT NULL,
  `hak_cuti_tahunan` decimal(8,2) NOT NULL,
  `hak_cuti_tahunlalu` decimal(8,2) NOT NULL,
  `hak_cuti_dispensasi` decimal(8,2) NOT NULL,
  `nik` varchar(100) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `tgl_habis_kontrak` date DEFAULT NULL,
  `hak_cuti_tahunlalu_backup` decimal(8,2) NOT NULL,
  PRIMARY KEY (`nip`),
  UNIQUE KEY `Unique` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pegawai`
--

LOCK TABLES `tb_pegawai` WRITE;
/*!40000 ALTER TABLE `tb_pegawai` DISABLE KEYS */;
INSERT INTO `tb_pegawai` VALUES ('017','Puji Astuti','DP','','','',NULL,'','','','','',6.49,0.00,0.00,NULL,'2020-05-11',NULL,'2021-07-16',0.00),('020','Ivanna yesika pattikayhatu','RE B1','','','',NULL,'','','','','',5.99,1.50,0.00,NULL,'2020-05-04',NULL,NULL,0.00),('141','Hanna Rotua','checker','','','',NULL,'','','','','',2.25,0.00,0.00,NULL,'2020-05-10',NULL,'2021-05-16',0.00),('144','Retno Ningsih UDC','checker','','','',NULL,'','','','','',0.75,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('154','Rini Triana','checker','','','',NULL,'','','','','',2.25,2.50,0.00,NULL,NULL,NULL,NULL,0.00),('157','Harianti UDC','checker','','','',NULL,'','','','','',2.25,4.00,0.00,NULL,NULL,NULL,NULL,0.00),('159','Ika Hendarwati','FIELD B1','','','',NULL,'','','','','',2.25,1.00,0.00,NULL,NULL,NULL,NULL,0.00),('222','Andre Andrian Imam','IT','','','',NULL,'','','','','',0.75,1.00,0.00,NULL,NULL,NULL,NULL,0.00),('294','Dewi Aprillia','FIELD B1','','','',NULL,'','','','','',1.75,1.00,0.00,NULL,NULL,NULL,NULL,0.00),('656','Yenni Irawan','RE B1','','','',NULL,'','','','','',2.25,2.00,0.00,NULL,NULL,NULL,NULL,0.00),('919','Roby Handoyo','IT','','','',NULL,'','','','','',2.25,5.00,0.00,NULL,NULL,NULL,NULL,0.00),('935','Sukanti','Field MS','','','',NULL,'','','','','',2.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('945','Hairani','DP','','','',NULL,'','','','','',2.25,3.00,0.00,NULL,NULL,NULL,NULL,0.00),('966','Mala','DP','','','',NULL,'','','','','',2.25,1.00,0.00,NULL,NULL,NULL,NULL,0.00),('969','Ayu','DP','','','',NULL,'','','','','',2.25,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('971','Siti Yulianti','CKK','','','',NULL,'','','','','',2.25,2.50,0.00,NULL,NULL,NULL,NULL,0.00),('972','Evi Susilawaty','CKK','','','',NULL,'','','','','',2.25,1.00,0.00,NULL,NULL,NULL,NULL,0.00),('976','Ardhya','UDC','','','',NULL,'','','','','',2.25,4.00,0.00,NULL,NULL,NULL,NULL,0.00),('987','Apry','DP','','','',NULL,'','','','','',2.25,0.50,0.00,NULL,NULL,NULL,NULL,0.00),('989','Eka Rivia Sakti','RE B1','','','',NULL,'','','','','',1.25,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('991','Hengki','DP','','','',NULL,'','','','','',2.25,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('998','Hendra','DP','','','',NULL,'','','','','',0.75,0.50,0.00,NULL,NULL,NULL,NULL,0.00),('Accounting','Dewi Marpaung','FINANCE','','','',NULL,'','','','','',2.25,6.00,0.00,NULL,NULL,NULL,NULL,0.00),('Amel','Amelia Yuli Revinda','FIELD B1','','','',NULL,'','','','','',2.25,3.00,0.00,NULL,NULL,NULL,NULL,0.00),('armansyah','Armansyah','E-BANKING','','','',NULL,'','','','','',2.25,1.00,0.00,NULL,NULL,NULL,NULL,0.00),('Ary','Ary Widiyanti','FIELD B2','','','',NULL,'','','','','',0.75,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('benjo','Benjo Valentino Jagger','Marketing','','','',NULL,'','','','','',2.25,6.00,0.00,NULL,NULL,NULL,NULL,0.00),('dedesoleman','Dede Soleman','IT','','','',NULL,'','','','','',2.25,1.00,0.00,NULL,NULL,NULL,NULL,0.00),('Dian','Dian Atikah','E-BANKING','','','',NULL,'','','','','',0.75,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('DyahDewi','Dyah Dewi Arumi','FIELD B1','','','',NULL,'','','','','',2.25,3.00,0.00,NULL,NULL,NULL,NULL,0.00),('Era','Eraninta Sembiring','RE B1','','','',NULL,'','','','','',1.25,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('farid','Farid Nuranshory','RE B2','','','',NULL,'','','','','',0.75,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('Fifit','Fifit Safitri','HC','','','',NULL,'','','','','',0.75,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('hudi','M Hudi','Driver','','','',NULL,'','','','','',2.25,2.00,0.00,NULL,NULL,NULL,NULL,0.00),('ibenk','Bambang Agus Surono','FIELD B1','','','',NULL,'','','','','',2.25,1.00,0.00,NULL,NULL,NULL,NULL,0.00),('Jaury','Jaury Jihanes P Tehupeiory','IT','','','',NULL,'','','','','',0.75,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('Lya','Kharisma Aprillya','E-BANKING','','','',NULL,'','','','','',2.25,5.00,0.00,NULL,NULL,NULL,NULL,0.00),('mallani','Mallani','Field B1','','','',NULL,'','','','','',2.25,7.00,0.00,NULL,NULL,NULL,NULL,0.00),('meinariclaudia','Meinari Claudia Mamengko','RE B2','','','',NULL,'','','','','',2.25,6.00,0.00,NULL,NULL,NULL,NULL,0.00),('Melinda Fatmawati','Melinda Fatmawati','FINANCE','','','',NULL,'','','','','',1.25,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('RetnoGumelar','Retno Gumelar','RE B2','','','',NULL,'','','','','',1.25,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('riandi','Riandi Mando','RE B2','','','',NULL,'','','','','',2.25,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('Ribka','Ribka Amanda','RE B2','','','',NULL,'','','','','',2.25,6.00,0.00,NULL,NULL,NULL,NULL,0.00),('Selly2509','Selly Maris Stella Napitupulu','MARKETING','','','',NULL,'','','','','',0.75,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('siswanto','Siswanto','Driver','','','',NULL,'','','','','',0.75,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('Siti Zuraidah','Siti Zuraidah','AUVIQ','','','',NULL,'','','','','',0.75,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('Sony','Sony Apriawan','AUVIQ','','','',NULL,'','','','','',2.25,2.00,0.00,NULL,NULL,NULL,NULL,0.00),('Suci','Suci Indah Sari','UDC','','','',NULL,'','','','','',2.25,5.00,0.00,NULL,NULL,NULL,NULL,0.00),('suparman','Suparman','OB','','','',NULL,'','','','','',2.25,0.00,0.00,NULL,NULL,NULL,NULL,0.00),('Tiyas','Priyati Cahyaningtiyas','FIELD B1','','','',NULL,'','','','','',0.75,0.00,0.00,NULL,NULL,NULL,NULL,0.00);
/*!40000 ALTER TABLE `tb_pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_potongmangkir`
--

DROP TABLE IF EXISTS `tb_potongmangkir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_potongmangkir` (
  `no` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `id_absen` varchar(10) NOT NULL,
  `pemotongan` int(11) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_potongmangkir`
--

LOCK TABLES `tb_potongmangkir` WRITE;
/*!40000 ALTER TABLE `tb_potongmangkir` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_potongmangkir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_setengahhari`
--

DROP TABLE IF EXISTS `tb_setengahhari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_setengahhari` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktudatang` time NOT NULL,
  `menitterlambat` int(11) NOT NULL,
  `potongcuti` int(11) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_setengahhari`
--

LOCK TABLES `tb_setengahhari` WRITE;
/*!40000 ALTER TABLE `tb_setengahhari` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_setengahhari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_unpaid`
--

DROP TABLE IF EXISTS `tb_unpaid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_unpaid` (
  `no` varchar(5) NOT NULL,
  `nama_manager` varchar(100) NOT NULL,
  `nip_karyawan` varchar(100) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `pengajuan` date NOT NULL,
  `dari` date NOT NULL,
  `sampai` date NOT NULL,
  `jml_hari` int(11) NOT NULL,
  `keterangan` varchar(300) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `cutisebelum` decimal(8,2) DEFAULT NULL,
  `cutisesudah` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_unpaid`
--

LOCK TABLES `tb_unpaid` WRITE;
/*!40000 ALTER TABLE `tb_unpaid` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_unpaid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_user` (
  `no_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(30) NOT NULL,
  `nama_user` varchar(64) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` varchar(16) NOT NULL,
  `aktif` varchar(1) NOT NULL,
  `absensoho` varchar(50) NOT NULL,
  `absentebet` varchar(50) NOT NULL,
  `iduser` varchar(50) NOT NULL,
  `id_absen` varchar(50) NOT NULL,
  `resign` varchar(50) DEFAULT '0',
  `level` varchar(50) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `div2` varchar(50) DEFAULT NULL,
  `mitra` varchar(1) DEFAULT NULL,
  `izinbackdate` int(11) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `tglresign` date DEFAULT NULL,
  `harian` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`no_user`),
  UNIQUE KEY `Unique` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` VALUES (1,'001','Ina Puspito','Direksi','','HRD','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'017','Puji Astuti','DP','12345','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'020','Ivanna yesika pattikayhatu','RE B1','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'141','Hanna Rotua','checker','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'144','Retno Ningsih UDC','checker','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'154','Rini Triana','checker','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'157','Harianti UDC','checker','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'159','Ika Hendarwati','FIELD B1','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'222','Andre Andrian Imam','IT','12345','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'294','Dewi Aprillia','FIELD B1','12345','Manager','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'656','Yenni Irawan','RE B1','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'919','Roby Handoyo','IT','','Manager','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'935','Sukanti','Field MS','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'945','Hairani','DP','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'966','Mala','DP','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'969','Ayu','DP','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'971','Siti Yulianti','CKK','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'972','Evi Susilawaty','CKK','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'976','Ardhya','UDC','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,'987','Apry','DP','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'989','Eka Rivia Sakti','RE B1','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'991','Hengki','DP','12345','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,'998','Hendra','DP','12345','Manager','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,'Accounting','Dewi Marpaung','FINANCE','','Manager','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,'admin','Andi Hatmoko','Direksi','12345','HRD','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'Amel','Amelia Yuli Revinda','FIELD B1','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,'armansyah','Armansyah','E-BANKING','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,'Ary','Ary Widiyanti','FIELD B2','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,'benjo','Benjo Valentino Jagger','Marketing','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,'dedesoleman','Dede Soleman','IT','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,'Dian','Dian Atikah','E-BANKING','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,'dummy','dummy','Direksi','12345','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,'DyahDewi','Dyah Dewi Arumi','FIELD B1','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,'Era','Eraninta Sembiring','RE B1','','Manager','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,'farid','Farid Nuranshory','RE B2','','Manager','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,'Field','Nurhayati','FIELD B1','','Pegawai','N','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,'Fifit','Fifit Safitri','HC','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,'hrd','Najwa','','12345','HRD','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,'hudi','M Hudi','Driver','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,'ibenk','Bambang Agus Surono','FIELD B1','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,'Iin minati','Iin Minati','FINANCE','','Pegawai','N','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,'Indira','Indira Eka Melia Wardhani','RE B1','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(43,'Jaury','Jaury Jihanes P Tehupeiory','IT','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(44,'Lya','Kharisma Aprillya','E-BANKING','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(45,'mallani','Mallani','Field B1','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(46,'meinariclaudia','Meinari Claudia Mamengko','RE B2','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(47,'Melinda Fatmawati','Melinda Fatmawati','FINANCE','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(48,'RetnoGumelar','Retno Gumelar','RE B2','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(49,'riandi','Riandi Mando','RE B2','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(50,'Ribka','Ribka Amanda','RE B2','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(51,'Selly2509','Selly Maris Stella Napitupulu','MARKETING','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(52,'siswanto','Siswanto','Driver','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(53,'Siti Zuraidah','Siti Zuraidah','AUVIQ','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(54,'Sony','Sony Apriawan','AUVIQ','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(55,'stella','Stella Olivia Durandt','SECRETARY','','Pegawai','N','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(56,'Suci','Suci Indah Sari','UDC','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(57,'sudhagama','Azico Sudhagama','RE B1','','Pegawai','N','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,'suparman','Suparman','OB','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(59,'thedyhermawan','Tedi Hermawan','IT','','Pegawai','N','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(60,'Tiyas','Priyati Cahyaningtiyas','FIELD B1','','Pegawai','Y','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(61,'Winda Andini','Winda Andini','FINANCE','','Pegawai','N','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(62,'Zulkifli','Muhammad Zulkifly Supardi','RE B1','','Pegawai','N','','','','','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user_andre`
--

DROP TABLE IF EXISTS `tb_user_andre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_user_andre` (
  `no_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(30) NOT NULL,
  `nama_user` varchar(64) NOT NULL,
  `mesin_soho` char(5) NOT NULL,
  `mesin_tebet` char(5) NOT NULL,
  PRIMARY KEY (`no_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user_andre`
--

LOCK TABLES `tb_user_andre` WRITE;
/*!40000 ALTER TABLE `tb_user_andre` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_user_andre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user_backup`
--

DROP TABLE IF EXISTS `tb_user_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_user_backup` (
  `id_user` varchar(30) NOT NULL,
  `nama_user` varchar(64) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` varchar(16) NOT NULL,
  `aktif` varchar(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user_backup`
--

LOCK TABLES `tb_user_backup` WRITE;
/*!40000 ALTER TABLE `tb_user_backup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_user_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timesheet`
--

DROP TABLE IF EXISTS `timesheet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timesheet` (
  `noid` int(11) NOT NULL AUTO_INCREMENT,
  `no_pkj` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `kegiatan` varchar(200) NOT NULL,
  `tanggal_aja` date NOT NULL,
  `jam` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `durasi` time NOT NULL,
  `job` varchar(100) NOT NULL,
  `non_project` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `lokasi_lain` varchar(100) NOT NULL,
  PRIMARY KEY (`noid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timesheet`
--

LOCK TABLES `timesheet` WRITE;
/*!40000 ALTER TABLE `timesheet` DISABLE KEYS */;
/*!40000 ALTER TABLE `timesheet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userinfo` (
  `USERID` int(11) NOT NULL AUTO_INCREMENT,
  `Badgenumber` varchar(24) NOT NULL,
  `Name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`USERID`),
  UNIQUE KEY `Badgenumber` (`Badgenumber`)
) ENGINE=MyISAM AUTO_INCREMENT=324 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_absen`
--

DROP TABLE IF EXISTS `v_absen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `v_absen` (
  `absensi_kegiatanid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_absen`
--

LOCK TABLES `v_absen` WRITE;
/*!40000 ALTER TABLE `v_absen` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_absen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `v_monthly_report`
--

DROP TABLE IF EXISTS `v_monthly_report`;
/*!50001 DROP VIEW IF EXISTS `v_monthly_report`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_monthly_report` AS SELECT 
 1 AS `USERID`,
 1 AS `name`,
 1 AS `tanggal`,
 1 AS `maximum`,
 1 AS `tanggalonly`,
 1 AS `1`,
 1 AS `2`,
 1 AS `3`,
 1 AS `4`,
 1 AS `5`,
 1 AS `6`,
 1 AS `7`,
 1 AS `8`,
 1 AS `9`,
 1 AS `10`,
 1 AS `11`,
 1 AS `12`,
 1 AS `13`,
 1 AS `14`,
 1 AS `15`,
 1 AS `16`,
 1 AS `17`,
 1 AS `18`,
 1 AS `19`,
 1 AS `20`,
 1 AS `21`,
 1 AS `22`,
 1 AS `23`,
 1 AS `24`,
 1 AS `25`,
 1 AS `26`,
 1 AS `27`,
 1 AS `28`,
 1 AS `29`,
 1 AS `30`,
 1 AS `31`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_timesheet`
--

DROP TABLE IF EXISTS `v_timesheet`;
/*!50001 DROP VIEW IF EXISTS `v_timesheet`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_timesheet` AS SELECT 
 1 AS `noid`,
 1 AS `no_pkj`,
 1 AS `id_user`,
 1 AS `name`,
 1 AS `divisi`,
 1 AS `kegiatan`,
 1 AS `tanggal_aja`,
 1 AS `jam`,
 1 AS `jam_selesai`,
 1 AS `durasi`,
 1 AS `job`,
 1 AS `non_project`,
 1 AS `lokasi`,
 1 AS `lokasi_lain`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vcheckin`
--

DROP TABLE IF EXISTS `vcheckin`;
/*!50001 DROP VIEW IF EXISTS `vcheckin`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vcheckin` AS SELECT 
 1 AS `USERID`,
 1 AS `Tgl`,
 1 AS `CheckIn`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `video` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tanggalupload` date NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `view_tedi`
--

DROP TABLE IF EXISTS `view_tedi`;
/*!50001 DROP VIEW IF EXISTS `view_tedi`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `view_tedi` AS SELECT 
 1 AS `nama`,
 1 AS `id_absen`,
 1 AS `user_id`,
 1 AS `JamMasuk`,
 1 AS `JamKeluar`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `absensi01`
--

/*!50001 DROP VIEW IF EXISTS `absensi01`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `absensi01` AS select cast(`absensi`.`tgl_dan_jam` as date) AS `tanggal`,`absensi`.`user_id` AS `user_id`,min(`absensi`.`tgl_dan_jam`) AS `Masuk`,max(`absensi`.`tgl_dan_jam`) AS `Keluar`,`tanggal_mulaiakhir`.`tanggalmulai` AS `tanggalmulai`,`tanggal_mulaiakhir`.`tanggalakhir` AS `tanggalakhir` from (`absensi` join `tanggal_mulaiakhir`) where ((`absensi`.`tgl_dan_jam` >= `tanggal_mulaiakhir`.`tanggalmulai`) and (`absensi`.`tgl_dan_jam` <= `tanggal_mulaiakhir`.`tanggalakhir`)) group by cast(`absensi`.`tgl_dan_jam` as date),`absensi`.`user_id` order by cast(`absensi`.`tgl_dan_jam` as date),`absensi`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `absensi02`
--

/*!50001 DROP VIEW IF EXISTS `absensi02`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `absensi02` AS select `absensi01`.`tanggal` AS `tanggal`,`absensi01`.`user_id` AS `user_id`,cast(`absensi01`.`Masuk` as time) AS `Masuk`,cast(`absensi01`.`Keluar` as time) AS `Keluar`,timediff(`absensi01`.`Keluar`,`absensi01`.`Masuk`) AS `jam_kerja` from `absensi01` where ((cast(`absensi01`.`Masuk` as time) <= '08:30:00') and (timediff(`absensi01`.`Keluar`,`absensi01`.`Masuk`) >= '09:00:00')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `absensi03`
--

/*!50001 DROP VIEW IF EXISTS `absensi03`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `absensi03` AS select `absensi02`.`user_id` AS `user_id`,`tb_user`.`id_user` AS `username`,count(0) AS `JumMasukTdkTelat`,sum(`absensi02`.`jam_kerja`) AS `tot_jam_kerja` from (`absensi02` join `tb_user` on((`absensi02`.`user_id` = `tb_user`.`id_absen`))) group by `absensi02`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `itung_cuti`
--

/*!50001 DROP VIEW IF EXISTS `itung_cuti`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `itung_cuti` AS select `absensi03`.`username` AS `username`,count(`daterange_cuti`.`no`) AS `jmlcuti` from ((`daterange_cuti` join `absensi03` on((`daterange_cuti`.`username` = `absensi03`.`username`))) join `tanggal_mulaiakhir`) where ((`daterange_cuti`.`tanggal` >= `tanggal_mulaiakhir`.`tanggalmulai`) and (`daterange_cuti`.`tanggal` <= `tanggal_mulaiakhir`.`tanggalakhir`)) group by `absensi03`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `itung_mangkir`
--

/*!50001 DROP VIEW IF EXISTS `itung_mangkir`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `itung_mangkir` AS select `absensi03`.`username` AS `username`,count(`tb_mangkir`.`no`) AS `jmlmangkir` from ((`tb_mangkir` join `absensi03` on((`tb_mangkir`.`username` = `absensi03`.`username`))) join `tanggal_mulaiakhir`) where ((`tb_mangkir`.`tanggal` >= `tanggal_mulaiakhir`.`tanggalmulai`) and (`tb_mangkir`.`tanggal` <= `tanggal_mulaiakhir`.`tanggalakhir`)) group by `absensi03`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `itung_sdsd`
--

/*!50001 DROP VIEW IF EXISTS `itung_sdsd`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `itung_sdsd` AS select `absensi03`.`username` AS `username`,count(`daterange_izin`.`no`) AS `jmlsdsd` from ((`daterange_izin` join `absensi03` on((`daterange_izin`.`username` = `absensi03`.`username`))) join `tanggal_mulaiakhir`) where ((`daterange_izin`.`jenis` = 'Sakit Dengan Surat Dokter') and (`daterange_izin`.`tanggal` >= `tanggal_mulaiakhir`.`tanggalmulai`) and (`daterange_izin`.`tanggal` <= `tanggal_mulaiakhir`.`tanggalakhir`)) group by `absensi03`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `itung_stsd`
--

/*!50001 DROP VIEW IF EXISTS `itung_stsd`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `itung_stsd` AS select `absensi03`.`username` AS `username`,count(`daterange_izin`.`no`) AS `jmlstsd` from ((`daterange_izin` join `absensi03` on((`daterange_izin`.`username` = `absensi03`.`username`))) join `tanggal_mulaiakhir`) where ((`daterange_izin`.`jenis` = 'Sakit Tanpa Surat Dokter') and (`daterange_izin`.`tanggal` >= `tanggal_mulaiakhir`.`tanggalmulai`) and (`daterange_izin`.`tanggal` <= `tanggal_mulaiakhir`.`tanggalakhir`)) group by `absensi03`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `itung_unpaid`
--

/*!50001 DROP VIEW IF EXISTS `itung_unpaid`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `itung_unpaid` AS select `absensi03`.`username` AS `username`,count(`daterange_unpaid`.`no`) AS `jmlunpaid` from ((`daterange_unpaid` join `absensi03` on((`daterange_unpaid`.`username` = `absensi03`.`username`))) join `tanggal_mulaiakhir`) where ((`daterange_unpaid`.`tanggal` >= `tanggal_mulaiakhir`.`tanggalmulai`) and (`daterange_unpaid`.`tanggal` <= `tanggal_mulaiakhir`.`tanggalakhir`)) group by `absensi03`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `jammasukpulang`
--

/*!50001 DROP VIEW IF EXISTS `jammasukpulang`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `jammasukpulang` AS select `absensi`.`user_id` AS `user_id`,`absensi`.`tgl_dan_jam` AS `tgl_dan_jam`,`absensi`.`verifikasi` AS `verifikasi`,`absensi`.`lokasi` AS `lokasi`,`absensi`.`jamnya` AS `jamnya` from `absensi` group by cast(`absensi`.`tgl_dan_jam` as date) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_monthly_report`
--

/*!50001 DROP VIEW IF EXISTS `v_monthly_report`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_monthly_report` AS select `a`.`USERID` AS `USERID`,`a`.`Name` AS `name`,`b`.`CHECKTIME` AS `tanggal`,max(cast(`b`.`CHECKTIME` as time)) AS `maximum`,cast(`b`.`CHECKTIME` as date) AS `tanggalonly`,(case when (dayofmonth(`b`.`CHECKTIME`) = 1) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `1`,(case when (dayofmonth(`b`.`CHECKTIME`) = 2) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `2`,(case when (dayofmonth(`b`.`CHECKTIME`) = 3) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `3`,(case when (dayofmonth(`b`.`CHECKTIME`) = 4) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `4`,(case when (dayofmonth(`b`.`CHECKTIME`) = 5) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `5`,(case when (dayofmonth(`b`.`CHECKTIME`) = 6) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `6`,(case when (dayofmonth(`b`.`CHECKTIME`) = 7) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `7`,(case when (dayofmonth(`b`.`CHECKTIME`) = 8) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `8`,(case when (dayofmonth(`b`.`CHECKTIME`) = 9) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `9`,(case when (dayofmonth(`b`.`CHECKTIME`) = 10) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `10`,(case when (dayofmonth(`b`.`CHECKTIME`) = 11) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `11`,(case when (dayofmonth(`b`.`CHECKTIME`) = 12) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `12`,(case when (dayofmonth(`b`.`CHECKTIME`) = 13) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `13`,(case when (dayofmonth(`b`.`CHECKTIME`) = 14) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `14`,(case when (dayofmonth(`b`.`CHECKTIME`) = 15) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `15`,(case when (dayofmonth(`b`.`CHECKTIME`) = 16) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `16`,(case when (dayofmonth(`b`.`CHECKTIME`) = 17) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `17`,(case when (dayofmonth(`b`.`CHECKTIME`) = 18) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `18`,(case when (dayofmonth(`b`.`CHECKTIME`) = 19) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `19`,(case when (dayofmonth(`b`.`CHECKTIME`) = 20) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `20`,(case when (dayofmonth(`b`.`CHECKTIME`) = 21) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `21`,(case when (dayofmonth(`b`.`CHECKTIME`) = 22) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `22`,(case when (dayofmonth(`b`.`CHECKTIME`) = 23) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `23`,(case when (dayofmonth(`b`.`CHECKTIME`) = 24) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `24`,(case when (dayofmonth(`b`.`CHECKTIME`) = 25) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `25`,(case when (dayofmonth(`b`.`CHECKTIME`) = 26) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `26`,(case when (dayofmonth(`b`.`CHECKTIME`) = 27) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `27`,(case when (dayofmonth(`b`.`CHECKTIME`) = 28) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `28`,(case when (dayofmonth(`b`.`CHECKTIME`) = 29) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `29`,(case when (dayofmonth(`b`.`CHECKTIME`) = 30) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `30`,(case when (dayofmonth(`b`.`CHECKTIME`) = 31) then (case when (dayofmonth(`b`.`CHECKTIME`) is not null) then cast(`b`.`CHECKTIME` as time) else 'X' end) end) AS `31` from (`userinfo` `a` join `checkinout` `b` on((`a`.`USERID` = `b`.`USERID`))) group by `b`.`CHECKTIME` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_timesheet`
--

/*!50001 DROP VIEW IF EXISTS `v_timesheet`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jayatta`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `v_timesheet` AS select `timesheet`.`noid` AS `noid`,`timesheet`.`no_pkj` AS `no_pkj`,`timesheet`.`id_user` AS `id_user`,`timesheet`.`name` AS `name`,`timesheet`.`divisi` AS `divisi`,`timesheet`.`kegiatan` AS `kegiatan`,`timesheet`.`tanggal_aja` AS `tanggal_aja`,`timesheet`.`jam` AS `jam`,`timesheet`.`jam_selesai` AS `jam_selesai`,`timesheet`.`durasi` AS `durasi`,`timesheet`.`job` AS `job`,`timesheet`.`non_project` AS `non_project`,`timesheet`.`lokasi` AS `lokasi`,`timesheet`.`lokasi_lain` AS `lokasi_lain` from `timesheet` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vcheckin`
--

/*!50001 DROP VIEW IF EXISTS `vcheckin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vcheckin` AS select `checkinout`.`USERID` AS `USERID`,cast(`checkinout`.`CHECKTIME` as date) AS `Tgl`,min(`checkinout`.`CHECKTIME`) AS `CheckIn` from `checkinout` group by `checkinout`.`USERID`,cast(`checkinout`.`CHECKTIME` as date) order by cast(`checkinout`.`CHECKTIME` as date),`checkinout`.`USERID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_tedi`
--

/*!50001 DROP VIEW IF EXISTS `view_tedi`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`mri`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_tedi` AS select `tb_user`.`nama_user` AS `nama`,`tb_user`.`id_absen` AS `id_absen`,`absensi`.`user_id` AS `user_id`,min(`absensi`.`tgl_dan_jam`) AS `JamMasuk`,max(`absensi`.`tgl_dan_jam`) AS `JamKeluar` from (`tb_user` join `absensi`) where ((`tb_user`.`id_absen` = `absensi`.`user_id`) and (cast(`absensi`.`tgl_dan_jam` as date) between '2019-06-21' and '2019-06-21')) group by `absensi`.`user_id` order by `tb_user`.`nama_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-22 11:56:17
