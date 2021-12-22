-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: 192.168.8.2    Database: jay2
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
-- Table structure for table `atmcenter`
--

DROP TABLE IF EXISTS `atmcenter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atmcenter` (
  `num` int(6) NOT NULL AUTO_INCREMENT,
  `project` varchar(24) DEFAULT NULL,
  `cabang` varchar(4) DEFAULT NULL,
  `nomesin` varchar(25) DEFAULT NULL,
  `namacabang` varchar(128) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `weekend_siang` varchar(50) DEFAULT NULL,
  `shp_weekend_siang` varchar(50) DEFAULT NULL,
  `tgl_weekend_siang` date DEFAULT NULL,
  `nomesin_weekend_siang` varchar(255) DEFAULT NULL,
  `status_weekend_siang` tinyint(1) DEFAULT NULL,
  `noform_weekend_siang` varchar(25) DEFAULT NULL,
  `weekend_malam` varchar(50) DEFAULT NULL,
  `shp_weekend_malam` varchar(50) DEFAULT NULL,
  `tgl_weekend_malam` date DEFAULT NULL,
  `nomesin_weekend_malam` varchar(50) DEFAULT NULL,
  `status_weekend_malam` tinyint(1) DEFAULT NULL,
  `noform_weekend_malam` varchar(25) DEFAULT NULL,
  `weekday_siang` varchar(50) DEFAULT NULL,
  `shp_weekday_siang` varchar(50) DEFAULT NULL,
  `tgl_weekday_siang` date DEFAULT NULL,
  `nomesin_weekday_siang` varchar(255) DEFAULT NULL,
  `status_weekday_siang` tinyint(1) DEFAULT NULL,
  `noform_weekday_siang` varchar(25) DEFAULT NULL,
  `weekday_malam` varchar(50) DEFAULT NULL,
  `shp_weekday_malam` varchar(50) DEFAULT NULL,
  `tgl_weekday_malam` date DEFAULT NULL,
  `nomesin_weekday_malam` varchar(255) DEFAULT NULL,
  `status_weekday_malam` tinyint(1) DEFAULT NULL,
  `noform_weekday_malam` varchar(25) DEFAULT NULL,
  `kodebank` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=29520 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `att_field_matrix`
--

DROP TABLE IF EXISTS `att_field_matrix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `att_field_matrix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `field_matrix` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `attribute`
--

DROP TABLE IF EXISTS `attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attribute` (
  `kode` char(3) NOT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `kategori` varchar(24) DEFAULT NULL,
  `flag` enum('0','1') NOT NULL,
  `transport` enum('y','n') NOT NULL DEFAULT 'n',
  `matrix` varchar(50) DEFAULT NULL,
  `kunjungan_q` int(1) DEFAULT NULL,
  `timedelivery` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `attribute_ebanking`
--

DROP TABLE IF EXISTS `attribute_ebanking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attribute_ebanking` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `sumber` int(11) DEFAULT NULL,
  `kategori` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bank` (
  `kode` char(3) NOT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `swift_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cabang`
--

DROP TABLE IF EXISTS `cabang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cabang` (
  `num` int(8) NOT NULL AUTO_INCREMENT,
  `project` char(4) NOT NULL,
  `kode` char(4) NOT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `alamat` varchar(254) DEFAULT NULL,
  `kota` varchar(64) DEFAULT NULL,
  `provinsi` varchar(64) NOT NULL,
  `kanwil` varchar(64) DEFAULT NULL,
  `kodepos` varchar(5) DEFAULT NULL,
  `notelpon` varchar(64) DEFAULT NULL,
  `fax` varchar(64) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `kd_kota` varchar(10) DEFAULT NULL,
  `spvdua` varchar(255) DEFAULT NULL,
  `kareg` varchar(100) DEFAULT NULL,
  `picperkota` varchar(100) DEFAULT NULL,
  `nostkb` varchar(255) DEFAULT NULL,
  `honor` varchar(255) DEFAULT NULL,
  `plantugasstart` date DEFAULT NULL,
  `plantugasend` date DEFAULT NULL,
  `kodebank` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`num`,`project`,`kode`),
  KEY `ix_project` (`project`),
  KEY `ix_cabang` (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=58016 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cabang_sulit`
--

DROP TABLE IF EXISTS `cabang_sulit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cabang_sulit` (
  `sulit_id` int(11) NOT NULL AUTO_INCREMENT,
  `sulit_projek` varchar(4) DEFAULT NULL,
  `sulit_kode` char(3) DEFAULT NULL,
  `sulit_nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sulit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `cek_jml_cabang`
--

DROP TABLE IF EXISTS `cek_jml_cabang`;
/*!50001 DROP VIEW IF EXISTS `cek_jml_cabang`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `cek_jml_cabang` AS SELECT 
 1 AS `num`,
 1 AS `jml`,
 1 AS `project`,
 1 AS `kode`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `code_list`
--

DROP TABLE IF EXISTS `code_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `code_list` (
  `id_var` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(5) DEFAULT NULL,
  `nm_var` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_var`)
) ENGINE=InnoDB AUTO_INCREMENT=355 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `code_list_tambahan`
--

DROP TABLE IF EXISTS `code_list_tambahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `code_list_tambahan` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `kuesioner` varchar(5) DEFAULT NULL,
  `variable` varchar(20) DEFAULT NULL,
  `kode` int(11) DEFAULT NULL,
  `skor` int(11) DEFAULT NULL,
  `label_variabel` text,
  `label_kode` text,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `noid` char(8) DEFAULT NULL,
  `ipaddress` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=7017 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `num` int(6) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) DEFAULT NULL,
  `notelpon` varchar(255) DEFAULT NULL,
  `kota` varchar(55) DEFAULT NULL,
  `aktual` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=566 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `daemons`
--

DROP TABLE IF EXISTS `daemons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_divisi`
--

DROP TABLE IF EXISTS `data_divisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_divisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan_divisi` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_foto_temuan`
--

DROP TABLE IF EXISTS `data_foto_temuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_foto_temuan` (
  `num` int(10) NOT NULL AUTO_INCREMENT,
  `shp` char(20) DEFAULT NULL,
  `project` char(20) DEFAULT NULL,
  `cabang` char(20) DEFAULT NULL,
  `kunjungan` char(20) DEFAULT NULL,
  `skenario` char(20) DEFAULT NULL,
  `ket_temuan` varchar(255) DEFAULT NULL,
  `foto_temuan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_jawaban_equest`
--

DROP TABLE IF EXISTS `data_jawaban_equest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_jawaban_equest` (
  `id_jawaban` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` varchar(11) NOT NULL,
  `id_skenario` varchar(11) DEFAULT NULL,
  `id_pembuat_equest` int(11) DEFAULT NULL,
  `id_kunjungan` varchar(5) NOT NULL,
  `kode_cabang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jawaban_equest` text NOT NULL,
  `sts` int(11) NOT NULL,
  `var_equest` text NOT NULL,
  `var_equest2` text NOT NULL,
  `var_equest3` text NOT NULL,
  `var_equest4` text NOT NULL,
  `var_equest5` text NOT NULL,
  `ket_cek` text NOT NULL,
  `ket_jawab` text NOT NULL,
  PRIMARY KEY (`id_jawaban`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_kuis`
--

DROP TABLE IF EXISTS `data_kuis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_kuis` (
  `id_kuis` int(11) NOT NULL AUTO_INCREMENT,
  `soal_kuis` text NOT NULL,
  `benar_kuis` text NOT NULL,
  `salah1_kuis` text NOT NULL,
  `salah2_kuis` text NOT NULL,
  `salah3_kuis` text NOT NULL,
  `id_skenario` int(11) NOT NULL,
  `kode_project` char(255) DEFAULT NULL,
  `kunjungan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kuis`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_nilai`
--

DROP TABLE IF EXISTS `data_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `kode_project` varchar(5) DEFAULT NULL,
  `kunjungan` varchar(5) DEFAULT NULL,
  `id_user` varchar(250) NOT NULL,
  `id_skenario` int(11) DEFAULT NULL,
  `total_nilai` int(11) NOT NULL,
  `benar_nilai` int(11) NOT NULL,
  `salah_nilai` int(11) NOT NULL,
  `tanggal_nilai` date NOT NULL,
  PRIMARY KEY (`id_nilai`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_pengajuan_sdm`
--

DROP TABLE IF EXISTS `data_pengajuan_sdm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_pengajuan_sdm` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `project` varchar(50) DEFAULT NULL,
  `kareg` varchar(15) DEFAULT NULL,
  `pic` varchar(15) DEFAULT NULL,
  `kota_dinas` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `status` int(1) DEFAULT '0',
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_rekaman`
--

DROP TABLE IF EXISTS `data_rekaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_rekaman` (
  `id_rekaman` int(11) NOT NULL AUTO_INCREMENT,
  `validator_id` varchar(20) DEFAULT NULL,
  `id_project` varchar(11) NOT NULL,
  `id_skenario` varchar(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `kode_cabang` varchar(11) NOT NULL,
  `kunjungan` varchar(5) DEFAULT NULL,
  `file_rekaman` varchar(250) NOT NULL,
  `tanggal_input` date NOT NULL,
  `sts_rekaman` int(11) NOT NULL,
  `sts_valid` int(11) NOT NULL,
  PRIMARY KEY (`id_rekaman`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4812 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_skenario`
--

DROP TABLE IF EXISTS `data_skenario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_skenario` (
  `id_skenario` int(11) NOT NULL AUTO_INCREMENT,
  `kode_project` varchar(255) NOT NULL,
  `nama_skenario` varchar(255) NOT NULL,
  `file_skenario` text NOT NULL,
  `file_kuis` text NOT NULL,
  `id_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id_skenario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_td`
--

DROP TABLE IF EXISTS `data_td`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_td` (
  `id_td` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` char(255) NOT NULL,
  `id_skenario` char(11) NOT NULL,
  `id_pembuat` char(11) NOT NULL,
  `pilihan_td` text NOT NULL,
  PRIMARY KEY (`id_td`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_waktu_td`
--

DROP TABLE IF EXISTS `data_waktu_td`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_waktu_td` (
  `id_waktu` int(11) NOT NULL AUTO_INCREMENT,
  `user_entry` char(11) NOT NULL,
  `id_project` varchar(11) NOT NULL,
  `kode_cabang` char(11) NOT NULL,
  `id_skenario` char(11) NOT NULL,
  `kapan_isi_form` varchar(255) NOT NULL,
  `jenis_form` varchar(255) NOT NULL,
  `kondisi_pengisian` varchar(255) NOT NULL,
  `proses` text NOT NULL,
  `timestamp` time DEFAULT NULL,
  `waktu` time NOT NULL,
  `akhir_td` time DEFAULT NULL,
  `full` time NOT NULL,
  `part_1` time DEFAULT NULL,
  `part_2` time DEFAULT NULL,
  `ket_interupsi` text,
  `temuan` text NOT NULL,
  `status_td` int(1) DEFAULT NULL,
  `revisi_ra` time DEFAULT NULL,
  `alasan_revisi` text,
  `user_revisi` char(11) DEFAULT NULL,
  `tanggal_revisi` date DEFAULT NULL,
  PRIMARY KEY (`id_waktu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37882 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_waktu_td_bak`
--

DROP TABLE IF EXISTS `data_waktu_td_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_waktu_td_bak` (
  `id_waktu` int(11) NOT NULL AUTO_INCREMENT,
  `user_entry` char(11) NOT NULL,
  `id_project` varchar(11) NOT NULL,
  `kode_cabang` char(11) NOT NULL,
  `id_skenario` char(11) NOT NULL,
  `kapan_isi_form` varchar(255) NOT NULL,
  `jenis_form` varchar(255) NOT NULL,
  `kondisi_pengisian` varchar(255) NOT NULL,
  `proses` text NOT NULL,
  `timestamp` time DEFAULT NULL,
  `waktu` time NOT NULL,
  `akhir_td` time DEFAULT NULL,
  `full` time NOT NULL,
  `part_1` time DEFAULT NULL,
  `part_2` time DEFAULT NULL,
  `ket_interupsi` text,
  `temuan` text NOT NULL,
  `status_td` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_waktu`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_waktu_td_gd`
--

DROP TABLE IF EXISTS `data_waktu_td_gd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_waktu_td_gd` (
  `id_waktu` int(11) NOT NULL AUTO_INCREMENT,
  `user_entry` varchar(24) NOT NULL,
  `id_project` varchar(11) NOT NULL,
  `kode_cabang` char(11) NOT NULL,
  `id_skenario` char(11) NOT NULL,
  `proses` text NOT NULL,
  `sub_proses` text,
  `td` text,
  `penyebab_lama` text,
  `temuan` text,
  `kasir_penaksir` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_waktu`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `data_waktu_timestamp`
--

DROP TABLE IF EXISTS `data_waktu_timestamp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_waktu_timestamp` (
  `id_waktu` int(11) NOT NULL AUTO_INCREMENT,
  `user_entry` char(11) NOT NULL,
  `id_project` varchar(11) NOT NULL,
  `kode_cabang` char(11) NOT NULL,
  `id_skenario` char(11) NOT NULL,
  `kapan_isi_form` varchar(255) NOT NULL,
  `jenis_form` varchar(255) NOT NULL,
  `kondisi_pengisian` varchar(255) NOT NULL,
  `proses` text NOT NULL,
  `waktu` time NOT NULL,
  `akhir_td` time NOT NULL,
  `full` time NOT NULL,
  `part_1` time DEFAULT NULL,
  `part_2` time DEFAULT NULL,
  `ket_interupsi` text,
  `temuan` text NOT NULL,
  `status_td` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_waktu`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `datahost`
--

DROP TABLE IF EXISTS `datahost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `datahost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `datarekening`
--

DROP TABLE IF EXISTS `datarekening`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `datarekening` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `Id` varchar(16) NOT NULL,
  `CodeBank` varchar(16) DEFAULT NULL,
  `NoRek` varchar(64) DEFAULT NULL,
  `JenRek` varchar(64) DEFAULT NULL,
  `Saldo` varchar(24) DEFAULT NULL,
  `TglSaldo` date DEFAULT NULL,
  `Cabang` varchar(128) DEFAULT NULL,
  `AlmtBank` varchar(255) DEFAULT NULL,
  `Kota` varchar(64) DEFAULT NULL,
  `KodePos` varchar(8) DEFAULT NULL,
  `TglBuka` date DEFAULT NULL,
  `TglTutup` date DEFAULT NULL,
  `StaRek` varchar(255) DEFAULT NULL,
  `FotoBuTab` varchar(255) DEFAULT NULL,
  `KepemilikanRek` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=7250 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `datarekening_backup`
--

DROP TABLE IF EXISTS `datarekening_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `datarekening_backup` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `Id` varchar(16) NOT NULL,
  `CodeBank` varchar(16) DEFAULT NULL,
  `NoRek` varchar(64) DEFAULT NULL,
  `JenRek` varchar(64) DEFAULT NULL,
  `Saldo` varchar(24) DEFAULT NULL,
  `TglSaldo` date DEFAULT NULL,
  `Cabang` varchar(128) DEFAULT NULL,
  `AlmtBank` varchar(255) DEFAULT NULL,
  `Kota` varchar(64) DEFAULT NULL,
  `KodePos` varchar(8) DEFAULT NULL,
  `TglBuka` date DEFAULT NULL,
  `TglTutup` date DEFAULT NULL,
  `StaRek` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=9072 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `datarekening_baru`
--

DROP TABLE IF EXISTS `datarekening_baru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `datarekening_baru` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `Id` varchar(16) NOT NULL,
  `CodeBank` varchar(16) DEFAULT NULL,
  `NoRek` varchar(64) DEFAULT NULL,
  `JenRek` varchar(64) DEFAULT NULL,
  `Saldo` varchar(24) DEFAULT NULL,
  `TglSaldo` date DEFAULT NULL,
  `Cabang` varchar(128) DEFAULT NULL,
  `AlmtBank` varchar(255) DEFAULT NULL,
  `Kota` varchar(64) DEFAULT NULL,
  `KodePos` varchar(8) DEFAULT NULL,
  `TglBuka` date DEFAULT NULL,
  `TglTutup` date DEFAULT NULL,
  `StaRek` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=9087 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `datarekening_trash`
--

DROP TABLE IF EXISTS `datarekening_trash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `datarekening_trash` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `Id` varchar(16) NOT NULL,
  `CodeBank` varchar(16) DEFAULT NULL,
  `NoRek` varchar(64) DEFAULT NULL,
  `JenRek` varchar(64) DEFAULT NULL,
  `Saldo` varchar(24) DEFAULT NULL,
  `TglSaldo` date DEFAULT NULL,
  `Cabang` varchar(128) DEFAULT NULL,
  `AlmtBank` varchar(255) DEFAULT NULL,
  `Kota` varchar(64) DEFAULT NULL,
  `KodePos` varchar(8) DEFAULT NULL,
  `TglBuka` date DEFAULT NULL,
  `TglTutup` date DEFAULT NULL,
  `StaRek` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=9174 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `datatraining`
--

DROP TABLE IF EXISTS `datatraining`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `datatraining` (
  `Id` varchar(16) NOT NULL,
  `KodeTrain` varchar(64) DEFAULT NULL,
  `TglTrain` date DEFAULT NULL,
  `StaTrain` varchar(64) DEFAULT NULL,
  `StatFinal` varchar(24) DEFAULT NULL,
  `KeteranganTrain` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dp`
--

DROP TABLE IF EXISTS `dp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(4) DEFAULT NULL,
  `cabang` varchar(4) DEFAULT NULL,
  `kunjungan` varchar(4) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=343 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dum_cab`
--

DROP TABLE IF EXISTS `dum_cab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dum_cab` (
  `kode` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ebanking`
--

DROP TABLE IF EXISTS `ebanking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ebanking` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(11) DEFAULT NULL,
  `bank` char(3) DEFAULT NULL,
  `channel` varchar(50) DEFAULT NULL,
  `transaksi` int(11) DEFAULT NULL,
  `os` varchar(50) DEFAULT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `hari` varchar(11) DEFAULT NULL,
  `waktu` varchar(11) DEFAULT NULL,
  `trx_ke` int(11) DEFAULT NULL,
  `nama_shopper` varchar(255) DEFAULT NULL,
  `norek` varchar(255) DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `user_input` char(50) DEFAULT NULL,
  `tanggal_evaluasi` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `percobaan` char(50) DEFAULT NULL,
  `penyebab` text,
  `total_td` decimal(8,2) DEFAULT NULL,
  `tgl_aktual` date DEFAULT NULL,
  `upload_bukti` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `r_temuan` varchar(255) DEFAULT NULL,
  `validator_id` char(50) DEFAULT NULL,
  `tgl_validasi` date DEFAULT NULL,
  `versi_label` int(11) DEFAULT NULL,
  `updatetd_id` char(20) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT NULL,
  `download_total` timestamp NULL DEFAULT NULL,
  `download_label` timestamp NULL DEFAULT NULL,
  `ket_reset` text,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=4070 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ebanking_aplikasi`
--

DROP TABLE IF EXISTS `ebanking_aplikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ebanking_aplikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `bank` char(3) DEFAULT NULL,
  `channel` varchar(50) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ebanking_cekfield`
--

DROP TABLE IF EXISTS `ebanking_cekfield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ebanking_cekfield` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(4) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `hari` varchar(15) DEFAULT NULL,
  `waktu` varchar(15) DEFAULT NULL,
  `provider` varchar(30) DEFAULT NULL,
  `download` decimal(8,2) DEFAULT NULL,
  `upload` decimal(8,2) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ebanking_data_td`
--

DROP TABLE IF EXISTS `ebanking_data_td`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ebanking_data_td` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank` char(11) DEFAULT NULL,
  `channel` varchar(50) DEFAULT NULL,
  `os` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `transaksi` int(11) DEFAULT NULL,
  `versi` int(11) DEFAULT NULL,
  `step` int(11) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `pembuat` char(50) DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=633 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ebanking_peralatan`
--

DROP TABLE IF EXISTS `ebanking_peralatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ebanking_peralatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(4) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis` varchar(25) DEFAULT NULL,
  `terpakai` varchar(100) DEFAULT NULL,
  `kosong` varchar(100) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ebanking_provider`
--

DROP TABLE IF EXISTS `ebanking_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ebanking_provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ebanking_rekening`
--

DROP TABLE IF EXISTS `ebanking_rekening`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ebanking_rekening` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `norek` varchar(70) DEFAULT NULL,
  `kategori` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ebanking_shopper`
--

DROP TABLE IF EXISTS `ebanking_shopper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ebanking_shopper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `jk` varchar(30) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ebanking_td`
--

DROP TABLE IF EXISTS `ebanking_td`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ebanking_td` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_eb` int(11) DEFAULT NULL,
  `project` char(5) DEFAULT NULL,
  `bank` char(11) DEFAULT NULL,
  `channel` varchar(50) DEFAULT NULL,
  `transaksi` int(11) DEFAULT NULL,
  `versi_label` int(11) DEFAULT NULL,
  `step1` decimal(8,2) DEFAULT NULL,
  `step2` decimal(8,2) DEFAULT NULL,
  `step3` decimal(8,2) DEFAULT NULL,
  `step4` decimal(8,2) DEFAULT NULL,
  `step5` decimal(8,2) DEFAULT NULL,
  `step6` decimal(8,2) DEFAULT NULL,
  `step7` decimal(8,2) DEFAULT NULL,
  `step8` decimal(8,2) DEFAULT NULL,
  `step9` decimal(8,2) DEFAULT NULL,
  `step10` decimal(8,2) DEFAULT NULL,
  `step11` decimal(8,2) DEFAULT NULL,
  `step12` decimal(8,2) DEFAULT NULL,
  `step13` decimal(8,2) DEFAULT NULL,
  `step14` decimal(8,2) DEFAULT NULL,
  `step15` decimal(8,2) DEFAULT NULL,
  `step16` decimal(8,2) DEFAULT NULL,
  `step17` decimal(8,2) DEFAULT NULL,
  `step18` decimal(8,2) DEFAULT NULL,
  `step19` decimal(8,2) DEFAULT NULL,
  `step20` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `field_kotakab`
--

DROP TABLE IF EXISTS `field_kotakab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `field_kotakab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kota_id` int(11) NOT NULL,
  `jeniskota` varchar(50) NOT NULL,
  `ump_bulanan` int(11) DEFAULT NULL,
  `ump_harian` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `field_pembayaran`
--

DROP TABLE IF EXISTS `field_pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `field_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomorstkb` int(11) DEFAULT NULL,
  `term` int(11) NOT NULL,
  `tanggalbuat` date NOT NULL,
  `kodeproject` varchar(10) NOT NULL,
  `id_data_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_aktual` int(11) DEFAULT NULL,
  `status_pembayaran` int(11) NOT NULL,
  `noid_bpu` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `field_sdm`
--

DROP TABLE IF EXISTS `field_sdm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `field_sdm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_data_id` varchar(20) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `posisi` varchar(30) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `tanggal_kaderisasi` date DEFAULT NULL,
  `kader_id` int(11) DEFAULT NULL,
  `kepala_id` int(11) DEFAULT NULL,
  `jumlah_kaderisasi` int(11) DEFAULT NULL,
  `mulai_kaderisasi` date DEFAULT NULL,
  `selesai_kaderisasi` date DEFAULT NULL,
  `penanggung_jawab_kaderisasi` int(11) DEFAULT NULL,
  `memo` varchar(255) DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique ID SDM` (`id_data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `form_keterlambatan`
--

DROP TABLE IF EXISTS `form_keterlambatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_keterlambatan` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `num_quest` int(50) DEFAULT NULL,
  `project` char(4) DEFAULT NULL,
  `cabang` char(11) DEFAULT NULL,
  `kunjungan` char(11) DEFAULT NULL,
  `r_kategori` char(11) DEFAULT NULL,
  `tgl_kunjungan` date DEFAULT NULL,
  `pwt` char(20) DEFAULT NULL,
  `ra_project` char(20) DEFAULT NULL,
  `alasan` text,
  `tgl_dibuat` timestamp NULL DEFAULT NULL,
  `pemohon` char(20) DEFAULT NULL,
  `pj_field` char(20) DEFAULT NULL,
  `mengetahui` char(20) DEFAULT NULL,
  `tgl_mengetahui` timestamp NULL DEFAULT NULL,
  `approval` varchar(20) DEFAULT NULL,
  `tgl_approve` timestamp NULL DEFAULT NULL,
  `evidence` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `form_validasi`
--

DROP TABLE IF EXISTS `form_validasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_validasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_eb` int(11) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `tujuan` int(11) DEFAULT NULL,
  `tanggal` varchar(50) DEFAULT NULL,
  `hari` varchar(50) DEFAULT NULL,
  `transaksi` varchar(50) DEFAULT NULL,
  `jam` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `format_file`
--

DROP TABLE IF EXISTS `format_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `format_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gammu`
--

DROP TABLE IF EXISTS `gammu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hari_libur`
--

DROP TABLE IF EXISTS `hari_libur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hari_libur` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT 'ID Hari Libur',
  `tanggal` date NOT NULL COMMENT 'Tanggal Libur',
  `hari` varchar(10) NOT NULL COMMENT 'Hari Libur',
  `keterangan` varchar(100) NOT NULL COMMENT 'Keterangan Libur',
  `tipe` enum('libur_nasional','cuti_bersama') DEFAULT NULL COMMENT 'Keterangan Tipe Libur',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `history_ulang`
--

DROP TABLE IF EXISTS `history_ulang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history_ulang` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `project` varchar(8) NOT NULL,
  `cabang` varchar(8) NOT NULL,
  `kunjungan` varchar(8) NOT NULL,
  `tgl_temuan` datetime NOT NULL COMMENT 'Tanggal Temuan Masalah',
  `id_user` varchar(10) NOT NULL COMMENT 'ID Shopper / Pewitness yang melakukan kesalahan',
  `potongan` int(8) NOT NULL COMMENT 'Jumlah Pemotongan Honor',
  `keterangan` text NOT NULL COMMENT 'Detail Alasan Pengulangan',
  `status` enum('yes','no') NOT NULL COMMENT 'Status honor user sudah dipotong atau belum.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=latin1 COMMENT='Table untuk menampung data pemotongan honor karena kesalahan kunjungan';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor`
--

DROP TABLE IF EXISTS `honor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `project` char(4) DEFAULT NULL,
  `cabang` char(4) DEFAULT NULL,
  `kunjungan` char(3) DEFAULT NULL,
  `shporpwt` char(8) DEFAULT NULL,
  `user` varchar(24) DEFAULT NULL,
  `transport` varchar(9) DEFAULT NULL,
  `transport_jauh` varchar(9) DEFAULT NULL,
  `honor` varchar(9) DEFAULT NULL,
  `pemotongan` varchar(500) DEFAULT NULL,
  `totalpemotongan` varchar(4) DEFAULT NULL,
  `total` varchar(9) DEFAULT NULL,
  `paid` varchar(4) DEFAULT NULL,
  `paidby` varchar(24) DEFAULT NULL,
  `datepaid` datetime DEFAULT NULL,
  `noform` varchar(28) DEFAULT NULL,
  PRIMARY KEY (`num`),
  FULLTEXT KEY `IXUser` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=51050 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `honor_atm_center`
--

DROP TABLE IF EXISTS `honor_atm_center`;
/*!50001 DROP VIEW IF EXISTS `honor_atm_center`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `honor_atm_center` AS SELECT 
 1 AS `project`,
 1 AS `cabang`,
 1 AS `kunjungan`,
 1 AS `tanggal`,
 1 AS `shp_atm`,
 1 AS `kota`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `honor_basic_hadir`
--

DROP TABLE IF EXISTS `honor_basic_hadir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_basic_hadir` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT 'ID Honor Basic dan Kehadiran',
  `tgl_proses` datetime NOT NULL COMMENT 'Tanggal Proses End Of Month',
  `user_id` char(3) NOT NULL COMMENT 'ID User',
  `group_id` varchar(2) NOT NULL,
  `prorate` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Detail apakah periode itu adalah prorate atau bukan',
  `jumlah_hari` int(2) NOT NULL COMMENT 'Jumlah Hari Kerja',
  `honor_basic_harian` int(12) NOT NULL COMMENT 'honor_basic / 22 hari (variasi)',
  `honor_basic` int(12) NOT NULL COMMENT 'Honor Basic dari table honor_basic_hadir_mx. Jika prorate maka (honor_basic_harian * hari kerja)',
  `honor_basic_potongan` int(12) NOT NULL COMMENT '(Jumlah tidak masuk * honor_basic_harian)',
  `total_honor_basic` int(12) NOT NULL COMMENT '(honor_basic - honor_basic_potongan)',
  `honor_hadir_harian` int(12) NOT NULL COMMENT 'honor_hadir / 22 hari (25000)',
  `honor_hadir` int(12) NOT NULL COMMENT 'Honor Hadir dari table honor_basic_hadir_mx. Jika prorate maka (honor_basic_harian * hari kerja)',
  `honor_hadir_potongan` int(12) NOT NULL COMMENT '(Jumlah tidak masuk * honor_hadir_harian)',
  `honor_hadir_potongan_terlambat` int(12) NOT NULL COMMENT '(Jumlah terlambat * potongan terlambat) (15000 - jan 15)',
  `total_honor_hadir` int(12) NOT NULL COMMENT '(honor_hadir - (honor_hadir_potongan + honor_hadir_potongan_terlambat))',
  `honor_tunjangan_harian` int(12) NOT NULL COMMENT 'honor_tunjangan / 22 hari (30700)',
  `honor_tunjangan` int(12) NOT NULL COMMENT 'Honor Tunjangan dari table honor_basic_hadir_mx. Pengganti Produktifitas jika hanya PKWT (bukan HL)',
  `honor_tunjangan_potongan` int(12) NOT NULL COMMENT '(Jumlah tidak masuk * honor_tunjangan_harian)',
  `total_honor_tunjangan` int(12) NOT NULL COMMENT '(honor_tunjangan - honor_tunjangan_potongan)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_basic_hadir_mx`
--

DROP TABLE IF EXISTS `honor_basic_hadir_mx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_basic_hadir_mx` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID Honor Basic dan Honor Kehadiran',
  `user_id` char(3) NOT NULL COMMENT 'ID User (Karyawan)',
  `group_id` varchar(2) NOT NULL COMMENT 'Grade User',
  `honor_basic` int(12) NOT NULL COMMENT 'Jumlah Honor Basic',
  `honor_hadir` int(12) NOT NULL COMMENT 'Jumlah Honor Kehadiran',
  `honor_tunjangan` int(12) NOT NULL COMMENT 'Jumlah Honor Tunjangan (Pengganti Produktifitas)',
  `aktif` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'Status Honor Basic dan Hadir',
  `created_by` char(3) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` char(3) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_basic_hadir_mx_copy1`
--

DROP TABLE IF EXISTS `honor_basic_hadir_mx_copy1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_basic_hadir_mx_copy1` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID Honor Basic dan Honor Kehadiran',
  `user_id` char(3) NOT NULL COMMENT 'ID User (Karyawan)',
  `group_id` varchar(2) NOT NULL COMMENT 'Grade User',
  `honor_basic` int(12) NOT NULL COMMENT 'Jumlah Honor Basic',
  `honor_hadir` int(12) NOT NULL COMMENT 'Jumlah Honor Kehadiran',
  `honor_tunjangan` int(12) NOT NULL COMMENT 'Jumlah Honor Tunjangan (Pengganti Produktifitas)',
  `aktif` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'Status Honor Basic dan Hadir',
  `created_by` char(3) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` char(3) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_batch`
--

DROP TABLE IF EXISTS `honor_batch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_batch` (
  `batch_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_projek` char(4) DEFAULT NULL,
  `batch_cabang` char(4) DEFAULT NULL,
  `batch_kunjungan` char(3) DEFAULT NULL,
  `batch_shporpwt` char(3) DEFAULT NULL,
  `batch_user` varchar(16) DEFAULT NULL,
  `batch_transport` varchar(9) DEFAULT NULL,
  `batch_transport_j` varchar(9) DEFAULT NULL,
  `batch_transport_k` varchar(9) DEFAULT NULL,
  `batch_honor` varchar(9) DEFAULT NULL,
  `batch_potongan_kode` varchar(8) DEFAULT NULL,
  `batch_potongan_nominal` varchar(9) DEFAULT NULL,
  `batch_potongan_keterangan` varchar(255) DEFAULT NULL,
  `batch_total` varchar(9) DEFAULT NULL,
  `batch_potongan2` varchar(255) DEFAULT NULL,
  `batch_ipck` varchar(255) DEFAULT NULL,
  `batch_nohp` varchar(65) DEFAULT NULL,
  `batch_norek` varchar(64) DEFAULT NULL,
  `batch_status` char(1) DEFAULT NULL,
  `batch_rekaman` enum('true','false') DEFAULT 'false',
  `batch_rekaman_tgl` date DEFAULT NULL,
  `batch_quest_tgl` date DEFAULT NULL,
  `batch_projek_nama` varchar(64) DEFAULT NULL,
  `batch_cabang_nama` varchar(64) DEFAULT NULL,
  `batch_kunjungan_nama` varchar(64) DEFAULT NULL,
  `batch_user_nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`batch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_do`
--

DROP TABLE IF EXISTS `honor_do`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_do` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `project` char(4) DEFAULT NULL,
  `cabang` char(4) DEFAULT NULL,
  `kunjungan` char(3) DEFAULT NULL,
  `shporpwt` char(8) DEFAULT NULL,
  `user` varchar(24) DEFAULT NULL,
  `transport` varchar(9) DEFAULT NULL,
  `transport_jauh` varchar(9) DEFAULT NULL,
  `honor` varchar(9) DEFAULT NULL,
  `pemotongan` varchar(500) DEFAULT NULL,
  `totalpemotongan` varchar(4) DEFAULT NULL,
  `total` varchar(9) DEFAULT NULL,
  `paid` varchar(4) DEFAULT NULL,
  `paidby` varchar(24) DEFAULT NULL,
  `datepaid` datetime DEFAULT NULL,
  `noform` varchar(28) DEFAULT NULL,
  PRIMARY KEY (`num`),
  FULLTEXT KEY `IXUser` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_edit_aktual`
--

DROP TABLE IF EXISTS `honor_edit_aktual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_edit_aktual` (
  `num` int(9) DEFAULT NULL,
  `project` char(4) DEFAULT NULL,
  `cabang` char(4) DEFAULT NULL,
  `kunjungan` char(3) DEFAULT NULL,
  `shporpwt` char(8) DEFAULT NULL,
  `user` varchar(24) DEFAULT NULL,
  `transport` varchar(9) DEFAULT NULL,
  `transport_jauh` varchar(9) DEFAULT NULL,
  `honor` varchar(9) DEFAULT NULL,
  `pemotongan` varchar(500) DEFAULT NULL,
  `totalpemotongan` varchar(4) DEFAULT NULL,
  `total` varchar(9) DEFAULT NULL,
  `paid` varchar(4) DEFAULT NULL,
  `paidby` varchar(24) DEFAULT NULL,
  `datepaid` datetime DEFAULT NULL,
  `noform` varchar(28) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_hadir_detail`
--

DROP TABLE IF EXISTS `honor_hadir_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_hadir_detail` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT 'ID Detail Kehadiran',
  `user_id` char(3) NOT NULL COMMENT 'ID User (Karyawan)',
  `group_id` varchar(2) NOT NULL COMMENT 'ID Grup (Karyawan)',
  `tgl_proses` datetime NOT NULL COMMENT 'Tanggal Proses (Kosong ketika input, update ketika proses end of month)',
  `jml_absen` int(2) NOT NULL DEFAULT '0' COMMENT 'Total Jumlah Tidak Masuk',
  `jml_terlambat` int(2) NOT NULL DEFAULT '0' COMMENT 'Total Jumlah Datang Terlambat',
  `created_by` char(3) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` char(3) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_prod`
--

DROP TABLE IF EXISTS `honor_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_prod` (
  `id_honor_prod` int(8) NOT NULL AUTO_INCREMENT,
  `tgl_proses` datetime NOT NULL,
  `id_user` char(4) NOT NULL,
  `bagian` char(20) NOT NULL,
  `grade` char(20) NOT NULL,
  `project` char(4) NOT NULL,
  `jumlah_q_besar` int(4) NOT NULL COMMENT 'Jumlah Q Besar yang ditangani',
  `honor_q_besar` int(8) NOT NULL COMMENT 'Honor Q Besar',
  `total_q_besar` int(12) NOT NULL COMMENT 'Jumlah Q Besar * Honor Q Besar',
  `jumlah_q_kecil` int(4) NOT NULL COMMENT 'Jumlah Q Kecil yang ditangani',
  `honor_q_kecil` int(8) NOT NULL COMMENT 'Honor Q Kecil',
  `total_q_kecil` int(12) NOT NULL COMMENT 'Jumlah Q Kecil * Honor Q Kecil',
  PRIMARY KEY (`id_honor_prod`)
) ENGINE=InnoDB AUTO_INCREMENT=4504 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_prod_anomali`
--

DROP TABLE IF EXISTS `honor_prod_anomali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_prod_anomali` (
  `anomali_id` int(11) NOT NULL AUTO_INCREMENT,
  `anomali_att` char(3) DEFAULT NULL,
  `anomali_input_ip` varchar(15) DEFAULT NULL,
  `anomali_input_date` datetime DEFAULT NULL,
  `anomali_input_id` char(4) DEFAULT NULL,
  `anomali_efektif` date DEFAULT NULL,
  `anomali_nonaktif` date DEFAULT NULL,
  `anomali_aktif` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`anomali_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_prod_last_process`
--

DROP TABLE IF EXISTS `honor_prod_last_process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_prod_last_process` (
  `tanggal_proses_akhir` datetime NOT NULL COMMENT 'Tanggal Proses',
  `tanggal_awal_periode` datetime NOT NULL COMMENT 'Awal Periode',
  `tanggal_akhir_periode` datetime DEFAULT NULL COMMENT 'Akhir Periode',
  PRIMARY KEY (`tanggal_proses_akhir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_prod_mx`
--

DROP TABLE IF EXISTS `honor_prod_mx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_prod_mx` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID Matrix',
  `project` char(5) DEFAULT NULL COMMENT 'Nama Project',
  `group_id` int(11) NOT NULL COMMENT 'ID User_Group',
  `honor_q_besar` int(8) NOT NULL COMMENT 'Honor Q Besar',
  `honor_q_kecil` int(8) NOT NULL COMMENT 'Honor Q Kecil',
  `aktif` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'Status Aktif',
  `created_by` char(3) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` char(3) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_tambahan`
--

DROP TABLE IF EXISTS `honor_tambahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_tambahan` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) DEFAULT NULL,
  `npwp` varchar(100) DEFAULT NULL,
  `jenkel` enum('L','P') DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `ket` varchar(225) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `user_create` char(8) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_training`
--

DROP TABLE IF EXISTS `honor_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` int(11) NOT NULL,
  `nama_honor` varchar(50) NOT NULL,
  `nominal_honor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honor_ulang`
--

DROP TABLE IF EXISTS `honor_ulang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honor_ulang` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `project` char(4) DEFAULT NULL,
  `cabang` char(4) DEFAULT NULL,
  `kunjungan` char(3) DEFAULT NULL,
  `shporpwt` char(8) DEFAULT NULL,
  `user` varchar(24) DEFAULT NULL,
  `transport` varchar(9) DEFAULT NULL,
  `transport_jauh` varchar(9) DEFAULT NULL,
  `honor` varchar(9) DEFAULT NULL,
  `pemotongan` varchar(128) DEFAULT NULL,
  `totalpemotongan` varchar(4) DEFAULT NULL,
  `total` varchar(9) DEFAULT NULL,
  `paid` varchar(4) DEFAULT NULL,
  `paidby` varchar(24) DEFAULT NULL,
  `datepaid` datetime DEFAULT NULL,
  `noform` varchar(28) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=49993 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honorlk`
--

DROP TABLE IF EXISTS `honorlk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honorlk` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `project` char(4) DEFAULT NULL,
  `cabang` char(4) DEFAULT NULL,
  `kunjungan` char(3) DEFAULT NULL,
  `shporpwt` char(8) DEFAULT NULL,
  `user` varchar(24) DEFAULT NULL,
  `kota` varchar(128) DEFAULT NULL,
  `transport` varchar(9) DEFAULT NULL,
  `transport_jauh` varchar(9) DEFAULT NULL,
  `honor` varchar(9) DEFAULT NULL,
  `pemotongan` varchar(256) DEFAULT NULL,
  `totalpemotongan` varchar(8) DEFAULT NULL,
  `total` varchar(9) DEFAULT NULL,
  `paid` varchar(4) DEFAULT NULL,
  `paidby` varchar(24) DEFAULT NULL,
  `datepaid` datetime DEFAULT NULL,
  `noform` varchar(28) DEFAULT NULL,
  `kd_kota` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=45399 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honorlk_do`
--

DROP TABLE IF EXISTS `honorlk_do`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honorlk_do` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `project` char(4) DEFAULT NULL,
  `cabang` char(4) DEFAULT NULL,
  `kunjungan` char(3) DEFAULT NULL,
  `shporpwt` char(8) DEFAULT NULL,
  `user` varchar(24) DEFAULT NULL,
  `kota` varchar(128) DEFAULT NULL,
  `transport` varchar(9) DEFAULT NULL,
  `transport_jauh` varchar(9) DEFAULT NULL,
  `honor` varchar(9) DEFAULT NULL,
  `pemotongan` varchar(256) DEFAULT NULL,
  `totalpemotongan` varchar(8) DEFAULT NULL,
  `total` varchar(9) DEFAULT NULL,
  `paid` varchar(4) DEFAULT NULL,
  `paidby` varchar(24) DEFAULT NULL,
  `datepaid` datetime DEFAULT NULL,
  `noform` varchar(28) DEFAULT NULL,
  `kd_kota` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=85519 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honorlk_edit_aktual`
--

DROP TABLE IF EXISTS `honorlk_edit_aktual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honorlk_edit_aktual` (
  `num` int(9) DEFAULT NULL,
  `project` char(4) DEFAULT NULL,
  `cabang` char(4) DEFAULT NULL,
  `kunjungan` char(3) DEFAULT NULL,
  `shporpwt` char(8) DEFAULT NULL,
  `user` varchar(24) DEFAULT NULL,
  `kota` varchar(128) DEFAULT NULL,
  `transport` varchar(9) DEFAULT NULL,
  `transport_jauh` varchar(9) DEFAULT NULL,
  `honor` varchar(9) DEFAULT NULL,
  `pemotongan` varchar(256) DEFAULT NULL,
  `totalpemotongan` varchar(8) DEFAULT NULL,
  `total` varchar(9) DEFAULT NULL,
  `paid` varchar(4) DEFAULT NULL,
  `paidby` varchar(24) DEFAULT NULL,
  `datepaid` datetime DEFAULT NULL,
  `noform` varchar(28) DEFAULT NULL,
  `kd_kota` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honorlk_ulang`
--

DROP TABLE IF EXISTS `honorlk_ulang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honorlk_ulang` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `project` char(4) DEFAULT NULL,
  `cabang` char(4) DEFAULT NULL,
  `kunjungan` char(3) DEFAULT NULL,
  `shporpwt` char(8) DEFAULT NULL,
  `user` varchar(24) DEFAULT NULL,
  `kota` varchar(128) DEFAULT NULL,
  `transport` varchar(9) DEFAULT NULL,
  `transport_jauh` varchar(9) DEFAULT NULL,
  `honor` varchar(9) DEFAULT NULL,
  `pemotongan` varchar(256) DEFAULT NULL,
  `totalpemotongan` varchar(8) DEFAULT NULL,
  `total` varchar(9) DEFAULT NULL,
  `paid` varchar(4) DEFAULT NULL,
  `paidby` varchar(24) DEFAULT NULL,
  `datepaid` datetime DEFAULT NULL,
  `noform` varchar(28) DEFAULT NULL,
  `kd_kota` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=44782 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `honortl`
--

DROP TABLE IF EXISTS `honortl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `honortl` (
  `num` int(6) NOT NULL AUTO_INCREMENT,
  `project` varchar(4) DEFAULT NULL,
  `cabang` varchar(3) DEFAULT NULL,
  `kunjungan` varchar(3) DEFAULT NULL,
  `tl` varchar(8) DEFAULT NULL,
  `noform` varchar(128) DEFAULT NULL,
  `honor` int(9) DEFAULT NULL,
  `etc` varchar(128) DEFAULT '',
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=10888 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `id_data`
--

DROP TABLE IF EXISTS `id_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `id_data` (
  `num` int(8) NOT NULL AUTO_INCREMENT,
  `Id` varchar(16) NOT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `AlmntTgl` varchar(128) DEFAULT NULL,
  `KecTgl` varchar(128) DEFAULT NULL,
  `KotaTgl` varchar(128) DEFAULT NULL,
  `KdPosTgl` varchar(8) DEFAULT NULL,
  `PropTgl` varchar(65) DEFAULT NULL,
  `Telpon` varchar(65) DEFAULT NULL,
  `HP` varchar(65) DEFAULT NULL,
  `Email` varchar(65) DEFAULT NULL,
  `Foto` varchar(128) DEFAULT NULL,
  `JenKel` varchar(24) DEFAULT NULL,
  `TptLahir` varchar(65) DEFAULT NULL,
  `TglLahir` date DEFAULT NULL,
  `Pekerjaan` varchar(128) DEFAULT NULL,
  `NmPerusahaan` varchar(128) DEFAULT NULL,
  `AlmtPerusahaan` varchar(254) DEFAULT NULL,
  `NoTelpPerusahaan` varchar(128) DEFAULT NULL,
  `IDNo` varchar(65) DEFAULT NULL,
  `IdJen` varchar(18) DEFAULT NULL,
  `AlmtID` varchar(128) DEFAULT NULL,
  `KotaID` varchar(65) DEFAULT NULL,
  `KdPosID` varchar(8) DEFAULT NULL,
  `PropID` varchar(65) DEFAULT NULL,
  `PicCard` varchar(255) DEFAULT NULL,
  `MasaBerlakuID` date DEFAULT NULL,
  `TglLamar` date DEFAULT NULL,
  `TglRekrut` timestamp NULL DEFAULT NULL,
  `Posisi` varchar(128) DEFAULT NULL,
  `Referensi` varchar(128) DEFAULT NULL,
  `Pendidikan` varchar(64) DEFAULT NULL,
  `CodeCV` varchar(128) DEFAULT NULL,
  `StaRekrut` varchar(12) DEFAULT NULL,
  `status` varchar(6) DEFAULT NULL,
  `TglInput` date DEFAULT NULL,
  `typeuser` varchar(8) DEFAULT NULL,
  `NmIbu` varchar(54) DEFAULT NULL,
  `OrgDekat` varchar(54) DEFAULT NULL,
  `HubunganOrgDekat` varchar(54) DEFAULT NULL,
  `NoTelpOrgDekat` varchar(54) DEFAULT NULL,
  `user_create` varchar(20) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `PicNpwp` varchar(255) DEFAULT NULL,
  `staff` tinyint(1) DEFAULT '0',
  `password` varchar(255) DEFAULT '12345',
  `level` varchar(255) DEFAULT NULL,
  `aktif` varchar(10) DEFAULT NULL,
  `keterangan_restore` text,
  `id_divisi` int(1) DEFAULT NULL,
  `id_akses` int(1) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `JenisHP` varchar(50) DEFAULT NULL,
  `ProviderHP` varchar(255) DEFAULT NULL,
  `rekrut` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num`,`Id`),
  KEY `ix_posisi` (`Posisi`) USING BTREE,
  KEY `ix_iddt_1` (`Id`,`KecTgl`,`KotaTgl`,`PropID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=104290 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `id_data_ba`
--

DROP TABLE IF EXISTS `id_data_ba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `id_data_ba` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(16) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kota` varchar(128) DEFAULT NULL,
  `posisi` varchar(20) DEFAULT NULL,
  `keterangan` text,
  `id_pengaju` varchar(255) DEFAULT NULL,
  `nama_pengaju` varchar(128) DEFAULT NULL,
  `jabatan_pengaju` varchar(128) DEFAULT NULL,
  `tgl_pengaju` varchar(128) DEFAULT NULL,
  `id_approve` varchar(16) DEFAULT NULL,
  `approve` int(1) DEFAULT '0',
  `tgl_approve` date DEFAULT NULL,
  PRIMARY KEY (`num`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `id_data_backup`
--

DROP TABLE IF EXISTS `id_data_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `id_data_backup` (
  `num` int(8) NOT NULL AUTO_INCREMENT,
  `Id` varchar(16) NOT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `AlmntTgl` varchar(128) DEFAULT NULL,
  `KecTgl` varchar(128) DEFAULT NULL,
  `KotaTgl` varchar(128) DEFAULT NULL,
  `KdPosTgl` varchar(8) DEFAULT NULL,
  `PropTgl` varchar(65) DEFAULT NULL,
  `Telpon` varchar(65) DEFAULT NULL,
  `HP` varchar(65) DEFAULT NULL,
  `Email` varchar(65) DEFAULT NULL,
  `Foto` varchar(128) DEFAULT NULL,
  `JenKel` varchar(24) DEFAULT NULL,
  `TptLahir` varchar(65) DEFAULT NULL,
  `TglLahir` date DEFAULT NULL,
  `Pekerjaan` varchar(128) DEFAULT NULL,
  `NmPerusahaan` varchar(128) DEFAULT NULL,
  `AlmtPerusahaan` varchar(254) DEFAULT NULL,
  `NoTelpPerusahaan` varchar(128) DEFAULT NULL,
  `IDNo` varchar(65) DEFAULT NULL,
  `IdJen` varchar(18) DEFAULT NULL,
  `AlmtID` varchar(128) DEFAULT NULL,
  `KotaID` varchar(65) DEFAULT NULL,
  `KdPosID` varchar(8) DEFAULT NULL,
  `PropID` varchar(65) DEFAULT NULL,
  `PicCard` varchar(255) DEFAULT NULL,
  `MasaBerlakuID` date DEFAULT NULL,
  `TglLamar` date DEFAULT NULL,
  `TglRekrut` date DEFAULT NULL,
  `Posisi` varchar(128) DEFAULT NULL,
  `Referensi` varchar(128) DEFAULT NULL,
  `Pendidikan` varchar(64) DEFAULT NULL,
  `CodeCV` varchar(128) DEFAULT NULL,
  `StaRekrut` varchar(12) DEFAULT NULL,
  `status` varchar(6) DEFAULT NULL,
  `TglInput` date DEFAULT NULL,
  `typeuser` varchar(8) DEFAULT NULL,
  `NmIbu` varchar(54) DEFAULT NULL,
  `OrgDekat` varchar(54) DEFAULT NULL,
  `HubunganOrgDekat` varchar(54) DEFAULT NULL,
  `NoTelpOrgDekat` varchar(54) DEFAULT NULL,
  `user_create` varchar(20) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `staff` tinyint(1) DEFAULT '0',
  `password` varchar(255) DEFAULT '12345',
  `level` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num`,`Id`),
  KEY `ix_posisi` (`Posisi`) USING BTREE,
  KEY `ix_iddt_1` (`Id`,`KecTgl`,`KotaTgl`,`PropID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=103184 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `id_data_baru`
--

DROP TABLE IF EXISTS `id_data_baru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `id_data_baru` (
  `num` int(8) NOT NULL AUTO_INCREMENT,
  `Id` varchar(16) NOT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `AlmntTgl` varchar(128) DEFAULT NULL,
  `KecTgl` varchar(128) DEFAULT NULL,
  `KotaTgl` varchar(128) DEFAULT NULL,
  `KdPosTgl` varchar(8) DEFAULT NULL,
  `PropTgl` varchar(65) DEFAULT NULL,
  `Telpon` varchar(65) DEFAULT NULL,
  `HP` varchar(65) DEFAULT NULL,
  `Email` varchar(65) DEFAULT NULL,
  `Foto` varchar(128) DEFAULT NULL,
  `JenKel` varchar(24) DEFAULT NULL,
  `TptLahir` varchar(65) DEFAULT NULL,
  `TglLahir` date DEFAULT NULL,
  `Pekerjaan` varchar(128) DEFAULT NULL,
  `NmPerusahaan` varchar(128) DEFAULT NULL,
  `AlmtPerusahaan` varchar(254) DEFAULT NULL,
  `NoTelpPerusahaan` varchar(128) DEFAULT NULL,
  `IDNo` varchar(65) DEFAULT NULL,
  `IdJen` varchar(18) DEFAULT NULL,
  `AlmtID` varchar(128) DEFAULT NULL,
  `KotaID` varchar(65) DEFAULT NULL,
  `KdPosID` varchar(8) DEFAULT NULL,
  `PropID` varchar(65) DEFAULT NULL,
  `PicCard` varchar(255) DEFAULT NULL,
  `MasaBerlakuID` date DEFAULT NULL,
  `TglLamar` date DEFAULT NULL,
  `TglRekrut` date DEFAULT NULL,
  `Posisi` varchar(128) DEFAULT NULL,
  `Referensi` varchar(128) DEFAULT NULL,
  `Pendidikan` varchar(64) DEFAULT NULL,
  `CodeCV` varchar(128) DEFAULT NULL,
  `StaRekrut` varchar(12) DEFAULT NULL,
  `status` varchar(6) DEFAULT NULL,
  `TglInput` date DEFAULT NULL,
  `typeuser` varchar(8) DEFAULT NULL,
  `NmIbu` varchar(54) DEFAULT NULL,
  `OrgDekat` varchar(54) DEFAULT NULL,
  `HubunganOrgDekat` varchar(54) DEFAULT NULL,
  `NoTelpOrgDekat` varchar(54) DEFAULT NULL,
  `user_create` varchar(20) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `staff` tinyint(1) DEFAULT '0',
  `password` varchar(255) DEFAULT '12345',
  `level` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`num`,`Id`),
  KEY `ix_posisi` (`Posisi`) USING BTREE,
  KEY `ix_iddt_1` (`Id`,`KecTgl`,`KotaTgl`,`PropID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=103217 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `id_data_trash`
--

DROP TABLE IF EXISTS `id_data_trash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `id_data_trash` (
  `num` int(8) NOT NULL AUTO_INCREMENT,
  `Id` varchar(16) NOT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `AlmntTgl` varchar(128) DEFAULT NULL,
  `KecTgl` varchar(128) DEFAULT NULL,
  `KotaTgl` varchar(128) DEFAULT NULL,
  `KdPosTgl` varchar(8) DEFAULT NULL,
  `PropTgl` varchar(65) DEFAULT NULL,
  `Telpon` varchar(65) DEFAULT NULL,
  `HP` varchar(65) DEFAULT NULL,
  `Email` varchar(65) DEFAULT NULL,
  `Foto` varchar(128) DEFAULT NULL,
  `JenKel` varchar(24) DEFAULT NULL,
  `TptLahir` varchar(65) DEFAULT NULL,
  `TglLahir` date DEFAULT NULL,
  `Pekerjaan` varchar(128) DEFAULT NULL,
  `NmPerusahaan` varchar(128) DEFAULT NULL,
  `AlmtPerusahaan` varchar(254) DEFAULT NULL,
  `NoTelpPerusahaan` varchar(128) DEFAULT NULL,
  `IDNo` varchar(65) DEFAULT NULL,
  `IdJen` varchar(18) DEFAULT NULL,
  `AlmtID` varchar(128) DEFAULT NULL,
  `KotaID` varchar(65) DEFAULT NULL,
  `KdPosID` varchar(8) DEFAULT NULL,
  `PropID` varchar(65) DEFAULT NULL,
  `PicCard` varchar(255) DEFAULT NULL,
  `MasaBerlakuID` date DEFAULT NULL,
  `TglLamar` date DEFAULT NULL,
  `TglRekrut` date DEFAULT NULL,
  `Posisi` varchar(128) DEFAULT NULL,
  `Referensi` varchar(128) DEFAULT NULL,
  `Pendidikan` varchar(64) DEFAULT NULL,
  `CodeCV` varchar(128) DEFAULT NULL,
  `StaRekrut` varchar(12) DEFAULT NULL,
  `status` varchar(6) DEFAULT NULL,
  `TglInput` date DEFAULT NULL,
  `typeuser` varchar(8) DEFAULT NULL,
  `NmIbu` varchar(54) DEFAULT NULL,
  `OrgDekat` varchar(54) DEFAULT NULL,
  `HubunganOrgDekat` varchar(54) DEFAULT NULL,
  `NoTelpOrgDekat` varchar(54) DEFAULT NULL,
  `user_create` varchar(20) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `keterangan_blacklist` text,
  `tgl_blacklist` date DEFAULT NULL,
  PRIMARY KEY (`num`,`Id`),
  KEY `ix_posisi` (`Posisi`),
  KEY `ix_iddt_1` (`Id`,`KecTgl`,`KotaTgl`,`PropID`)
) ENGINE=MyISAM AUTO_INCREMENT=100546 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inbox`
--

DROP TABLE IF EXISTS `inbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` varchar(160) NOT NULL DEFAULT '',
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  `deleted` varchar(1) DEFAULT '',
  `Readed` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=40880 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inbox_modif`
--

DROP TABLE IF EXISTS `inbox_modif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inbox_modif` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` varchar(160) NOT NULL DEFAULT '',
  `ID` int(10) unsigned NOT NULL,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  `deleted` varchar(1) DEFAULT '',
  `Readed` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jakarta_kota_list`
--

DROP TABLE IF EXISTS `jakarta_kota_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jakarta_kota_list` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `kota` varchar(50) NOT NULL,
  `aktif` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jenis_training`
--

DROP TABLE IF EXISTS `jenis_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jenis_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kanwil`
--

DROP TABLE IF EXISTS `kanwil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kanwil` (
  `num` int(4) NOT NULL AUTO_INCREMENT,
  `projek` varchar(4) NOT NULL DEFAULT '',
  `kode` varchar(3) DEFAULT NULL,
  `kodekanwil` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`num`,`projek`)
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kelompok_menu`
--

DROP TABLE IF EXISTS `kelompok_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelompok_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_divisi` int(11) DEFAULT NULL,
  `urut` int(11) DEFAULT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `control_menu` varchar(100) DEFAULT NULL,
  `sub` int(11) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kelompok_submenu`
--

DROP TABLE IF EXISTS `kelompok_submenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelompok_submenu` (
  `id_submenu` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `urut` int(11) DEFAULT NULL,
  `nama_submenu` varchar(100) DEFAULT NULL,
  `control_submenu` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_submenu`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `konsistensi`
--

DROP TABLE IF EXISTS `konsistensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `konsistensi` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `project` char(4) DEFAULT NULL,
  `project_name` varchar(100) DEFAULT NULL,
  `unique` varchar(255) DEFAULT NULL,
  `serial` varchar(100) DEFAULT NULL,
  `code` varchar(11) DEFAULT NULL,
  `cabang` varchar(15) DEFAULT NULL,
  `z3` text,
  `variable` varchar(15) DEFAULT NULL,
  `kode` char(11) DEFAULT NULL,
  `check` text,
  `verifikasi` varchar(100) DEFAULT NULL,
  `final_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `konsistensi_query`
--

DROP TABLE IF EXISTS `konsistensi_query`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `konsistensi_query` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `query` text,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kota`
--

DROP TABLE IF EXISTS `kota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) DEFAULT NULL,
  `nm_kelurahan` varchar(255) DEFAULT NULL,
  `nm_kecamatan` varchar(255) DEFAULT NULL,
  `nm_kota` varchar(50) DEFAULT NULL,
  `nm_provinsi` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `nm_pulau` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `last_sinkron`
--

DROP TABLE IF EXISTS `last_sinkron`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `last_sinkron` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `noid` varchar(10) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `activity` text,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=227182 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logpoin`
--

DROP TABLE IF EXISTS `logpoin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logpoin` (
  `num` int(6) NOT NULL AUTO_INCREMENT,
  `id` varchar(16) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `namabarang` varchar(255) DEFAULT NULL,
  `poin` int(4) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `materi_training`
--

DROP TABLE IF EXISTS `materi_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materi_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` int(11) NOT NULL,
  `user_noid` int(11) NOT NULL,
  `materi` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matrix_cut_off`
--

DROP TABLE IF EXISTS `matrix_cut_off`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrix_cut_off` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_berlaku` date NOT NULL,
  `rule` tinyint(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matrix_honor_sdm_field`
--

DROP TABLE IF EXISTS `matrix_honor_sdm_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrix_honor_sdm_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jeniskota` varchar(10) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `produktivitas` int(11) NOT NULL,
  `produktivitas_lk` int(11) DEFAULT NULL,
  `supervisi_mitra` int(11) NOT NULL DEFAULT '0',
  `supervisi_kontrak` int(11) NOT NULL DEFAULT '0',
  `training` int(11) NOT NULL,
  `insentif_timeline` int(11) NOT NULL,
  `insentif_kaderisasi` int(11) NOT NULL,
  `insentif_upload` int(11) NOT NULL,
  `penalti_pengulangan` int(11) NOT NULL,
  `penalti_keterlambatan_upload` int(11) NOT NULL,
  `penalti_keterlambatan_timeline` int(11) NOT NULL,
  `penalti_kaderisasi` int(11) NOT NULL,
  `user_update` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matrix_perdin`
--

DROP TABLE IF EXISTS `matrix_perdin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrix_perdin` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `kota_asal` varchar(100) NOT NULL,
  `kota_tujuan` varchar(100) NOT NULL,
  `perdin` int(11) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matrixhonor`
--

DROP TABLE IF EXISTS `matrixhonor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrixhonor` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `project` varchar(24) DEFAULT NULL,
  `typehonor` varchar(24) DEFAULT NULL,
  `burek` varchar(24) DEFAULT NULL,
  `turek` varchar(24) DEFAULT NULL,
  `komplain` varchar(24) DEFAULT NULL,
  `tanyainfo` varchar(24) DEFAULT NULL,
  `cs` varchar(24) DEFAULT NULL,
  `teller` varchar(24) DEFAULT NULL,
  `cabterpencil` varchar(24) DEFAULT NULL,
  `retur` varchar(24) DEFAULT NULL,
  `atmnoninstant` varchar(24) DEFAULT NULL,
  `atmmalam` varchar(24) DEFAULT NULL,
  `atmmalamcabterpencil` varchar(24) DEFAULT NULL,
  `telponburek` varchar(24) DEFAULT NULL,
  `telponbiasa` varchar(24) DEFAULT NULL,
  `etc1` varchar(24) DEFAULT NULL,
  `etc2` varchar(24) DEFAULT NULL,
  `setorburek` varchar(24) DEFAULT NULL,
  `tarik` varchar(24) DEFAULT NULL,
  `tukar` varchar(24) DEFAULT NULL,
  `tellerterpisah` varchar(24) DEFAULT NULL,
  `ktlterbilang` varchar(24) DEFAULT NULL,
  `satpam` varchar(24) DEFAULT NULL,
  `transferdebet` varchar(24) DEFAULT NULL,
  `ktljumlah` varchar(24) DEFAULT NULL,
  `atmcenterweekday` varchar(24) DEFAULT NULL,
  `atmcenterweekend` varchar(24) DEFAULT NULL,
  `prasyarat` varchar(24) DEFAULT NULL,
  `atmcabangemoney` varchar(24) DEFAULT NULL,
  `ontime` varchar(24) DEFAULT NULL,
  `ontime2` varchar(24) DEFAULT NULL,
  `emoney` varchar(24) DEFAULT NULL,
  `nasabah` varchar(24) DEFAULT NULL,
  `nonnasabah` varchar(24) DEFAULT NULL,
  `wdq5` varchar(24) DEFAULT NULL,
  `weq5` varchar(24) DEFAULT NULL,
  `wdq6` varchar(24) DEFAULT NULL,
  `weq6` varchar(24) DEFAULT NULL,
  `prakuq2` varchar(24) DEFAULT NULL,
  `prakuq3` varchar(24) DEFAULT NULL,
  `atmcenter_wds` varchar(24) DEFAULT NULL,
  `merchant_wd` varchar(24) DEFAULT NULL,
  `merchant_we` varchar(24) DEFAULT NULL,
  `atmarea_wd` varchar(24) DEFAULT NULL,
  `atmarea_we` varchar(24) DEFAULT NULL,
  `carrefour_wd` varchar(24) DEFAULT NULL,
  `carrefour_we` varchar(24) DEFAULT NULL,
  `parkir_wd` varchar(24) DEFAULT NULL,
  `parkir_we` varchar(24) DEFAULT NULL,
  `minimarket_wd` varchar(24) DEFAULT NULL,
  `minimarket_we` varchar(24) DEFAULT NULL,
  `tol_wd` varchar(24) DEFAULT NULL,
  `krl_busway_wd` varchar(24) DEFAULT NULL,
  `tol_we` varchar(24) DEFAULT NULL,
  `krl_busway_we` varchar(24) DEFAULT NULL,
  `bayarkk_wd` varchar(24) DEFAULT NULL,
  `bayarkk_we` varchar(24) DEFAULT NULL,
  `cut_off_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=790 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matrixhonorlk`
--

DROP TABLE IF EXISTS `matrixhonorlk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrixhonorlk` (
  `num` int(9) NOT NULL AUTO_INCREMENT,
  `project` varchar(24) DEFAULT NULL,
  `model` varchar(54) DEFAULT NULL,
  `typehonor` varchar(24) DEFAULT NULL,
  `burek` varchar(24) DEFAULT NULL,
  `turek` varchar(24) DEFAULT NULL,
  `komplain` varchar(24) DEFAULT NULL,
  `tanyainfo` varchar(24) DEFAULT NULL,
  `cs` varchar(24) DEFAULT NULL,
  `teller` varchar(24) DEFAULT NULL,
  `cabterpencil` varchar(24) DEFAULT NULL,
  `retur` varchar(24) DEFAULT NULL,
  `atmnoninstant` varchar(24) DEFAULT NULL,
  `atmmalam` varchar(24) DEFAULT NULL,
  `atmmalamcabterpencil` varchar(24) DEFAULT NULL,
  `telponburek` varchar(24) DEFAULT NULL,
  `telponbiasa` varchar(24) DEFAULT NULL,
  `etc1` varchar(24) DEFAULT '',
  `etc2` varchar(24) DEFAULT NULL,
  `trfphoneplus` varchar(24) DEFAULT NULL,
  `setorburek` varchar(24) DEFAULT NULL,
  `tarik` varchar(24) DEFAULT NULL,
  `tukar` varchar(24) DEFAULT NULL,
  `tellerterpisah` varchar(24) DEFAULT NULL,
  `ktlterbilang` varchar(24) DEFAULT NULL,
  `satpam` varchar(24) DEFAULT NULL,
  `transferdebet` varchar(24) DEFAULT NULL,
  `ktljumlah` varchar(24) DEFAULT NULL,
  `prasyarat` varchar(24) DEFAULT NULL,
  `atmcabangemoney` varchar(24) DEFAULT NULL,
  `ontime` varchar(24) DEFAULT NULL,
  `ontime2` varchar(24) DEFAULT NULL,
  `emoney` varchar(24) DEFAULT NULL,
  `nasabah` varchar(24) DEFAULT NULL,
  `nonnasabah` varchar(24) DEFAULT NULL,
  `wdq5` varchar(24) DEFAULT NULL,
  `weq5` varchar(24) DEFAULT NULL,
  `wdq6` varchar(24) DEFAULT NULL,
  `weq6` varchar(24) DEFAULT NULL,
  `wd1q7` varchar(24) DEFAULT NULL,
  `wd2q7` varchar(24) DEFAULT NULL,
  `weq7` varchar(24) DEFAULT NULL,
  `wdq8` varchar(24) DEFAULT NULL,
  `weq8` varchar(24) DEFAULT NULL,
  `prakuq2` varchar(24) DEFAULT NULL,
  `prakuq3` varchar(24) DEFAULT NULL,
  `atmcenterweekday` varchar(24) DEFAULT NULL,
  `atmcenterweekend` varchar(24) DEFAULT NULL,
  `atmcenter_wds` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=872 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matrixpotongan`
--

DROP TABLE IF EXISTS `matrixpotongan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrixpotongan` (
  `id_matrix` int(8) NOT NULL AUTO_INCREMENT,
  `project` varchar(8) NOT NULL,
  `kode_att` varchar(8) NOT NULL COMMENT 'Kode Attribute yang diulang',
  `pemotongan_honor` varchar(24) NOT NULL COMMENT 'Jumlah Pemotongan Honor',
  `posisi` enum('shp','pwt','shi') DEFAULT 'shp' COMMENT 'Posisi User',
  `persen` enum('no','yes') NOT NULL,
  PRIMARY KEY (`id_matrix`)
) ENGINE=InnoDB AUTO_INCREMENT=973 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matrixprobing`
--

DROP TABLE IF EXISTS `matrixprobing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrixprobing` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID Honor Probing',
  `project` char(4) NOT NULL COMMENT 'Kode Project || ALL jika masih bersifat global',
  `regional` enum('kota1','kota2','kota3','kota4','jakarta') NOT NULL COMMENT 'Regional Sesuai Kota',
  `tipe_honor` enum('shp','pwt','shi') NOT NULL COMMENT 'Honor untuk SHP / PWT / SHI',
  `honor_probing` int(6) NOT NULL COMMENT 'Angka honor probing',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matrixtl`
--

DROP TABLE IF EXISTS `matrixtl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrixtl` (
  `num` int(8) NOT NULL AUTO_INCREMENT,
  `project` varchar(4) DEFAULT NULL,
  `attribut` varchar(3) DEFAULT NULL,
  `honor` int(9) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=496 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(100) NOT NULL DEFAULT '#',
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  `pid` varchar(5) DEFAULT NULL,
  `permission` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mprovinsi`
--

DROP TABLE IF EXISTS `mprovinsi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mprovinsi` (
  `num` int(3) NOT NULL AUTO_INCREMENT,
  `nmprovinsi` varchar(60) DEFAULT NULL,
  `kode` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mx_honor_prod`
--

DROP TABLE IF EXISTS `mx_honor_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mx_honor_prod` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `project` char(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `bagian` char(20) NOT NULL,
  `grade` char(20) DEFAULT NULL,
  `honor_q_besar` int(8) NOT NULL COMMENT 'Jumlah Honor Quest Besar',
  `honor_q_kecil` int(8) NOT NULL COMMENT 'Jumlah Honor Quest Kecil',
  `aktif` enum('y','n') NOT NULL DEFAULT 'y',
  `created_by` char(4) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` char(4) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `noformlk`
--

DROP TABLE IF EXISTS `noformlk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noformlk` (
  `num` int(8) NOT NULL AUTO_INCREMENT,
  `noform` varchar(24) NOT NULL,
  `periode` varchar(128) DEFAULT NULL,
  `t