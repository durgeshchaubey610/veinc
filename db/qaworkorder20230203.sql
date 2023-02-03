-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: qaworkor_vecrm
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `auto_refersh`
--

DROP TABLE IF EXISTS `auto_refersh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auto_refersh` (
  `id` int NOT NULL AUTO_INCREMENT,
  `auto_refersh` varchar(11) DEFAULT NULL,
  `building_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bill_labor`
--

DROP TABLE IF EXISTS `bill_labor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bill_labor` (
  `blid` int NOT NULL AUTO_INCREMENT,
  `building` int NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `charge_hour` float NOT NULL,
  `global_template` int NOT NULL,
  `import_template` int NOT NULL DEFAULT '0',
  `assign_to` varchar(255) NOT NULL,
  `assign_default` int NOT NULL DEFAULT '0',
  `set_default` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`blid`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bill_rate`
--

DROP TABLE IF EXISTS `bill_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bill_rate` (
  `brid` int NOT NULL AUTO_INCREMENT,
  `building` int NOT NULL,
  `rate_name` varchar(250) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int NOT NULL,
  `multiplier` float NOT NULL,
  `global_template` int NOT NULL,
  `import_template` int NOT NULL DEFAULT '0',
  `set_default` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`brid`)
) ENGINE=MyISAM AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `build_service`
--

DROP TABLE IF EXISTS `build_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `build_service` (
  `bsid` int NOT NULL AUTO_INCREMENT,
  `building` int NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `unit_measure` varchar(255) NOT NULL,
  `cost` float NOT NULL,
  `minimum` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `global_template` int NOT NULL DEFAULT '0',
  `import_template` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`bsid`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `building_module_access`
--

DROP TABLE IF EXISTS `building_module_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `building_module_access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `building_id` int DEFAULT NULL,
  `module_id` varchar(255) DEFAULT NULL,
  `assigned_date` datetime DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=569 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `building_service`
--

DROP TABLE IF EXISTS `building_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `building_service` (
  `bsId` int NOT NULL AUTO_INCREMENT,
  `woId` int NOT NULL,
  `service` int NOT NULL,
  `charge` varchar(250) NOT NULL,
  `unit` varchar(250) NOT NULL,
  `amount_requested` varchar(250) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bsId`)
) ENGINE=MyISAM AUTO_INCREMENT=374 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `buildings`
--

DROP TABLE IF EXISTS `buildings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buildings` (
  `build_id` int unsigned NOT NULL AUTO_INCREMENT,
  `cust_id` int unsigned NOT NULL COMMENT 'Account number or customer auto inc id',
  `user_id` int NOT NULL COMMENT 'IF VT Admin create building',
  `buildingName` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `suite` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `state_code` char(2) DEFAULT NULL,
  `postalCode` varchar(20) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `phoneExt` int DEFAULT NULL,
  `faxNumber` varchar(20) DEFAULT NULL,
  `timezone` int DEFAULT NULL,
  `billCompanyName` varchar(250) DEFAULT NULL,
  `billAddress` varchar(250) DEFAULT NULL,
  `billAddress2` varchar(250) DEFAULT NULL,
  `billSuite` varchar(250) DEFAULT NULL,
  `billcity` varchar(250) DEFAULT NULL,
  `billState` varchar(250) DEFAULT NULL,
  `billState_code` char(2) DEFAULT NULL,
  `billPostalCode` varchar(250) DEFAULT NULL,
  `billPhone` varchar(250) DEFAULT NULL,
  `billPhoneExt` int DEFAULT NULL,
  `billFax` varchar(250) DEFAULT NULL,
  `attention` varchar(255) DEFAULT NULL,
  `uniqueCostCenter` int unsigned DEFAULT NULL,
  `remit_address` text,
  `dateCreated` datetime DEFAULT NULL,
  `status` enum('0','1','2','3') NOT NULL COMMENT '0=deactive, 1=active, 2=demo, 3=cancel',
  PRIMARY KEY (`build_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `cat_id` int unsigned NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) DEFAULT NULL,
  `prioritySchedule` varchar(255) DEFAULT NULL,
  `account_user` varchar(255) DEFAULT NULL,
  `send_email` varchar(255) DEFAULT NULL,
  `include_exclude` varchar(255) DEFAULT NULL,
  `visible_status` int NOT NULL DEFAULT '1',
  `createdBy` int unsigned DEFAULT NULL COMMENT 'category creater user id',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `remove_status` int NOT NULL DEFAULT '0',
  `remove_date` date DEFAULT NULL,
  `history_remove` int NOT NULL DEFAULT '0',
  `history_date` date DEFAULT NULL,
  `global_template` tinyint(1) NOT NULL DEFAULT '0',
  `import_template` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` date NOT NULL,
  `updated_date` datetime NOT NULL,
  `building_id` int DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=945 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coi_au_details`
--

DROP TABLE IF EXISTS `coi_au_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coi_au_details` (
  `coi_au_details_ID` int NOT NULL AUTO_INCREMENT,
  `Building_ID` int NOT NULL,
  `uniqueCostCenter` int DEFAULT NULL,
  `coi_au_details_holder` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `coi_au_details_specialterms` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `coi_au_details_send_certificate_to` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`coi_au_details_ID`),
  KEY `bmID` (`coi_au_details_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coi_au_requirements`
--

DROP TABLE IF EXISTS `coi_au_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coi_au_requirements` (
  `coi_au_requir_ID` int NOT NULL AUTO_INCREMENT,
  `Building_ID` int NOT NULL,
  `uniqueCostCenter` int DEFAULT NULL,
  `coi_vt_default_ID` int NOT NULL DEFAULT '0',
  `coi_au_defaults_Tenant` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `coi_au_defaults_Vendor` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`coi_au_requir_ID`),
  KEY `bmID` (`coi_au_requir_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=511 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coi_au_tenant`
--

DROP TABLE IF EXISTS `coi_au_tenant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coi_au_tenant` (
  `coi_au_tenant_id` int NOT NULL AUTO_INCREMENT,
  `building_id` int NOT NULL,
  `uniquecostcenter` int DEFAULT NULL,
  `tenant_number` int DEFAULT NULL,
  `tenant_Id` int NOT NULL COMMENT 'form Tenant table',
  `coi_au_tenant_active` enum('1','0') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1',
  `coi_au_date_from` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Active From',
  `coi_au_date_to` date NOT NULL DEFAULT '0000-00-00' COMMENT 'Exipers',
  `coi_au_pdf_upload` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `coi_au_Ten_or_Vendor` enum('T','V') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'T' COMMENT 'T - Tenant, V - Vendor',
  `coi_au_send_reminder` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y' COMMENT 'Send reminder automaticly',
  PRIMARY KEY (`coi_au_tenant_id`),
  KEY `bmID` (`coi_au_tenant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coi_building_details`
--

DROP TABLE IF EXISTS `coi_building_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coi_building_details` (
  `coi_bld_details_ID` int NOT NULL,
  `Building_ID` int NOT NULL,
  `Tenant_ID` int DEFAULT NULL,
  `coi_Statis_id` int NOT NULL DEFAULT '0',
  `coi_Expire_date` date NOT NULL DEFAULT '0000-00-00',
  `coi_Certificate_Holder` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `coi_Special_Terms` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coi_items`
--

DROP TABLE IF EXISTS `coi_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coi_items` (
  `coi_Item_ID` int NOT NULL,
  `coi_Item_Description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `coi_Item_Tab` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coi_tenant_details`
--

DROP TABLE IF EXISTS `coi_tenant_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coi_tenant_details` (
  `coi_tenant_details_ID` int NOT NULL,
  `Building_ID` int NOT NULL,
  `coi_Item_ID` int DEFAULT NULL,
  `coi_Tenant_Limit` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `coi_Vendor_Limit` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `coi_Certificate_Holder` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `coi_Special_Terms` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `coi_vt_defaults`
--

DROP TABLE IF EXISTS `coi_vt_defaults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coi_vt_defaults` (
  `coi_vt_default_ID` int NOT NULL AUTO_INCREMENT,
  `coi_vt_default_description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `coi_vt_defaults_Tenant` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `coi_vt_defaults_Vendor` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `coi_vt_defaults_tab` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`coi_vt_default_ID`),
  KEY `bmID` (`coi_vt_default_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company` (
  `cust_id` int NOT NULL AUTO_INCREMENT,
  `companyName` varchar(200) NOT NULL,
  `corp_account_number` varchar(25) NOT NULL COMMENT 'corporate account number',
  `activationDate` date NOT NULL,
  `createdDate` date NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `company_logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `conference_room`
--

DROP TABLE IF EXISTS `conference_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conference_room` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `conference_schedule`
--

DROP TABLE IF EXISTS `conference_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conference_schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `schedule_name` varchar(255) NOT NULL,
  `week_days_id` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `all_day` int NOT NULL,
  `building_id` int NOT NULL,
  `default` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `confroom_building_access`
--

DROP TABLE IF EXISTS `confroom_building_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `confroom_building_access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `location` varchar(255) NOT NULL,
  `building_id` int NOT NULL,
  `multi_mode` int NOT NULL DEFAULT '0',
  `multi_id` varchar(255) NOT NULL,
  `schedule_id` int NOT NULL,
  `tenant_admin` int NOT NULL,
  `tenant_user` int NOT NULL,
  `recurrence_building_user` int NOT NULL,
  `recurrence_tenant_admin` int NOT NULL,
  `recurrence_tenant_user` int NOT NULL,
  `auto_billing` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contact_type`
--

DROP TABLE IF EXISTS `contact_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_type` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `contact` varchar(255) NOT NULL,
  `building` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `croom_design`
--

DROP TABLE IF EXISTS `croom_design`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `croom_design` (
  `d_id` int NOT NULL AUTO_INCREMENT,
  `design_name` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `room_id` int NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `croom_plan`
--

DROP TABLE IF EXISTS `croom_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `croom_plan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(255) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `croom_rate_schedule`
--

DROP TABLE IF EXISTS `croom_rate_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `croom_rate_schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plan` varchar(255) NOT NULL,
  `cost` int NOT NULL,
  `min` int NOT NULL,
  `max` int NOT NULL,
  `room_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=981 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `croom_request`
--

DROP TABLE IF EXISTS `croom_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `croom_request` (
  `crid` int NOT NULL AUTO_INCREMENT,
  `tenant` int NOT NULL,
  `created_user` int NOT NULL,
  `meeting_title` varchar(255) NOT NULL,
  `croom_id` int NOT NULL,
  `design_id` int NOT NULL,
  `schedule_id` int NOT NULL,
  `building_id` int NOT NULL,
  `requested_date` datetime NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `booking_type` varchar(100) NOT NULL,
  `Rang_type` int NOT NULL,
  `rang_value` varchar(100) NOT NULL,
  `end_date` datetime NOT NULL,
  `parent_id` int NOT NULL,
  PRIMARY KEY (`crid`),
  KEY `building_id` (`building_id`),
  KEY `croom_id` (`croom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3190 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dashboard_menu`
--

DROP TABLE IF EXISTS `dashboard_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboard_menu` (
  `did` int NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) NOT NULL,
  `parent_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_group`
--

DROP TABLE IF EXISTS `email_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL,
  `building_id` int DEFAULT NULL,
  `send_as` int DEFAULT NULL,
  `days_of_week` int DEFAULT NULL,
  `complete_notification` int DEFAULT NULL,
  `imported_from` int NOT NULL DEFAULT '0',
  `created_by` int DEFAULT NULL,
  `is_default` enum('0','1') DEFAULT NULL,
  `active` int DEFAULT NULL,
  `action` int DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_group_users`
--

DROP TABLE IF EXISTS `email_group_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_group_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `group_id` int NOT NULL,
  `user_id` int NOT NULL,
  `send_as` int NOT NULL,
  `days_of_week` int NOT NULL,
  `complete_notification` int DEFAULT NULL,
  `action` int DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=847 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_location`
--

DROP TABLE IF EXISTS `email_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_location` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email_name` varchar(255) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_log`
--

DROP TABLE IF EXISTS `email_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `email_sent_by` int DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `log_type` varchar(255) NOT NULL,
  `log_message` varchar(255) DEFAULT NULL,
  `email_status` int NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=40356 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_log_old`
--

DROP TABLE IF EXISTS `email_log_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_log_old` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `email_sent_by` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `log_type` varchar(255) NOT NULL,
  `log_message` varchar(255) DEFAULT NULL,
  `email_status` int NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=285267 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_log_old2`
--

DROP TABLE IF EXISTS `email_log_old2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_log_old2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `email_sent_by` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `log_type` varchar(255) NOT NULL,
  `log_message` varchar(255) DEFAULT NULL,
  `email_status` int NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=305541 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email_title` varchar(255) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_content` text NOT NULL,
  `role` int NOT NULL,
  `system_generated` int NOT NULL,
  `email_location` int NOT NULL,
  `status` int DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `build_id` int NOT NULL,
  `type` int NOT NULL DEFAULT '0',
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `form_request`
--

DROP TABLE IF EXISTS `form_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `form_name` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telephone` varchar(200) NOT NULL,
  `question` varchar(10000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `labor`
--

DROP TABLE IF EXISTS `labor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `labor` (
  `lid` int NOT NULL AUTO_INCREMENT,
  `woId` int NOT NULL,
  `emp_id` int NOT NULL,
  `charge_hour` varchar(255) NOT NULL,
  `bl_id` int DEFAULT NULL,
  `rate_charge` varchar(255) NOT NULL,
  `job_time` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lid`),
  KEY `woId` (`woId`)
) ENGINE=MyISAM AUTO_INCREMENT=3999 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `length`
--

DROP TABLE IF EXISTS `length`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `length` (
  `lID` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`lID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `parent id` FOREIGN KEY (`parent_id`) REFERENCES `parent_location` (`pl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `location_access`
--

DROP TABLE IF EXISTS `location_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location_access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location_id` int NOT NULL,
  `role` int NOT NULL,
  `is_access` enum('0','1') NOT NULL DEFAULT '0',
  `is_read` enum('0','1') NOT NULL DEFAULT '0',
  `is_write` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `date_created` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `service` int NOT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `markup` varchar(255) DEFAULT NULL,
  `vendor` int DEFAULT NULL,
  `vendor_part` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `mfg` varchar(255) DEFAULT NULL,
  `notes` text,
  `buildingId` int NOT NULL,
  `global_template` int NOT NULL DEFAULT '0',
  `import_template` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `remove_status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=894 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `material_charge`
--

DROP TABLE IF EXISTS `material_charge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material_charge` (
  `mcId` int NOT NULL AUTO_INCREMENT,
  `woId` int NOT NULL,
  `material_id` int NOT NULL,
  `cost` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `markup` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`mcId`),
  KEY `material_id` (`material_id`),
  KEY `woId` (`woId`)
) ENGINE=MyISAM AUTO_INCREMENT=2266 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `material_vendor`
--

DROP TABLE IF EXISTS `material_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material_vendor` (
  `mvId` int NOT NULL AUTO_INCREMENT,
  `material` int NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `cell_number` varchar(255) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `vendor_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `remove_status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`mvId`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_billingmonth`
--

DROP TABLE IF EXISTS `meters_billingmonth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_billingmonth` (
  `BillingMonth_ID` int NOT NULL AUTO_INCREMENT,
  `BillingMonth_Date` date DEFAULT NULL,
  PRIMARY KEY (`BillingMonth_ID`),
  KEY `bmID` (`BillingMonth_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_billingmonth_bak`
--

DROP TABLE IF EXISTS `meters_billingmonth_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_billingmonth_bak` (
  `BillingMonth_ID` int NOT NULL AUTO_INCREMENT,
  `BillingMonth_Date` date DEFAULT NULL,
  PRIMARY KEY (`BillingMonth_ID`),
  KEY `bmID` (`BillingMonth_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_billtype`
--

DROP TABLE IF EXISTS `meters_billtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_billtype` (
  `btID` int NOT NULL AUTO_INCREMENT,
  `btName` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`btID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_billtype_bak`
--

DROP TABLE IF EXISTS `meters_billtype_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_billtype_bak` (
  `btID` int NOT NULL AUTO_INCREMENT,
  `btName` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`btID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_conversion`
--

DROP TABLE IF EXISTS `meters_conversion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_conversion` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `convertFrom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `convertTo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `calculation` double DEFAULT NULL,
  `mc_System_Template` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_meter`
--

DROP TABLE IF EXISTS `meters_meter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_meter` (
  `Meter_ID` int NOT NULL AUTO_INCREMENT,
  `Building_ID` int DEFAULT NULL,
  `MeterNameNumber` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `MeterLocation` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `MeterIntialNumber` double DEFAULT NULL,
  `MeterMultiplyer` int DEFAULT NULL,
  `MeterNew` int DEFAULT NULL,
  `MeterTurnOver` double DEFAULT NULL,
  `MeterDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `UtilityCompany_ID` int DEFAULT NULL,
  `MeterSortNumber` int DEFAULT NULL,
  `MeterInitialDate` date DEFAULT '1918-10-27',
  `MeterBillable` tinyint(1) NOT NULL,
  `MeterConversion` double DEFAULT NULL,
  `IsParent` tinyint(1) NOT NULL DEFAULT '0',
  `Parent_MeterID` int DEFAULT NULL,
  `IsChild` tinyint(1) NOT NULL DEFAULT '0',
  `Child_Install_Date` date DEFAULT NULL,
  PRIMARY KEY (`Meter_ID`),
  KEY `Parrent_MeterID` (`Parent_MeterID`),
  KEY `buildingID` (`Building_ID`),
  KEY `UTid` (`UtilityCompany_ID`),
  KEY `MeterId` (`Meter_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_meter_bak`
--

DROP TABLE IF EXISTS `meters_meter_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_meter_bak` (
  `Meter_ID` int NOT NULL AUTO_INCREMENT,
  `Building_ID` int DEFAULT NULL,
  `MeterNameNumber` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `MeterLocation` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `MeterIntialNumber` double DEFAULT NULL,
  `MeterMultiplyer` int DEFAULT NULL,
  `MeterNew` int DEFAULT NULL,
  `MeterTurnOver` double DEFAULT NULL,
  `MeterDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `UtilityCompany_ID` int DEFAULT NULL,
  `MeterSortNumber` int DEFAULT NULL,
  `MeterInitialDate` date DEFAULT '1918-10-27',
  `MeterBillable` tinyint(1) NOT NULL,
  `MeterConversion` double DEFAULT NULL,
  `IsParent` tinyint(1) NOT NULL DEFAULT '0',
  `Parent_MeterID` int DEFAULT NULL,
  `IsChild` tinyint(1) NOT NULL DEFAULT '0',
  `Child_Install_Date` date DEFAULT NULL,
  PRIMARY KEY (`Meter_ID`),
  KEY `Parrent_MeterID` (`Parent_MeterID`),
  KEY `buildingID` (`Building_ID`),
  KEY `UTid` (`UtilityCompany_ID`),
  KEY `MeterId` (`Meter_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_meterdetails`
--

DROP TABLE IF EXISTS `meters_meterdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_meterdetails` (
  `CompanyID` double DEFAULT NULL,
  `Meter_ID` double DEFAULT NULL,
  `MultyMeterPercentage` double DEFAULT NULL,
  `Building_ID` int NOT NULL,
  KEY `MeterID` (`Meter_ID`),
  KEY `CompanyID` (`CompanyID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_meterdetails_bak`
--

DROP TABLE IF EXISTS `meters_meterdetails_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_meterdetails_bak` (
  `CompanyID` double DEFAULT NULL,
  `Meter_ID` double DEFAULT NULL,
  `MultyMeterPercentage` double DEFAULT NULL,
  `Building_ID` int NOT NULL,
  KEY `MeterID` (`Meter_ID`),
  KEY `CompanyID` (`CompanyID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_meterreading`
--

DROP TABLE IF EXISTS `meters_meterreading`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_meterreading` (
  `MeterReading_ID` int NOT NULL AUTO_INCREMENT,
  `mrMeterReading` double DEFAULT NULL,
  `MeterUtility_ID` int DEFAULT NULL,
  `Meter_ID` int DEFAULT NULL,
  `mrTurnOver` tinyint(1) NOT NULL,
  `mrOldReading` double DEFAULT NULL,
  `mrTakenBY` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mrEnteredBY` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `BillingMonth_ID` int DEFAULT NULL,
  `mrUsage` int DEFAULT NULL,
  `Building_ID` int NOT NULL,
  UNIQUE KEY `mrID` (`MeterReading_ID`) USING BTREE,
  KEY `bmID` (`BillingMonth_ID`) USING BTREE,
  KEY `MeterID` (`Meter_ID`) USING BTREE,
  KEY `Building_ID` (`Building_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2708 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_meterreading_bak`
--

DROP TABLE IF EXISTS `meters_meterreading_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_meterreading_bak` (
  `MeterReading_ID` int NOT NULL AUTO_INCREMENT,
  `mrMeterReading` double DEFAULT NULL,
  `MeterUtility_ID` int DEFAULT NULL,
  `Meter_ID` int DEFAULT NULL,
  `mrTurnOver` tinyint(1) NOT NULL,
  `mrOldReading` double DEFAULT NULL,
  `mrTakenBY` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mrEnteredBY` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `BillingMonth_ID` int DEFAULT NULL,
  `mrUsage` int DEFAULT NULL,
  `Building_ID` int NOT NULL,
  UNIQUE KEY `mrID` (`MeterReading_ID`) USING BTREE,
  KEY `bmID` (`BillingMonth_ID`) USING BTREE,
  KEY `MeterID` (`Meter_ID`) USING BTREE,
  KEY `Building_ID` (`Building_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2708 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_meterutility`
--

DROP TABLE IF EXISTS `meters_meterutility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_meterutility` (
  `MeterUtility_ID` int NOT NULL AUTO_INCREMENT,
  `Building_ID` int NOT NULL,
  `muLocalSubMeterDate` date DEFAULT NULL,
  `muBillFromDate` date DEFAULT NULL,
  `muBillToDate` date DEFAULT NULL,
  `muCost` double DEFAULT NULL,
  `muKWH` double DEFAULT NULL,
  `muCostperKWH` double DEFAULT NULL,
  `UtilityCompany_ID` int DEFAULT NULL,
  `muDateInput` date DEFAULT NULL,
  `BillingMonth_ID` int DEFAULT NULL,
  PRIMARY KEY (`MeterUtility_ID`) USING BTREE,
  KEY `muid` (`MeterUtility_ID`),
  KEY `utID` (`UtilityCompany_ID`),
  KEY `bdID` (`BillingMonth_ID`),
  KEY `Building_ID` (`Building_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_meterutility_bak`
--

DROP TABLE IF EXISTS `meters_meterutility_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_meterutility_bak` (
  `MeterUtility_ID` int NOT NULL AUTO_INCREMENT,
  `Building_ID` int NOT NULL,
  `muLocalSubMeterDate` date DEFAULT NULL,
  `muBillFromDate` date DEFAULT NULL,
  `muBillToDate` date DEFAULT NULL,
  `muCost` double DEFAULT NULL,
  `muKWH` double DEFAULT NULL,
  `muCostperKWH` double DEFAULT NULL,
  `UtilityCompany_ID` int DEFAULT NULL,
  `muDateInput` date DEFAULT NULL,
  `BillingMonth_ID` int DEFAULT NULL,
  PRIMARY KEY (`MeterUtility_ID`) USING BTREE,
  KEY `muid` (`MeterUtility_ID`),
  KEY `utID` (`UtilityCompany_ID`),
  KEY `bdID` (`BillingMonth_ID`),
  KEY `Building_ID` (`Building_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_utilitycompany`
--

DROP TABLE IF EXISTS `meters_utilitycompany`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_utilitycompany` (
  `UtilityCompany_ID` int NOT NULL AUTO_INCREMENT,
  `Building_ID` int NOT NULL,
  `uniqueCostCenter` int NOT NULL,
  `utType` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utAccountNumber` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utCompanyName` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utCompanyAdd` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utContact` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utPhone` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utEmail` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utBillSchedual` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utDeleted` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `utBillToDate` date NOT NULL,
  `utBillFromDate` date NOT NULL,
  `muUtilityBill` float NOT NULL,
  `muUsage` float NOT NULL,
  `muCostperUnit` float NOT NULL,
  `muUOM` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utInvoiceForMonthOf` date NOT NULL,
  PRIMARY KEY (`UtilityCompany_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_utilitycompany_bak`
--

DROP TABLE IF EXISTS `meters_utilitycompany_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_utilitycompany_bak` (
  `UtilityCompany_ID` int NOT NULL AUTO_INCREMENT,
  `Building_ID` int NOT NULL,
  `uniqueCostCenter` int NOT NULL,
  `utType` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utAccountNumber` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utCompanyName` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utCompanyAdd` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utContact` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utPhone` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utEmail` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utBillSchedual` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utDeleted` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `utBillToDate` date NOT NULL,
  `utBillFromDate` date NOT NULL,
  `muUtilityBill` float NOT NULL,
  `muUsage` float NOT NULL,
  `muCostperUnit` float NOT NULL,
  `muUOM` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `utInvoiceForMonthOf` date NOT NULL,
  PRIMARY KEY (`UtilityCompany_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_utilitytype`
--

DROP TABLE IF EXISTS `meters_utilitytype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_utilitytype` (
  `tyID` int NOT NULL AUTO_INCREMENT,
  `tyName` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  UNIQUE KEY `tyID` (`tyID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_wo_ten_link`
--

DROP TABLE IF EXISTS `meters_wo_ten_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_wo_ten_link` (
  `MeterReading_ID` int NOT NULL,
  `BillingMonth_ID` int NOT NULL,
  `CompanyID` double DEFAULT NULL,
  `Meter_ID` double DEFAULT NULL,
  `wo_number` bigint DEFAULT NULL,
  `Building_ID` int NOT NULL,
  KEY `MeterID` (`Meter_ID`),
  KEY `MeterReading_ID` (`MeterReading_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meters_wo_ten_link_bak`
--

DROP TABLE IF EXISTS `meters_wo_ten_link_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meters_wo_ten_link_bak` (
  `MeterReading_ID` int NOT NULL,
  `BillingMonth_ID` int NOT NULL,
  `CompanyID` double DEFAULT NULL,
  `Meter_ID` double DEFAULT NULL,
  `wo_number` bigint DEFAULT NULL,
  `Building_ID` int NOT NULL,
  KEY `MeterID` (`Meter_ID`),
  KEY `MeterReading_ID` (`MeterReading_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modules` (
  `module_id` int NOT NULL AUTO_INCREMENT,
  `module_name` varchar(200) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notes_predefined`
--

DROP TABLE IF EXISTS `notes_predefined`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes_predefined` (
  `nid` int NOT NULL AUTO_INCREMENT,
  `notes` text NOT NULL,
  `cust_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `outside_service`
--

DROP TABLE IF EXISTS `outside_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `outside_service` (
  `osId` int NOT NULL AUTO_INCREMENT,
  `woId` int NOT NULL,
  `vendor` int NOT NULL,
  `job_description` varchar(255) NOT NULL,
  `job_cost` varchar(255) NOT NULL,
  `markup` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`osId`),
  KEY `woId` (`woId`)
) ENGINE=MyISAM AUTO_INCREMENT=1086 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parent_location`
--

DROP TABLE IF EXISTS `parent_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parent_location` (
  `pl_id` int NOT NULL AUTO_INCREMENT,
  `p_location` varchar(255) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`pl_id`),
  KEY `pl_id` (`pl_id`),
  KEY `pl_id_2` (`pl_id`),
  KEY `pl_id_3` (`pl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_equipment_detail`
--

DROP TABLE IF EXISTS `pm_au_equipment_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_equipment_detail` (
  `AU_Equipment_Detail_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Equipment_Name_ID` int NOT NULL,
  `AU_Template_Name_ID` int NOT NULL,
  `AU_Template_Designation_ID` int NOT NULL,
  `Equipment_Floor` varchar(200) NOT NULL,
  `Equipment_Unit` varchar(200) NOT NULL,
  `Equipment_Make_Model` varchar(200) NOT NULL,
  `Equipment_Location` varchar(200) NOT NULL,
  `Equipment_Serial_Number` varchar(200) DEFAULT NULL,
  `Equipment_Inservice_Date` date DEFAULT NULL,
  `Equipment_Notes` varchar(200) DEFAULT NULL,
  `Equipment_Status` int NOT NULL,
  `Equipment_Manual` varchar(200) DEFAULT NULL,
  `Equipment_Image` varchar(200) DEFAULT NULL,
  `Outside_Contract` varchar(200) DEFAULT NULL,
  `uniqueCostCenter` varchar(200) DEFAULT NULL,
  `BuildingID` int NOT NULL,
  PRIMARY KEY (`AU_Equipment_Detail_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_equipment_email_group`
--

DROP TABLE IF EXISTS `pm_au_equipment_email_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_equipment_email_group` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Group_Name` varchar(200) NOT NULL,
  `Building_id` int NOT NULL,
  `Send_as` varchar(200) NOT NULL,
  `Days_of_week` varchar(200) NOT NULL,
  `Complete_notification` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_equipment_manual`
--

DROP TABLE IF EXISTS `pm_au_equipment_manual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_equipment_manual` (
  `AU_Equipment_Manual_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Equipment_Detail_ID` int NOT NULL,
  `Equipment_Manual` varchar(200) NOT NULL,
  PRIMARY KEY (`AU_Equipment_Manual_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_equipment_name`
--

DROP TABLE IF EXISTS `pm_au_equipment_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_equipment_name` (
  `AU_Equipment_Name_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Equipment_Name` varchar(200) NOT NULL,
  `uniqueCostCenter` int NOT NULL,
  `BuildingID` int NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AU_Equipment_Name_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_equipment_readings`
--

DROP TABLE IF EXISTS `pm_au_equipment_readings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_equipment_readings` (
  `AU_Equipment_Readings_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Equipment_Detail_ID` int NOT NULL,
  `AU_Template_Reading_ID` int NOT NULL,
  `Start_Date` varchar(200) DEFAULT NULL,
  `End_Date` varchar(200) DEFAULT NULL,
  `Startdate_month` varchar(200) NOT NULL,
  `Email_group_ID` int NOT NULL,
  `AU_Assign_Vendor` varchar(200) NOT NULL,
  `Vendor_ID` int NOT NULL,
  PRIMARY KEY (`AU_Equipment_Readings_ID`),
  KEY `AU_Equipment_Readings_ID` (`AU_Equipment_Readings_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_equipment_task`
--

DROP TABLE IF EXISTS `pm_au_equipment_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_equipment_task` (
  `AU_Equipment_Task_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Equipment_Detail_ID` int NOT NULL,
  `AU_Template_Task_ID` int NOT NULL,
  `Start_Date` varchar(200) DEFAULT NULL,
  `End_Date` varchar(200) DEFAULT NULL,
  `Startdate_month` varchar(200) NOT NULL DEFAULT '01',
  `Email_group_ID` int NOT NULL,
  `AU_Assign_Vendor` varchar(200) NOT NULL,
  `Vendor_ID` int NOT NULL,
  PRIMARY KEY (`AU_Equipment_Task_ID`),
  UNIQUE KEY `AU_Equipment_Task_ID` (`AU_Equipment_Task_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_equipment_task_BK_May2021`
--

DROP TABLE IF EXISTS `pm_au_equipment_task_BK_May2021`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_equipment_task_BK_May2021` (
  `AU_Equipment_Task_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Equipment_Detail_ID` int NOT NULL,
  `AU_Template_Task_ID` int NOT NULL,
  `Start_Date` varchar(200) DEFAULT NULL,
  `End_Date` varchar(200) DEFAULT NULL,
  `Startdate_month` varchar(200) NOT NULL DEFAULT '01',
  `Email_group_ID` int NOT NULL,
  `AU_Assign_Vendor` varchar(200) NOT NULL,
  `Vendor_ID` int NOT NULL,
  PRIMARY KEY (`AU_Equipment_Task_ID`),
  UNIQUE KEY `AU_Equipment_Task_ID` (`AU_Equipment_Task_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=350 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_equipment_vendor`
--

DROP TABLE IF EXISTS `pm_au_equipment_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_equipment_vendor` (
  `VID` int NOT NULL AUTO_INCREMENT,
  `Company_Name` varchar(200) NOT NULL,
  `First_Name` varchar(200) NOT NULL,
  `Last_Name` varchar(200) NOT NULL,
  `Services` varchar(200) NOT NULL,
  PRIMARY KEY (`VID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_equipment_vendor_contact`
--

DROP TABLE IF EXISTS `pm_au_equipment_vendor_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_equipment_vendor_contact` (
  `VCID` int NOT NULL AUTO_INCREMENT,
  `VID` int NOT NULL,
  `First_Name` varchar(200) NOT NULL,
  `Last_name` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Phone_Number` int NOT NULL,
  `Cell_Number` int NOT NULL,
  `Status` int NOT NULL,
  PRIMARY KEY (`VCID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_frequency`
--

DROP TABLE IF EXISTS `pm_au_frequency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_frequency` (
  `AU_Frequency_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  `Column` int NOT NULL DEFAULT '1' COMMENT 'Drop Down 1- Frequency 2- Perform Task for every',
  `Interval_Value` varchar(200) NOT NULL,
  `Interval` varchar(100) NOT NULL DEFAULT 'default',
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AU_Frequency_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_history`
--

DROP TABLE IF EXISTS `pm_au_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_history` (
  `PM_History_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Equipment_Task_Reading_ID` int NOT NULL,
  `AU_Equipment_Detail_ID` int NOT NULL,
  `AU_Template_Designation_ID` int NOT NULL,
  `Parent_ID` int NOT NULL,
  `PM_WO_StartDate` date NOT NULL,
  `BuildingID` int NOT NULL,
  `PM_WO_Number` int NOT NULL,
  `Reading_Task` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `PM_Actual_JobTime` float NOT NULL,
  `PM_WO_Complete_Date` date NOT NULL,
  `PM_Note_Comments` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `PM_CompletedBy_UID` int NOT NULL,
  `Reading_Value` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PM_History_ID`),
  UNIQUE KEY `PM_WO_ID` (`PM_History_ID`),
  KEY `AU_Equipment_Task_ID` (`AU_Equipment_Task_Reading_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_history_notes`
--

DROP TABLE IF EXISTS `pm_au_history_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_history_notes` (
  `PM_WO_Notes_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Equipment_Detail_ID` int NOT NULL,
  `AU_Template_Designation_ID` int NOT NULL,
  `PM_WO_DateStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PM_WO_Notes` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `PM_WO_Number` int NOT NULL,
  `Building_ID` int NOT NULL,
  PRIMARY KEY (`PM_WO_Notes_ID`),
  KEY `AU_Equipment_Task_Reading_ID` (`AU_Equipment_Detail_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_history_photos`
--

DROP TABLE IF EXISTS `pm_au_history_photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_history_photos` (
  `PM_WO_Photo_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Equipment_Detail_ID` int NOT NULL,
  `AU_Template_Designation_ID` int NOT NULL,
  `PM_WO_Photo` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Building_ID` int NOT NULL,
  `PM_WO_DateStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PM_WO_Number` int NOT NULL,
  PRIMARY KEY (`PM_WO_Photo_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_jobtime`
--

DROP TABLE IF EXISTS `pm_au_jobtime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_jobtime` (
  `AU_JobTime_ID` int NOT NULL AUTO_INCREMENT,
  `JobTime_Name` varchar(200) NOT NULL,
  `JobTime_Value` varchar(200) NOT NULL,
  PRIMARY KEY (`AU_JobTime_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_startdateadjustment`
--

DROP TABLE IF EXISTS `pm_au_startdateadjustment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_startdateadjustment` (
  `AU_sda_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  PRIMARY KEY (`AU_sda_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_template_name`
--

DROP TABLE IF EXISTS `pm_au_template_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_template_name` (
  `AU_Template_Name_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Template_Name` varchar(200) NOT NULL,
  `uniqueCostCenter` varchar(200) DEFAULT NULL,
  `BuildingID` int NOT NULL,
  `user_id` int NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AU_Template_Name_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_template_reading`
--

DROP TABLE IF EXISTS `pm_au_template_reading`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_template_reading` (
  `AU_Template_Reading_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Template_Designation_ID` int NOT NULL,
  `AU_Frequency_ID` int DEFAULT NULL,
  `Reading_Instruction` varchar(200) NOT NULL,
  `Interval_Value` varchar(200) DEFAULT NULL,
  `Reading_Value` varchar(200) DEFAULT NULL,
  `Tolerance` varchar(200) DEFAULT NULL,
  `Start_date` varchar(200) DEFAULT NULL,
  `End_date` varchar(200) DEFAULT NULL,
  `Seasonal_Task` varchar(200) DEFAULT NULL,
  `Seasonal_Start_Date` varchar(200) DEFAULT NULL,
  `Seasonal_End_Date` varchar(200) DEFAULT NULL,
  `AU_sda_ID` int DEFAULT NULL,
  `AU_uom_ID` int DEFAULT NULL,
  `Startdate_month` varchar(200) DEFAULT NULL,
  `Startdate_EOM` int DEFAULT NULL,
  `Task_jobtime` varchar(200) DEFAULT NULL,
  `overtime` varchar(200) DEFAULT NULL,
  `Assigned_to` varchar(200) DEFAULT NULL,
  `View_order` bigint DEFAULT NULL,
  `Parent_ID` int NOT NULL,
  `User_id` int NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AU_Template_Reading_ID`),
  KEY `AU_Template_Reading_ID` (`AU_Template_Reading_ID`),
  KEY `AU_Template_Designation_ID` (`AU_Template_Designation_ID`),
  KEY `AU_Frequency_ID` (`AU_Frequency_ID`),
  KEY `AU_sda_ID` (`AU_sda_ID`),
  KEY `AU_uom_ID` (`AU_uom_ID`),
  KEY `Parent_ID` (`Parent_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_template_task`
--

DROP TABLE IF EXISTS `pm_au_template_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_template_task` (
  `AU_Template_Task_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Template_Designation_ID` int DEFAULT NULL,
  `Task_Instruction` varchar(200) DEFAULT NULL,
  `AU_Frequency_ID` int DEFAULT NULL,
  `Interval_Value` varchar(200) DEFAULT NULL,
  `Start_date` varchar(200) DEFAULT NULL,
  `End_date` varchar(200) DEFAULT NULL,
  `Seasonal_Task` varchar(200) DEFAULT NULL,
  `Seasonal_Start_Date` varchar(200) DEFAULT NULL,
  `Seasonal_End_Date` varchar(200) DEFAULT NULL,
  `AU_sda_ID` int DEFAULT NULL,
  `Startdate_month` varchar(200) DEFAULT NULL,
  `Startdate_EOM` varchar(200) DEFAULT NULL,
  `Task_jobtime` varchar(200) DEFAULT NULL,
  `overtime` varchar(200) DEFAULT NULL,
  `Assigned_to` int DEFAULT NULL,
  `View_order` bigint DEFAULT NULL,
  `Parent_ID` int NOT NULL,
  `User_id` int NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AU_Template_Task_ID`),
  KEY `AU_Template_Task_ID` (`AU_Template_Task_ID`),
  KEY `AU_Template_Designation_ID` (`AU_Template_Designation_ID`),
  KEY `AU_Frequency_ID` (`AU_Frequency_ID`),
  KEY `Parent_ID` (`Parent_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_template_typedesignation`
--

DROP TABLE IF EXISTS `pm_au_template_typedesignation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_template_typedesignation` (
  `AU_Template_Designation_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Template_Name_ID` int NOT NULL,
  `AU_TypeDesignation` varchar(100) NOT NULL,
  `AU_TypeDescritpion` varchar(500) NOT NULL,
  `User_id` int NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AU_Template_Designation_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_temporary_template_reading`
--

DROP TABLE IF EXISTS `pm_au_temporary_template_reading`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_temporary_template_reading` (
  `AU_Template_Reading_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Template_Designation_ID` int NOT NULL,
  `AU_Frequency_ID` int DEFAULT NULL,
  `Reading_Instruction` varchar(200) NOT NULL,
  `Interval_Value` varchar(200) DEFAULT NULL,
  `Reading_Value` varchar(200) DEFAULT NULL,
  `Tolerance` varchar(200) DEFAULT NULL,
  `Start_date` varchar(200) DEFAULT NULL,
  `End_date` varchar(200) DEFAULT NULL,
  `Seasonal_Task` varchar(200) DEFAULT NULL,
  `Seasonal_Start_Date` varchar(200) DEFAULT NULL,
  `Seasonal_End_Date` varchar(200) DEFAULT NULL,
  `AU_sda_ID` int DEFAULT NULL,
  `AU_uom_ID` int DEFAULT NULL,
  `Startdate_month` varchar(200) DEFAULT NULL,
  `Startdate_EOM` int DEFAULT NULL,
  `Task_jobtime` varchar(200) DEFAULT NULL,
  `overtime` varchar(200) DEFAULT NULL,
  `Assigned_to` varchar(200) DEFAULT NULL,
  `View_order` bigint DEFAULT NULL,
  `Parent_ID` int NOT NULL,
  `User_id` int NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AU_Template_Reading_ID`),
  KEY `AU_Template_Reading_ID` (`AU_Template_Reading_ID`),
  KEY `AU_Template_Designation_ID` (`AU_Template_Designation_ID`),
  KEY `AU_Frequency_ID` (`AU_Frequency_ID`),
  KEY `Parent_ID` (`Parent_ID`),
  KEY `AU_uom_ID` (`AU_uom_ID`),
  KEY `AU_sda_ID` (`AU_sda_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_temporary_template_task`
--

DROP TABLE IF EXISTS `pm_au_temporary_template_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_temporary_template_task` (
  `AU_Template_Task_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Template_Designation_ID` int DEFAULT NULL,
  `Task_Instruction` varchar(200) DEFAULT NULL,
  `AU_Frequency_ID` int DEFAULT NULL,
  `Interval_Value` varchar(200) NOT NULL DEFAULT '1',
  `Start_date` varchar(200) DEFAULT NULL,
  `End_date` varchar(200) DEFAULT NULL,
  `Seasonal_Task` varchar(200) DEFAULT NULL,
  `Seasonal_Start_Date` varchar(200) DEFAULT NULL,
  `Seasonal_End_Date` varchar(200) DEFAULT NULL,
  `AU_sda_ID` int DEFAULT NULL,
  `Startdate_month` varchar(200) DEFAULT NULL,
  `Startdate_EOM` varchar(200) DEFAULT NULL,
  `Task_jobtime` varchar(200) DEFAULT NULL,
  `overtime` varchar(200) DEFAULT NULL,
  `Assigned_to` int DEFAULT NULL,
  `View_order` bigint DEFAULT NULL,
  `Parent_ID` int NOT NULL,
  `User_id` int NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AU_Template_Task_ID`),
  KEY `AU_Template_Task_ID` (`AU_Template_Task_ID`),
  KEY `AU_Frequency_ID` (`AU_Frequency_ID`),
  KEY `AU_Template_Designation_ID` (`AU_Template_Designation_ID`),
  KEY `Parent_ID` (`Parent_ID`),
  KEY `AU_sda_ID` (`AU_sda_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_unitofmeasure`
--

DROP TABLE IF EXISTS `pm_au_unitofmeasure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_unitofmeasure` (
  `AU_uom_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AU_uom_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_view_tables`
--

DROP TABLE IF EXISTS `pm_au_view_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_view_tables` (
  `id` int NOT NULL AUTO_INCREMENT,
  `display_table_view` varchar(200) NOT NULL,
  `pm_type` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_wo_manual`
--

DROP TABLE IF EXISTS `pm_au_wo_manual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_wo_manual` (
  `PM_MAN_ID` int NOT NULL AUTO_INCREMENT COMMENT 'Manual PM ID',
  `Building_ID` int NOT NULL COMMENT 'Building ID',
  `uniqueCostCenter` int NOT NULL COMMENT 'Cost Center Number',
  `Date_TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int NOT NULL COMMENT 'User ID from user_access table',
  `PM_MAN_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date - Create PM for this Date',
  PRIMARY KEY (`PM_MAN_ID`),
  KEY `Building_ID` (`Building_ID`),
  KEY `uniqueCostCenter` (`uniqueCostCenter`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_work_order`
--

DROP TABLE IF EXISTS `pm_au_work_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_work_order` (
  `PM_WO_ID` int NOT NULL AUTO_INCREMENT,
  `AU_Equipment_Task_Reading_ID` int NOT NULL,
  `AU_Equipment_Detail_ID` int NOT NULL,
  `AU_Template_Designation_ID` int NOT NULL,
  `Parent_ID` int NOT NULL,
  `PM_WO_StartDate` date NOT NULL,
  `PM_WO_SendEMail` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `BuildingID` int NOT NULL,
  `PM_WO_Number` int NOT NULL,
  `Reading_Task` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PM_WO_ID`),
  UNIQUE KEY `PM_WO_ID` (`PM_WO_ID`),
  KEY `AU_Equipment_Task_ID` (`AU_Equipment_Task_Reading_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_au_work_order_options`
--

DROP TABLE IF EXISTS `pm_au_work_order_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_au_work_order_options` (
  `PM_WO_Options_ID` int NOT NULL AUTO_INCREMENT,
  `BuildingID` int NOT NULL,
  `PM_Auto_Create_Jobs` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `PM_Auto_Schedule` enum('E','F','W','M') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'M' COMMENT 'E - Every Day, F - Week Day Only, W - Week ly Day, M - Monthly',
  `PM_Auto_Month_Day_Of_Week` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1',
  `PM_Auto_Month_Generate` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Day' COMMENT 'Day or Monday through Sunday',
  `PM_Auto_Exclude` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Exclude Daily and or Weekly when generatig PM WO',
  `PM_Reports_Separate` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `PM_Reports_Exclude_Daily` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Y',
  `PM_Reports_Exclude_Weekly` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `PM_Complete_Job_Time` enum('M','O','R') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'O' COMMENT 'M - Mandatory, O - Optional, R - Remove time requirements',
  PRIMARY KEY (`PM_WO_Options_ID`) USING BTREE,
  UNIQUE KEY `PM_WO_Options_ID` (`PM_WO_Options_ID`),
  KEY `BuildingID` (`BuildingID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_view_tables`
--

DROP TABLE IF EXISTS `pm_view_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_view_tables` (
  `id` int NOT NULL AUTO_INCREMENT,
  `display_table_view` varchar(200) NOT NULL,
  `pm_type` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_vt_template_name`
--

DROP TABLE IF EXISTS `pm_vt_template_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_vt_template_name` (
  `VT_Template_Name_ID` int NOT NULL AUTO_INCREMENT,
  `VT_Template_Name` varchar(500) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Vt_Admin_Template` varchar(50) NOT NULL DEFAULT 'Yes' COMMENT 'value Only: Yes or No ',
  PRIMARY KEY (`VT_Template_Name_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_vt_template_reading`
--

DROP TABLE IF EXISTS `pm_vt_template_reading`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_vt_template_reading` (
  `VT_Template_Reading_ID` int NOT NULL AUTO_INCREMENT,
  `VT_Template_Designation_ID` int NOT NULL,
  `AU_Frequency_ID` int DEFAULT NULL,
  `Reading_Instruction` varchar(500) DEFAULT NULL,
  `Interval_Value` int NOT NULL DEFAULT '1',
  `Reading_Value` varchar(100) DEFAULT NULL,
  `Tolerance` varchar(100) DEFAULT NULL,
  `Start_date` varchar(100) DEFAULT NULL,
  `End_date` varchar(100) NOT NULL,
  `Seasonal_Task` varchar(100) NOT NULL,
  `Seasonal_Start_Date` varchar(200) NOT NULL,
  `Seasonal_End_Date` varchar(200) NOT NULL,
  `Startdate_month` varchar(100) DEFAULT NULL,
  `AU_sda_ID` int DEFAULT NULL,
  `AU_uom_ID` int DEFAULT NULL,
  `Task_jobtime` varchar(100) DEFAULT NULL,
  `Overtime` varchar(100) DEFAULT NULL,
  `Assigned_to` varchar(100) DEFAULT NULL,
  `View_order` int DEFAULT NULL,
  `Parent_ID` int NOT NULL DEFAULT '0',
  `User_ID` int NOT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`VT_Template_Reading_ID`),
  KEY `VT_Template_Reading_ID` (`VT_Template_Reading_ID`),
  KEY `VT_Template_Designation_ID` (`VT_Template_Designation_ID`),
  KEY `AU_Frequency_ID` (`AU_Frequency_ID`),
  KEY `AU_sda_ID` (`AU_sda_ID`),
  KEY `AU_uom_ID` (`AU_uom_ID`),
  KEY `Parent_ID` (`Parent_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_vt_template_task`
--

DROP TABLE IF EXISTS `pm_vt_template_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_vt_template_task` (
  `VT_Template_Task_ID` int NOT NULL AUTO_INCREMENT,
  `Task_Instruction` varchar(500) DEFAULT NULL,
  `AU_Frequency_ID` int DEFAULT NULL,
  `Interval_Value` int NOT NULL DEFAULT '1',
  `Start_date` varchar(100) DEFAULT NULL,
  `End_date` varchar(100) NOT NULL,
  `Seasonal_Task` varchar(100) NOT NULL,
  `Seasonal_Start_Date` varchar(200) NOT NULL,
  `Seasonal_End_Date` varchar(200) NOT NULL,
  `Startdate_month` varchar(100) DEFAULT NULL,
  `AU_sda_ID` int DEFAULT NULL,
  `Task_jobtime` varchar(100) DEFAULT NULL,
  `Overtime` varchar(100) DEFAULT NULL,
  `Assigned_to` varchar(100) DEFAULT NULL,
  `View_order` int DEFAULT NULL,
  `Parent_ID` int NOT NULL DEFAULT '0',
  `VT_Template_Designation_ID` int NOT NULL,
  `User_ID` int NOT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`VT_Template_Task_ID`),
  KEY `VT_Template_Task_ID` (`VT_Template_Task_ID`),
  KEY `AU_Frequency_ID` (`AU_Frequency_ID`),
  KEY `AU_sda_ID` (`AU_sda_ID`),
  KEY `Parent_ID` (`Parent_ID`),
  KEY `AU_sda_ID_2` (`AU_sda_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=880 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm_vt_template_typedesignation`
--

DROP TABLE IF EXISTS `pm_vt_template_typedesignation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pm_vt_template_typedesignation` (
  `VT_Template_Designation_ID` int NOT NULL AUTO_INCREMENT,
  `VT_Template_Name_ID` int NOT NULL,
  `VT_TypeDesignation` varchar(100) NOT NULL,
  `VT_TypeDescritpion` varchar(500) NOT NULL,
  `User_id` int NOT NULL,
  `VT_Admin_Template` varchar(50) NOT NULL DEFAULT 'Yes',
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`VT_Template_Designation_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `priority` (
  `pid` int unsigned NOT NULL AUTO_INCREMENT,
  `priorityName` varchar(100) NOT NULL,
  `priorityDescription` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `global_template` tinyint NOT NULL DEFAULT '0',
  `import_template` tinyint NOT NULL DEFAULT '0',
  `import_from` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL,
  `created_date` date NOT NULL,
  `modefied_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `building_id` int DEFAULT NULL,
  PRIMARY KEY (`pid`),
  KEY `building_id` (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=299 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `priority_schedule`
--

DROP TABLE IF EXISTS `priority_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `priority_schedule` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `priority_id` int unsigned NOT NULL,
  `start_status` varchar(10) NOT NULL,
  `end_status` varchar(10) NOT NULL,
  `Time` int NOT NULL,
  `length` varchar(20) NOT NULL,
  `access_days` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `start_time_active` varchar(255) NOT NULL,
  `end_time_active` varchar(255) NOT NULL,
  `all_day_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int NOT NULL,
  `created_date` datetime NOT NULL,
  `modefied_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `priority_id` (`priority_id`),
  KEY `priority_id_2` (`priority_id`)
) ENGINE=InnoDB AUTO_INCREMENT=951 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `push_tokens`
--

DROP TABLE IF EXISTS `push_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `push_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `push_id` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `badges` varchar(255) NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report` (
  `rid` int NOT NULL AUTO_INCREMENT,
  `report_name` varchar(255) NOT NULL,
  `dashboard_menu` varchar(255) NOT NULL,
  `report_mrt` varchar(255) NOT NULL,
  `report_option` text NOT NULL,
  `report_target` varchar(255) NOT NULL,
  `accounts` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `Report_Type` varchar(10) NOT NULL DEFAULT 'HTML',
  PRIMARY KEY (`rid`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `report.old`
--

DROP TABLE IF EXISTS `report.old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report.old` (
  `rid` int NOT NULL AUTO_INCREMENT,
  `report_name` varchar(255) NOT NULL,
  `dashboard_menu` varchar(255) NOT NULL,
  `report_mrt` varchar(255) NOT NULL,
  `report_option` text NOT NULL,
  `report_target` varchar(255) NOT NULL,
  `accounts` varchar(255) NOT NULL,
  `Report_Type` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`rid`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `roleID` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=deactive, 1=active',
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule` (
  `schedule_id` int unsigned NOT NULL AUTO_INCREMENT,
  `priority_id` int NOT NULL,
  `statusStart` varchar(50) NOT NULL,
  `statusEnd` varchar(50) NOT NULL,
  `time` int NOT NULL,
  `lengthTime` varchar(50) NOT NULL,
  `lengthDay` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=deactive, 1=active',
  PRIMARY KEY (`schedule_id`),
  KEY `priority_id` (`priority_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `schedule_status`
--

DROP TABLE IF EXISTS `schedule_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule_status` (
  `ssID` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`ssID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `send_as`
--

DROP TABLE IF EXISTS `send_as`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `send_as` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `service` varchar(255) NOT NULL,
  `building` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setting` (
  `setting_id` int NOT NULL AUTO_INCREMENT,
  `from_name` varchar(250) NOT NULL,
  `from_email` varchar(250) NOT NULL,
  `bcc_name` varchar(250) NOT NULL,
  `bcc_email` varchar(250) NOT NULL,
  `contactus_name` varchar(200) NOT NULL,
  `contactus_email` varchar(200) NOT NULL,
  `support_name` varchar(200) NOT NULL,
  `support_email` varchar(200) NOT NULL,
  `per_page` int NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` int NOT NULL AUTO_INCREMENT,
  `state` varchar(22) NOT NULL,
  `state_code` char(2) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `system_default`
--

DROP TABLE IF EXISTS `system_default`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_default` (
  `sd_id` int NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL,
  `support_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `voc_logo` varchar(255) NOT NULL,
  `footer_info` varchar(255) NOT NULL,
  `mail_data` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tenant`
--

DROP TABLE IF EXISTS `tenant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenantName` varchar(255) DEFAULT NULL,
  `tenantContact` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `suite` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `state_code` char(2) DEFAULT NULL,
  `postalCode` varchar(255) DEFAULT NULL,
  `faxNumber` int DEFAULT NULL,
  `phoneNumber` varchar(250) DEFAULT NULL,
  `phoneExt` varchar(150) DEFAULT NULL,
  `billtoAddress` text,
  `attention` varchar(255) DEFAULT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateddate` datetime DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `buildingId` int DEFAULT NULL,
  `imported_from` int DEFAULT '0',
  `status` int DEFAULT NULL,
  `remove_status` int DEFAULT '0',
  `remove_date` date DEFAULT NULL,
  `history_remove` int DEFAULT '0',
  `history_date` date DEFAULT NULL,
  `userStatus` int DEFAULT NULL,
  `tenant_number` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=946 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tenant_BAK2`
--

DROP TABLE IF EXISTS `tenant_BAK2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenant_BAK2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenantName` varchar(255) NOT NULL,
  `tenantContact` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `suite` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `state_code` char(2) NOT NULL,
  `postalCode` varchar(255) NOT NULL,
  `faxNumber` int NOT NULL,
  `phoneNumber` varchar(250) NOT NULL,
  `phoneExt` varchar(150) NOT NULL,
  `billtoAddress` text NOT NULL,
  `attention` varchar(255) NOT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateddate` datetime NOT NULL,
  `userId` int NOT NULL,
  `buildingId` int NOT NULL,
  `imported_from` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `remove_status` int NOT NULL DEFAULT '0',
  `remove_date` date DEFAULT NULL,
  `history_remove` int NOT NULL DEFAULT '0',
  `history_date` date DEFAULT NULL,
  `userStatus` int NOT NULL,
  `tenant_number` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=718 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tenant_BAK3`
--

DROP TABLE IF EXISTS `tenant_BAK3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenant_BAK3` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenantName` varchar(255) NOT NULL,
  `tenantContact` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `suite` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `state_code` char(2) NOT NULL,
  `postalCode` varchar(255) NOT NULL,
  `faxNumber` int NOT NULL,
  `phoneNumber` varchar(250) NOT NULL,
  `phoneExt` varchar(150) NOT NULL,
  `billtoAddress` text NOT NULL,
  `attention` varchar(255) NOT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateddate` datetime NOT NULL,
  `userId` int NOT NULL,
  `buildingId` int NOT NULL,
  `imported_from` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `remove_status` int NOT NULL DEFAULT '0',
  `remove_date` date DEFAULT NULL,
  `history_remove` int NOT NULL DEFAULT '0',
  `history_date` date DEFAULT NULL,
  `userStatus` int NOT NULL,
  `tenant_number` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=718 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tenant_bak`
--

DROP TABLE IF EXISTS `tenant_bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenant_bak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenantName` varchar(255) NOT NULL,
  `tenantContact` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `suite` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `state_code` char(2) NOT NULL,
  `postalCode` varchar(255) NOT NULL,
  `faxNumber` int NOT NULL,
  `phoneNumber` varchar(250) NOT NULL,
  `phoneExt` varchar(150) NOT NULL,
  `billtoAddress` text NOT NULL,
  `attention` varchar(255) NOT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateddate` datetime NOT NULL,
  `userId` int NOT NULL,
  `buildingId` int NOT NULL,
  `imported_from` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `remove_status` int NOT NULL DEFAULT '0',
  `remove_date` date DEFAULT NULL,
  `history_remove` int NOT NULL DEFAULT '0',
  `history_date` date DEFAULT NULL,
  `userStatus` int NOT NULL,
  `tenant_number` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=449 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tenantusers`
--

DROP TABLE IF EXISTS `tenantusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenantusers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenantId` int NOT NULL,
  `userId` int NOT NULL,
  `suite_location` varchar(255) NOT NULL,
  `main_contact` int NOT NULL DEFAULT '0',
  `cc_enable` int NOT NULL,
  `send_as` varchar(255) NOT NULL,
  `complete_notification` int NOT NULL DEFAULT '0',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateddate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tenantId` (`tenantId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=1933 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tenantusers_BAK`
--

DROP TABLE IF EXISTS `tenantusers_BAK`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenantusers_BAK` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenantId` int NOT NULL,
  `userId` int NOT NULL,
  `suite_location` varchar(255) NOT NULL,
  `main_contact` int NOT NULL DEFAULT '0',
  `cc_enable` int NOT NULL,
  `send_as` varchar(255) NOT NULL,
  `complete_notification` int NOT NULL DEFAULT '0',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateddate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tenantId` (`tenantId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=1294 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tenantusers_bak2`
--

DROP TABLE IF EXISTS `tenantusers_bak2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenantusers_bak2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenantId` int NOT NULL,
  `userId` int NOT NULL,
  `suite_location` varchar(255) NOT NULL,
  `main_contact` int NOT NULL DEFAULT '0',
  `cc_enable` int NOT NULL,
  `send_as` varchar(255) NOT NULL,
  `complete_notification` int NOT NULL DEFAULT '0',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateddate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tenantId` (`tenantId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=1202 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `time_zone`
--

DROP TABLE IF EXISTS `time_zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `time_zone` (
  `id` int NOT NULL AUTO_INCREMENT,
  `time_value` varchar(250) NOT NULL,
  `time_label` varchar(255) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_access`
--

DROP TABLE IF EXISTS `user_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location_id` int NOT NULL,
  `user_id` int NOT NULL,
  `is_access` enum('0','1') NOT NULL,
  `is_read` enum('0','1') NOT NULL,
  `is_write` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1060 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_building_module_access`
--

DROP TABLE IF EXISTS `user_building_module_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_building_module_access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `building_id` int NOT NULL,
  `modules_id` varchar(50) NOT NULL COMMENT 'comma separated value',
  `assigned_date` datetime NOT NULL,
  `distributiongroup_id` varchar(200) NOT NULL,
  `last_update_date` datetime NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `building_id` (`building_id`),
  KEY `modules_id` (`modules_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2751 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `uid` int unsigned NOT NULL AUTO_INCREMENT,
  `cust_id` int DEFAULT NULL,
  `userName` varchar(50) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `phoneExt` varchar(255) DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '7',
  `lastAccess` datetime DEFAULT NULL,
  `regDate` date NOT NULL,
  `user_img` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '0=inactive, 1=active',
  `ccwelcomeletter` int NOT NULL DEFAULT '0',
  `note_notification` int NOT NULL DEFAULT '1',
  `alert_notification` int NOT NULL DEFAULT '1',
  `remove_status` int NOT NULL DEFAULT '0',
  `remove_date` date DEFAULT NULL,
  `history_remove` int NOT NULL DEFAULT '0',
  `history_date` date DEFAULT NULL,
  `passkey` varchar(255) DEFAULT NULL,
  `passkeyStatus` tinyint(1) DEFAULT NULL,
  `passkeyTime` datetime DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `login_session` varchar(250) DEFAULT NULL,
  `logout_time` int NOT NULL DEFAULT '14400',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2257 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_BAK`
--

DROP TABLE IF EXISTS `users_BAK`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_BAK` (
  `uid` int unsigned NOT NULL AUTO_INCREMENT,
  `cust_id` int DEFAULT NULL,
  `userName` varchar(50) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `phoneExt` varchar(255) DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '7',
  `lastAccess` datetime DEFAULT NULL,
  `regDate` date NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '0=inactive, 1=active',
  `ccwelcomeletter` int NOT NULL DEFAULT '0',
  `note_notification` int NOT NULL DEFAULT '1',
  `alert_notification` int NOT NULL DEFAULT '1',
  `remove_status` int NOT NULL DEFAULT '0',
  `remove_date` date DEFAULT NULL,
  `history_remove` int NOT NULL DEFAULT '0',
  `history_date` date DEFAULT NULL,
  `passkey` varchar(255) DEFAULT NULL,
  `passkeyStatus` tinyint(1) DEFAULT NULL,
  `passkeyTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(200) NOT NULL,
  `login_session` varchar(250) DEFAULT NULL,
  `logout_time` int NOT NULL DEFAULT '14400',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=1562 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_bak2`
--

DROP TABLE IF EXISTS `users_bak2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_bak2` (
  `uid` int unsigned NOT NULL AUTO_INCREMENT,
  `cust_id` int DEFAULT NULL,
  `userName` varchar(50) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `phoneExt` varchar(255) DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '7',
  `lastAccess` datetime DEFAULT NULL,
  `regDate` date NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '0=inactive, 1=active',
  `ccwelcomeletter` int NOT NULL DEFAULT '0',
  `note_notification` int NOT NULL DEFAULT '1',
  `alert_notification` int NOT NULL DEFAULT '1',
  `remove_status` int NOT NULL DEFAULT '0',
  `remove_date` date DEFAULT NULL,
  `history_remove` int NOT NULL DEFAULT '0',
  `history_date` date DEFAULT NULL,
  `passkey` varchar(255) DEFAULT NULL,
  `passkeyStatus` tinyint(1) DEFAULT NULL,
  `passkeyTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(200) NOT NULL,
  `login_session` varchar(250) DEFAULT NULL,
  `logout_time` int NOT NULL DEFAULT '14400',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=1441 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor` (
  `vid` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `services` int NOT NULL,
  `contact_type` int NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `cell_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `state_code` char(2) NOT NULL,
  `postal_code` varchar(200) NOT NULL,
  `emergency_contact` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `buildingId` int NOT NULL,
  `notes` text NOT NULL,
  `remove_status` int NOT NULL DEFAULT '0',
  `global_template` int NOT NULL DEFAULT '0',
  `import_template` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vendor_contact`
--

DROP TABLE IF EXISTS `vendor_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor_contact` (
  `vcId` int NOT NULL AUTO_INCREMENT,
  `vid` int NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone_number` varchar(250) NOT NULL,
  `cell_number` varchar(250) NOT NULL,
  `emergency_contact` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `remove_status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`vcId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `week_days`
--

DROP TABLE IF EXISTS `week_days`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `week_days` (
  `wdID` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`wdID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wo_batch`
--

DROP TABLE IF EXISTS `wo_batch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wo_batch` (
  `batchid` int NOT NULL AUTO_INCREMENT,
  `batch_number` bigint NOT NULL,
  `building_id` int NOT NULL,
  `tenant_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int NOT NULL,
  PRIMARY KEY (`batchid`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wo_category_log`
--

DROP TABLE IF EXISTS `wo_category_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wo_category_log` (
  `wcId` int NOT NULL AUTO_INCREMENT,
  `woId` int NOT NULL,
  `category` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`wcId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wo_complete`
--

DROP TABLE IF EXISTS `wo_complete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wo_complete` (
  `wcId` int NOT NULL AUTO_INCREMENT,
  `woId` int NOT NULL,
  `date_cp_in` date NOT NULL,
  `date_cp_out` date NOT NULL,
  `time_in` varchar(150) NOT NULL,
  `time_out` varchar(150) NOT NULL,
  `wo_status` int NOT NULL,
  `version` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`wcId`),
  KEY `woId` (`woId`)
) ENGINE=MyISAM AUTO_INCREMENT=14411 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wo_files`
--

DROP TABLE IF EXISTS `wo_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wo_files` (
  `wfId` int NOT NULL AUTO_INCREMENT,
  `woId` int NOT NULL,
  `file_title` varchar(250) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`wfId`),
  KEY `woId` (`woId`)
) ENGINE=MyISAM AUTO_INCREMENT=2437 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wo_history_log`
--

DROP TABLE IF EXISTS `wo_history_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wo_history_log` (
  `whId` int NOT NULL AUTO_INCREMENT,
  `woId` int NOT NULL,
  `log_type` varchar(255) NOT NULL,
  `current_value` text,
  `change_value` text,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`whId`),
  KEY `woId` (`woId`)
) ENGINE=MyISAM AUTO_INCREMENT=70095 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wo_note`
--

DROP TABLE IF EXISTS `wo_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wo_note` (
  `wnId` int NOT NULL AUTO_INCREMENT,
  `woId` int NOT NULL,
  `note_date` date NOT NULL,
  `note` varchar(255) NOT NULL,
  `internal` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  PRIMARY KEY (`wnId`),
  KEY `woId` (`woId`)
) ENGINE=MyISAM AUTO_INCREMENT=11701 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wo_parameter`
--

DROP TABLE IF EXISTS `wo_parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wo_parameter` (
  `wpId` int NOT NULL AUTO_INCREMENT,
  `building` int NOT NULL,
  `status_closed` int NOT NULL,
  `billable` int NOT NULL,
  `inc_tnt_rqt` int NOT NULL,
  `email_tenant` int NOT NULL,
  `sale_tax` varchar(250) NOT NULL,
  `auto_charge` int NOT NULL,
  `dft_markup` varchar(250) NOT NULL,
  `override_markup` int NOT NULL,
  `time_in_start` varchar(250) NOT NULL,
  `time_in_incmt` varchar(250) NOT NULL,
  `time_min_charge` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`wpId`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wo_schedule_status`
--

DROP TABLE IF EXISTS `wo_schedule_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wo_schedule_status` (
  `wssId` int NOT NULL AUTO_INCREMENT,
  `worder_id` int NOT NULL,
  `schedule_id` int NOT NULL,
  `priority_id` int NOT NULL,
  `status` int NOT NULL,
  `current_status` int NOT NULL,
  `reminder` int DEFAULT NULL,
  `ckey` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`wssId`),
  KEY `worder_id` (`worder_id`),
  KEY `schedule_id` (`schedule_id`),
  KEY `priority_id` (`priority_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65358 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `work_description`
--

DROP TABLE IF EXISTS `work_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_description` (
  `id` int NOT NULL AUTO_INCREMENT,
  `woId` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `woId` (`woId`)
) ENGINE=MyISAM AUTO_INCREMENT=8534 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `work_order`
--

DROP TABLE IF EXISTS `work_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_order` (
  `woId` int NOT NULL AUTO_INCREMENT,
  `tenant` int NOT NULL,
  `building` int NOT NULL,
  `suite_location` varchar(255) DEFAULT '',
  `suite_location2` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `create_user` int NOT NULL,
  `date_requested` date NOT NULL,
  `time_requested` varchar(255) NOT NULL,
  `priority` int DEFAULT NULL,
  `category` int NOT NULL,
  `internal_work_order` int DEFAULT NULL,
  `master_internal_work_order` int NOT NULL,
  `work_order_request` text NOT NULL,
  `wo_file` varchar(255) DEFAULT NULL,
  `work_status` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `wo_number` bigint DEFAULT NULL,
  `wo_batch` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`woId`),
  KEY `user_id` (`user_id`),
  KEY `email_id` (`email_id`),
  KEY `tenant` (`tenant`),
  KEY `building` (`building`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26312 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `work_order_update`
--

DROP TABLE IF EXISTS `work_order_update`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_order_update` (
  `upId` int NOT NULL AUTO_INCREMENT,
  `wo_id` int NOT NULL,
  `wo_request` text,
  `internal_note` text,
  `wo_status` int NOT NULL,
  `billable_opt` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `current_update` int NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`upId`),
  KEY `wo_id` (`wo_id`),
  KEY `user_id` (`user_id`),
  KEY `upId` (`upId`),
  KEY `wo_status` (`wo_status`)
) ENGINE=InnoDB AUTO_INCREMENT=80572 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `work_status`
--

DROP TABLE IF EXISTS `work_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-03 13:14:31
