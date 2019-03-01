/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 5.7.21 : Database - training
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `approval_statuses` */

DROP TABLE IF EXISTS `approval_statuses`;

CREATE TABLE `approval_statuses` (
  `approval_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `training_request_id` int(10) unsigned NOT NULL,
  `approver_id` int(10) unsigned NOT NULL,
  `status` enum('pending','approved','denied') CHARACTER SET utf8 DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`approval_status_id`),
  KEY `training_request_id` (`training_request_id`),
  KEY `approver_id` (`approver_id`),
  CONSTRAINT `approver_id` FOREIGN KEY (`approver_id`) REFERENCES `approvers` (`approver_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `training_request_id` FOREIGN KEY (`training_request_id`) REFERENCES `training_requests` (`training_request_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `approval_statuses` */

insert  into `approval_statuses`(`approval_status_id`,`training_request_id`,`approver_id`,`status`,`created_at`,`updated_at`) values 
(143,62,14,'pending','2018-12-26 15:23:45','2018-12-26 15:23:45'),
(144,63,14,'pending','2018-12-26 17:09:44','2018-12-26 17:09:44');

/*Table structure for table `approvers` */

DROP TABLE IF EXISTS `approvers`;

CREATE TABLE `approvers` (
  `approver_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `approver_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `position` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`approver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `approvers` */

insert  into `approvers`(`approver_id`,`approver_name`,`email`,`position`,`created_by`,`created_at`,`updated_at`) values 
(14,'Prince Ivan Kent Tiburcio','princeivankentmtiburcio@gmail.com','Programmer','(By dafault) Miguel Sanggalang','2018-10-29 17:06:38','2018-11-13 12:59:55');

/*Table structure for table `customer_dealers` */

DROP TABLE IF EXISTS `customer_dealers`;

CREATE TABLE `customer_dealers` (
  `customer_dealer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `training_request_id` int(10) unsigned NOT NULL,
  `dealer` varchar(150) CHARACTER SET utf8 NOT NULL,
  `branch` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`customer_dealer_id`),
  KEY `cd.training_request_id` (`training_request_id`),
  CONSTRAINT `cd.training_request_id` FOREIGN KEY (`training_request_id`) REFERENCES `training_requests` (`training_request_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_dealers` */

insert  into `customer_dealers`(`customer_dealer_id`,`training_request_id`,`dealer`,`branch`) values 
(57,62,'GenCars','Alabang'),
(58,63,'GenCars','Alabang');

/*Table structure for table `customer_models` */

DROP TABLE IF EXISTS `customer_models`;

CREATE TABLE `customer_models` (
  `customer_model_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `training_request_id` int(10) unsigned NOT NULL,
  `model` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`customer_model_id`),
  KEY `cm.training_request_id` (`training_request_id`),
  CONSTRAINT `cm.training_request_id` FOREIGN KEY (`training_request_id`) REFERENCES `training_requests` (`training_request_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_models` */

insert  into `customer_models`(`customer_model_id`,`training_request_id`,`model`) values 
(60,62,'mu-X'),
(61,63,'C&E Series');

/*Table structure for table `customer_participants` */

DROP TABLE IF EXISTS `customer_participants`;

CREATE TABLE `customer_participants` (
  `customer_participant_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `training_request_id` int(10) unsigned NOT NULL,
  `participant` varchar(100) CHARACTER SET utf8 NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`customer_participant_id`),
  KEY `cp.training_request_id` (`training_request_id`),
  CONSTRAINT `cp.training_request_id` FOREIGN KEY (`training_request_id`) REFERENCES `training_requests` (`training_request_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer_participants` */

insert  into `customer_participants`(`customer_participant_id`,`training_request_id`,`participant`,`quantity`) values 
(54,62,'Devs',20),
(55,63,'Driver',1);

/*Table structure for table `dealers` */

DROP TABLE IF EXISTS `dealers`;

CREATE TABLE `dealers` (
  `dealer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dealer` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `branch` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dealer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `dealers` */

insert  into `dealers`(`dealer_id`,`dealer`,`branch`,`created_at`,`updated_at`) values 
(113,'GenCars','Alabang','2018-10-08 15:46:15','2018-10-08 15:46:15'),
(114,'GenCars','Batangas','2018-10-08 16:49:07','2018-10-08 16:49:07');

/*Table structure for table `designated_trainors` */

DROP TABLE IF EXISTS `designated_trainors`;

CREATE TABLE `designated_trainors` (
  `designated_trainor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `training_request_id` int(10) unsigned NOT NULL,
  `trainor_id` int(10) unsigned NOT NULL,
  `assigned_by` varchar(191) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`designated_trainor_id`),
  KEY `trainor_id` (`trainor_id`),
  KEY `td.training_request_id` (`training_request_id`),
  CONSTRAINT `td.training_request_id` FOREIGN KEY (`training_request_id`) REFERENCES `training_requests` (`training_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trainor_id` FOREIGN KEY (`trainor_id`) REFERENCES `trainors` (`trainor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `designated_trainors` */

insert  into `designated_trainors`(`designated_trainor_id`,`training_request_id`,`trainor_id`,`assigned_by`,`created_at`,`updated_at`) values 
(24,62,22,'Prince Ivan Kent Tiburcio','2018-12-26 15:23:42','2018-12-26 15:23:42'),
(25,63,22,'Prince Ivan Kent Tiburcio','2018-12-26 17:09:43','2018-12-26 17:09:43');

/*Table structure for table `email_categories` */

DROP TABLE IF EXISTS `email_categories`;

CREATE TABLE `email_categories` (
  `email_category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`email_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `email_categories` */

insert  into `email_categories`(`email_category_id`,`category`) values 
(1,'admin_approval'),
(2,'superior_approval'),
(3,'request_submitted'),
(4,'request_approved'),
(5,'trainor_notification'),
(6,'requestor_notification'),
(7,'superior_disapproval'),
(8,'basic_template');

/*Table structure for table `emails` */

DROP TABLE IF EXISTS `emails`;

CREATE TABLE `emails` (
  `email_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_category_id` int(10) unsigned DEFAULT NULL,
  `subject` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `sender` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `recipient` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `message` text CHARACTER SET utf8,
  `cc` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `attachment` text CHARACTER SET utf8,
  `redirect_url` text CHARACTER SET utf8,
  `accept_url` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `deny_url` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `sent_at` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`email_id`),
  KEY `email_category_id` (`email_category_id`),
  CONSTRAINT `email_category_id` FOREIGN KEY (`email_category_id`) REFERENCES `email_categories` (`email_category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=410 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `emails` */

insert  into `emails`(`email_id`,`email_category_id`,`subject`,`sender`,`recipient`,`title`,`message`,`cc`,`attachment`,`redirect_url`,`accept_url`,`deny_url`,`sent_at`,`created_at`,`updated_at`) values 
(402,1,'Requesting for a Training','interface-notif@isuzuphil.com','prince-tiburcio@isuzuphil.com','Training Request','Greetings! Prince Ivan Kent Tiburcio of <strong>PayGo</strong> is requesting for a <br/>\r\n							training program: AFTERSALES TRAINING <br/>\r\n							on Dec 26, 2018 Wed - 02:47 PM\r\n							Please click the button to navigate directly to our system.',NULL,NULL,'http://localhost/fleet_training_request/admin/training_requests',NULL,NULL,'2018-12-26 14:52:36','2018-12-26 14:50:12','2018-12-26 14:52:36'),
(403,5,'Request Submitted','interface-notif@isuzuphil.com','princeivankentmtiburcio@gmail.com','Request Submitted!','Greetings! Your <strong>request for training has been submitted.</strong> Please wait for IPC Administrator to response.<br>\r\n						Thank you.',NULL,NULL,NULL,NULL,NULL,'2018-12-26 14:52:40','2018-12-26 14:50:12','2018-12-26 14:52:40'),
(404,1,'Requesting for a Training','interface-notif@isuzuphil.com','prince-tiburcio@isuzuphil.com','Training Request','Greetings! Prince Ivan Kent Tiburcio of <strong>PayGo</strong> is requesting for a <br/>\r\n							training program: AFTERSALES TRAINING <br/>\r\n							on Dec 27, 2018 Thu - 08:30 AM\r\n							Please click the button to navigate directly to our system.',NULL,NULL,'http://localhost/fleet_training_request/admin/training_requests',NULL,NULL,'2018-12-26 15:23:04','2018-12-26 15:22:03','2018-12-26 15:23:04'),
(405,5,'Request Submitted','interface-notif@isuzuphil.com','princeivankentmtiburcio@gmail.com','Request Submitted!','Greetings! Your <strong>request for training has been submitted.</strong> Please wait for IPC Administrator to response.<br>\r\n						Thank you.',NULL,NULL,NULL,NULL,NULL,'2018-12-26 15:23:09','2018-12-26 15:22:03','2018-12-26 15:23:09'),
(406,2,'Training Request Approval','interface-notif@isuzuphil.com','princeivankentmtiburcio@gmail.com','Training Request Approval','Greetings! Prince Ivan Kent Tiburcio of <strong>PayGo</strong> is requesting for a <br/>\r\n                            training program                                                        : AFTERSALES TRAINING <br/>\r\n                            on       Dec 27, 2018 Thu - 08: 30 AM',NULL,NULL,NULL,'http://localhost/fleet_training_request/superior/approve/143','http://localhost/fleet_training_request/superior/disapprove/143','2018-12-26 15:26:31','2018-12-26 15:23:45','2018-12-26 15:26:31'),
(407,1,'Requesting for a Training','interface-notif@isuzuphil.com','prince-tiburcio@isuzuphil.com','Training Request','Greetings! Prince Ivan Kent Marquez Tiburcio of <strong>adas</strong> is requesting for a <br/>\r\n							training program: AFTERSALES TRAINING <br/>\r\n							on Nov 20, 2018 Tue - 05:08 PM\r\n							Please click the button to navigate directly to our system.',NULL,NULL,'http://localhost/fleet_training_request/admin/training_requests',NULL,NULL,NULL,'2018-12-26 17:09:20','2018-12-26 17:09:20'),
(408,5,'Request Submitted','interface-notif@isuzuphil.com','princeivankentmtiburcio@gmail.com','Request Submitted!','Greetings! Your <strong>request for training has been submitted.</strong> Please wait for IPC Administrator to response.<br>\r\n						Thank you.',NULL,NULL,NULL,NULL,NULL,NULL,'2018-12-26 17:09:20','2018-12-26 17:09:20'),
(409,2,'Training Request Approval','interface-notif@isuzuphil.com','princeivankentmtiburcio@gmail.com','Training Request Approval','Greetings! Prince Ivan Kent Marquez Tiburcio of <strong>adas</strong> is requesting for a <br/>\r\n                            training program                                                        : AFTERSALES TRAINING <br/>\r\n                            on       Nov 20, 2018 Tue - 05: 08 PM',NULL,NULL,NULL,'http://localhost/fleet_training_request/superior/approve/144','http://localhost/fleet_training_request/superior/disapprove/144',NULL,'2018-12-26 17:09:44','2018-12-26 17:09:44');

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `training_program_id` int(10) unsigned DEFAULT NULL,
  `image` text CHARACTER SET utf8,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`image_id`),
  KEY `training_program_id` (`training_program_id`),
  CONSTRAINT `training_program_id` FOREIGN KEY (`training_program_id`) REFERENCES `training_programs` (`training_program_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `images` */

insert  into `images`(`image_id`,`training_program_id`,`image`,`created_at`,`updated_at`) values 
(2,32,'1538967105.png','2018-10-08 10:51:46','2018-10-08 10:51:46'),
(3,32,'1538967157.png','2018-10-08 10:52:37','2018-10-08 10:52:37'),
(4,32,'1538968983.png','2018-10-08 11:23:03','2018-10-08 11:23:03'),
(5,32,'1538969334.jpeg','2018-10-08 11:28:54','2018-10-08 11:28:54'),
(6,32,'1538969341.jpeg','2018-10-08 11:29:01','2018-10-08 11:29:01'),
(7,32,'1538969345.jpeg','2018-10-08 11:29:05','2018-10-08 11:29:05'),
(8,32,'1538969438.jpeg','2018-10-08 11:30:38','2018-10-08 11:30:38'),
(9,32,'1538969441.jpeg','2018-10-08 11:30:41','2018-10-08 11:30:41'),
(10,32,'1538969442.jpeg','2018-10-08 11:30:42','2018-10-08 11:30:42'),
(11,33,'1539229396.jpeg','2018-10-11 11:43:17','2018-10-11 11:43:17');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values 
('2018_11_22_093944_create_schedules_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `program_features` */

DROP TABLE IF EXISTS `program_features`;

CREATE TABLE `program_features` (
  `program_feature_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `training_program_id` int(10) unsigned DEFAULT NULL,
  `feature` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`program_feature_id`),
  KEY `pd.training_program_id` (`training_program_id`),
  CONSTRAINT `pd.training_program_id` FOREIGN KEY (`training_program_id`) REFERENCES `training_programs` (`training_program_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `program_features` */

insert  into `program_features`(`program_feature_id`,`training_program_id`,`feature`,`created_at`,`updated_at`) values 
(22,33,'Product Feature Orientation and Familiarization','2018-10-05 17:29:24','2018-10-05 17:29:24'),
(23,33,'Vehicle Handling and Operation','2018-10-05 17:29:24','2018-10-05 17:29:24'),
(24,33,'Pre-drive and Post-drive Safety Practices','2018-10-05 17:29:24','2018-10-05 17:29:24'),
(41,32,'Basic Periodic Maintenance Service','2018-10-08 09:15:18','2018-10-08 09:15:18'),
(42,32,'Isuzu Genuine Parts Familiarization','2018-10-08 09:15:18','2018-10-08 09:15:18'),
(53,32,'Added feature #2','2018-10-09 13:01:24','2018-10-09 13:01:24');

/*Table structure for table `schedules` */

DROP TABLE IF EXISTS `schedules`;

CREATE TABLE `schedules` (
  `schedule_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text COLLATE utf8_unicode_ci,
  `created_by` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `training_request_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `schedules` */

insert  into `schedules`(`schedule_id`,`start_date`,`end_date`,`reason`,`created_by`,`training_request_id`,`created_at`,`updated_at`) values 
(11,'2018-11-15','2018-11-17','Training Program','Fourmi Structured Cabling Services | Maria Ivy T. Raymundo',60,'2018-12-26 10:50:47','2018-12-26 16:18:19'),
(22,'2018-11-20','2018-11-21','AFTERSALES TRAINING for training people','adas | Prince Ivan Kent Marquez Tiburcio',63,'2018-12-26 17:09:44','2019-02-21 08:07:54');

/*Table structure for table `special_training_images` */

DROP TABLE IF EXISTS `special_training_images`;

CREATE TABLE `special_training_images` (
  `special_training_image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `special_training_id` int(10) unsigned NOT NULL,
  `image` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`special_training_image_id`),
  KEY `special_training_id` (`special_training_id`),
  CONSTRAINT `special_training_id` FOREIGN KEY (`special_training_id`) REFERENCES `special_trainings` (`special_training_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `special_training_images` */

insert  into `special_training_images`(`special_training_image_id`,`special_training_id`,`image`,`created_at`,`updated_at`) values 
(19,5,'1541664874.png','2018-11-08 16:14:34','2018-11-08 16:14:34'),
(20,5,'1541664978.png','2018-11-08 16:16:18','2018-11-08 16:16:18'),
(21,5,'1541664982.png','2018-11-08 16:16:22','2018-11-08 16:16:22'),
(22,6,'1541665586.jpeg','2018-11-08 16:26:26','2018-11-08 16:26:26'),
(23,6,'1541665589.jpeg','2018-11-08 16:26:30','2018-11-08 16:26:30');

/*Table structure for table `special_trainings` */

DROP TABLE IF EXISTS `special_trainings`;

CREATE TABLE `special_trainings` (
  `special_training_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `program_title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`special_training_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `special_trainings` */

insert  into `special_trainings`(`special_training_id`,`program_title`,`created_at`,`updated_at`) values 
(5,'Program Title #101','2018-11-08 14:23:40','2019-02-21 08:09:07'),
(6,'Program Title #2','2018-11-08 14:24:30','2018-11-08 16:04:28');

/*Table structure for table `training_programs` */

DROP TABLE IF EXISTS `training_programs`;

CREATE TABLE `training_programs` (
  `training_program_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `program_title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`training_program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `training_programs` */

insert  into `training_programs`(`training_program_id`,`program_title`,`description`,`created_at`,`updated_at`) values 
(32,'AFTERSALES TRAINING','Recommended for technician, mechanic and other technical staff.','2018-10-05 17:27:43','2018-10-05 17:27:43'),
(33,'PRE-DELIVERY TRAINING','Recommended for driver, driver assistant, and other non-technical state.','2018-10-05 17:29:24','2018-10-05 17:29:24');

/*Table structure for table `training_requests` */

DROP TABLE IF EXISTS `training_requests`;

CREATE TABLE `training_requests` (
  `training_request_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `office_address` text CHARACTER SET utf8 NOT NULL,
  `contact_person` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `position` varchar(50) CHARACTER SET utf8 NOT NULL,
  `contact_number` varchar(20) CHARACTER SET utf8 NOT NULL,
  `training_date` datetime NOT NULL,
  `training_venue` varchar(120) CHARACTER SET utf8 NOT NULL,
  `training_address` text CHARACTER SET utf8 NOT NULL,
  `training_program_id` int(10) unsigned NOT NULL,
  `unit_model_id` int(10) unsigned NOT NULL,
  `request_status` enum('approved','denied','pending') CHARACTER SET utf8 NOT NULL DEFAULT 'pending',
  `requestor_confirmation` enum('confirmed','cancelled','pending','reschedule') CHARACTER SET utf8 NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`training_request_id`,`contact_number`),
  KEY `r.training_program_id` (`training_program_id`),
  KEY `unit_model_id` (`unit_model_id`),
  CONSTRAINT `r.training_program_id` FOREIGN KEY (`training_program_id`) REFERENCES `training_programs` (`training_program_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unit_model_id` FOREIGN KEY (`unit_model_id`) REFERENCES `unit_models` (`unit_model_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `training_requests` */

insert  into `training_requests`(`training_request_id`,`company_name`,`office_address`,`contact_person`,`email`,`position`,`contact_number`,`training_date`,`training_venue`,`training_address`,`training_program_id`,`unit_model_id`,`request_status`,`requestor_confirmation`,`created_at`,`updated_at`) values 
(62,'PayGo','Parian Calamba Laguna','Prince Ivan Kent Tiburcio','princeivankentmtiburcio@gmail.com','Web Developer','9467311489','2018-12-27 08:30:00','Fleet Customer','Parian Calamba Laguna',32,22,'approved','pending','2018-12-26 15:22:03','2018-12-26 15:23:45'),
(63,'adas','dasdas','Prince Ivan Kent Marquez Tiburcio','princeivankentmtiburcio@gmail.com','asdasd','9467311489','2018-11-20 17:08:00','Fleet Customer','asdasd',32,22,'approved','pending','2018-12-26 17:09:20','2018-12-26 17:09:44');

/*Table structure for table `trainors` */

DROP TABLE IF EXISTS `trainors`;

CREATE TABLE `trainors` (
  `trainor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `mname` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `lname` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(150) CHARACTER SET utf8 NOT NULL,
  `created_by` varchar(150) CHARACTER SET utf8 NOT NULL,
  `deleted_at` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`trainor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `trainors` */

insert  into `trainors`(`trainor_id`,`fname`,`mname`,`lname`,`email`,`created_by`,`deleted_at`,`created_at`,`updated_at`) values 
(22,'Prince',NULL,'Tiburcio','princeivankentmtiburcio@gmail.com','Get name from session',NULL,'2018-11-06 15:03:23','2018-11-13 12:58:46');

/*Table structure for table `unit_models` */

DROP TABLE IF EXISTS `unit_models`;

CREATE TABLE `unit_models` (
  `unit_model_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `image` text CHARACTER SET utf8,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`unit_model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `unit_models` */

insert  into `unit_models`(`unit_model_id`,`model_name`,`description`,`image`,`created_at`,`updated_at`) values 
(16,'Bus','Service','1539046892.png','2018-10-05 13:15:18','2018-11-19 13:36:05'),
(17,'Crosswind','Adventurer','1538720261.png','2018-10-05 13:16:21','2018-10-05 14:17:41'),
(18,'C&E Series','Truck','1538720270.png','2018-10-05 13:17:01','2018-10-05 14:17:50'),
(21,'N Series','Truck','1538720285.png','2018-10-05 13:17:54','2018-10-05 14:18:05'),
(22,'mu-X','7-Seater','1538720292.png','2018-10-05 13:32:10','2018-10-05 14:29:52'),
(23,'PUV Series 2 & 3','Service','1538720301.png','2018-10-05 13:35:45','2018-10-05 14:29:27'),
(28,'F Series','truck','1538720337.png','2018-10-05 14:18:57','2018-10-05 14:29:14'),
(29,'D-max','Pickup','1538977326.png','2018-10-08 13:42:06','2018-10-08 13:42:06');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
