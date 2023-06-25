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
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authentifications`
--

LOCK TABLES `authentifications` WRITE;
/*!40000 ALTER TABLE `authentifications` DISABLE KEYS */;
INSERT INTO `authentifications` VALUES (140,1,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36','$2y$10$AawupIxW/axhM2mK0Ks9BuEhHR6eX94.ooVeJQjjs5Pudsbf4rf/C','2023-06-25 11:59:57','2023-07-25 11:59:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing`
--

LOCK TABLES `housing` WRITE;
/*!40000 ALTER TABLE `housing` DISABLE KEYS */;
INSERT INTO `housing` VALUES (34,'Appartement Le Marais',2,120,'Un charmant appartement situé dans le quartier animé du Marais.',NULL,NULL,4,2,1,'terrace,garden','garage,parking_spot',80),(35,'Appartement Saint-Germain',3,180,'Un élégant appartement situé dans le quartier chic de Saint-Germain-des-Prés.',NULL,NULL,5,3,2,'pool,terrace','underground_parking',100),(36,'Appartement Montmartre',4,200,'Un appartement pittoresque avec vue sur la célèbre basilique du Sacré-Cœur.',NULL,NULL,3,2,1,'garden,gym','covered_parking_space',90),(37,'Appartement Le Marais 2',2,150,'Un appartement moderne et confortable au cœur du quartier du Marais.',NULL,NULL,2,1,1,'terrace','parking_spot',60),(38,'Appartement Champs-Élysées',6,300,'Un luxueux appartement offrant une vue imprenable sur les Champs-Élysées.',NULL,NULL,6,4,2,'pool,terrace','garage,underground_parking',150),(39,'Appartement Latin Quarter',3,170,'Un appartement confortable niché dans le quartier animé du Quartier Latin.',NULL,NULL,4,2,1,'garden','parking_spot',75),(40,'Appartement Le Marais 3',4,220,'Un spacieux appartement rénové avec goût dans le quartier branché du Marais.',NULL,NULL,5,3,2,'terrace,garden,gym','garage',110),(41,'Appartement Montmartre 2',2,130,'Un appartement confortable et lumineux au pied de la butte Montmartre.',NULL,NULL,3,1,1,'garden,gym','parking_spot',70),(42,'Appartement Île de la Cité',2,140,'Un appartement élégant offrant une vue magnifique sur la Seine et la cathédrale Notre-Dame.',NULL,NULL,3,1,1,'terrace','covered_parking_space',65),(43,'Appartement Le Marais 4',3,180,'Un appartement récemment rénové situé dans le quartier prisé du Marais.',NULL,NULL,4,2,1,'terrace,gym','underground_parking',85),(44,'Appartement Montparnasse',4,210,'Un appartement moderne et spacieux près de la tour Montparnasse.',NULL,NULL,5,3,2,'pool','garage,parking_spot',95),(45,'Appartement Belleville',3,160,'Un appartement confortable avec une vue panoramique sur le quartier de Belleville.',NULL,NULL,4,2,1,'terrace,garden','covered_parking_space',80),(46,'Appartement Le Marais 5',2,140,'Un appartement idéalement situé au cœur du Marais, à proximité des boutiques et des restaurants.',NULL,NULL,3,1,1,'terrace','parking_spot',60),(47,'Appartement Montmartre 3',4,200,'Un appartement avec une atmosphère bohème offrant une vue imprenable sur la ville depuis la butte Montmartre.',NULL,NULL,5,3,2,'garden,gym','garage,parking_spot',95),(48,'Appartement Le Marais 6',2,130,'Un appartement élégant situé dans une rue calme du Marais, à quelques pas des principales attractions.',NULL,NULL,2,1,1,'terrace','parking_spot',55),(49,'Appartement Saint-Germain 2',3,190,'Un appartement spacieux avec des touches de design moderne, idéal pour les familles ou les groupes.',NULL,NULL,4,2,1,'pool,terrace','underground_parking',85),(50,'Appartement Montmartre 4',2,150,'Un appartement chaleureux situé dans le quartier bohème de Montmartre, à proximité des cafés et des artistes de rue.',NULL,NULL,3,1,1,'garden','parking_spot',70),(51,'Appartement Le Marais 7',4,220,'Un appartement élégant et lumineux au cœur du quartier du Marais, à quelques pas des meilleurs magasins et restaurants.',NULL,NULL,5,3,2,'terrace,garden,gym','covered_parking_space',100),(52,'Appartement Latin Quarter 2',3,180,'Un appartement confortable situé dans le Quartier Latin, à proximité des universités et des sites historiques.',NULL,NULL,4,2,1,'garden','parking_spot',75),(53,'Appartement Le Marais 8',5,250,'Un appartement spacieux et élégant dans le quartier tendance du Marais, idéal pour les séjours en famille ou entre amis.',NULL,NULL,6,4,2,'terrace,garden,gym','garage,underground_parking',120),(54,'Appartement Champs-Élysées 2',2,130,'Un appartement moderne et confortable offrant une vue imprenable sur l\'avenue des Champs-Élysées.',NULL,NULL,3,1,1,'terrace','covered_parking_space',65),(55,'Appartement Montmartre 5',4,210,'Un charmant appartement situé au pied de la butte Montmartre, à proximité des cafés et des artistes.',NULL,NULL,4,2,1,'garden,gym','parking_spot',90),(56,'Appartement Le Marais 9',2,140,'Un appartement confortable et bien équipé dans le quartier branché du Marais, à quelques pas des meilleurs bars et restaurants.',NULL,NULL,3,1,1,'terrace','parking_spot',60),(57,'Appartement Montparnasse 2',3,180,'Un appartement moderne et spacieux offrant une vue panoramique sur la tour Montparnasse.',NULL,NULL,4,2,1,'pool','garage,parking_spot',80),(58,'Appartement Belleville 2',4,220,'Un appartement lumineux avec une terrasse donnant sur le quartier éclectique de Belleville.',NULL,NULL,5,3,2,'terrace,garden,gym','underground_parking',100);
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
INSERT INTO `housing_images` VALUES (34,'https://v.seloger.com/s/cdn/x/visuels/0/k/w/0/0kw06vz5oli02s5bh0ghawyulmf8vvs47x09ww5fk.jpg'),(34,'https://v.seloger.com/s/cdn/x/visuels/1/1/j/6/11j6ct5mc9aq12lyr9krg2g87k6keina61mmhq5j4.jpg'),(34,'https://v.seloger.com/s/cdn/x/visuels/1/6/u/h/16uhjhuqspzrnnh3gs5yrztn2h0g5s5zglha9lzeo.jpg'),(34,'https://v.seloger.com/s/cdn/x/visuels/1/g/j/7/1gj724mnrgfwhetzzje7md95yhnwyifll1jwl5gg0.jpg'),(34,'https://v.seloger.com/s/cdn/x/visuels/1/i/o/q/1ioqvqrl4k4jh9ykbww6vx4ikilz2se2n2jfmfb0g.jpg'),(35,'https://v.seloger.com/s/cdn/x/visuels/0/e/7/e/0e7eyaj5z3dwvmiawodx0q6t8p7ytmwohrhpmfy0w.jpg'),(35,'https://v.seloger.com/s/cdn/x/visuels/0/l/l/v/0llvvarpxtml0f553p9lfwquh9xkg99e8d4q8ruo0.jpg'),(35,'https://v.seloger.com/s/cdn/x/visuels/0/y/l/n/0ylncc36u1uaxbmfafhf0ti5tcnf633eninhskh6o.jpg'),(35,'https://v.seloger.com/s/cdn/x/visuels/1/2/s/v/12svmx5a4jedyoq1cgi33kakh2kk3i8xr9dce21vk.jpg'),(35,'https://v.seloger.com/s/cdn/x/visuels/1/c/2/5/1c25zde740juewrv8zdmwkw39ceoyxp3yie6108hs.jpg'),(36,'https://v.seloger.com/s/cdn/x/visuels/0/i/4/2/0i423ijfejo0vrghveja66xhdeckw3r5k9jg2gyi8.jpg'),(36,'https://v.seloger.com/s/cdn/x/visuels/0/j/q/6/0jq66wlnxiywhv6vqibujbyo5l2yfq3um2p7k2nqo.jpg'),(36,'https://v.seloger.com/s/cdn/x/visuels/0/l/2/c/0l2cfl622u48vbo5453l12bmusy6zwqemrlarvp9s.jpg'),(36,'https://v.seloger.com/s/cdn/x/visuels/0/n/k/2/0nk2got91u2fexbxvcsi1c5ehoiud8rwr6d8ncsz4.jpg'),(36,'https://v.seloger.com/s/cdn/x/visuels/2/5/y/u/25yu39nzyhfchimlfj9o1e702e346ve6o6gg7go1c.jpg'),(37,'https://v.seloger.com/s/cdn/x/visuels/1/g/c/5/1gc5rgmzgjcgkzk7pwphtwx410nyddpz9g3zxosn4.jpg'),(37,'https://v.seloger.com/s/cdn/x/visuels/1/g/z/e/1gzer0ss380oorfeyrkg7r2p2isg2jszwzxq3yn0g.jpg'),(37,'https://v.seloger.com/s/cdn/x/visuels/1/j/k/f/1jkfasi9sl92dk3266d0ugw27ax9hstistcyfhzb4.jpg'),(37,'https://v.seloger.com/s/cdn/x/visuels/1/l/3/e/1l3evap0lmurib99rzzef9f0fbt8hvv1lajebyby8.jpg'),(37,'https://v.seloger.com/s/cdn/x/visuels/1/u/k/k/1ukk2ibu73ad6p8rmyutvnqdzjgv4ajtbkxdcl6gw.jpg'),(38,'https://v.seloger.com/s/cdn/x/visuels/0/0/2/7/0027koyhan7bfvmqdo1lj0habyp4w2cbnjcyfwqqa.jpg'),(38,'https://v.seloger.com/s/cdn/x/visuels/0/l/g/6/0lg6r2jcsxupeqoql0tjy20ah6zgqgb4tqdvq0pci.jpg'),(38,'https://v.seloger.com/s/cdn/x/visuels/0/z/k/1/0zk1qumabtpzwj9qw42inesgjyhelxgqgou5u040i.jpg'),(38,'https://v.seloger.com/s/cdn/x/visuels/1/6/u/0/16u0uf1nyvog5looami0cs9r92bn4apxl81foa72q.jpg'),(38,'https://v.seloger.com/s/cdn/x/visuels/1/9/q/c/19qcjnjjlw02ene36obqheggeyixamsorua4i48k2.jpg'),(39,'https://v.seloger.com/s/cdn/x/visuels/0/r/9/v/0r9v8rfyqt31kn0mh1vcl2c8djrshaji0btvy7b6g.jpg'),(39,'https://v.seloger.com/s/cdn/x/visuels/0/u/6/t/0u6tmarmqfmzxsmdewh3rq96v3xg0rj6l1lr5z4go.jpg'),(39,'https://v.seloger.com/s/cdn/x/visuels/1/c/x/4/1cx46l5lo9cse8b2d88uqp9hbm9j2sh0x7150l26w.jpg'),(39,'https://v.seloger.com/s/cdn/x/visuels/2/9/b/l/29blx09ienoiornoy848z5hw7xyul4p94wpwtgg2g.jpg'),(39,'https://v.seloger.com/s/cdn/x/visuels/2/a/v/g/2avgqi6wsacyj5kaxidrrtgms45ulzp7wxc7n1hlk.jpg'),(40,'https://v.seloger.com/s/cdn/x/visuels/0/c/p/k/0cpk32bp8fig1n89iwvb9zknu6unaun2ojqdvi0k4.jpg'),(40,'https://v.seloger.com/s/cdn/x/visuels/0/g/a/l/0galr251xiq39m1pzemblc9fk9ai86h8ffuy7pl5g.jpg'),(40,'https://v.seloger.com/s/cdn/x/visuels/0/s/y/d/0sydmrce11kysg8ly5xtqgrpmreuzmh86vx2wje50.jpg'),(40,'https://v.seloger.com/s/cdn/x/visuels/0/y/l/a/0yladv07vlnv92y4yio65lffn23hy2efga4sawdhw.jpg'),(40,'https://v.seloger.com/s/cdn/x/visuels/2/5/4/2/2542oi1zk3i376j2xw08ylq645f1qqgtmph3ihil0.jpg'),(41,'https://v.seloger.com/s/cdn/x/visuels/0/l/9/u/0l9u207s3fxlrjdxcu5bhofvdj0za1ov4ymvjljmo.jpg'),(41,'https://v.seloger.com/s/cdn/x/visuels/1/0/h/v/10hvbyvcjxka4sicazdrylipab4h75ymvniyynusg.jpg'),(41,'https://v.seloger.com/s/cdn/x/visuels/1/1/t/d/11tdg5djfugrlinshrlhqdyceoken0kp5b8t6ra1s.jpg'),(41,'https://v.seloger.com/s/cdn/x/visuels/1/g/2/o/1g2oult7u1r5x7ynktp6tl9t2h1cc80l99fft2sgs.jpg'),(41,'https://v.seloger.com/s/cdn/x/visuels/1/m/u/m/1mum0bw5vemsd2fw4onlrlh0qhdq92sxvwy1w8m1s.jpg'),(42,'https://v.seloger.com/s/cdn/x/visuels/0/0/4/6/00465a715bnosjnqpvm471o7cw1whyrcd4fsg2www.jpg'),(42,'https://v.seloger.com/s/cdn/x/visuels/0/x/o/s/0xosonc9q1h9lldhz5bdgghrnszfmwggrx8of697k.jpg'),(42,'https://v.seloger.com/s/cdn/x/visuels/1/u/y/9/1uy9cltv6rs6hbqpz4sdh3ltbz04dggmza6vls6xs.jpg'),(42,'https://v.seloger.com/s/cdn/x/visuels/1/v/b/w/1vbwejtu80uvcw23y6xzhyyv2n5sf54u4osirt5b4.jpg'),(42,'https://v.seloger.com/s/cdn/x/visuels/2/3/9/w/239wcp9nyp2c1cxk384g5gt5nxh2ssbdq6mc5ob34.jpg'),(43,'https://v.seloger.com/s/cdn/x/visuels/0/3/n/0/03n0z1jvxrvm6cven8jcmowrovut1i2ljrx39c4es.jpg'),(43,'https://v.seloger.com/s/cdn/x/visuels/0/6/v/t/06vtato5c4kcqvj686nxt2wx343fjt157dyugekb7.jpg'),(43,'https://v.seloger.com/s/cdn/x/visuels/0/o/s/j/0osj19g7wbv8d41w615288rnldvj9tfl3r6nf1103.jpg'),(43,'https://v.seloger.com/s/cdn/x/visuels/0/v/z/r/0vzrbcf0kccdy344rvytrw9oshcpseittuyfqohub.jpg'),(43,'https://v.seloger.com/s/cdn/x/visuels/1/o/r/w/1orw2hersjipcrnfht88bx6wmssjpq468ev70qtzn.jpg'),(44,'https://v.seloger.com/s/cdn/x/visuels/0/1/4/y/014yqqimjtod2vizdua30xo0y404i6ge9me58yav4.jpg'),(44,'https://v.seloger.com/s/cdn/x/visuels/0/h/j/b/0hjbftevftohcakbfs47sp8pvb95d4z3olyl28cjk.jpg'),(44,'https://v.seloger.com/s/cdn/x/visuels/0/k/9/2/0k92t8a8um184kgqhsu4mrodif37qqb65564gt6rk.jpg'),(44,'https://v.seloger.com/s/cdn/x/visuels/0/s/9/8/0s98lblnlb2zl8l69g5hluot0cn200ibp1hup6phc.jpg'),(44,'https://v.seloger.com/s/cdn/x/visuels/1/n/2/7/1n27pl4w2xn3nt73lpflc1qhcr4bbcbog6j1azot0.jpg'),(45,'https://v.seloger.com/s/cdn/x/visuels/0/b/3/5/0b35yamz7w7qwh4d7zkq3mwefdee57nn1tktt6m37.jpg'),(45,'https://v.seloger.com/s/cdn/x/visuels/0/s/i/j/0sijjrsflk0mh8rsjtcjcsyry9d3hyzc3x82mihci.jpg'),(45,'https://v.seloger.com/s/cdn/x/visuels/1/f/1/y/1f1yfmpl57nx067l6gz3qepc9r4295eblbcc4lis3.jpg'),(45,'https://v.seloger.com/s/cdn/x/visuels/1/l/u/1/1lu1u0bbdrwu751nxwyfhhwc1qzgngvdwii7adis4.jpg'),(45,'https://v.seloger.com/s/cdn/x/visuels/2/0/8/f/208fquzwyloj2gvc5oyekxh7m1xbtwfga0dg18w9g.jpg'),(46,'https://v.seloger.com/s/cdn/x/visuels/0/5/1/q/051qjxqqsthdkv4ix7d40kjcvzx2osj3cdkcfherk.jpg'),(46,'https://v.seloger.com/s/cdn/x/visuels/0/k/f/9/0kf9cjgl5nqq43n0feuhi8uanhsb0mqwy6jl3cmio.jpg'),(46,'https://v.seloger.com/s/cdn/x/visuels/1/a/a/g/1aagbucyu04yovjv9b7kqmt49b2h9gv7m57q8vsw0.jpg'),(46,'https://v.seloger.com/s/cdn/x/visuels/1/e/3/k/1e3k9c9x7n3867jkt8xc56denqxx4q6eljf7zp1q8.jpg'),(46,'https://v.seloger.com/s/cdn/x/visuels/1/l/v/9/1lv95cdesbxgfpk5015efhomhljnx4j479jdwwhds.jpg'),(47,'https://v.seloger.com/s/cdn/x/visuels/0/8/0/p/080peejo76j493fesmuanjy8h35dddi699wha7u98.jpg'),(47,'https://v.seloger.com/s/cdn/x/visuels/0/9/b/4/09b4s0oozxvec28579shnu4f2c4ievj7we89sue40.jpg'),(47,'https://v.seloger.com/s/cdn/x/visuels/0/e/2/o/0e2oe86555uox5ighfl5a41aucbauhpfmn3o2wxdp.jpg'),(48,'https://v.seloger.com/s/cdn/x/visuels/0/k/m/e/0kme0sr4s4zyhlqyxm0a36rbimpno65bgiwl0icjk.jpg'),(48,'https://v.seloger.com/s/cdn/x/visuels/0/l/f/b/0lfb8zfx0weoydx1plhosefhenxy7vi8tg01i2vwg.jpg'),(48,'https://v.seloger.com/s/cdn/x/visuels/1/f/f/c/1ffcu6aolouqq19gdp7k03mx603fxo13rfh69xaf4.jpg'),(48,'https://v.seloger.com/s/cdn/x/visuels/1/j/k/f/1jkffp27jl5jrt5rfhj183n8g5ks6u2ykplo332tc.jpg'),(48,'https://v.seloger.com/s/cdn/x/visuels/1/t/l/e/1tlefco4i6fsbiatdwqtfo4skqyfotwsztd9wqry8.jpg'),(49,'https://v.seloger.com/s/cdn/x/visuels/0/1/l/z/01lzxid3e6q62cquklabzgix17bobty7qt2pou993.jpg'),(49,'https://v.seloger.com/s/cdn/x/visuels/1/d/p/g/1dpgc5x2r96gxmtha3ayexuj9heaxdtowdd24lavr.jpg'),(49,'https://v.seloger.com/s/cdn/x/visuels/1/f/z/z/1fzza2mtu7rm13mbf3tbh3m3rgw4xb3exyxt2orbr.jpg'),(49,'https://v.seloger.com/s/cdn/x/visuels/2/2/d/t/22dt5ojawqym6fixilgyli2mtx8iay3nrud5gpwt3.jpg'),(50,'https://v.seloger.com/s/cdn/x/visuels/0/a/f/q/0afqigyidc3u2upgfrgjvre7c3g0txnlzvd32mvdd.jpg'),(50,'https://v.seloger.com/s/cdn/x/visuels/0/c/l/c/0clcfst6nvzvce687h2ntt574pwz0fizt0jzhc95d.jpg'),(50,'https://v.seloger.com/s/cdn/x/visuels/0/s/u/e/0suefgt20l5ry7213or3u4w71dnsqlsithy9hij4h.jpg'),(51,'https://v.seloger.com/s/cdn/x/visuels/0/0/b/t/00btyc5pbxup2i9srwq2o5heamtfvrmlls43qzts0.jpg'),(51,'https://v.seloger.com/s/cdn/x/visuels/1/0/y/v/10yvbs4dsdl42iikxliwwdyzl2fpvvxatfdoo47ls.jpg'),(51,'https://v.seloger.com/s/cdn/x/visuels/2/7/2/y/272ymqy3xzysbmax442u8blgjgxi8gyn53cdbr340.jpg'),(52,'https://v.seloger.com/s/cdn/x/visuels/0/h/4/m/0h4mvzlke5loyg9z7xoewvi68i37gqi8ryljtf68j.jpg'),(52,'https://v.seloger.com/s/cdn/x/visuels/1/c/n/j/1cnj6337kvw7biibjnptmbfg8ise4dm0za88m742b.jpg'),(52,'https://v.seloger.com/s/cdn/x/visuels/1/m/8/h/1m8hrirbvcgabedeh7p9ynt1qfn8mhnilvg61w11v.jpg'),(53,'https://v.seloger.com/s/cdn/x/visuels/0/v/6/n/0v6n4b8epcjim3h7d4xvbhlarijymil8enjqrrb8w.jpg'),(53,'https://v.seloger.com/s/cdn/x/visuels/1/r/m/o/1rmowrphlz58ohjg89ud45jak46syib1zp53qlbqo.jpg'),(53,'https://v.seloger.com/s/cdn/x/visuels/2/1/a/b/21abmqzovqlfrmd1g86olexju6fg8g03kvwvl0a7k.jpg'),(54,'https://v.seloger.com/s/cdn/x/visuels/0/j/s/n/0jsnjs3b95jdrg7g32qho8sid4gm3cbyjfq1ix9w4.jpg'),(54,'https://v.seloger.com/s/cdn/x/visuels/0/o/b/b/0obbllu6dl2kwtpk3ybx5q4pp01jyew9p8dttd74k.jpg'),(54,'https://v.seloger.com/s/cdn/x/visuels/0/p/7/7/0p7722vzdcovc27ekjk43osc9t63c8wb0h8s0ab10.jpg'),(55,'https://v.seloger.com/s/cdn/x/visuels/0/1/j/6/01j6r23he3144u6vfg5yi0y13zw4j5xx4nxqtfwjk.jpg'),(55,'https://v.seloger.com/s/cdn/x/visuels/1/9/s/m/19smayc7jesg8x9oztpnvubkqr7olic4x99k45ges.jpg'),(55,'https://v.seloger.com/s/cdn/x/visuels/2/7/m/2/27m29z1hr470zu64id5nw3y74v25kxjxjxx7833b4.jpg'),(56,'https://v.seloger.com/s/cdn/x/visuels/0/c/y/i/0cyiajrgz0faqy000ncr9hj5s4x34d3dzib6q0wgk.jpg'),(56,'https://v.seloger.com/s/cdn/x/visuels/0/y/s/3/0ys3auu6b7tf7cxrsrxnr4y83ij1tigmdt8abcklw.jpg'),(56,'https://v.seloger.com/s/cdn/x/visuels/1/g/9/8/1g98ofixgp6q583v8d9mxaomj00o04eox46c3wevo.jpg'),(57,'https://v.seloger.com/s/cdn/x/visuels/0/b/v/2/0bv2kvorgg952bis14dnaubrxx97xgfvc1t52g59s.jpg'),(57,'https://v.seloger.com/s/cdn/x/visuels/1/y/g/d/1ygdua00n9eqpiieh4x966n0bpdir9cm9oclwnfzk.jpg'),(57,'https://v.seloger.com/s/cdn/x/visuels/2/1/6/b/216b14hjxngcvcxvn0h6lkz6kv75ffy135ioupui8.jpg'),(58,'https://v.seloger.com/s/cdn/x/visuels/0/v/l/2/0vl2vkq8zkus4gfj5sfqdlyruwr0hq6dsls0wqjpw.jpg'),(58,'https://v.seloger.com/s/cdn/x/visuels/1/w/5/t/1w5tq2zb671tcihpamsdxnsnls2k2ftuzjfdk20d0.jpg'),(58,'https://v.seloger.com/s/cdn/x/visuels/2/4/p/3/24p3xjgxb67uj1kj1pkckvy36p7j4gxvx350at1eb.jpg');
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
INSERT INTO `housing_location` VALUES (54,'France','Paris','75003','03','654 Rue de Bretagne'),(34,'France','Paris','75004','04','123 Rue du Temple'),(37,'France','Paris','75004','04','321 Rue de Rivoli'),(43,'France','Paris','75004','04','321 Rue des Archives'),(51,'France','Paris','75004','04','321 Rue Saint-Antoine'),(40,'France','Paris','75004','04','654 Rue de la Verrerie'),(46,'France','Paris','75004','04','654 Rue Vieille du Temple'),(42,'France','Paris','75004','04','789 Quai de l\'Hôtel de Ville'),(56,'France','Paris','75004','04','789 Rue des Francs-Bourgeois'),(39,'France','Paris','75005','05','987 Boulevard Saint-Michel'),(35,'France','Paris','75006','06','456 Rue de Rennes'),(49,'France','Paris','75008','08','456 Avenue Montaigne'),(38,'France','Paris','75008','08','654 Avenue des Champs-Élysées'),(53,'France','Paris','75009','09','987 Rue La Fayette'),(48,'France','Paris','75012','12','123 Rue de Lyon'),(57,'France','Paris','75013','13','321 Boulevard Vincent Auriol'),(44,'France','Paris','75015','15','654 Boulevard Montparnasse'),(58,'France','Paris','75015','15','789 Rue de Vaugirard'),(50,'France','Paris','75015','15','789 Rue Lecourbe'),(52,'France','Paris','75016','16','654 Avenue Foch'),(47,'France','Paris','75018','18','321 Rue Caulaincourt'),(41,'France','Paris','75018','18','321 Rue Lamarck'),(36,'France','Paris','75018','18','789 Rue des Abbesses'),(55,'France','Paris','75020','20','321 Boulevard de Ménilmontant'),(45,'France','Paris','75020','20','987 Rue de Belleville');
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
INSERT INTO `housing_services` VALUES (35,1),(38,1),(39,1),(44,1),(45,1),(49,1),(54,1),(55,1),(34,2),(35,2),(37,2),(38,2),(42,2),(44,2),(45,2),(46,2),(50,2),(52,2),(54,2),(55,2),(56,2),(58,2),(34,3),(36,3),(39,3),(43,3),(44,3),(45,3),(47,3),(49,3),(53,3),(54,3),(55,3),(57,3),(35,4),(39,4),(41,4),(43,4),(45,4),(49,4),(51,4),(53,4),(55,4),(44,5),(45,5),(54,5),(55,5),(35,6),(44,6),(54,6),(36,7),(37,7),(41,7),(46,7),(51,7),(56,7),(36,8),(46,8),(56,8),(35,9),(43,9),(46,9),(47,9),(53,9),(56,9),(57,9),(36,10),(42,10),(45,10),(46,10),(52,10),(55,10),(56,10);
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing_unavailability`
--

LOCK TABLES `housing_unavailability` WRITE;
/*!40000 ALTER TABLE `housing_unavailability` DISABLE KEYS */;
INSERT INTO `housing_unavailability` VALUES (23,51,'2023-06-23','2023-06-24','booked',21),(24,51,'2023-07-03','2023-07-09','booked',22);
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
  `reservation_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `display` enum('hide','show') NOT NULL DEFAULT 'hide',
  PRIMARY KEY (`id`),
  KEY `opinions_user_id_fk` (`user_id`),
  KEY `opinions_reservation_id_fk` (`reservation_id`),
  CONSTRAINT `opinions_reservation_id_fk` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `opinions_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinions`
--

LOCK TABLES `opinions` WRITE;
/*!40000 ALTER TABLE `opinions` DISABLE KEYS */;
INSERT INTO `opinions` VALUES (11,1,21,'test opinion id 21 ','hide');
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (21,1,51,6,1320,'pass'),(22,1,51,2,440,'accept');
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Benjamin','SCHINKEL','b_schinkel@hetic.eu','$2y$10$VyEce85T1gXP8SAktpGvw.87qSH7jsJPdi7pUZX.Aia2zQXUBebOK','2001-12-16','client,management,admin','2023-06-13 03:43:04','valid','2023-06-25 20:35:43'),(3,'Julien','Heitz','j_heitz@hetic.eu','$2y$10$3ZBo5Vd.zwOeS/PnJK9VD.xbE86EO5NJlJmgTFvqkNmRcVPm7QaA2','2001-04-30','client,admin','2023-06-13 04:02:22','valid','2023-06-13 04:02:22'),(5,'Louisan','Tchitoula','l_tchitoula@hetic.eu','$2y$10$pnqgog5JR4xCxybNYVCkCOCFH5jk4UmgohkhUR20WBMKbsFKiboDC','2001-01-01','client,admin','2023-06-20 14:00:34','valid','2023-06-20 12:00:38'),(6,'Sabrina','Attos','s_attos@hetic.eu','$2y$10$py3DaPWDIrGmxRdbqXv84Ogaj/ocXvCcCpfPQCq5WvUq7N7fP2wsK','2001-01-01','client,admin','2023-06-20 14:01:09','valid','2023-06-20 12:01:12'),(7,'Alessandro','Garau','a_garau@hetic.eu','$2y$10$nZJIRG/3/nD5QXtmnuwM3enA5UTFoUq7XaJysukM6gK3nf9OQtwDG','2001-01-01','client,admin','2023-06-20 14:01:42','valid','2023-06-20 12:01:45'),(8,'Marie-Gwenaëlle','Fahem','m_fahem@hetic.eu','$2y$10$q/qdZO05ywj0zXJiKvhTFueQqbCKfYkdzgAzvaEdWu/nrIk73NXWO','2001-01-01','client,admin','2023-06-20 14:02:30','valid','2023-06-20 12:02:34'),(9,'Marie','René','m_rene@hetic.eu','$2y$10$nFUSEBOQafSD0lFiL/KkWeVoerxFOui5uX1qMHtO7SxI8lfaoxp8m','2001-01-01','client,admin','2023-06-20 14:03:02','valid','2023-06-20 12:03:08');
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

-- Dump completed on 2023-06-25 22:38:31
