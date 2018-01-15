CREATE DATABASE  IF NOT EXISTS `enfim_digital` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `enfim_digital`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: enfim_digital
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `idCourse` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `sigla` varchar(20) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `internship` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idCourse`),
  UNIQUE KEY `name_UNIQUE` (`name`,`level`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `idCourses` int(11) NOT NULL AUTO_INCREMENT,
  `year` year(4) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `completeName` varchar(100) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `local` varchar(100) DEFAULT NULL,
  `vacancy` int(11) DEFAULT NULL,
  `idCourse` varchar(50) DEFAULT NULL,
  `internship` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `observations` longtext,
  PRIMARY KEY (`idCourses`),
  UNIQUE KEY `course_UNIQUE` (`course`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `courses_documents`
--

DROP TABLE IF EXISTS `courses_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses_documents` (
  `idCourses` int(11) NOT NULL,
  `idDocuments` int(11) NOT NULL,
  `idModules` int(11) NOT NULL,
  `idCourse` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `public` varchar(20) DEFAULT NULL,
  `observations` longtext,
  `status` varchar(20) DEFAULT NULL,
  `document1` varchar(100) DEFAULT NULL,
  `document1Blob` longblob,
  `document2` varchar(100) DEFAULT NULL,
  `document2Blob` longblob,
  `document3` varchar(100) DEFAULT NULL,
  `document3Blob` longblob,
  `document4` varchar(100) DEFAULT NULL,
  `document4Blob` longblob,
  `dateAutor` datetime DEFAULT NULL,
  `idAutor` int(11) DEFAULT NULL,
  `dateDiretor` datetime DEFAULT NULL,
  `idDiretor` int(11) DEFAULT NULL,
  `datePedagogico` datetime DEFAULT NULL,
  `idPedagogico` int(11) DEFAULT NULL,
  `dateExecutiva` datetime DEFAULT NULL,
  `idExecutiva` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCourses`,`idDocuments`,`idModules`,`idCourse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `courses_evaluations`
--

DROP TABLE IF EXISTS `courses_evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses_evaluations` (
  `idEvaluations` int(11) NOT NULL,
  `idUsers` int(11) NOT NULL,
  `idCourses` int(11) NOT NULL,
  `idCourse` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `evaluation` json DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idEvaluations`,`idUsers`,`idCourses`,`idCourse`),
  UNIQUE KEY `unique` (`idUsers`,`idCourses`),
  KEY `index` (`idEvaluations`,`idUsers`,`idCourses`,`idCourse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `courses_informations`
--

DROP TABLE IF EXISTS `courses_informations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses_informations` (
  `idInformations` int(11) NOT NULL AUTO_INCREMENT,
  `idCourses` int(11) NOT NULL,
  `idCourse` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `observations` longtext,
  `status` varchar(20) DEFAULT NULL,
  `document` varchar(100) DEFAULT NULL,
  `documentBlob` longblob,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`idInformations`),
  UNIQUE KEY `idInformation_UNIQUE` (`idInformations`),
  KEY `index` (`idInformations`,`idCourses`,`idCourse`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `courses_modules`
--

DROP TABLE IF EXISTS `courses_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses_modules` (
  `idModules` int(11) NOT NULL,
  `idCourse` int(11) NOT NULL,
  `idCourses` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `duration` int(3) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `observations` varchar(45) DEFAULT NULL,
  `idUsers` int(11) DEFAULT NULL,
  PRIMARY KEY (`idModules`,`idCourse`,`idCourses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `courses_team`
--

DROP TABLE IF EXISTS `courses_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses_team` (
  `idCourses` int(11) NOT NULL,
  `idUsers` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idCourses`,`idUsers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `idDocuments` int(11) NOT NULL AUTO_INCREMENT,
  `idModules` int(11) NOT NULL,
  `idCourse` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `public` varchar(20) DEFAULT NULL,
  `observations` longtext,
  `status` varchar(20) DEFAULT NULL,
  `document1` varchar(100) DEFAULT NULL,
  `document1Blob` longblob,
  `document2` varchar(100) DEFAULT NULL,
  `document2Blob` longblob,
  `document3` varchar(100) DEFAULT NULL,
  `document3Blob` longblob,
  `document4` varchar(100) DEFAULT NULL,
  `document4Blob` longblob,
  `dateAutor` datetime DEFAULT NULL,
  `idAutor` int(11) DEFAULT NULL,
  `dateDiretor` datetime DEFAULT NULL,
  `idDiretor` int(11) DEFAULT NULL,
  `datePedagogico` datetime DEFAULT NULL,
  `idPedagogico` int(11) DEFAULT NULL,
  `dateExecutiva` datetime DEFAULT NULL,
  `idExecutiva` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDocuments`,`idModules`,`idCourse`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluations` (
  `idEvaluations` int(11) NOT NULL AUTO_INCREMENT,
  `idCourse` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `template` json DEFAULT NULL,
  `dateExecutiva` datetime DEFAULT NULL,
  `idExecutiva` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEvaluations`,`idCourse`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `idModules` int(11) NOT NULL AUTO_INCREMENT,
  `idCourse` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `duration` int(3) NOT NULL DEFAULT '0',
  `type` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idModules`),
  UNIQUE KEY `name_UNIQUE` (`name`,`idCourse`,`idModules`)
) ENGINE=InnoDB AUTO_INCREMENT=276 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sigla` varchar(20) DEFAULT NULL,
  `permission` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zipCode` varchar(9) DEFAULT NULL,
  `local` varchar(50) DEFAULT NULL,
  `mobile` varchar(9) DEFAULT NULL,
  `telephone` varchar(9) DEFAULT NULL,
  `observations` longtext,
  `iban` varchar(25) DEFAULT NULL,
  `aepId` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUsers`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_courses`
--

DROP TABLE IF EXISTS `users_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_courses` (
  `idUsers` int(11) NOT NULL,
  `idCourses` int(11) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `unitType` varchar(50) DEFAULT NULL,
  `rank` varchar(50) DEFAULT NULL,
  `boRank` varchar(20) DEFAULT NULL,
  `qa` varchar(20) DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `receipt` varchar(20) DEFAULT NULL,
  `observations` longtext,
  `attended` varchar(20) DEFAULT NULL,
  `passedCourse` varchar(20) DEFAULT NULL,
  `passedInternship` varchar(20) DEFAULT NULL,
  `passed` varchar(20) DEFAULT NULL,
  `boCourse` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idUsers`,`idCourses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-15 19:05:24
