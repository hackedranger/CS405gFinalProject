-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: mysql    Database: jtpo224
-- ------------------------------------------------------
-- Server version	5.5.5-10.0.31-MariaDB-0ubuntu0.16.04.2

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
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `author` varchar(30) DEFAULT NULL,
  `ISBN` int(13) NOT NULL,
  KEY `ISBN` (`ISBN`),
  CONSTRAINT `authors_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_keywords`
--

DROP TABLE IF EXISTS `book_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_keywords` (
  `ISBN` int(13) DEFAULT NULL,
  `KEYWORD` varchar(30) NOT NULL,
  KEY `ISBN` (`ISBN`),
  CONSTRAINT `book_keywords_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_keywords`
--

LOCK TABLES `book_keywords` WRITE;
/*!40000 ALTER TABLE `book_keywords` DISABLE KEYS */;
/*!40000 ALTER TABLE `book_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `ISBN` int(13) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `publisher` varchar(30) DEFAULT NULL,
  `language` varchar(15) DEFAULT NULL,
  `pubDate` date DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `QUANTITY` int(11) NOT NULL DEFAULT '0',
  `subject` varchar(20) DEFAULT NULL,
  `summary` text,
  PRIMARY KEY (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `orderNumber` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `ISBN` int(13) DEFAULT NULL,
  `ccNumber` int(11) NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `status` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `billingAddr` varchar(30) NOT NULL,
  `orderDate` date NOT NULL,
  `shippingAddr` varchar(30) NOT NULL,
  PRIMARY KEY (`orderNumber`),
  KEY `UID` (`UID`),
  KEY `ISBN` (`ISBN`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `UID` int(11) NOT NULL,
  `ISBN` int(13) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text,
  KEY `UID` (`UID`),
  KEY `ISBN` (`ISBN`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('manager','customer') NOT NULL DEFAULT 'customer',
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-16  7:17:43
