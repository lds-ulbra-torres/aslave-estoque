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
-- Table structure for table `stock_input_products`
--

DROP TABLE IF EXISTS `stock_input_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_input_products` (
  `id_product` int(11) NOT NULL,
  `id_stock` bigint(20) NOT NULL,
  `unit_price_input` decimal(18,2) NOT NULL,
  `amount_input` decimal(18,2) NOT NULL,
  PRIMARY KEY (`id_product`,`id_stock`),
  KEY `fk_stock_products_has_stock_input_stock_input1_idx` (`id_stock`),
  KEY `fk_stock_products_has_stock_input_stock_products1_idx` (`id_product`),
  CONSTRAINT `id_product` FOREIGN KEY (`id_product`) REFERENCES `stock_products` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_stock` FOREIGN KEY (`id_stock`) REFERENCES `stock_input` (`id_stock`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_input_products`
--

LOCK TABLES `stock_input_products` WRITE;
/*!40000 ALTER TABLE `stock_input_products` DISABLE KEYS */;
INSERT INTO `stock_input_products` VALUES (131,39,3.00,10.00),(131,40,5.00,2.00),(132,40,3.00,20.00),(133,39,20.00,3.00),(133,40,5.00,10.00),(135,39,5.00,3.00);
/*!40000 ALTER TABLE `stock_input_products` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`slavedb_teste`@`%%`*/ /*!50003 TRIGGER Tgr_stock_input_products_Insert AFTER INSERT
ON  stock_input_products
FOR EACH ROW
BEGIN
    UPDATE stock_products sp SET   sp.unit_price = NEW.unit_price_input , sp.amount = sp.amount + NEW.amount_input
WHERE sp.id_product = NEW.id_product;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`slavedb_teste`@`%%`*/ /*!50003 TRIGGER Tgr_stock_input_products_update AFTER update
ON  stock_input_products
FOR EACH ROW
BEGIN
	IF NEW.amount_input >= OLD.amount_input THEN

		UPDATE stock_products sp SET   sp.unit_price = NEW.unit_price_input ,
		sp.amount = sp.amount + (NEW.amount_input -OLD.amount_input) 
		WHERE sp.id_product = OLD.id_product;

	ELSEIF NEW.amount_input < OLD.amount_input THEN

		UPDATE stock_products sp SET   sp.unit_price = NEW.unit_price_input ,
		sp.amount = sp.amount - (OLD.amount_input -NEW.amount_input) 
		WHERE sp.id_product = OLD.id_product;

	END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`slavedb_teste`@`%%`*/ /*!50003 TRIGGER Tgr_stock_input_products_delete AFTER delete
ON  stock_input_products
FOR EACH ROW
BEGIN
    UPDATE stock_products sp SET   sp.unit_price = OLD.unit_price_input , sp.amount = sp.amount - OLD.amount_input
WHERE sp.id_product = OLD.id_product;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-22 19:45:02
