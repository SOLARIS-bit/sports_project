/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for debian-linux-gnu (aarch64)
--
-- Host: localhost    Database: sports_management
-- ------------------------------------------------------
-- Server version	10.11.11-MariaDB-0+deb12u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Card`
--

DROP TABLE IF EXISTS `Card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Card` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `card_type` enum('yellow','red') NOT NULL,
  `minute_given` int(11) NOT NULL,
  PRIMARY KEY (`card_id`),
  KEY `idx_card_match` (`match_id`),
  KEY `idx_card_player` (`player_id`),
  CONSTRAINT `Card_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `Match` (`match_id`),
  CONSTRAINT `Card_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Card`
--

LOCK TABLES `Card` WRITE;
/*!40000 ALTER TABLE `Card` DISABLE KEYS */;
INSERT INTO `Card` VALUES
(1,1,2,'yellow',34),
(2,1,7,'yellow',65),
(5,4,17,'yellow',30),
(6,5,2,'red',38),
(7,6,7,'yellow',55),
(8,7,25,'yellow',70),
(9,1,2,'yellow',34),
(10,1,7,'yellow',65),
(11,2,8,'red',88),
(12,3,12,'yellow',60),
(13,4,18,'yellow',45),
(14,4,22,'yellow',72),
(15,5,16,'yellow',33),
(16,5,21,'red',85),
(17,6,6,'yellow',28),
(18,6,7,'red',72);
/*!40000 ALTER TABLE `Card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Competition`
--

DROP TABLE IF EXISTS `Competition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Competition` (
  `competition_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`competition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Competition`
--

LOCK TABLES `Competition` WRITE;
/*!40000 ALTER TABLE `Competition` DISABLE KEYS */;
INSERT INTO `Competition` VALUES
(1,'Champions League','2023-09-01','2024-05-30'),
(2,'National Cup','2023-08-15','2024-04-20'),
(3,'Champions League','2023-09-01','2024-05-30'),
(4,'National Cup','2023-08-15','2024-04-20');
/*!40000 ALTER TABLE `Competition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Goal`
--

DROP TABLE IF EXISTS `Goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Goal` (
  `goal_id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `minute_scored` int(11) NOT NULL,
  PRIMARY KEY (`goal_id`),
  KEY `team_id` (`team_id`),
  KEY `idx_goal_match` (`match_id`),
  KEY `idx_goal_player` (`player_id`),
  CONSTRAINT `Goal_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `Match` (`match_id`),
  CONSTRAINT `Goal_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`),
  CONSTRAINT `Goal_ibfk_3` FOREIGN KEY (`team_id`) REFERENCES `Team` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Goal`
--

LOCK TABLES `Goal` WRITE;
/*!40000 ALTER TABLE `Goal` DISABLE KEYS */;
INSERT INTO `Goal` VALUES
(1,1,1,1,23),
(2,1,6,2,45),
(3,1,1,1,67),
(8,4,16,4,14),
(9,4,20,5,52),
(10,4,16,4,78),
(11,5,1,1,33),
(12,5,13,3,60),
(13,6,6,2,27),
(14,6,11,4,59),
(15,7,25,5,44),
(16,7,1,1,71),
(17,1,1,1,23),
(18,1,6,2,45),
(19,1,1,1,67),
(20,2,7,2,12),
(21,2,11,3,42),
(22,3,1,1,15),
(23,3,5,1,78),
(24,4,16,4,64),
(25,5,21,5,12),
(26,5,16,4,33),
(27,5,22,5,67),
(28,5,17,4,89),
(29,6,1,1,18),
(30,6,6,2,42),
(31,6,2,1,55),
(32,6,5,1,82);
/*!40000 ALTER TABLE `Goal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Group`
--

DROP TABLE IF EXISTS `Group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `competition_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `competition_id` (`competition_id`),
  CONSTRAINT `Group_ibfk_1` FOREIGN KEY (`competition_id`) REFERENCES `Competition` (`competition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Group`
--

LOCK TABLES `Group` WRITE;
/*!40000 ALTER TABLE `Group` DISABLE KEYS */;
INSERT INTO `Group` VALUES
(1,'Group X',1),
(2,'Group Y',1),
(3,'Round of 16',2),
(4,'Quarter Finals',2),
(5,'Group X',1),
(6,'Group Y',1),
(7,'Round of 16',2),
(8,'Quarter Finals',2),
(9,'Semi Finals',2),
(10,'Final',2);
/*!40000 ALTER TABLE `Group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Match`
--

DROP TABLE IF EXISTS `Match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Match` (
  `match_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime NOT NULL,
  `venue` varchar(100) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `referee_id` int(11) NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  PRIMARY KEY (`match_id`),
  KEY `team1_id` (`team1_id`),
  KEY `team2_id` (`team2_id`),
  KEY `idx_match_group` (`group_id`),
  KEY `idx_match_referee` (`referee_id`),
  KEY `idx_match_date` (`date_time`),
  CONSTRAINT `Match_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `Group` (`group_id`),
  CONSTRAINT `Match_ibfk_2` FOREIGN KEY (`referee_id`) REFERENCES `Referee` (`referee_id`),
  CONSTRAINT `Match_ibfk_3` FOREIGN KEY (`team1_id`) REFERENCES `Team` (`team_id`),
  CONSTRAINT `Match_ibfk_4` FOREIGN KEY (`team2_id`) REFERENCES `Team` (`team_id`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`team1_id` <> `team2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Match`
--

LOCK TABLES `Match` WRITE;
/*!40000 ALTER TABLE `Match` DISABLE KEYS */;
INSERT INTO `Match` VALUES
(1,'2023-09-10 20:00:00','Stadium Alpha',1,1,1,2),
(2,'2023-09-17 18:00:00','Stadium Beta',1,2,2,3),
(3,'2023-09-24 19:30:00','Stadium Gamma',1,3,3,1),
(4,'2023-10-01 19:45:00','Stadium Delta',2,4,4,5),
(5,'2023-10-08 20:00:00','Stadium Epsilon',2,5,5,4),
(6,'2023-11-10 19:00:00','Stadium Alpha',3,1,1,4),
(7,'2023-11-11 15:00:00','Stadium Beta',3,2,2,5),
(8,'2023-09-11 20:00:00','Stadium Delta',2,4,4,5),
(9,'2023-10-01 18:00:00','Stadium Alpha',3,5,1,3),
(10,'2023-10-02 20:00:00','Stadium Beta',3,2,2,4),
(11,'2023-10-03 19:00:00','Stadium Gamma',3,1,5,1),
(12,'2023-09-10 20:00:00','Alpha Arena',1,1,1,2),
(13,'2023-09-17 18:00:00','Bravo Stadium',1,2,2,3),
(14,'2023-09-24 19:30:00','Charlie Field',1,3,3,1),
(15,'2023-09-11 20:00:00','Delta Ground',2,4,4,5),
(16,'2023-09-18 17:00:00','Echo Park',2,5,5,4),
(17,'2023-10-15 15:00:00','Alpha Arena',3,1,1,2),
(18,'2023-10-16 16:30:00','Bravo Stadium',3,2,3,4),
(19,'2023-11-05 14:00:00','Delta Ground',4,3,1,3),
(20,'2023-09-10 20:00:00','Alpha Arena',1,1,1,2),
(21,'2023-09-17 18:00:00','Bravo Stadium',1,2,2,3),
(22,'2023-09-24 19:30:00','Charlie Field',1,3,3,1),
(23,'2023-09-11 20:00:00','Delta Ground',2,4,4,5),
(24,'2023-09-18 17:00:00','Echo Park',2,5,5,4),
(25,'2023-10-15 15:00:00','Alpha Arena',3,1,1,2),
(26,'2023-10-16 16:30:00','Bravo Stadium',3,2,3,4),
(27,'2023-11-05 14:00:00','Delta Ground',3,3,1,3);
/*!40000 ALTER TABLE `Match` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Player`
--

DROP TABLE IF EXISTS `Player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Player` (
  `player_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`player_id`),
  KEY `idx_player_team` (`team_id`),
  KEY `idx_player_position` (`position`),
  CONSTRAINT `Player_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `Team` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Player`
--

LOCK TABLES `Player` WRITE;
/*!40000 ALTER TABLE `Player` DISABLE KEYS */;
INSERT INTO `Player` VALUES
(1,'John Smith','1995-02-14','Forward',1),
(2,'Mike Johnson','1992-07-22','Midfielder',1),
(3,'David Wilson','1990-11-05','Defender',1),
(4,'Paul Brown','1993-04-18','Goalkeeper',1),
(5,'Kevin Davis','1994-09-30','Forward',1),
(6,'Robert Taylor','1991-06-12','Forward',2),
(7,'James White','1989-12-25','Midfielder',2),
(8,'Thomas Harris','1992-03-08','Defender',2),
(9,'Daniel Martin','1988-08-15','Goalkeeper',2),
(10,'Christopher Lee','1993-05-20','Forward',2),
(11,'Andrew Walker','1994-01-10','Forward',3),
(12,'Richard Scott','1991-08-22','Midfielder',3),
(13,'Brian Adams','1990-06-15','Defender',3),
(14,'Henry Moore','1993-03-27','Goalkeeper',3),
(15,'Timothy Allen','1995-12-05','Forward',3),
(16,'Chris Carter','1992-02-17','Forward',4),
(17,'Justin Reed','1989-09-30','Midfielder',4),
(18,'Patrick Bell','1991-05-13','Defender',4),
(19,'George Young','1990-08-19','Goalkeeper',4),
(20,'Louis Baker','1993-06-21','Forward',4),
(21,'Samuel Green','1994-04-14','Forward',5),
(22,'Edward King','1992-11-07','Midfielder',5),
(23,'Leon Wood','1990-10-01','Defender',5),
(24,'Adam Hughes','1988-07-12','Goalkeeper',5),
(25,'Benjamin Fox','1995-01-25','Forward',5),
(26,'John Smith','1995-02-14','Forward',1),
(27,'Mike Johnson','1992-07-22','Midfielder',1),
(28,'David Wilson','1990-11-05','Defender',1),
(29,'Paul Brown','1993-04-18','Goalkeeper',1),
(30,'Kevin Davis','1994-09-30','Forward',1),
(31,'Robert Taylor','1991-06-12','Forward',2),
(32,'James White','1989-12-25','Midfielder',2),
(33,'Thomas Harris','1992-03-08','Defender',2),
(34,'Daniel Martin','1988-08-15','Goalkeeper',2),
(35,'Christopher Lee','1993-05-20','Forward',2),
(36,'Andrew Walker','1994-01-10','Forward',3),
(37,'Richard Scott','1991-08-22','Midfielder',3),
(38,'Joseph Green','1989-04-15','Defender',3),
(39,'Matthew Adams','1993-11-30','Goalkeeper',3),
(40,'Charles Baker','1992-07-05','Forward',3),
(41,'Edward Nelson','1990-05-18','Forward',4),
(42,'George Carter','1988-12-03','Midfielder',4),
(43,'Frank Mitchell','1991-09-25','Defender',4),
(44,'Henry Roberts','1987-06-12','Goalkeeper',4),
(45,'Walter Hall','1993-02-28','Forward',4),
(46,'Arthur Young','1995-03-17','Forward',5),
(47,'Raymond King','1992-10-08','Midfielder',5),
(48,'Patrick Wright','1990-07-19','Defender',5),
(49,'Donald Lopez','1989-04-22','Goalkeeper',5),
(50,'Kenneth Hill','1994-11-11','Forward',5);
/*!40000 ALTER TABLE `Player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Referee`
--

DROP TABLE IF EXISTS `Referee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Referee` (
  `referee_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`referee_id`),
  UNIQUE KEY `license_number` (`license_number`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Referee`
--

LOCK TABLES `Referee` WRITE;
/*!40000 ALTER TABLE `Referee` DISABLE KEYS */;
INSERT INTO `Referee` VALUES
(1,'Mark Williams','English','REF001'),
(2,'Steve Clark','Scottish','REF002'),
(3,'Alan Thompson','Welsh','REF003'),
(4,'Peter Evans','Irish','REF004'),
(5,'Gary Roberts','English','REF005'),
(6,'Michael Oliver','English','REF-OLI-001'),
(7,'Antonio Mateu','Spanish','REF-MAT-002'),
(8,'Felix Brych','German','REF-BRY-003'),
(9,'Daniele Orsato','Italian','REF-ORS-004'),
(10,'Björn Kuipers','Dutch','REF-KUI-005');
/*!40000 ALTER TABLE `Referee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Team`
--

DROP TABLE IF EXISTS `Team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `founded_date` date DEFAULT NULL,
  `home_stadium` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Team`
--

LOCK TABLES `Team` WRITE;
/*!40000 ALTER TABLE `Team` DISABLE KEYS */;
INSERT INTO `Team` VALUES
(1,'Team A','1990-01-15','Stadium Alpha'),
(2,'Team B','1985-05-20','Stadium Beta'),
(3,'Team C','2000-11-10','Stadium Gamma'),
(4,'Team D','1978-03-25','Stadium Delta'),
(5,'Team E','1995-07-30','Stadium Epsilon'),
(6,'Team Alpha','1990-01-15','Alpha Arena'),
(7,'Team Bravo','1985-05-20','Bravo Stadium'),
(8,'Team Charlie','2000-11-10','Charlie Field'),
(9,'Team Delta','1978-03-25','Delta Ground'),
(10,'Team Echo','1995-07-30','Echo Park');
/*!40000 ALTER TABLE `Team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Team_Group`
--

DROP TABLE IF EXISTS `Team_Group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Team_Group` (
  `team_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `assigned_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`team_id`,`group_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `Team_Group_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `Team` (`team_id`),
  CONSTRAINT `Team_Group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `Group` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Team_Group`
--

LOCK TABLES `Team_Group` WRITE;
/*!40000 ALTER TABLE `Team_Group` DISABLE KEYS */;
INSERT INTO `Team_Group` VALUES
(1,1,'2025-04-14 14:48:08'),
(1,3,'2025-04-14 14:48:08'),
(2,1,'2025-04-14 14:48:08'),
(2,3,'2025-04-14 14:48:08'),
(3,1,'2025-04-14 14:48:08'),
(3,3,'2025-04-14 14:48:08'),
(4,2,'2025-04-14 14:48:08'),
(4,3,'2025-04-14 14:48:08'),
(5,2,'2025-04-14 14:48:08'),
(5,3,'2025-04-14 14:48:08');
/*!40000 ALTER TABLE `Team_Group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `player_stats`
--

DROP TABLE IF EXISTS `player_stats`;
/*!50001 DROP VIEW IF EXISTS `player_stats`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `player_stats` AS SELECT
 1 AS `player_id`,
  1 AS `name`,
  1 AS `birth_date`,
  1 AS `position`,
  1 AS `team_id`,
  1 AS `goals_scored`,
  1 AS `yellow_cards`,
  1 AS `red_cards` */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `player_stats`
--

/*!50001 DROP VIEW IF EXISTS `player_stats`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb3 */;
/*!50001 SET character_set_results     = utf8mb3 */;
/*!50001 SET collation_connection      = utf8mb3_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`solaris`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `player_stats` AS select `p`.`player_id` AS `player_id`,`p`.`name` AS `name`,`p`.`birth_date` AS `birth_date`,`p`.`position` AS `position`,`p`.`team_id` AS `team_id`,(select count(0) from `Goal` `g` where `g`.`player_id` = `p`.`player_id`) AS `goals_scored`,(select count(0) from `Card` `c` where `c`.`player_id` = `p`.`player_id` and `c`.`card_type` = 'yellow') AS `yellow_cards`,(select count(0) from `Card` `c` where `c`.`player_id` = `p`.`player_id` and `c`.`card_type` = 'red') AS `red_cards` from `Player` `p` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-16 18:44:40
