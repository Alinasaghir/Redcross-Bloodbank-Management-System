-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: redcross
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `ADMIN_ID` varchar(4) NOT NULL,
  `USERNAME` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ADMIN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('A-01','alina12@gmail.com','alina123'),('A-02','dahika12@gmail.com','dahika456'),('A-03','sadia123@gmail.com','sadia789');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER ADMIN_BeforeInsert

BEFORE INSERT ON ADMIN

FOR EACH ROW

BEGIN

  DECLARE NEW_ID INT;

  SET NEW_ID = (SELECT COALESCE(MAX(SUBSTRING_INDEX(ADMIN_ID, '-', -1)), 0) + 1 FROM ADMIN);

  SET NEW.ADMIN_ID = CONCAT('A-', LPAD(NEW_ID, 2, '0'));

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary table structure for view `admin_anonymous_view`
--

DROP TABLE IF EXISTS `admin_anonymous_view`;
/*!50001 DROP VIEW IF EXISTS `admin_anonymous_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `admin_anonymous_view` AS SELECT
 1 AS `EMAIL`,
  1 AS `PHONE`,
  1 AS `SURVEY`,
  1 AS `FUNDS` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `admin_bloodbag_view`
--

DROP TABLE IF EXISTS `admin_bloodbag_view`;
/*!50001 DROP VIEW IF EXISTS `admin_bloodbag_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `admin_bloodbag_view` AS SELECT
 1 AS `BLOOD_ID`,
  1 AS `BLOOD_TYPE`,
  1 AS `STOCK` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `admin_donor_view`
--

DROP TABLE IF EXISTS `admin_donor_view`;
/*!50001 DROP VIEW IF EXISTS `admin_donor_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `admin_donor_view` AS SELECT
 1 AS `USER_ID`,
  1 AS `FIRST_NAME`,
  1 AS `LAST_NAME`,
  1 AS `EMAIL`,
  1 AS `BLOOD_GROUP`,
  1 AS `AGE`,
  1 AS `DISEASE` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `admin_questions_view`
--

DROP TABLE IF EXISTS `admin_questions_view`;
/*!50001 DROP VIEW IF EXISTS `admin_questions_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `admin_questions_view` AS SELECT
 1 AS `NAME`,
  1 AS `EMAIL`,
  1 AS `PHONE`,
  1 AS `MESSAGE` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `admin_recipient_view`
--

DROP TABLE IF EXISTS `admin_recipient_view`;
/*!50001 DROP VIEW IF EXISTS `admin_recipient_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `admin_recipient_view` AS SELECT
 1 AS `USER_ID`,
  1 AS `FIRST_NAME`,
  1 AS `LAST_NAME`,
  1 AS `EMAIL`,
  1 AS `BLOOD_GROUP`,
  1 AS `QUANTITY`,
  1 AS `COST_RS` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `anonymousperson`
--

DROP TABLE IF EXISTS `anonymousperson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anonymousperson` (
  `EMAIL` varchar(20) NOT NULL,
  `PHONE` varchar(14) NOT NULL,
  `SURVEY` varchar(3) NOT NULL,
  `FUNDS` varchar(3) NOT NULL,
  PRIMARY KEY (`EMAIL`,`PHONE`),
  CONSTRAINT `anonymousperson_ibfk_1` FOREIGN KEY (`EMAIL`, `PHONE`) REFERENCES `funds` (`EMAIL`, `PHONE`),
  CONSTRAINT `anonymousperson_ibfk_2` FOREIGN KEY (`EMAIL`, `PHONE`) REFERENCES `survey` (`email`, `phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anonymousperson`
--

LOCK TABLES `anonymousperson` WRITE;
/*!40000 ALTER TABLE `anonymousperson` DISABLE KEYS */;
INSERT INTO `anonymousperson` VALUES ('alex.smith@example.c','02198765432','yes','yes'),('alexsmith60@example.','02198765432','yes','yes'),('anonymous','0','yes','yes'),('jane.doe@example.com','03098765432','yes','yes'),('janedoe97@example.co','03098765432','yes','yes'),('john.doe@example.com','02112345678','yes','yes'),('sam.wilson@example.c','02191919191','yes','yes');
/*!40000 ALTER TABLE `anonymousperson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bloodbag`
--

DROP TABLE IF EXISTS `bloodbag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bloodbag` (
  `BLOOD_TYPE` varchar(10) DEFAULT NULL,
  `BLOOD_ID` varchar(20) NOT NULL,
  `STOCK` int(65) NOT NULL,
  PRIMARY KEY (`BLOOD_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bloodbag`
--

LOCK TABLES `bloodbag` WRITE;
/*!40000 ALTER TABLE `bloodbag` DISABLE KEYS */;
INSERT INTO `bloodbag` VALUES ('A+','A+_1',510),('A-','A-_1',491),('AB+','AB+_1',500),('AB-','AB-_1',500),('B+','B+_1',500),('B-','B-_1',500),('O+','O+_1',500),('O-','O-_1',500);
/*!40000 ALTER TABLE `bloodbag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donor`
--

DROP TABLE IF EXISTS `donor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donor` (
  `USER_ID` varchar(256) NOT NULL,
  `AGE` varchar(100) NOT NULL,
  `DISEASE` varchar(20) NOT NULL,
  PRIMARY KEY (`USER_ID`),
  CONSTRAINT `donor_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donor`
--

LOCK TABLES `donor` WRITE;
/*!40000 ALTER TABLE `donor` DISABLE KEYS */;
INSERT INTO `donor` VALUES ('D-01','19','None'),('D-02','32','None');
/*!40000 ALTER TABLE `donor` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER AFTER_INSERT_DONOR

AFTER INSERT ON DONOR

FOR EACH ROW

BEGIN

    DECLARE bloodGroup VARCHAR(10);

    SELECT BLOOD_GROUP INTO bloodGroup FROM USERS WHERE USER_ID = NEW.USER_ID;

    

    UPDATE BLOODBAG

    SET STOCK = STOCK + 1.0

    WHERE BLOOD_TYPE = bloodGroup;

    

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `funds`
--

DROP TABLE IF EXISTS `funds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funds` (
  `EMAIL` varchar(20) NOT NULL,
  `PHONE` varchar(14) NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `SPONSOR` varchar(3) DEFAULT NULL,
  `PAYMENT_OPT` varchar(40) NOT NULL,
  `MESSAGE` varchar(300) DEFAULT NULL,
  `NAME` varchar(80) NOT NULL,
  PRIMARY KEY (`EMAIL`,`PHONE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funds`
--

LOCK TABLES `funds` WRITE;
/*!40000 ALTER TABLE `funds` DISABLE KEYS */;
INSERT INTO `funds` VALUES ('alex.smith@example.c','02198765432',50000.00,'Yes','check','For charity purposes.','Alex'),('alex.smith@example.c','02198765433',70000.00,'no','JazzCash','Helping the homeless.','Smith'),('alexsmith60@example.','02198765432',50000.00,'Yes','Bank Transfer','For charity purposes.','Alex Smith'),('alina.saghir@example','03012345678',75000.00,'yes','EasyPaisa','Supporting medical expenses.','Alina'),('alinasaghir97@gmail.','02193939003',60000.00,'no','JazzCash','Use them on storage devices.','Alina Saghir'),('anonymous','0',970024.00,NULL,'Check','','anonymous'),('emily.jones@example.','03011223344',60000.00,'no','Check','Donation for clean water dispensers.','emily'),('fatimaaliis@gmail.co','03273939003',2000.00,'no','Check','use it anywhere.','fatima'),('jane.doe@example.com','03087654321',50000.00,'no','JazzCash','Helping those in need.','jane'),('jane.doe@example.com','03098765432',80000.00,'No','Easypaisa','For medical expenses.',''),('janedoe97@example.co','03098765432',80000.00,'No','Easypaisa','For medical expenses.',''),('john.doe@example.com','02112345678',60000.00,'No','JazzCash','Use them on storage devices.',''),('john.doe@example.com','02198765432',100000.00,'yes','pay pal','Donation for a noble cause.',''),('johndoe98@example.co','02122345678',60000.00,'No','JazzCash','Use them on storage devices.',''),('sadiamoeed@gmail.com','02193939003',60000.00,'no','JazzCash','Use them on storage devices.',''),('sam.wilson@example.c','02191919191',55000.00,'yes','JazzCash','Supporting efforts.',''),('user1001@example.com','02134567890',80000.00,'yes','Check','Donation for education.',''),('user2002@example.com','03023456789',90000.00,'yes','EasyPaisa','Supporting community development.',''),('user9999@example.com','03091919191',65000.00,'no','EasyPaisa','Donation for healthcare services.','');
/*!40000 ALTER TABLE `funds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `funds_view`
--

DROP TABLE IF EXISTS `funds_view`;
/*!50001 DROP VIEW IF EXISTS `funds_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `funds_view` AS SELECT
 1 AS `NAME`,
  1 AS `EMAIL`,
  1 AS `PHONE`,
  1 AS `AMOUNT`,
  1 AS `SPONSOR`,
  1 AS `MESSAGE` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `NAME` varchar(80) NOT NULL,
  `EMAIL` varchar(20) NOT NULL,
  `PHONE` varchar(14) NOT NULL,
  `message` varchar(225) DEFAULT NULL,
  `CONTACT_ID` varchar(225) NOT NULL,
  PRIMARY KEY (`CONTACT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES ('Alice Williams','alice@example.com','03456789120','Book appointment','CONTACT-04'),('Michael Brown','michael@example.com','03415162721','Need some assistance related to your services.','CONTACT-05'),('Emily Davis','emily@example.com','02178901234','A question about your services.','CONTACT-06'),('William Wilson','william@example.com','03456789011','Can you provide more information?','CONTACT-07'),('Sarah Taylor','sarah@example.com','03908172634','Inquiry regarding donation process.','CONTACT-08'),('Daniel Anderson','daniel@example.com','03543216780','Question about eligibility.','CONTACT-09'),('Olivia Martinez','olivia@example.com','03939223202','Feedback about previous donation experience.','CONTACT-10');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `contact` BEFORE INSERT ON `questions` FOR EACH ROW BEGIN

  DECLARE NEW_ID INT;

  SET NEW_ID = (SELECT COALESCE(MAX(SUBSTRING_INDEX(CONTACT_ID, '-', -1)), 0) + 1 FROM questions);

  SET NEW.CONTACT_ID = CONCAT('CONTACT-', LPAD(NEW_ID, 2, '0'));

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `recipient`
--

DROP TABLE IF EXISTS `recipient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipient` (
  `USER_ID` varchar(256) NOT NULL,
  `QUANTITY` int(65) NOT NULL,
  `COST_RS` int(65) NOT NULL,
  PRIMARY KEY (`USER_ID`),
  CONSTRAINT `recipient_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipient`
--

LOCK TABLES `recipient` WRITE;
/*!40000 ALTER TABLE `recipient` DISABLE KEYS */;
INSERT INTO `recipient` VALUES ('R-01',8,17600),('R-02',90,198000),('R-03',49,107800),('R-04',10,22000),('R-06',9,19800);
/*!40000 ALTER TABLE `recipient` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER AFTER_INSERT_RECIPIENT

AFTER INSERT ON RECIPIENT

FOR EACH ROW

BEGIN

    -- Get the blood type and new quantity of the recipient from the USERS and RECIPIENT tables

    DECLARE bloodType VARCHAR(10);

    DECLARE newQuantity INT(65);



    SELECT BLOOD_GROUP INTO bloodType FROM USERS WHERE USER_ID = NEW.USER_ID;

    SELECT QUANTITY INTO newQuantity FROM RECIPIENT WHERE USER_ID = NEW.USER_ID;

    

    -- Check if the blood type exists in the BLOODBAG table

    SET @stock := 0;

    SELECT STOCK INTO @stock FROM BLOODBAG WHERE BLOOD_TYPE = bloodType;



    IF @stock IS NOT NULL THEN

        -- Update the stock in the BLOODBAG table

        SET @newStock := @stock - newQuantity;

        IF @newStock >= 0 THEN

            UPDATE BLOODBAG

            SET STOCK = @newStock

            WHERE BLOOD_TYPE = bloodType;

        ELSE

            SIGNAL SQLSTATE '45000'

            SET MESSAGE_TEXT = 'Error: Blood bag does not have sufficient stock.';

        END IF;

    ELSE

        SIGNAL SQLSTATE '45000'

        SET MESSAGE_TEXT = 'Error: Blood bag stock for the blood group not found.';

    END IF;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey` (
  `name` varchar(80) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `address` varchar(100) NOT NULL,
  `rating` int(10) NOT NULL,
  `feedback` varchar(300) NOT NULL,
  `total_responses` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`email`),
  UNIQUE KEY `UC_EMAIL_PHONE` (`email`,`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

LOCK TABLES `survey` WRITE;
/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
INSERT INTO `survey` VALUES ('Ahmed Raza','ahmed.raza@example.c','03033333333','666 Blue Ridge, Lahore, Pakistan',5,'Highly recommended!',0),('Alex Smith','alex.smith@example.c','02198765432','789 Ocean Road, Karachi, Pakistan',3,'Average service.',0),('Alex Smith','alexsmith60@example.','02198765432','789 Ocean Road, Karachi, Pakistan',3,'Average service.',0),('Ali Khan','ali.khan@example.com','03091919191','777 Green Garden, Karachi, Pakistan',2,'Needs improvement.',0),('anonymous','anonymous','0','Not provided',3,'best',7),('Ayesha Khan','ayesha.khan@example.','02144444444','999 Sun Avenue, Karachi, Pakistan',5,'Excellent service!',0),('Emily Jones','emily.jones@example.','03012345678','101 Skyline Avenue, Islamabad, Pakistan',4,'Good support!',0),('Jane Doe','jane.doe@example.com','03098765432','456 Park Avenue, Lahore, Pakistan',5,'Excellent experience!',0),('Jane Doe','janedoe97@example.co','03098765432','456 Park Avenue, Lahore, Pakistan',5,'Excellent experience!',0),('John Doe','john.doe@example.com','02112345678','123 Main Street, Karachi, Pakistan',4,'Great service!',0),('John Doe','johndoe98@example.co','0212345678','123 Main Street, Karachi, Pakistan',4,'Great service!',0),('Sam Wilson','sam.wilson@example.c','02191919191','222 Liberty Street, Lahore, Pakistan',5,'Very satisfied!',0),('Sara Ahmed','sara.ahmed@example.c','02122222222','444 Rose Lane, Karachi, Pakistan',4,'Helpful staff!',0),('Usama Aftab','usamaislite@gmail.co','03433339090','karachi',6,'',1),('Usman Ali','usman.ali@example.co','03055555555','333 Moon Crescent, Islamabad, Pakistan',3,'Fair experience.',0);
/*!40000 ALTER TABLE `survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `survey_summary_view`
--

DROP TABLE IF EXISTS `survey_summary_view`;
/*!50001 DROP VIEW IF EXISTS `survey_summary_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `survey_summary_view` AS SELECT
 1 AS `NAME`,
  1 AS `EMAIL`,
  1 AS `RATING`,
  1 AS `FEEDBACK` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `USER_ID` varchar(256) NOT NULL,
  `EMAIL` varchar(20) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `GENDER` varchar(6) NOT NULL,
  `BLOOD_GROUP` varchar(4) DEFAULT NULL,
  `CATEGORY` varchar(9) DEFAULT NULL,
  `SYS_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `PHONE` varchar(14) NOT NULL,
  PRIMARY KEY (`USER_ID`,`EMAIL`),
  KEY `idx_blood_group` (`BLOOD_GROUP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('D-01','dahika230@gmail.com','Dahika','Abdul Hafeez','Female','B-','donor','2023-07-17 18:32:16','03520200202'),('D-02','saad10@gmail.com','Saad','Waqar','Male','O+','donor','2023-07-17 18:35:53','03930200202'),('R-01','alinasaghir@gmail.co','Alina','Saghir','Female','A-','recipient','2023-07-17 18:28:01','02120200202'),('R-02','sadiamoeed10@gmail.c','Sadia','Moeed','Female','AB+','recipient','2023-07-17 18:33:05','03820200202'),('R-03','itsawesome10@gmail.c','Fahad','Khan','Male','O+','recipient','2023-07-17 18:39:24','03932100202'),('R-04','alinasaghir97@gmail.','Komal','Saghir','Male','A-','recipient','2023-07-17 21:00:16','03433238390'),('R-05','alinasaghir97@gmail.','Komal','Saghir','Male','A-','recipient','2023-07-17 21:03:45','03433268390'),('R-06','alinasaghir97@gmail.','Komal','Saghir','Male','A-','recipient','2023-07-17 21:08:15','03433268390');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER USERS_BEFOREINSERT

BEFORE INSERT ON USERS

FOR EACH ROW

BEGIN

    DECLARE NEW_ID INT;

    IF NEW.CATEGORY = 'DONOR' THEN

        SET NEW_ID = (SELECT COALESCE(MAX(SUBSTRING_INDEX(USER_ID, '-', -1)), 0) + 1 FROM USERS WHERE CATEGORY = 'DONOR');

        SET NEW.USER_ID = CONCAT('D-', LPAD(NEW_ID, 2, '0'));

    ELSEIF NEW.CATEGORY = 'RECIPIENT' THEN

        SET NEW_ID = (SELECT COALESCE(MAX(SUBSTRING_INDEX(USER_ID, '-', -1)), 0) + 1 FROM USERS WHERE CATEGORY = 'RECIPIENT');

        SET NEW.USER_ID = CONCAT('R-', LPAD(NEW_ID, 2, '0'));

    END IF;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary table structure for view `users_sorted_view`
--

DROP TABLE IF EXISTS `users_sorted_view`;
/*!50001 DROP VIEW IF EXISTS `users_sorted_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `users_sorted_view` AS SELECT
 1 AS `USER_ID`,
  1 AS `EMAIL`,
  1 AS `FIRST_NAME`,
  1 AS `LAST_NAME`,
  1 AS `GENDER`,
  1 AS `BLOOD_GROUP`,
  1 AS `CATEGORY`,
  1 AS `SYS_DATE`,
  1 AS `PHONE` */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `admin_anonymous_view`
--

/*!50001 DROP VIEW IF EXISTS `admin_anonymous_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `admin_anonymous_view` AS select `anonymousperson`.`EMAIL` AS `EMAIL`,`anonymousperson`.`PHONE` AS `PHONE`,`anonymousperson`.`SURVEY` AS `SURVEY`,`anonymousperson`.`FUNDS` AS `FUNDS` from `anonymousperson` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `admin_bloodbag_view`
--

/*!50001 DROP VIEW IF EXISTS `admin_bloodbag_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `admin_bloodbag_view` AS select `bloodbag`.`BLOOD_ID` AS `BLOOD_ID`,`bloodbag`.`BLOOD_TYPE` AS `BLOOD_TYPE`,`bloodbag`.`STOCK` AS `STOCK` from `bloodbag` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `admin_donor_view`
--

/*!50001 DROP VIEW IF EXISTS `admin_donor_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `admin_donor_view` AS select `d`.`USER_ID` AS `USER_ID`,`u`.`FIRST_NAME` AS `FIRST_NAME`,`u`.`LAST_NAME` AS `LAST_NAME`,`u`.`EMAIL` AS `EMAIL`,`u`.`BLOOD_GROUP` AS `BLOOD_GROUP`,`d`.`AGE` AS `AGE`,`d`.`DISEASE` AS `DISEASE` from (`donor` `d` join `users` `u` on(`d`.`USER_ID` = `u`.`USER_ID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `admin_questions_view`
--

/*!50001 DROP VIEW IF EXISTS `admin_questions_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `admin_questions_view` AS select `questions`.`NAME` AS `NAME`,`questions`.`EMAIL` AS `EMAIL`,`questions`.`PHONE` AS `PHONE`,`questions`.`message` AS `MESSAGE` from `questions` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `admin_recipient_view`
--

/*!50001 DROP VIEW IF EXISTS `admin_recipient_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `admin_recipient_view` AS select `r`.`USER_ID` AS `USER_ID`,`u`.`FIRST_NAME` AS `FIRST_NAME`,`u`.`LAST_NAME` AS `LAST_NAME`,`u`.`EMAIL` AS `EMAIL`,`u`.`BLOOD_GROUP` AS `BLOOD_GROUP`,`r`.`QUANTITY` AS `QUANTITY`,`r`.`COST_RS` AS `COST_RS` from (`recipient` `r` join `users` `u` on(`r`.`USER_ID` = `u`.`USER_ID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `funds_view`
--

/*!50001 DROP VIEW IF EXISTS `funds_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `funds_view` AS select `funds`.`NAME` AS `NAME`,`funds`.`EMAIL` AS `EMAIL`,`funds`.`PHONE` AS `PHONE`,`funds`.`amount` AS `AMOUNT`,`funds`.`SPONSOR` AS `SPONSOR`,`funds`.`MESSAGE` AS `MESSAGE` from `funds` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `survey_summary_view`
--

/*!50001 DROP VIEW IF EXISTS `survey_summary_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `survey_summary_view` AS select `survey`.`name` AS `NAME`,`survey`.`email` AS `EMAIL`,`survey`.`rating` AS `RATING`,`survey`.`feedback` AS `FEEDBACK` from `survey` order by `survey`.`rating` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `users_sorted_view`
--

/*!50001 DROP VIEW IF EXISTS `users_sorted_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `users_sorted_view` AS select `users`.`USER_ID` AS `USER_ID`,`users`.`EMAIL` AS `EMAIL`,`users`.`FIRST_NAME` AS `FIRST_NAME`,`users`.`LAST_NAME` AS `LAST_NAME`,`users`.`GENDER` AS `GENDER`,`users`.`BLOOD_GROUP` AS `BLOOD_GROUP`,`users`.`CATEGORY` AS `CATEGORY`,`users`.`SYS_DATE` AS `SYS_DATE`,`users`.`PHONE` AS `PHONE` from `users` order by `users`.`CATEGORY` */;
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

-- Dump completed on 2023-07-18 12:03:26
