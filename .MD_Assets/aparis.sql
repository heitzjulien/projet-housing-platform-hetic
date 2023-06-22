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
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authentifications`
--

LOCK TABLES `authentifications` WRITE;
/*!40000 ALTER TABLE `authentifications` DISABLE KEYS */;
INSERT INTO `authentifications` VALUES (108,10,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36','$2y$10$wglEL5nKfecXXBQkxIVjXeug.EOvHY/8xLYhw4lyHmyQyUVxoIDuS','2023-06-20 12:21:55','2023-07-20 12:21:55');
/*!40000 ALTER TABLE `authentifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_reservation_id` (`reservation_id`),
  KEY `conversations_client_id_fk` (`client_id`),
  CONSTRAINT `conversations_client_id_fk` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE
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
  PRIMARY KEY (`id`),
  KEY `housekeeping_ibfk_1` (`user_id`),
  KEY `housekeeping_housing_id_fk` (`housing_id`),
  CONSTRAINT `housekeeping_housing_id_fk` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`) ON DELETE CASCADE,
  CONSTRAINT `housekeeping_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
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
  PRIMARY KEY (`id`),
  KEY `housekeeping_notes_ibfk_1` (`housekeeping_id`),
  CONSTRAINT `housekeeping_notes_ibfk_1` FOREIGN KEY (`housekeeping_id`) REFERENCES `housekeeping` (`id`) ON DELETE CASCADE
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
  `description` text NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `instruction` varchar(255) DEFAULT NULL,
  `number_pieces` int(11) NOT NULL,
  `number_rooms` int(11) NOT NULL,
  `number_bathroom` int(11) NOT NULL,
  `exterior` set('pool','terrace','garden','gym') DEFAULT NULL,
  `car_park` set('garage','underground_parking','parking_spot','covered_parking_space') DEFAULT NULL,
  `area` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing`
--

LOCK TABLES `housing` WRITE;
/*!40000 ALTER TABLE `housing` DISABLE KEYS */;
INSERT INTO `housing` VALUES (1,'Appartement',4,300,'lorem','lorem','lorem',5,2,2,NULL,NULL,90),(2,'Appartement',6,450,'lorem','lorem','lorem',7,4,3,NULL,NULL,120),(3,'Appartement',2,250,'lorem','lorem','lorem',5,1,1,NULL,'garage',100),(4,'Appartement',8,800,'lorem','lorem','lorem',10,6,3,'terrace,gym',NULL,250);
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
  PRIMARY KEY (`housing_id`,`image`),
  CONSTRAINT `housing_images_housing_id_fk` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing_images`
--

LOCK TABLES `housing_images` WRITE;
/*!40000 ALTER TABLE `housing_images` DISABLE KEYS */;
INSERT INTO `housing_images` VALUES (1,'https://static.wixstatic.com/media/5d0cb1_4b077f93a2df451c9bbc69ab3cd27791~mv2.jpg'),(1,'https://upload.wikimedia.org/wikipedia/commons/7/7a/7_rue_Alfred-de-Vigny_Paris.jpg'),(1,'https://www.architoi.com/wp-content/uploads/2023/05/artdeco-rovere-chevron-spina-13.jpg'),(2,'https://v.seloger.com/s/width/800/visuels/0/e/c/k/0eckul97gfqiserr8d0y9ri67y25ex6zhm15w8m40.jpg'),(2,'https://v.seloger.com/s/width/800/visuels/1/4/q/n/14qn5jipf94rpnbwolp12tqnvjr6vux0m8yekabqo.jpg'),(2,'https://v.seloger.com/s/width/800/visuels/1/x/3/n/1x3nmtq06m2obaq5vd6wcforrk2q3k916p48m2700.jpg'),(3,'https://v.seloger.com/s/width/800/visuels/0/2/y/j/02yjsxj9lsfb7g7jinll5owjrvhp0rb8dx0r1cfe8.jpg'),(3,'https://v.seloger.com/s/width/800/visuels/0/r/k/v/0rkv2fzegr80l9tg8nf3wq1k1kprj3ylt6y33opgw.jpg'),(3,'https://v.seloger.com/s/width/800/visuels/0/v/y/f/0vyf57iw7h7y6ibhhvlbux5ds6d69dbkzyaum5ecw.jpg'),(4,'https://v.seloger.com/s/cdn/x/visuels/1/m/0/u/1m0ujf1l86u49z3gdqwqvu05isb49jr5rt7ab8fls.jpg'),(4,'https://v.seloger.com/s/cdn/x/visuels/1/u/n/w/1unwbkiniv9w1v6glstsel5ethmajacmjbr42hx4w.jpg'),(4,'https://v.seloger.com/s/cdn/x/visuels/2/5/b/l/25bl0mj717jvt70wt1t0ppj3aizw6y8smw2077pj4.jpg'),(4,'https://v.seloger.com/s/cdn/x/visuels/2/a/7/u/2a7u09pocns01r4i3wd6knomsnpb8k61v8gr9iccg.jpg');
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
  UNIQUE KEY `uc_location` (`country`,`city`,`zip`,`district`,`address`),
  CONSTRAINT `housing_location_housing_id_fk` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing_location`
--

LOCK TABLES `housing_location` WRITE;
/*!40000 ALTER TABLE `housing_location` DISABLE KEYS */;
INSERT INTO `housing_location` VALUES (1,'France','Paris','75006','06','17 Rue de la Paix'),(4,'France','Paris','75009','09','24 Place de la Concorde'),(2,'France','Paris','75012','12','07 Avenue des Champs-Élysées'),(3,'France','Paris','75017','17','33 Boulevard Saint-Germain');
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
INSERT INTO `housing_services` VALUES (2,1),(4,1),(3,2),(1,3),(4,3),(2,4),(3,5),(1,6),(4,6),(2,7),(1,8),(4,9);
/*!40000 ALTER TABLE `housing_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `housing_unavailability`
--

DROP TABLE IF EXISTS `housing_unavailability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `housing_unavailability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `housing_id` int(11) NOT NULL,
  `unavailability_start` date NOT NULL,
  `unavailability_end` date NOT NULL,
  `unavailability_status` enum('booked','checkout','renovation') NOT NULL,
  `reservation_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `housing_id` (`housing_id`),
  KEY `fk_housing_unavailability_reservation` (`reservation_id`),
  CONSTRAINT `fk_housing_unavailability_reservation` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `housing_unavailability_ibfk_1` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing_unavailability`
--

LOCK TABLES `housing_unavailability` WRITE;
/*!40000 ALTER TABLE `housing_unavailability` DISABLE KEYS */;
INSERT INTO `housing_unavailability` VALUES (12,1,'2023-06-13','2023-06-18','booked',10),(16,2,'2023-06-23','2023-06-25','booked',14),(18,2,'2023-06-26','2023-06-30','booked',16),(21,3,'2023-06-26','2023-06-30','booked',19),(22,3,'2023-07-01','2023-07-04','booked',20);
/*!40000 ALTER TABLE `housing_unavailability` ENABLE KEYS */;
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
  PRIMARY KEY (`id`),
  KEY `messages_ibfk_1` (`conversation_id`),
  KEY `messages_user_id_fk` (`user_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
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
  PRIMARY KEY (`message_id`,`image`),
  CONSTRAINT `messages_images_message_id_fk` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `housing_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `display` enum('hide','show') NOT NULL DEFAULT 'hide',
  PRIMARY KEY (`id`),
  KEY `opinions_user_id_fk` (`user_id`),
  KEY `opinions_housing_id_fk` (`housing_id`),
  KEY `opinions_reservation_id_fk` (`reservation_id`),
  CONSTRAINT `opinions_housing_id_fk` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`) ON DELETE CASCADE,
  CONSTRAINT `opinions_reservation_id_fk` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `opinions_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
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
  PRIMARY KEY (`opinion_id`,`image`),
  CONSTRAINT `fk_opinions_images_opinion_id` FOREIGN KEY (`opinion_id`) REFERENCES `opinions` (`id`) ON DELETE CASCADE
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `housing_id` int(11) NOT NULL,
  `reservation_period` int(11) NOT NULL,
  `reservation_total_price` int(11) NOT NULL,
  `reservation_status` enum('pass','accept','cancel','currently') NOT NULL DEFAULT 'accept',
  PRIMARY KEY (`id`),
  KEY `fk_reservations_user_id` (`user_id`),
  KEY `fk_reservations_housing_id` (`housing_id`),
  CONSTRAINT `fk_reservations_housing_id` FOREIGN KEY (`housing_id`) REFERENCES `housing` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_reservations_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (10,1,1,7,2100,'pass'),(14,1,2,2,900,'currently'),(16,1,2,4,1800,'accept'),(19,1,3,4,1000,'accept'),(20,1,3,3,750,'accept');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'service_icon_1','Service de conciergerie 24/7','Assistance disponible 24 heures sur 24 pour répondre aux demandes des résidents.'),(2,'service_icon_2','Service de nettoyage et d\'entretien régulier','Nettoyage et entretien régulier de l\'appartement pour maintenir un niveau de propreté élevé.'),(3,'service_icon_3','Service de voiturier','Stationnement et gestion des véhicules des résidents assurés par un service de voiturier.'),(4,'service_icon_4','Service de sécurité et de surveillance','Sécurité et surveillance pour garantir la tranquillité et la protection des résidents.'),(5,'service_icon_5','Service de spa et de bien-être','Massages et soins de beauté dispensés dans l\'intimité de l\'appartement.'),(6,'service_icon_6','Service de livraison de repas gastronomiques','Livraison de repas gastronomiques à l\'appartement ou service d\'un chef privé pour des dîners exclusifs.'),(7,'service_icon_7','Service de conciergerie en voyage','Assistance dans la planification de voyages, réservation de billets d\'avion, d\'hôtels et d\'activités.'),(8,'service_icon_8','Service de location de voitures de luxe','Location de voitures de luxe ou service de chauffeur privé pour les déplacements.'),(9,'service_icon_9','Service de salle de sport et de remise en forme','Équipements haut de gamme et entraîneur personnel pour des séances d\'exercice privées.'),(10,'service_icon_10','Service de garderie pour enfants','Activités ludiques et surveillance professionnelle pour les enfants des résidents.');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Benjamin','SCHINKEL','b_schinkel@hetic.eu','$2y$10$VyEce85T1gXP8SAktpGvw.87qSH7jsJPdi7pUZX.Aia2zQXUBebOK','2001-12-16','client,admin','2023-06-13 03:43:04','valid','2023-06-22 22:29:44'),(3,'Julien','Heitz','j_heitz@hetic.eu','$2y$10$3ZBo5Vd.zwOeS/PnJK9VD.xbE86EO5NJlJmgTFvqkNmRcVPm7QaA2','2001-04-30','client,admin','2023-06-13 04:02:22','valid','2023-06-13 04:02:22'),(4,'Tanguy','Claude','t_claude@hetic.eu','$2y$10$PfiL6brtpUhF.OO1yZyBkueR21f/wQtwgiJIsCuLo1Af6sw3GHdoi','2001-03-21','client','2023-06-18 17:21:51','waiting','2023-06-18 21:44:16'),(5,'Louisan','Tchitoula','l_tchitoula@hetic.eu','$2y$10$pnqgog5JR4xCxybNYVCkCOCFH5jk4UmgohkhUR20WBMKbsFKiboDC','2001-01-01','client,admin','2023-06-20 14:00:34','valid','2023-06-20 12:00:38'),(6,'Sabrina','Attos','s_attos@hetic.eu','$2y$10$py3DaPWDIrGmxRdbqXv84Ogaj/ocXvCcCpfPQCq5WvUq7N7fP2wsK','2001-01-01','client,admin','2023-06-20 14:01:09','valid','2023-06-20 12:01:12'),(7,'Alessandro','Garau','a_garau@hetic.eu','$2y$10$nZJIRG/3/nD5QXtmnuwM3enA5UTFoUq7XaJysukM6gK3nf9OQtwDG','2001-01-01','client,admin','2023-06-20 14:01:42','valid','2023-06-20 12:01:45'),(8,'Marie-Gwenaëlle','Fahem','m_fahem@hetic.eu','$2y$10$q/qdZO05ywj0zXJiKvhTFueQqbCKfYkdzgAzvaEdWu/nrIk73NXWO','2001-01-01','client,admin','2023-06-20 14:02:30','valid','2023-06-20 12:02:34'),(9,'Marie','René','m_rene@hetic.eu','$2y$10$nFUSEBOQafSD0lFiL/KkWeVoerxFOui5uX1qMHtO7SxI8lfaoxp8m','2001-01-01','client,admin','2023-06-20 14:03:02','valid','2023-06-20 12:03:08'),(10,'John','Doe','j_doe@hetic.eu','$2y$10$I9LezQX7nvXVd8FTiUHazecAui3bkJI1PUSyefoPjx2xcvaGRZzXq','2001-01-01','client','2023-06-20 14:21:54','waiting','2023-06-20 14:21:54');
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

-- Dump completed on 2023-06-23  1:12:05
