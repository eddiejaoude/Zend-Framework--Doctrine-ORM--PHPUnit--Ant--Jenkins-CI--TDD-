-- MySQL dump 10.13  Distrib 5.1.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: skeleton
-- ------------------------------------------------------
-- Server version	5.1.54-1ubuntu4

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
-- Table structure for table `account_events`
--

DROP TABLE IF EXISTS `account_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `event` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_events`
--

LOCK TABLES `account_events` WRITE;
/*!40000 ALTER TABLE `account_events` DISABLE KEYS */;
INSERT INTO `account_events` VALUES (1,1,'logged in','2011-06-05 11:15:50'),(2,1,'logged in','2011-06-05 11:15:50'),(3,1,'logged in','2011-06-05 11:53:04'),(4,1,'logged in','2011-06-05 11:53:04'),(5,3,'logged in','2011-06-11 08:25:28'),(6,3,'logged out','2011-06-11 08:58:30'),(7,1,'logged in','2011-06-11 08:58:40'),(8,1,'logged in','2011-06-11 15:14:16'),(9,1,'logged in','2011-06-11 15:14:18'),(10,1,'logged in','2011-06-14 06:27:22'),(11,1,'logged in','2011-06-14 06:27:24'),(12,1,'logged in','2011-06-14 06:33:14'),(13,1,'logged in','2011-06-14 06:33:16'),(14,1,'logged in','2011-06-14 06:35:49'),(15,1,'logged in','2011-06-14 06:35:51'),(16,1,'logged in','2011-06-14 06:40:13'),(17,1,'logged in','2011-06-14 06:40:15'),(18,1,'logged in','2011-06-14 06:49:10'),(19,1,'logged in','2011-06-14 06:49:12'),(20,1,'logged in','2011-06-14 06:49:29'),(21,1,'logged in','2011-06-14 06:50:44'),(22,1,'logged in','2011-06-14 06:50:45'),(23,1,'logged out','2011-06-14 06:55:04'),(24,1,'logged in','2011-06-14 06:57:11'),(25,1,'logged in','2011-06-14 06:57:13'),(26,1,'logged in','2011-06-14 07:02:10'),(27,1,'logged in','2011-06-14 07:02:11'),(28,1,'logged out','2011-06-14 07:02:11'),(29,1,'logged in','2011-06-14 07:02:13'),(30,1,'logged in','2011-06-14 07:03:12'),(31,1,'logged in','2011-06-14 07:03:24'),(32,1,'logged out','2011-06-14 07:03:24'),(33,1,'logged in','2011-06-14 07:03:30'),(34,1,'logged out','2011-06-14 07:03:30'),(35,1,'logged in','2011-06-14 07:04:13'),(36,1,'logged out','2011-06-14 07:04:13'),(37,1,'logged in','2011-06-14 07:04:18'),(38,1,'logged out','2011-06-14 07:04:18'),(39,1,'logged in','2011-06-14 07:04:27'),(40,1,'logged out','2011-06-14 07:04:27'),(41,1,'logged in','2011-06-14 07:04:31'),(42,1,'logged out','2011-06-14 07:04:31'),(43,1,'logged in','2011-06-14 07:04:46'),(44,1,'logged out','2011-06-14 07:04:46'),(45,1,'logged in','2011-06-14 07:04:50'),(46,1,'logged out','2011-06-14 07:04:50'),(47,1,'logged in','2011-06-14 07:05:03'),(48,1,'logged out','2011-06-14 07:05:03'),(49,1,'logged in','2011-06-14 07:05:12'),(50,1,'logged in','2011-06-14 07:05:12'),(51,1,'logged out','2011-06-14 07:05:12'),(52,1,'logged in','2011-06-14 07:05:14'),(53,1,'logged in','2011-06-14 07:06:52'),(54,1,'logged in','2011-06-14 07:06:52'),(55,1,'logged out','2011-06-14 07:06:52'),(56,1,'logged in','2011-06-14 07:06:54');
/*!40000 ALTER TABLE `account_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-05 11:14:25'),(3,'admin','admin@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2010-01-01 00:00:00'),(4,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-05 11:53:04'),(5,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-11 15:14:15'),(6,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-14 06:27:21'),(7,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-14 06:33:13'),(8,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-14 06:35:48'),(9,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-14 06:40:12'),(10,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-14 06:49:09'),(11,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-14 06:50:43'),(12,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-14 06:57:10'),(13,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-14 07:02:10'),(14,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-14 07:05:11'),(15,'test','test@test.com','d2ba838e6629500eceefd5fabc1916e5acba3e8c2a379234297d7eba45995c7a','2011-06-14 07:06:51');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts_role_members`
--

DROP TABLE IF EXISTS `accounts_role_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_role_members` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_role_members`
--

LOCK TABLES `accounts_role_members` WRITE;
/*!40000 ALTER TABLE `accounts_role_members` DISABLE KEYS */;
INSERT INTO `accounts_role_members` VALUES (1,1,2),(2,1,1);
/*!40000 ALTER TABLE `accounts_role_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_privileges`
--

DROP TABLE IF EXISTS `acl_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_privileges` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_privileges`
--

LOCK TABLES `acl_privileges` WRITE;
/*!40000 ALTER TABLE `acl_privileges` DISABLE KEYS */;
INSERT INTO `acl_privileges` VALUES (1,'auth','account','index','Watch Profile Information'),(2,'auth','account','update','Update Profile Information'),(3,'default','index','index','Homepage'),(4,'auth','login','index','Login page'),(5,'auth','acl','roles',NULL),(6,'auth','register','index','Registration'),(7,'default','error','index','Standard error page'),(8,'default','error','error','Page not found'),(9,'auth','account','event','User event/history/audit page'),(10,'auth','logout','index','Logout user'),(11,'auth','password','forgot','Forgotten password');
/*!40000 ALTER TABLE `acl_privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_role_privileges`
--

DROP TABLE IF EXISTS `acl_role_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_role_privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `privilege_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_role_privileges`
--

LOCK TABLES `acl_role_privileges` WRITE;
/*!40000 ALTER TABLE `acl_role_privileges` DISABLE KEYS */;
INSERT INTO `acl_role_privileges` VALUES (1,1,1),(2,3,3),(9,2,1),(11,3,6),(12,3,4),(13,3,7),(14,3,8),(15,2,9),(16,2,10),(17,3,11);
/*!40000 ALTER TABLE `acl_role_privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_roles`
--

DROP TABLE IF EXISTS `acl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_roles`
--

LOCK TABLES `acl_roles` WRITE;
/*!40000 ALTER TABLE `acl_roles` DISABLE KEYS */;
INSERT INTO `acl_roles` VALUES (1,'admin','Administrators'),(2,'user','Registered visitors'),(3,'guest','Anonymous Visitors');
/*!40000 ALTER TABLE `acl_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-06-14  7:07:02
