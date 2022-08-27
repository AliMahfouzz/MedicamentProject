-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: treaq
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `idadmin` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(450) DEFAULT NULL,
  `lname` varchar(450) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin',NULL,'admin@admin.com','123456789');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `idclient` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(450) DEFAULT NULL,
  `lname` varchar(450) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `phone` varchar(450) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `location` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idclient`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'ali','mah','ali@hotmail.com','0123456','123456789','1651870788icons8-male-user-40.png',NULL),(2,'mostafa','kh','msk@client.com','123456123456','123456789','1652045317icons8-male-user-40.png',NULL),(3,'sam','user','sam@client.com','123456123456123','123456789','1652081545icons8-male-user-40.png',NULL),(4,'as','as','as@as.com','120','123456789','1653404543icon-5359553_1280.png','qahira');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery` (
  `iddelivery` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(450) DEFAULT NULL,
  `lname` varchar(450) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  `phone` varchar(450) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `approved` varchar(45) DEFAULT NULL,
  `location` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`iddelivery`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery`
--

LOCK TABLES `delivery` WRITE;
/*!40000 ALTER TABLE `delivery` DISABLE KEYS */;
INSERT INTO `delivery` VALUES (1,'hasan','mohamd','delivery@delivery.com','123456789','1234567890123456','1651873516icons8-blockchain-new-logo-48.png','1',NULL),(2,'d','d','de@de.com','123456','12345678901','1653404643icon-5359553_1280.png','0','qahira');
/*!40000 ALTER TABLE `delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `idorders` int NOT NULL AUTO_INCREMENT,
  `idproduct` varchar(450) DEFAULT NULL,
  `assigned_to` varchar(450) DEFAULT NULL,
  `delivered` varchar(450) DEFAULT '0',
  `idusers` varchar(450) DEFAULT NULL,
  `idpharmacy` varchar(450) DEFAULT NULL,
  `ordertype` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idorders`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (3,'2','1','1','1','3',NULL),(4,'2','1','1','2','3',NULL),(5,'2',NULL,'0','1','3','cash');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pharmacie`
--

DROP TABLE IF EXISTS `pharmacie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pharmacie` (
  `idpharmacie` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(450) DEFAULT NULL,
  `lname` varchar(450) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  `phone` varchar(450) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `location` varchar(450) DEFAULT NULL,
  `description` varchar(450) DEFAULT NULL,
  `approved` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpharmacie`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pharmacie`
--

LOCK TABLES `pharmacie` WRITE;
/*!40000 ALTER TABLE `pharmacie` DISABLE KEYS */;
INSERT INTO `pharmacie` VALUES (3,'pharmacie','ali','pharmacie@pharmacie.com','123456789','0123456789','1651873667WhatsApp.jpeg','all egypt cities, aswan, qahira','pharamcie description','1'),(4,'cairo','','cairo@pharmacie.com','123456789','0123456789012','1652018604pharmacy.jpg','al gizah','pharamacie approved','1'),(5,'asd','','asd@asd.com','123456789','123123','1653404577icon-5359553_1280.png','gizah','asd','0');
/*!40000 ALTER TABLE `pharmacie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pharmacist`
--

DROP TABLE IF EXISTS `pharmacist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pharmacist` (
  `idpharmacist` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(450) DEFAULT NULL,
  `lname` varchar(450) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  `phone` varchar(450) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `approved` varchar(45) DEFAULT NULL,
  `location` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idpharmacist`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pharmacist`
--

LOCK TABLES `pharmacist` WRITE;
/*!40000 ALTER TABLE `pharmacist` DISABLE KEYS */;
INSERT INTO `pharmacist` VALUES (1,'pharmacist','ali','pharmacist@pharmacist.com','12345678901','0123456789','1651873477brain.jpg','1',NULL),(2,'newpharmacist','ali','newpharmacist@hotmail.com','123456789','01230123','1652081631icons8-male-user-40.png','1',NULL),(3,'asd','asd','asdddd@asd.com','123456','123123123','1653404613icon-5359553_1280.png','0','aswan');
/*!40000 ALTER TABLE `pharmacist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `idproduct` int NOT NULL AUTO_INCREMENT,
  `pname` varchar(450) DEFAULT NULL,
  `pdescription` varchar(450) DEFAULT NULL,
  `pprice` varchar(450) DEFAULT NULL,
  `pimage` varchar(450) DEFAULT NULL,
  `idpharmacy` varchar(450) DEFAULT NULL,
  `ptype` varchar(450) DEFAULT NULL,
  `pcategory` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idproduct`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (2,'Panadol Advance','Panadol Advance is the best medication product','5.5','1652009301panadol.jpg','3','healthy','Drugs'),(3,'sabril','sabril','15','1652017878OIP.jpg','3','healthy','Drugs'),(4,'histamed','histamed 120mg','35','1652017960histamed.jpg','3','healthy','Drugs'),(5,'betadine','betadine','30','1652018095betadine.jpg','3','betadine','Drugs'),(6,'otipax','otipax','100','1652018933otipax.jpg','4','healthy','Drugs');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question` (
  `idquestion` int NOT NULL AUTO_INCREMENT,
  `qname` varchar(450) DEFAULT NULL,
  `qdescription` varchar(450) DEFAULT NULL,
  `qfile` varchar(450) DEFAULT NULL,
  `replied` varchar(45) DEFAULT NULL,
  `replied_user` varchar(450) DEFAULT NULL,
  `idusers` varchar(45) DEFAULT NULL,
  `response` varchar(45) DEFAULT '0',
  `filereply` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idquestion`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,'Heart disease','i have been visited the doctor last week','','asdasdasdasdasd','1','2','1','1652048309otipax.jpg'),(2,'Heart disease','desc','1652075107pharmacy.jpg','reply\r\n','1','1','1','');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-24 18:09:13
