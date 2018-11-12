-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2018 at 09:31 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval_statuses`
--

DROP TABLE IF EXISTS `approval_statuses`;
CREATE TABLE IF NOT EXISTS `approval_statuses` (
  `approval_status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `training_request_id` int(10) UNSIGNED NOT NULL,
  `approver_id` int(10) UNSIGNED NOT NULL,
  `status` enum('pending','approved','denied') COLLATE utf8_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`approval_status_id`),
  KEY `training_request_id` (`training_request_id`),
  KEY `approver_id` (`approver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `approval_statuses`
--

INSERT INTO `approval_statuses` (`approval_status_id`, `training_request_id`, `approver_id`, `status`, `created_at`, `updated_at`) VALUES
(130, 42, 14, 'approved', '2018-11-07 06:33:10', '2018-11-07 06:33:30'),
(131, 42, 15, 'approved', '2018-11-07 06:33:10', '2018-11-07 06:33:34'),
(132, 42, 17, 'approved', '2018-11-07 06:33:10', '2018-11-07 06:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `approvers`
--

DROP TABLE IF EXISTS `approvers`;
CREATE TABLE IF NOT EXISTS `approvers` (
  `approver_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `approver_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`approver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `approvers`
--

INSERT INTO `approvers` (`approver_id`, `approver_name`, `email`, `position`, `created_by`, `created_at`, `updated_at`) VALUES
(14, 'Prince Ivan Kent Tiburcio', 'prince-tiburcio@isuzuphil.com', 'Programmer', '(By dafault) Miguel Sanggalang', '2018-10-29 09:06:38', '2018-10-29 09:06:38'),
(15, 'Christopher Desiderio', 'chris@isuzuphil.com', 'MIS Supervisor', '(By dafault) Miguel Sanggalang', '2018-10-29 09:07:05', '2018-10-29 09:07:05'),
(17, 'Miguel R. Sanggalang', 'migs-sanggalang@isuzuphil.com', 'Staff', '(By dafault) Miguel Sanggalang', '2018-11-06 06:37:01', '2018-11-06 06:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `customer_dealers`
--

DROP TABLE IF EXISTS `customer_dealers`;
CREATE TABLE IF NOT EXISTS `customer_dealers` (
  `customer_dealer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `training_request_id` int(10) UNSIGNED NOT NULL,
  `dealer` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`customer_dealer_id`),
  KEY `cd.training_request_id` (`training_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_dealers`
--

INSERT INTO `customer_dealers` (`customer_dealer_id`, `training_request_id`, `dealer`, `branch`) VALUES
(37, 42, 'GenCars', 'Batangas'),
(38, 43, 'GenCars', 'Batangas'),
(39, 44, 'GenCars', 'Batangas'),
(40, 45, 'GenCars', 'Batangas');

-- --------------------------------------------------------

--
-- Table structure for table `customer_models`
--

DROP TABLE IF EXISTS `customer_models`;
CREATE TABLE IF NOT EXISTS `customer_models` (
  `customer_model_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `training_request_id` int(10) UNSIGNED NOT NULL,
  `model` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`customer_model_id`),
  KEY `cm.training_request_id` (`training_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_models`
--

INSERT INTO `customer_models` (`customer_model_id`, `training_request_id`, `model`) VALUES
(30, 42, 'mu-X'),
(31, 43, 'mu-X'),
(32, 44, 'mu-X'),
(33, 45, 'mu-X');

-- --------------------------------------------------------

--
-- Table structure for table `customer_participants`
--

DROP TABLE IF EXISTS `customer_participants`;
CREATE TABLE IF NOT EXISTS `customer_participants` (
  `customer_participant_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `training_request_id` int(10) UNSIGNED NOT NULL,
  `participant` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`customer_participant_id`),
  KEY `cp.training_request_id` (`training_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_participants`
--

INSERT INTO `customer_participants` (`customer_participant_id`, `training_request_id`, `participant`, `quantity`) VALUES
(27, 42, 'Mechanic', 5),
(28, 42, 'Driver', 2),
(29, 43, 'Mechanic', 5),
(30, 44, 'Mechanic', 5),
(31, 45, 'Mechanic', 5),
(32, 45, 'Driver', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

DROP TABLE IF EXISTS `dealers`;
CREATE TABLE IF NOT EXISTS `dealers` (
  `dealer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dealer` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dealer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`dealer_id`, `dealer`, `branch`, `created_at`, `updated_at`) VALUES
(113, 'GenCars', 'Alabang', '2018-10-08 07:46:15', '2018-10-08 07:46:15'),
(114, 'GenCars', 'Batangas', '2018-10-08 08:49:07', '2018-10-08 08:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `email_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email_category_id` int(10) UNSIGNED DEFAULT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sender` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recipient` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `cc` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment` text COLLATE utf8_unicode_ci,
  `redirect_url` text COLLATE utf8_unicode_ci,
  `accept_url` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deny_url` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sent_at` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`email_id`),
  KEY `email_category_id` (`email_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=351 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`email_id`, `email_category_id`, `subject`, `sender`, `recipient`, `title`, `message`, `cc`, `attachment`, `redirect_url`, `accept_url`, `deny_url`, `sent_at`, `created_at`, `updated_at`) VALUES
(335, 2, 'Training Request Approval', 'interface-notif@isuzuphil.com', 'prince-tiburcio@isuzuphil.com', 'Training Request Approval', 'Greetings! Maria Ivy T. Raymundo of <strong>Fourmi Structured Cabling Services</strong> is requesting for a <br/>\n						training program: AFTERSALES TRAINING <br/>\n						on Nov 15, 2018 Thu - 08:30 AM', NULL, NULL, NULL, 'http://localhost/fleet_training_request/superior/approve/130', 'http://localhost/fleet_training_request/superior/disapprove/130', '2018-11-07 14:33:19', '2018-11-07 06:33:10', '2018-11-07 06:33:19'),
(336, 2, 'Training Request Approval', 'interface-notif@isuzuphil.com', 'chris@isuzuphil.com', 'Training Request Approval', 'Greetings! Maria Ivy T. Raymundo of <strong>Fourmi Structured Cabling Services</strong> is requesting for a <br/>\n						training program: AFTERSALES TRAINING <br/>\n						on Nov 15, 2018 Thu - 08:30 AM', NULL, NULL, NULL, 'http://localhost/fleet_training_request/superior/approve/131', 'http://localhost/fleet_training_request/superior/disapprove/131', '2018-11-07 14:33:23', '2018-11-07 06:33:10', '2018-11-07 06:33:23'),
(337, 2, 'Training Request Approval', 'interface-notif@isuzuphil.com', 'migs-sanggalang@isuzuphil.com', 'Training Request Approval', 'Greetings! Maria Ivy T. Raymundo of <strong>Fourmi Structured Cabling Services</strong> is requesting for a <br/>\n						training program: AFTERSALES TRAINING <br/>\n						on Nov 15, 2018 Thu - 08:30 AM', NULL, NULL, NULL, 'http://localhost/fleet_training_request/superior/approve/132', 'http://localhost/fleet_training_request/superior/disapprove/132', '2018-11-07 14:33:27', '2018-11-07 06:33:10', '2018-11-07 06:33:27'),
(338, 6, 'Training Program', 'interface-notif@isuzuphil.com', 'sofia@gmail.com', 'Training Program', 'Greetings! IPC Administrator has been approved your <strong>training request</strong>.<br/>\n                            Training program will be held on: Isuzu Philippines Corporation <br/>\n                            at       Nov 15, 2018 Thu - 08: 30 AM', NULL, NULL, 'http://localhost/fleet_training_request/customer/reschedule_request/42', 'http://localhost/fleet_training_request/customer/confirm_request/42', 'http://localhost/fleet_training_request/customer/cancellation_request/42', '2018-11-07 14:33:50', '2018-11-07 06:33:37', '2018-11-07 06:33:50'),
(339, NULL, 'Reschedule Training Program', 'interface-notif@isuzuphil.com', 'marilou-cabarles@isuzuphil.com', 'Reschedule Training Program', 'Maria Ivy T. Raymundo of <strong>Fourmi Structured Cabling Services</strong><br/>\r\n							has been requesting for a reschedule of their training program. <br/>\r\n							You may call him/her on this number: <strong>09467311489</strong>', NULL, NULL, 'http://localhost/fleet_training_request/admin/training_requests', NULL, NULL, '2018-11-07 14:34:09', '2018-11-07 06:33:53', '2018-11-07 06:34:09'),
(340, NULL, 'Rescheduled Training Program', 'interface-notif@isuzuphil.com', 'sofia@gmail.com', 'Rescheduled Training Program', 'Good Day! Your Training Request has been successfully rescheduled. <br/>\n                    See you on Isuzu Philippines Corporation <br/>\n                    at Nov 20, 2018 Tue - 08:30 AM', NULL, NULL, 'http://localhost/fleet_training_request/admin/training_requests', NULL, NULL, '2018-11-07 16:06:10', '2018-11-07 08:05:59', '2018-11-07 08:06:10'),
(341, NULL, 'Rescheduled Training Program', 'interface-notif@isuzuphil.com', 'sofia@gmail.com', 'Rescheduled Training Program', 'Your Training Request has been successfully rescheduled. <br/>\n                    See you on Isuzu Philippines Corporation <br/>\n                    at Nov 25, 2018 Sun - 08:30 AM. Thank you!', NULL, NULL, 'http://localhost/fleet_training_request/admin/training_requests', NULL, NULL, '2018-11-07 16:09:14', '2018-11-07 08:08:57', '2018-11-07 08:09:14'),
(342, NULL, 'Rescheduled Training Program', 'interface-notif@isuzuphil.com', 'sofia@gmail.com', 'Rescheduled Training Program', 'Your Training Request has been successfully rescheduled. <br/>\n                    See you on Isuzu Philippines Corporation <br/>\n                    at Nov 25, 2018 Sun - 08:30 AM. Thank you!', NULL, NULL, 'http://localhost/fleet_training_request/admin/training_requests', NULL, NULL, '2018-11-07 16:10:21', '2018-11-07 08:10:13', '2018-11-07 08:10:21'),
(343, NULL, 'Rescheduled Training Program', 'interface-notif@isuzuphil.com', 'sofia@gmail.com', 'Rescheduled Training Program', 'Your Training Request has been successfully rescheduled. <br/>\n                    See you on Isuzu Philippines Corporation <br/>\n                    at Nov 07, 2018 Wed - 04:11 PM. Thank you!', NULL, NULL, 'http://localhost/fleet_training_request/admin/training_requests', NULL, NULL, '2018-11-07 16:12:02', '2018-11-07 08:11:49', '2018-11-07 08:12:02'),
(344, 5, 'Rescheduled Training Program', 'interface-notif@isuzuphil.com', 'sofia@gmail.com', 'Rescheduled Training Program', 'Your Training Request has been successfully rescheduled. <br/>\n                    See you on Isuzu Philippines Corporation <br/>\n                    at Nov 25, 2018 Sun - 03:00 AM. Thank you!', NULL, NULL, 'http://localhost/fleet_training_request/admin/training_requests', NULL, NULL, '2018-11-07 16:14:19', '2018-11-07 08:14:11', '2018-11-07 08:14:19'),
(345, 1, 'Requesting for a Training', 'interface-notif@isuzuphil.com', 'marilou-cabarles@isuzuphil.com', 'Training Request', 'Greetings! Taylor Otwell of <strong>Laravel</strong> is requesting for a <br/>\n							training program: AFTERSALES TRAINING <br/>\n							on 2018-11-15 08:30:00\n							Please click the button to navigate directly to our system.', NULL, NULL, 'http://localhost/fleet_training_request/admin/training_requests', NULL, NULL, NULL, '2018-11-08 02:12:04', '2018-11-08 02:12:04'),
(346, 6, 'Request Submitted', 'interface-notif@isuzuphil.com', 'taylor@gmail.com', 'Request Submitted!', 'Greetings! Your <strong>request for training has been submitted.</strong> Please wait for IPC Administrator to response.<br>\n						Thank you.', NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-08 02:12:04', '2018-11-08 02:12:04'),
(347, 1, 'Requesting for a Training', 'interface-notif@isuzuphil.com', 'marilou-cabarles@isuzuphil.com', 'Training Request', 'Greetings! Taylor Otwell of <strong>Laravel</strong> is requesting for a <br/>\n							training program: AFTERSALES TRAINING <br/>\n							on 2018-11-15 08:30:00\n							Please click the button to navigate directly to our system.', NULL, NULL, 'http://localhost/fleet_training_request/admin/training_requests', NULL, NULL, NULL, '2018-11-08 02:13:05', '2018-11-08 02:13:05'),
(348, 6, 'Request Submitted', 'interface-notif@isuzuphil.com', 'taylor@gmail.com', 'Request Submitted!', 'Greetings! Your <strong>request for training has been submitted.</strong> Please wait for IPC Administrator to response.<br>\n						Thank you.', NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-08 02:13:05', '2018-11-08 02:13:05'),
(349, 1, 'Requesting for a Training', 'interface-notif@isuzuphil.com', 'marilou-cabarles@isuzuphil.com', 'Training Request', 'Greetings! Maria Ivy T. Raymundo of <strong>Fourmi Structured Cabling Services</strong> is requesting for a <br/>\n							training program: PRE-DELIVERY TRAINING <br/>\n							on 2018-11-15 08:30:00\n							Please click the button to navigate directly to our system.', NULL, NULL, 'http://localhost/fleet_training_request/admin/training_requests', NULL, NULL, NULL, '2018-11-08 02:14:04', '2018-11-08 02:14:04'),
(350, 6, 'Request Submitted', 'interface-notif@isuzuphil.com', 'sofia@gmail.com', 'Request Submitted!', 'Greetings! Your <strong>request for training has been submitted.</strong> Please wait for IPC Administrator to response.<br>\n						Thank you.', NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-08 02:14:04', '2018-11-08 02:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `email_categories`
--

DROP TABLE IF EXISTS `email_categories`;
CREATE TABLE IF NOT EXISTS `email_categories` (
  `email_category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`email_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_categories`
--

INSERT INTO `email_categories` (`email_category_id`, `category`) VALUES
(1, 'admin_approval'),
(2, 'superior_approval'),
(3, 'request_submitted'),
(4, 'request_approved'),
(5, 'trainor_notification'),
(6, 'requestor_notification'),
(7, 'superior_disapproval'),
(8, 'basic_template');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `training_program_id` int(10) UNSIGNED DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`image_id`),
  KEY `training_program_id` (`training_program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `training_program_id`, `image`, `created_at`, `updated_at`) VALUES
(2, 32, '1538967105.png', '2018-10-08 02:51:46', '2018-10-08 02:51:46'),
(3, 32, '1538967157.png', '2018-10-08 02:52:37', '2018-10-08 02:52:37'),
(4, 32, '1538968983.png', '2018-10-08 03:23:03', '2018-10-08 03:23:03'),
(5, 32, '1538969334.jpeg', '2018-10-08 03:28:54', '2018-10-08 03:28:54'),
(6, 32, '1538969341.jpeg', '2018-10-08 03:29:01', '2018-10-08 03:29:01'),
(7, 32, '1538969345.jpeg', '2018-10-08 03:29:05', '2018-10-08 03:29:05'),
(8, 32, '1538969438.jpeg', '2018-10-08 03:30:38', '2018-10-08 03:30:38'),
(9, 32, '1538969441.jpeg', '2018-10-08 03:30:41', '2018-10-08 03:30:41'),
(10, 32, '1538969442.jpeg', '2018-10-08 03:30:42', '2018-10-08 03:30:42'),
(11, 33, '1539229396.jpeg', '2018-10-11 03:43:17', '2018-10-11 03:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_features`
--

DROP TABLE IF EXISTS `program_features`;
CREATE TABLE IF NOT EXISTS `program_features` (
  `program_feature_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `training_program_id` int(10) UNSIGNED DEFAULT NULL,
  `feature` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`program_feature_id`),
  KEY `pd.training_program_id` (`training_program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `program_features`
--

INSERT INTO `program_features` (`program_feature_id`, `training_program_id`, `feature`, `created_at`, `updated_at`) VALUES
(22, 33, 'Product Feature Orientation and Familiarization', '2018-10-05 09:29:24', '2018-10-05 09:29:24'),
(23, 33, 'Vehicle Handling and Operation', '2018-10-05 09:29:24', '2018-10-05 09:29:24'),
(24, 33, 'Pre-drive and Post-drive Safety Practices', '2018-10-05 09:29:24', '2018-10-05 09:29:24'),
(41, 32, 'Basic Periodic Maintenance Service', '2018-10-08 01:15:18', '2018-10-08 01:15:18'),
(42, 32, 'Isuzu Genuine Parts Familiarization', '2018-10-08 01:15:18', '2018-10-08 01:15:18'),
(53, 32, 'Added feature #2', '2018-10-09 05:01:24', '2018-10-09 05:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `schedule_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(199) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `date`, `reason`, `created_by`, `created_at`, `updated_at`) VALUES
(10, '2018-11-11', '', 'Prince Ivan Kent', '2018-11-08 02:44:21', '2018-11-08 02:44:21'),
(11, '2018-11-12', '', 'Prince Ivan Kent', '2018-11-08 02:44:23', '2018-11-08 02:44:23'),
(12, '2018-11-13', '', 'Prince Ivan Kent', '2018-11-08 02:44:25', '2018-11-08 02:44:25'),
(13, '2018-11-14', '', 'Prince Ivan Kent', '2018-11-08 02:44:26', '2018-11-08 02:44:26'),
(14, '2018-11-15', '', 'Prince Ivan Kent', '2018-11-08 02:44:30', '2018-11-08 02:44:30'),
(15, '2018-11-16', '', 'Prince Ivan Kent', '2018-11-08 02:44:32', '2018-11-08 02:44:32'),
(16, '2018-11-17', '', 'Prince Ivan Kent', '2018-11-08 02:44:34', '2018-11-08 02:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `special_trainings`
--

DROP TABLE IF EXISTS `special_trainings`;
CREATE TABLE IF NOT EXISTS `special_trainings` (
  `special_training_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`special_training_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `special_trainings`
--

INSERT INTO `special_trainings` (`special_training_id`, `program_title`, `created_at`, `updated_at`) VALUES
(5, 'Program Title #1', '2018-11-08 06:23:40', '2018-11-08 08:04:25'),
(6, 'Program Title #2', '2018-11-08 06:24:30', '2018-11-08 08:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `special_training_images`
--

DROP TABLE IF EXISTS `special_training_images`;
CREATE TABLE IF NOT EXISTS `special_training_images` (
  `special_training_image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `special_training_id` int(10) UNSIGNED NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`special_training_image_id`),
  KEY `special_training_id` (`special_training_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `special_training_images`
--

INSERT INTO `special_training_images` (`special_training_image_id`, `special_training_id`, `image`, `created_at`, `updated_at`) VALUES
(19, 5, '1541664874.png', '2018-11-08 08:14:34', '2018-11-08 08:14:34'),
(20, 5, '1541664978.png', '2018-11-08 08:16:18', '2018-11-08 08:16:18'),
(21, 5, '1541664982.png', '2018-11-08 08:16:22', '2018-11-08 08:16:22'),
(22, 6, '1541665586.jpeg', '2018-11-08 08:26:26', '2018-11-08 08:26:26'),
(23, 6, '1541665589.jpeg', '2018-11-08 08:26:30', '2018-11-08 08:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `training_programs`
--

DROP TABLE IF EXISTS `training_programs`;
CREATE TABLE IF NOT EXISTS `training_programs` (
  `training_program_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`training_program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `training_programs`
--

INSERT INTO `training_programs` (`training_program_id`, `program_title`, `description`, `created_at`, `updated_at`) VALUES
(32, 'AFTERSALES TRAINING', 'Recommended for technician, mechanic and other technical staff.', '2018-10-05 09:27:43', '2018-10-05 09:27:43'),
(33, 'PRE-DELIVERY TRAINING', 'Recommended for driver, driver assistant, and other non-technical state.', '2018-10-05 09:29:24', '2018-10-05 09:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `training_requests`
--

DROP TABLE IF EXISTS `training_requests`;
CREATE TABLE IF NOT EXISTS `training_requests` (
  `training_request_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `office_address` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_person` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `training_date` datetime NOT NULL,
  `training_venue` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `training_address` text COLLATE utf8_unicode_ci NOT NULL,
  `training_program_id` int(10) UNSIGNED NOT NULL,
  `unit_model_id` int(10) UNSIGNED NOT NULL,
  `request_status` enum('approved','denied','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `requestor_confirmation` enum('confirmed','cancelled','pending','reschedule') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`training_request_id`,`contact_number`),
  KEY `r.training_program_id` (`training_program_id`),
  KEY `unit_model_id` (`unit_model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `training_requests`
--

INSERT INTO `training_requests` (`training_request_id`, `company_name`, `office_address`, `contact_person`, `email`, `position`, `contact_number`, `training_date`, `training_venue`, `training_address`, `training_program_id`, `unit_model_id`, `request_status`, `requestor_confirmation`, `created_at`, `updated_at`) VALUES
(42, 'Fourmi Structured Cabling Services', 'Mayapa, Calamba Laguna', 'Maria Ivy T. Raymundo', 'sofia@gmail.com', 'Web Developer', '09467311489', '2018-11-25 03:00:00', 'Flee Customer', 'Isuzu Philippines Corporation', 32, 22, 'approved', 'confirmed', '2018-11-05 07:29:59', '2018-11-07 08:14:11'),
(43, 'Laravel', 'New York', 'Taylor Otwell', 'taylor@gmail.com', 'CEO', '09467311489', '2018-11-15 08:30:00', 'IPC', 'Isuzu Philippines Corporation', 32, 16, 'pending', 'pending', '2018-11-08 02:12:04', '2018-11-08 02:12:04'),
(44, 'Laravel', 'New York', 'Taylor Otwell', 'taylor@gmail.com', 'CEO', '09467311489', '2018-11-15 08:30:00', 'IPC', 'Isuzu Philippines Corporation', 32, 16, 'pending', 'pending', '2018-11-08 02:13:05', '2018-11-08 02:13:05'),
(45, 'Fourmi Structured Cabling Services', 'Mayapa, Calamba Laguna', 'Maria Ivy T. Raymundo', 'sofia@gmail.com', 'Web Developer', '09467311489', '2018-11-15 08:30:00', 'Flee Customer', 'Isuzu Philippines Corporation', 33, 29, 'pending', 'pending', '2018-11-08 02:14:04', '2018-11-08 02:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `trainors`
--

DROP TABLE IF EXISTS `trainors`;
CREATE TABLE IF NOT EXISTS `trainors` (
  `trainor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`trainor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trainors`
--

INSERT INTO `trainors` (`trainor_id`, `fname`, `mname`, `lname`, `email`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(22, 'Jerome', NULL, 'Fabricante', 'jerome-fabricante@isuzuphil.com', 'Get name from session', NULL, '2018-11-06 07:03:23', '2018-11-06 07:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `trainor_designations`
--

DROP TABLE IF EXISTS `trainor_designations`;
CREATE TABLE IF NOT EXISTS `trainor_designations` (
  `trainor_designation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `training_request_id` int(10) UNSIGNED NOT NULL,
  `trainor_id` int(10) UNSIGNED NOT NULL,
  `assigned_by` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`trainor_designation_id`),
  KEY `trainor_id` (`trainor_id`),
  KEY `td.training_request_id` (`training_request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_models`
--

DROP TABLE IF EXISTS `unit_models`;
CREATE TABLE IF NOT EXISTS `unit_models` (
  `unit_model_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`unit_model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_models`
--

INSERT INTO `unit_models` (`unit_model_id`, `model_name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(16, 'Busy', 'Service', '1539046892.png', '2018-10-05 05:15:18', '2018-10-12 03:24:40'),
(17, 'Crosswind', 'Adventurer', '1538720261.png', '2018-10-05 05:16:21', '2018-10-05 06:17:41'),
(18, 'C&E Series', 'Truck', '1538720270.png', '2018-10-05 05:17:01', '2018-10-05 06:17:50'),
(21, 'N Series', 'Truck', '1538720285.png', '2018-10-05 05:17:54', '2018-10-05 06:18:05'),
(22, 'mu-X', '7-Seater', '1538720292.png', '2018-10-05 05:32:10', '2018-10-05 06:29:52'),
(23, 'PUV Series 2 & 3', 'Service', '1538720301.png', '2018-10-05 05:35:45', '2018-10-05 06:29:27'),
(28, 'F Series', 'truck', '1538720337.png', '2018-10-05 06:18:57', '2018-10-05 06:29:14'),
(29, 'D-max', 'Pickup', '1538977326.png', '2018-10-08 05:42:06', '2018-10-08 05:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approval_statuses`
--
ALTER TABLE `approval_statuses`
  ADD CONSTRAINT `approver_id` FOREIGN KEY (`approver_id`) REFERENCES `approvers` (`approver_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `training_request_id` FOREIGN KEY (`training_request_id`) REFERENCES `training_requests` (`training_request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_dealers`
--
ALTER TABLE `customer_dealers`
  ADD CONSTRAINT `cd.training_request_id` FOREIGN KEY (`training_request_id`) REFERENCES `training_requests` (`training_request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_models`
--
ALTER TABLE `customer_models`
  ADD CONSTRAINT `cm.training_request_id` FOREIGN KEY (`training_request_id`) REFERENCES `training_requests` (`training_request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_participants`
--
ALTER TABLE `customer_participants`
  ADD CONSTRAINT `cp.training_request_id` FOREIGN KEY (`training_request_id`) REFERENCES `training_requests` (`training_request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `email_category_id` FOREIGN KEY (`email_category_id`) REFERENCES `email_categories` (`email_category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `training_program_id` FOREIGN KEY (`training_program_id`) REFERENCES `training_programs` (`training_program_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program_features`
--
ALTER TABLE `program_features`
  ADD CONSTRAINT `pd.training_program_id` FOREIGN KEY (`training_program_id`) REFERENCES `training_programs` (`training_program_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `special_training_images`
--
ALTER TABLE `special_training_images`
  ADD CONSTRAINT `special_training_id` FOREIGN KEY (`special_training_id`) REFERENCES `special_trainings` (`special_training_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `training_requests`
--
ALTER TABLE `training_requests`
  ADD CONSTRAINT `r.training_program_id` FOREIGN KEY (`training_program_id`) REFERENCES `training_programs` (`training_program_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_model_id` FOREIGN KEY (`unit_model_id`) REFERENCES `unit_models` (`unit_model_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trainor_designations`
--
ALTER TABLE `trainor_designations`
  ADD CONSTRAINT `td.training_request_id` FOREIGN KEY (`training_request_id`) REFERENCES `training_requests` (`training_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trainor_id` FOREIGN KEY (`trainor_id`) REFERENCES `trainors` (`trainor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
