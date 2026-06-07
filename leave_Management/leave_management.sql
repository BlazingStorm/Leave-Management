-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: leave_management
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (1,4,'Leave Applied','Applied for Casual_leave from 2026-06-10 00:00:00 to 2026-06-12 00:00:00','2026-06-07 13:53:50','2026-06-07 13:53:50'),(2,2,'Leave Approved','Approved leave request #1','2026-06-07 13:54:10','2026-06-07 13:54:10'),(3,4,'Leave Applied','Applied for Sick_leave from 2026-06-19 00:00:00 to 2026-06-20 00:00:00','2026-06-07 13:57:05','2026-06-07 13:57:05'),(4,2,'Leave Rejected','Rejected leave request #2','2026-06-07 14:31:37','2026-06-07 14:31:37'),(5,2,'Leave Rejected','Rejected leave request #2','2026-06-07 14:49:03','2026-06-07 14:49:03');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `manager_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_employee_id_unique` (`employee_id`),
  KEY `employees_user_id_foreign` (`user_id`),
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,1,'EMP001','9999999999','Admin','Administrator',NULL,'2026-06-07 13:53:09','2026-06-07 13:53:09'),(2,2,'EMP002','9999999998','IT','Project Manager',NULL,'2026-06-07 13:53:10','2026-06-07 13:53:10'),(3,3,'EMP003','9999999997','Finance','Project Manager',NULL,'2026-06-07 13:53:10','2026-06-07 13:53:10'),(4,4,'EMP004','9999999996','IT','juinor dev',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(5,5,'EMP0105','9280919904','HR','Deburring Machine Operator',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(6,6,'EMP0106','2178080178','IT','Mechanical Inspector',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(7,7,'EMP0107','0355663700','HR','Plating Machine Operator',3,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(8,8,'EMP0108','4055689718','HR','Tailor',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(9,9,'EMP0109','0799071687','IT','Construction',3,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(10,10,'EMP0110','2777859462','Finance','New Accounts Clerk',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(11,11,'EMP0111','8377912149','IT','Clergy',3,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(12,12,'EMP0112','6901342637','Finance','Plumber',3,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(13,13,'EMP0113','6369119425','IT','Anesthesiologist',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(14,14,'EMP0114','9991990921','HR','Event Planner',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(15,15,'EMP0115','3073623229','HR','Entertainment Attendant',3,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(16,16,'EMP0116','9738893105','IT','Fast Food Cook',3,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(17,17,'EMP0117','8046856472','IT','Sawing Machine Setter',3,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(18,18,'EMP0118','3926035841','Finance','Painter and Illustrator',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(19,19,'EMP0119','3564360447','Finance','Railroad Yard Worker',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(20,20,'EMP0120','6078555761','IT','Credit Checker',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(21,21,'EMP0121','4799604904','IT','Construction Carpenter',3,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(22,22,'EMP0122','5289762565','Finance','Tailor',3,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(23,23,'EMP0123','5811291819','Finance','Ambulance Driver',2,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(24,24,'EMP0124','9516800120','Finance','Record Clerk',3,'2026-06-07 13:53:11','2026-06-07 13:53:11');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_balances`
--

DROP TABLE IF EXISTS `leave_balances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_balances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `leave_type_id` bigint(20) unsigned NOT NULL,
  `allocated_days` int(11) NOT NULL,
  `used_days` int(11) NOT NULL,
  `remaining_days` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_balances_user_id_foreign` (`user_id`),
  KEY `leave_balances_leave_type_id_foreign` (`leave_type_id`),
  CONSTRAINT `leave_balances_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leave_balances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_balances`
--

LOCK TABLES `leave_balances` WRITE;
/*!40000 ALTER TABLE `leave_balances` DISABLE KEYS */;
INSERT INTO `leave_balances` VALUES (1,4,1,10,3,7,'2026-06-07 13:53:11','2026-06-07 13:54:10'),(2,4,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(3,4,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(4,5,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(5,5,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(6,5,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(7,6,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(8,6,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(9,6,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(10,7,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(11,7,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(12,7,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(13,8,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(14,8,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(15,8,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(16,9,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(17,9,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(18,9,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(19,10,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(20,10,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(21,10,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(22,11,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(23,11,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(24,11,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(25,12,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(26,12,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(27,12,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(28,13,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(29,13,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(30,13,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(31,14,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(32,14,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(33,14,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(34,15,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(35,15,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(36,15,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(37,16,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(38,16,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(39,16,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(40,17,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(41,17,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(42,17,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(43,18,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(44,18,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(45,18,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(46,19,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(47,19,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(48,19,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(49,20,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(50,20,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(51,20,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(52,21,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(53,21,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(54,21,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(55,22,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(56,22,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(57,22,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(58,23,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(59,23,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(60,23,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(61,24,1,10,0,10,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(62,24,2,12,0,12,'2026-06-07 13:53:11','2026-06-07 13:53:11'),(63,24,3,5,0,5,'2026-06-07 13:53:11','2026-06-07 13:53:11');
/*!40000 ALTER TABLE `leave_balances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_requests`
--

DROP TABLE IF EXISTS `leave_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `leave_type_id` bigint(20) unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` mediumtext NOT NULL,
  `total_days` int(11) NOT NULL,
  `status` enum('approved','pending','rejected') NOT NULL DEFAULT 'pending',
  `manager_id` bigint(20) unsigned DEFAULT NULL,
  `manager_remarks` text DEFAULT NULL,
  `approved_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_requests_user_id_foreign` (`user_id`),
  KEY `leave_requests_leave_type_id_foreign` (`leave_type_id`),
  KEY `leave_requests_manager_id_foreign` (`manager_id`),
  CONSTRAINT `leave_requests_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leave_requests_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`),
  CONSTRAINT `leave_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_requests`
--

LOCK TABLES `leave_requests` WRITE;
/*!40000 ALTER TABLE `leave_requests` DISABLE KEYS */;
INSERT INTO `leave_requests` VALUES (1,4,1,'2026-06-10','2026-06-12','dt',3,'approved',2,NULL,'2026-06-07','2026-06-07 13:53:50','2026-06-07 13:54:10'),(2,4,2,'2026-06-19','2026-06-20','bws',2,'rejected',2,'nope','2026-06-07','2026-06-07 13:57:05','2026-06-07 14:49:02');
/*!40000 ALTER TABLE `leave_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_types`
--

DROP TABLE IF EXISTS `leave_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `default_count` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_types`
--

LOCK TABLES `leave_types` WRITE;
/*!40000 ALTER TABLE `leave_types` DISABLE KEYS */;
INSERT INTO `leave_types` VALUES (1,'Casual_leave','10','2026-06-07 13:53:09','2026-06-07 13:53:09'),(2,'Sick_leave','12','2026-06-07 13:53:09','2026-06-07 13:53:09'),(3,'Earned_leave','5','2026-06-07 13:53:09','2026-06-07 13:53:09');
/*!40000 ALTER TABLE `leave_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_06_131431_create_leave_types_table',1),(5,'2026_06_06_131853_create_leave_balances_table',1),(6,'2026_06_06_165020_create_leave_requests_table',1),(7,'2026_06_06_170318_create_audit_logs_table',1),(8,'2026_06_06_171405_create_employees_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('eZDL9AFZsvb9jAGSV8MgSHYckIXI2P7p6vDLnJj0',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXNSdnZjUzZld1dBTXRFYVF0Tk8wVmU5ZGFxV29nMTJKRjZpTHNleCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1780860996),('Fhpwj0C6kSB7Sg1qvlMPYTYvX50zGI18Oipl1Izr',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQjA5Y0MyeGozcGhPN3VvWlNPc3VpU3duNXV4Z3JXOXNsNGVFa0xsSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lbXBsb3llZS9sZWF2ZSI7czo1OiJyb3V0ZSI7czoyMDoiZW1wbG95ZWUubGVhdmUuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc4MDg2MzU5NTt9fQ==',1780863619),('WP7SF4LpYEZauy0405DJwbUUdDIo8aCXZxUbejjD',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMnZSeWx6SFk3SjJwZ1E1UXl1VUFOYXZkaXdzekttYjJKcWZpbXMzVCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3VzZXJzIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2VycyI7czo1OiJyb3V0ZSI7czoxMToidXNlcnMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1780860996);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manager','employee') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@test.com','$2y$12$nuyXmZMUxmvFY1eOGjZsOezrtSZ1zY15pfl6EoL8xNCjeORHIl4pm','admin','active',NULL,NULL,'2026-06-07 13:53:09','2026-06-07 13:53:09'),(2,'Manager1','manager1@test.com','$2y$12$tque2j/sMfXQzBRUlTmeSOocZxE2Tnx0BodPk.PdVmDAbPgC0uV6u','manager','active',NULL,NULL,'2026-06-07 13:53:10','2026-06-07 13:53:10'),(3,'Manager2','manager2@test.com','$2y$12$kxJmEXk2uLOYAjVw5YikmOY9gsAglk8jR/CmNm9BEz.jz2tOoj3O6','manager','active',NULL,NULL,'2026-06-07 13:53:10','2026-06-07 13:53:10'),(4,'employee','employee@test.com','$2y$12$nazcOR/InrNKnCYXgfix6uw1aoh01N917fXeqopp2kjj6p2.8KfDu','employee','active','2026-06-07 13:53:10','C0XOtBIFp9nGtkt9u37OfzBsZt7rwvdWxycPyYrMEEHX4rXKppJJB5Lz0jGu','2026-06-07 13:53:11','2026-06-07 13:53:11'),(5,'Ona Labadie','tatyana.senger@example.net','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','9B7X5kL9Qn','2026-06-07 13:53:11','2026-06-07 13:53:11'),(6,'Junior Olson II','nader.bailee@example.org','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','CB108gbnHQ','2026-06-07 13:53:11','2026-06-07 13:53:11'),(7,'Russel Harris Sr.','gleichner.meggie@example.net','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','kMFr4qYE6v','2026-06-07 13:53:11','2026-06-07 13:53:11'),(8,'Florine Walsh','gmayer@example.com','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','xv1tLw760i','2026-06-07 13:53:11','2026-06-07 13:53:11'),(9,'Conor Thompson','emil25@example.org','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','kjE23yai0K','2026-06-07 13:53:11','2026-06-07 13:53:11'),(10,'Mr. Randi Miller','tmorissette@example.net','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','w7j0551Gg5','2026-06-07 13:53:11','2026-06-07 13:53:11'),(11,'Mable Haley III','lewis49@example.com','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','yleEYOIgul','2026-06-07 13:53:11','2026-06-07 13:53:11'),(12,'Natasha Lockman III','nolan61@example.net','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','2qMFF9qGvg','2026-06-07 13:53:11','2026-06-07 13:53:11'),(13,'Jackson Wolff PhD','kertzmann.leatha@example.org','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','AS7OjLM2Db','2026-06-07 13:53:11','2026-06-07 13:53:11'),(14,'Mrs. Camylle Goodwin','marina43@example.com','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','1xH2ErchAV','2026-06-07 13:53:11','2026-06-07 13:53:11'),(15,'Donato Corkery','skylar.rowe@example.com','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','2Df753uDhm','2026-06-07 13:53:11','2026-06-07 13:53:11'),(16,'Dr. Joyce Klein IV','jnader@example.net','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','Ste1qabXXS','2026-06-07 13:53:11','2026-06-07 13:53:11'),(17,'Abraham Ankunding','valentin10@example.net','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','Dmz3j3SEHm','2026-06-07 13:53:11','2026-06-07 13:53:11'),(18,'Prof. Sebastian Larson III','blanche58@example.com','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','mTfcrgPLfP','2026-06-07 13:53:11','2026-06-07 13:53:11'),(19,'Mrs. Leora Bartell','merle12@example.net','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','9OBcENoIlE','2026-06-07 13:53:11','2026-06-07 13:53:11'),(20,'Mr. Simeon O\'Keefe MD','ndamore@example.net','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','QdgrYg7CRT','2026-06-07 13:53:11','2026-06-07 13:53:11'),(21,'Prof. Gerson Romaguera DVM','orlo84@example.org','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','4sAy2Xj7nH','2026-06-07 13:53:11','2026-06-07 13:53:11'),(22,'Guy Kuphal','damore.alena@example.net','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','TkSTPwUY8s','2026-06-07 13:53:11','2026-06-07 13:53:11'),(23,'Rosalinda Klocko','ike.carroll@example.net','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','Rykk32kXxl','2026-06-07 13:53:11','2026-06-07 13:53:11'),(24,'Dr. Alfred Marks PhD','orn.amelie@example.org','$2y$12$dZHxBO.XFaUgRMxk4AqTkuXnjxhLL81Aahohddsdu9QEzM/8wHbxW','employee','active','2026-06-07 13:53:11','CMdvE44Qzm','2026-06-07 13:53:11','2026-06-07 13:53:11');
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

-- Dump completed on 2026-06-08  1:58:31
