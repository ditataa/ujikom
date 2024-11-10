-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: ujikom_galeri
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `album` (
  `id_album` int NOT NULL AUTO_INCREMENT,
  `nama_album` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `tanggal_dibuat` date DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_album`),
  KEY `album_user_FK` (`id_user`),
  CONSTRAINT `album_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (18,'Alam','Alam Bebas','2024-11-02',5),(20,'Kaka1','kaka1','2024-11-03',1),(27,'Kenangan k','2024','2024-11-05',5);
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foto`
--

DROP TABLE IF EXISTS `foto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foto` (
  `id_foto` int NOT NULL AUTO_INCREMENT,
  `judul_foto` varchar(255) DEFAULT NULL,
  `deskripsi_foto` text,
  `tanggal_unggah` date DEFAULT NULL,
  `lokasi_file` varchar(255) DEFAULT NULL,
  `id_album` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_foto`),
  KEY `foto_album_FK` (`id_album`),
  KEY `foto_user_FK` (`id_user`),
  CONSTRAINT `foto_album_FK` FOREIGN KEY (`id_album`) REFERENCES `album` (`id_album`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `foto_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto`
--

LOCK TABLES `foto` WRITE;
/*!40000 ALTER TABLE `foto` DISABLE KEYS */;
INSERT INTO `foto` VALUES (18,'Foto anjing','Anjing','2024-11-03','assets/img/988401670_th.jpg',20,1),(24,'Hutan','Pemandangan di dalam hutan','2024-11-03','assets/img/920683847_Hutan.jpg',18,5),(28,'Kenangan 2024','codingan sekolah','2024-11-05','assets/img/1623203780_Screenshot 2024-10-23 085321.png',27,5),(31,'Test Foto','Mencoba 2','2024-11-06','assets/img/1195609456_Screenshot 2024-10-23 101444.png',20,1);
/*!40000 ALTER TABLE `foto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komentar_foto`
--

DROP TABLE IF EXISTS `komentar_foto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `komentar_foto` (
  `id_komentar` int NOT NULL AUTO_INCREMENT,
  `id_foto` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `isi_komentar` text,
  `tanggal_komentar` date DEFAULT NULL,
  PRIMARY KEY (`id_komentar`),
  KEY `komentar_foto_foto_FK` (`id_foto`),
  KEY `komentar_foto_user_FK` (`id_user`),
  CONSTRAINT `komentar_foto_foto_FK` FOREIGN KEY (`id_foto`) REFERENCES `foto` (`id_foto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `komentar_foto_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komentar_foto`
--

LOCK TABLES `komentar_foto` WRITE;
/*!40000 ALTER TABLE `komentar_foto` DISABLE KEYS */;
INSERT INTO `komentar_foto` VALUES (17,18,5,'Lucu','2024-11-03'),(20,24,5,'hutannya bagus','2024-11-05'),(21,18,1,'bagus','2024-11-06');
/*!40000 ALTER TABLE `komentar_foto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `like_foto`
--

DROP TABLE IF EXISTS `like_foto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `like_foto` (
  `id_like` int NOT NULL AUTO_INCREMENT,
  `id_foto` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `tanggal_like` date DEFAULT NULL,
  PRIMARY KEY (`id_like`),
  KEY `like_foto_user_FK` (`id_user`),
  KEY `like_foto_foto_FK` (`id_foto`),
  CONSTRAINT `like_foto_foto_FK` FOREIGN KEY (`id_foto`) REFERENCES `foto` (`id_foto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `like_foto_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like_foto`
--

LOCK TABLES `like_foto` WRITE;
/*!40000 ALTER TABLE `like_foto` DISABLE KEYS */;
INSERT INTO `like_foto` VALUES (77,24,5,'2024-11-05'),(80,18,5,'2024-11-05'),(86,18,1,'2024-11-06');
/*!40000 ALTER TABLE `like_foto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `alamat` text,
  `level` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'dita','admin','dita@gmail.com','dita ainun','cileunyi','admin'),(5,'asep','user','asep@gmail.com','Asep Dudi','Bandung','user');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ujikom_galeri'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-07  7:48:34
