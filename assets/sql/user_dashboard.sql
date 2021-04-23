-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: user_dashboard
-- ------------------------------------------------------
-- Server version	5.7.31

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `comment` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,1,'hello','2021-04-23 17:48:22',NULL),(2,1,2,'asdasd','2021-04-23 17:53:42',NULL),(3,1,2,'asdasd','2021-04-23 18:03:58',NULL),(4,1,2,'asdasd','2021-04-23 18:04:39',NULL),(5,1,2,'asdasd','2021-04-23 18:04:53',NULL),(6,1,7,'hello','2021-04-23 21:06:34',NULL),(7,1,6,'new post','2021-04-23 22:12:29',NULL),(8,1,6,'new post','2021-04-23 22:16:01',NULL),(9,1,6,'new post','2021-04-23 22:19:28',NULL),(10,4,9,'hello','2021-04-23 22:44:26',NULL),(11,4,6,'Aloha Admin','2021-04-23 22:45:53',NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `wall` int(11) DEFAULT NULL,
  `message` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,1,'Hello! This is my Post!','2021-04-23 16:52:32',NULL),(2,1,1,'Hey This is my Second Post','2021-04-23 16:54:53',NULL),(3,1,1,'Third Post!','2021-04-23 16:55:31',NULL),(4,1,1,'Hee Yah!!','2021-04-23 16:57:49',NULL),(5,1,1,'Test Please Work!','2021-04-23 16:59:48',NULL),(6,1,1,'asdasd','2021-04-23 17:01:04',NULL),(7,1,3,'Hello','2021-04-23 21:03:33',NULL),(8,1,3,'Yeah! It\'s working','2021-04-23 21:06:47',NULL),(9,1,2,'Hello','2021-04-23 22:27:50',NULL),(10,4,2,'yeah','2021-04-23 22:44:35',NULL),(11,4,4,'Aloha!','2021-04-23 22:44:49',NULL);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_level` varchar(10) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Christian Earle','Peralta','christianearle01@gmail.com','da7b00dc27e0deed60ea01aed0bcba52','admin','Hello! What A Nice Day! ^_^','2021-04-22 21:14:03','2021-04-23 14:23:21'),(2,'Christian','Peralta','christianearle@gmail.com','da7b00dc27e0deed60ea01aed0bcba52','normal',NULL,'2021-04-22 21:17:08','2021-04-23 09:35:07'),(3,'Earle','Peralta','earle@gmail.com','da7b00dc27e0deed60ea01aed0bcba52','admin',NULL,'2021-04-22 22:00:07','2021-04-23 14:24:12'),(4,'lepleplep','lepleplep','lep@gmail.com','7af079969e226b8a62c5483637d7e33a','normal',NULL,'2021-04-23 22:30:48',NULL);
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

-- Dump completed on 2021-04-23 22:56:48
