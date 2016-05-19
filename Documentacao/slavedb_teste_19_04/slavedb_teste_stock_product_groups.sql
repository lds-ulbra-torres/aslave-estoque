CREATE DATABASE  IF NOT EXISTS `slavedb_teste` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;
USE `slavedb_teste`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: slavedb_teste.mysql.dbaas.com.br    Database: slavedb_teste
-- ------------------------------------------------------
-- Server version	5.6.21-69.0-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `stock_product_groups`
--

DROP TABLE IF EXISTS `stock_product_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_product_groups` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name_group` varchar(250) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_product_groups`
--

LOCK TABLES `stock_product_groups` WRITE;
/*!40000 ALTER TABLE `stock_product_groups` DISABLE KEYS */;
INSERT INTO `stock_product_groups` VALUES (90,'Alimentícios'),(91,'Higiene'),(92,'Produtos de Limpeza'),(93,'Ferramentas');
/*!40000 ALTER TABLE `stock_product_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-22 19:45:03
