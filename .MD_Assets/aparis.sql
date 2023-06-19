-- MySQL dump 10.13  Distrib 5.7.39, for osx11.0 (x86_64)
--
-- Host: localhost    Database: aparis
-- ------------------------------------------------------
-- Server version	5.7.39

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
-- Table structure for table `authentifications`
--

DROP TABLE IF EXISTS `authentifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authentifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token_end` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_user_agent` (`user_id`,`agent`),
  CONSTRAINT `authentifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authentifications`
--

LOCK TABLES `authentifications` WRITE;
/*!40000 ALTER TABLE `authentifications` DISABLE KEYS */;
INSERT INTO `authentifications` VALUES (101,1,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36','$2y$10$AoYABL2l2C6MvnKDV3gKqO3eGSHFo4D95Iv5fQJ2POXscjX6otpfC','2023-06-19 08:12:52','2023-07-19 08:12:52');
/*!40000 ALTER TABLE `authentifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_reservation_id` (`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `housekeeping`
--

DROP TABLE IF EXISTS `housekeeping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `housekeeping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `housing_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `status` enum('ToDo','InProgress','Done') NOT NULL DEFAULT 'ToDo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housekeeping`
--

LOCK TABLES `housekeeping` WRITE;
/*!40000 ALTER TABLE `housekeeping` DISABLE KEYS */;
/*!40000 ALTER TABLE `housekeeping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `housekeeping_notes`
--

DROP TABLE IF EXISTS `housekeeping_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `housekeeping_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `housekeeping_id` int(11) NOT NULL,
  `note_content` text NOT NULL,
  `note_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housekeeping_notes`
--

LOCK TABLES `housekeeping_notes` WRITE;
/*!40000 ALTER TABLE `housekeeping_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `housekeeping_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `housing`
--

DROP TABLE IF EXISTS `housing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `housing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `note` text,
  `instruction` text,
  `number_pieces` int(11) NOT NULL,
  `number_rooms` int(11) NOT NULL,
  `number_bathroom` int(11) NOT NULL,
  `exterior` set('pool','terrace','garden') DEFAULT NULL,
  `car_park` set('garage','underground_parking','Parking_spot','Covered_parking_space') DEFAULT NULL,
  `area` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing`
--

LOCK TABLES `housing` WRITE;
/*!40000 ALTER TABLE `housing` DISABLE KEYS */;
/*!40000 ALTER TABLE `housing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `housing_images`
--

DROP TABLE IF EXISTS `housing_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `housing_images` (
  `housing_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`housing_id`,`image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing_images`
--

LOCK TABLES `housing_images` WRITE;
/*!40000 ALTER TABLE `housing_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `housing_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `housing_location`
--

DROP TABLE IF EXISTS `housing_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `housing_location` (
  `housing_id` int(11) NOT NULL,
  `country` enum('France') NOT NULL DEFAULT 'France',
  `city` enum('Paris') NOT NULL DEFAULT 'Paris',
  `zip` enum('75001','75002','75003','75004','75005','75006','75007','75008','75009','75010','75011','75012','75013','75014','75015','75016','75017','75018','75019','75020') NOT NULL,
  `district` enum('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20') NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`housing_id`),
  UNIQUE KEY `uc_location` (`country`,`city`,`zip`,`district`,`address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing_location`
--

LOCK TABLES `housing_location` WRITE;
/*!40000 ALTER TABLE `housing_location` DISABLE KEYS */;
/*!40000 ALTER TABLE `housing_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `housing_services`
--

DROP TABLE IF EXISTS `housing_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `housing_services` (
  `housing_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`housing_id`,`service_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `housing_services_ibfk_1` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`) ON DELETE CASCADE,
  CONSTRAINT `housing_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing_services`
--

LOCK TABLES `housing_services` WRITE;
/*!40000 ALTER TABLE `housing_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `housing_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `housing_unavailability`
--

DROP TABLE IF EXISTS `housing_unavailability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `housing_unavailability` (
  `id` int(11) NOT NULL,
  `housing_id` int(11) NOT NULL,
  `unavailability_start` datetime NOT NULL,
  `unavailability_end` datetime NOT NULL,
  `unavailability_status` enum('booked','checkout','renovation') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `housing_id` (`housing_id`),
  CONSTRAINT `housing_unavailability_ibfk_1` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing_unavailability`
--

LOCK TABLES `housing_unavailability` WRITE;
/*!40000 ALTER TABLE `housing_unavailability` DISABLE KEYS */;
/*!40000 ALTER TABLE `housing_unavailability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `housing_unavailability_booked_extra`
--

DROP TABLE IF EXISTS `housing_unavailability_booked_extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `housing_unavailability_booked_extra` (
  `unavailability_id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`unavailability_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing_unavailability_booked_extra`
--

LOCK TABLES `housing_unavailability_booked_extra` WRITE;
/*!40000 ALTER TABLE `housing_unavailability_booked_extra` DISABLE KEYS */;
/*!40000 ALTER TABLE `housing_unavailability_booked_extra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('send','read') NOT NULL DEFAULT 'send',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages_images`
--

DROP TABLE IF EXISTS `messages_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages_images` (
  `message_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`message_id`,`image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages_images`
--

LOCK TABLES `messages_images` WRITE;
/*!40000 ALTER TABLE `messages_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opinions`
--

DROP TABLE IF EXISTS `opinions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opinions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `housing_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `display` enum('hide','show') NOT NULL DEFAULT 'hide',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinions`
--

LOCK TABLES `opinions` WRITE;
/*!40000 ALTER TABLE `opinions` DISABLE KEYS */;
/*!40000 ALTER TABLE `opinions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opinions_images`
--

DROP TABLE IF EXISTS `opinions_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opinions_images` (
  `opinion_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`opinion_id`,`image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinions_images`
--

LOCK TABLES `opinions_images` WRITE;
/*!40000 ALTER TABLE `opinions_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `opinions_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `housing_id` int(11) NOT NULL,
  `reservation_period` int(11) NOT NULL,
  `reservation_total_price` int(11) NOT NULL,
  `reservation_status` enum('pass','accept','cancel') NOT NULL DEFAULT 'accept',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `roles` set('client','management','maintenance','admin') NOT NULL DEFAULT 'client',
  `account_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_status` enum('waiting','valid','disable') NOT NULL DEFAULT 'waiting',
  `last_seen` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Benjamin','SCHINKEL','b_schinkel@hetic.eu','$2y$10$VghD73ek5HWc5aVR/jpnPeBauIN3XlFn/TR6SosNZeGqtK8i5oUSK','2001-12-16','client,admin','2023-06-13 03:43:04','valid','2023-06-19 08:27:00'),(3,'Julien','Heitz','j_heitz@hetic.eu','$2y$10$3ZBo5Vd.zwOeS/PnJK9VD.xbE86EO5NJlJmgTFvqkNmRcVPm7QaA2','2001-04-30','client','2023-06-13 04:02:22','waiting','2023-06-13 04:02:22'),(4,'Tanguy','Claude','t_claude@hetic.eu','$2y$10$PfiL6brtpUhF.OO1yZyBkueR21f/wQtwgiJIsCuLo1Af6sw3GHdoi','2001-03-21','client','2023-06-18 17:21:51','waiting','2023-06-18 21:44:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_admins_extra`
--

DROP TABLE IF EXISTS `users_admins_extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_admins_extra` (
  `user_id` int(11) NOT NULL,
  `role_subrogation` enum('client','management','maintenance','admin') NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `users_admins_extra_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_admins_extra`
--

LOCK TABLES `users_admins_extra` WRITE;
/*!40000 ALTER TABLE `users_admins_extra` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_admins_extra` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-19 10:35:18
