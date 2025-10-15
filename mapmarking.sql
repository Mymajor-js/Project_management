-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2025 at 07:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mapmarking`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `Nactivity` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `imgmodels`
--

CREATE TABLE `imgmodels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `Nactivity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `imgmodels`
--

INSERT INTO `imgmodels` (`id`, `latitude`, `longitude`, `image_path`, `Nactivity`, `created_at`, `updated_at`) VALUES
(413, 15.931493, 102.023082, '17503191886853c05454433.jpg', 'Npst', '2025-06-19 00:46:28', '2025-06-19 00:46:28'),
(414, 13.756300, 100.501800, '17505846026857cd1a99f63.png', 'กิจกรรมทดสอบแจ้งเตือนsaa', '2025-06-22 02:30:03', '2025-06-22 02:30:03'),
(415, 13.756300, 100.501800, '17505847676857cdbfa77de.webp', 'กิจกรรมทดสอบแจ้งเตือนsaa', '2025-06-22 02:32:47', '2025-06-22 02:32:47'),
(416, 15.928737, 102.013353, '175852925668d106e8770a2.jpg', 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', '2025-09-22 01:20:57', '2025-09-22 01:20:57'),
(417, 15.928737, 102.013353, '175852925768d106e91ef66.jpg', 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', '2025-09-22 01:20:57', '2025-09-22 01:20:57'),
(418, 15.928737, 102.013353, '175852925768d106e91ff98.jpg', 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', '2025-09-22 01:20:57', '2025-09-22 01:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE `markers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `latitude` decimal(10,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `subdistrict` varchar(255) DEFAULT NULL,
  `Nactivity` varchar(255) DEFAULT NULL,
  `mauban` varchar(255) DEFAULT NULL,
  `mautee` varchar(255) DEFAULT NULL,
  `arear_money` varchar(255) DEFAULT NULL,
  `time_pj` date DEFAULT NULL,
  `time_pj_end` date DEFAULT NULL,
  `year_money` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `suggestions` longtext DEFAULT NULL,
  `my_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `number_target` varchar(255) DEFAULT NULL,
  `number_target_out` varchar(255) DEFAULT NULL,
  `performancex` longtext DEFAULT NULL,
  `applied` longtext DEFAULT NULL,
  `project_id` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `latitude`, `longitude`, `province`, `district`, `subdistrict`, `Nactivity`, `mauban`, `mautee`, `arear_money`, `time_pj`, `time_pj_end`, `year_money`, `description`, `suggestions`, `my_name`, `status`, `number_target`, `number_target_out`, `performancex`, `applied`, `project_id`, `created_at`, `updated_at`) VALUES
(46, NULL, NULL, 'ศรีเกิด', NULL, NULL, 'testx', NULL, NULL, NULL, '2025-06-20', '2025-06-28', '2568', NULL, NULL, 'Adminx', 'Pending', NULL, NULL, NULL, NULL, 'A18', '2025-03-23 23:15:41', '2025-06-15 04:08:35'),
(61, NULL, NULL, 'นครราชสีมา', NULL, NULL, 'N_test1', NULL, NULL, NULL, NULL, NULL, '2567', NULL, NULL, 'นิติธร ครองห้วยบง', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-06-14 03:33:34', '2025-06-14 03:33:34'),
(62, NULL, NULL, 'โคราช', NULL, NULL, 'Two_test', NULL, NULL, NULL, NULL, NULL, '2567', NULL, NULL, 'นิติธร ครองห้วยบง', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-06-14 03:35:03', '2025-06-14 03:35:03'),
(63, 15.931493, 102.023082, NULL, NULL, NULL, 'Npst', NULL, NULL, NULL, NULL, NULL, '2568', NULL, NULL, 'นิติธร ครองห้วยบง', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-06-14 04:22:05', '2025-06-18 23:54:30'),
(72, NULL, NULL, NULL, NULL, NULL, 'sadssada', NULL, NULL, NULL, NULL, NULL, '2566', NULL, NULL, 'นิติธร ครองห้วยบง', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-06-15 04:40:16', '2025-06-18 23:54:53'),
(73, 15.928737, 102.013353, 'ชัยภูมิ', 'เมืองชัยภูมิ', 'เมือง', 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', '-', '-', 'งบแผ่นดิน', '2025-06-17', '2025-09-17', '2568', 'ปัญหา อุปสรรค และข้อเสนอแนะ', 'ปัญหา อุปสรรค และข้อเสนอแนะ', '00000000', 'Pending', 'นักศึกษา จำนวน 35 คน อาจารย์ บุคลากร จำนวน 3 คน', '-', 'การจัดโครงการนี้ ก าหนดจัดกิจกรรม 3 วัน โดยวันแรก จะเป็นการบรรยายเชิงปฏิบัติการ เรื่อง การ\r\nดูแลสุขภาวะและคุณภาพชีวิตผู้สูงอายุในสถาณการณ์โลกปัจจุบัน กิจกรรมฐาน “การท างานในระบบญี่ปุ่น” \r\n(PDCA HORENSO 5ส 3MU) และการบรรยายเชิงปฏิบัติการ เรื่อง มาตรฐานสากลในการจัดการสุขภาพ\r\nผู้สูงอายุ และการจัดการห้องปฏิบัติการการดูแลผู้สูงอายุ นักศึกษามีความรู้ ความเข้าใจและมีทักษะด้านการ\r\nจัดการห้องปฏิบัติการการดูแลผู้สูงอายุ วันที่สอง การบรรยายเชิงปฏิบัติการ เรื่อง ทักษะการดูแลผู้สูงอายุใน\r\nประเทศญี่ปุ่น และทักษะการบริบาลและการส่งเสริมสุขภาพภาคภาษาญี่ปุ่น นักศึกษามีความรู้ความเข้าใจ\r\nและมีทักษะการดูแลผู้สูงอายุและการส่งเสริมสุขภาพภาคภาษาญี่ปุ่น วัฒนธรรม กฎระเบียบ ข้อบังคับในการ\r\nบริบาลผู้สูงอายุในประเทสญี่ปุ่น และวันที่สาม การบรรยายเชิงปฏิบัติการ เรื่อง การสร้างเสริมประสบการณ', 'เกิดความร่วมมือในการพัฒนาด้านการศึกษาระหว่างมหาวิทยาลัยราชภัฏชัยภูมิกับสถาบันพัฒนาชีวิต', NULL, '2025-06-16 23:51:47', '2025-06-16 23:53:24'),
(74, 15.921834, 102.021726, 'ชัยภูมิ', 'เมือง', 'เมือง', 'TTTT_s', '-', '-', 'ภายนอก', '2025-06-21', '2025-06-22', '2567', 'wwqeqwgef', 'qwdqascfagvargws', 'นิติธร ครองห้วยบง', 'Pending', '-', '-', 'ฟหกฟกหกอวง', 'assddfdfqw', NULL, '2025-06-21 01:08:01', '2025-06-21 01:08:01'),
(75, 15.931993, 102.024092, 'ชัยภูมิ', 'เมือง', 'เมือง', 'pppppx', '-', '-', '2131', '2025-06-21', '2025-06-22', '4efew', 'sdfsf', 'dfbddf', 'นิติธร ครองห้วยบง', 'Pending', '-', '-', 'vvgnhere', 'dgbfds', NULL, '2025-06-21 01:37:30', '2025-06-21 01:37:30'),
(76, NULL, NULL, NULL, NULL, NULL, 'ssss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-21 02:07:43', '2025-06-21 02:07:43'),
(77, NULL, NULL, NULL, NULL, NULL, 'ssss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-21 02:08:06', '2025-06-21 02:08:06'),
(78, 15.931993, 102.024092, 'ชัยภูมิ', 'เมือง', 'เมือง', 'pppppxxdd', '-', '-', '2131', '2025-06-21', '2025-06-22', '4efew', 'sadsc', 'asdadfe', 'นิติธร ครองห้วยบง', 'Pending', '-', '-', 'asfsvdv', 'asfavfsd', NULL, '2025-06-22 00:12:07', '2025-06-22 00:12:07'),
(79, 15.931993, 102.024092, 'ชัยภูมิ', 'เมือง', 'เมือง', 'pppppxxddxzczc', '-', '-', '2131', '2025-06-21', '2025-06-22', '4efew', 'ssdee', 'adaefeaf', 'นิติธร ครองห้วยบง', 'Pending', '-', '-', 'asacsdc', 'sadacsa', NULL, '2025-06-22 00:18:49', '2025-06-22 00:18:49'),
(80, 15.931993, 102.025523, 'ชัยภูมิ', 'เมือง', 'เมือง', 'ojsishos', '-', '-', 'ascdcs', '2025-06-21', '2025-06-22', 'asdfef', 'dssdvsd', 'svsfbb', 'นิติธร ครองห้วยบง', 'Pending', '-', '-', 'sdcsdfbf', 'sdbgbf', NULL, '2025-06-22 00:20:54', '2025-06-22 00:20:54'),
(81, 13.756300, 100.501800, NULL, NULL, NULL, 'test111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 00:25:53', '2025-06-22 00:25:53'),
(82, 13.756300, 100.501800, NULL, NULL, NULL, '21edqw', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 00:30:57', '2025-06-22 00:30:57'),
(83, 13.756300, 100.501800, NULL, NULL, NULL, 'กิจกรรมทดสอบแจ้งเตือนsaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 00:31:10', '2025-06-22 00:31:10'),
(84, 13.756300, 100.501800, NULL, NULL, NULL, 'กิจกรรมทดสอบแจ้งเตือนหฟกฟหกฟห', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 00:54:14', '2025-06-22 00:54:14'),
(85, 13.756300, 100.501800, NULL, NULL, NULL, 'sadeee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-22 01:03:36', '2025-06-22 01:03:36'),
(86, NULL, NULL, NULL, NULL, NULL, 'asdadaawww', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-06-22 01:42:55', '2025-06-22 01:42:55'),
(87, NULL, NULL, NULL, NULL, NULL, 'fdffweweq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-06-22 02:08:12', '2025-06-22 02:08:12'),
(88, 13.756300, 100.501800, NULL, NULL, NULL, 'ohjhk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-24 00:20:18', '2025-06-24 00:20:18'),
(89, 13.756300, 100.501800, NULL, NULL, NULL, 'rokvowoqq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 23:09:24', '2025-06-30 23:09:24'),
(90, 13.756300, 100.501800, NULL, NULL, NULL, 'rokvowoqq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 23:10:16', '2025-06-30 23:10:16'),
(91, 13.756300, 100.501800, NULL, NULL, NULL, 'pretest1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 23:18:44', '2025-06-30 23:18:44'),
(92, 13.756300, 100.501800, NULL, NULL, NULL, 'กิจกรรมทดสอบแจ้งเตือน', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 23:20:00', '2025-06-30 23:20:00'),
(93, 13.756300, 100.501800, NULL, NULL, NULL, 'กิจกรรมทดสอบแจ้งเตือน1111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 23:21:01', '2025-06-30 23:21:01'),
(94, 13.756300, 100.501800, NULL, NULL, NULL, 'qwodjaff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 23:51:18', '2025-06-30 23:51:18'),
(95, 13.756300, 100.501800, NULL, NULL, NULL, 'Niosadw', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 23:57:21', '2025-06-30 23:57:21'),
(96, 13.756300, 100.501800, NULL, NULL, NULL, 'sadkaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-30 23:58:25', '2025-06-30 23:58:25'),
(97, NULL, NULL, NULL, NULL, NULL, 'Nissx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-07-01 00:00:12', '2025-07-01 00:00:12'),
(98, NULL, NULL, NULL, NULL, NULL, 'ajafod', NULL, NULL, NULL, NULL, NULL, '1091', NULL, NULL, 'test', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-07-04 03:37:40', '2025-07-04 03:37:40'),
(99, 15.933228, 102.017679, NULL, NULL, NULL, 'xcvxff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Nititdsk', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-07-04 03:39:02', '2025-09-21 23:41:35'),
(100, NULL, NULL, NULL, NULL, NULL, 'opp', NULL, NULL, NULL, NULL, NULL, '2569', NULL, NULL, 'test', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-09-22 01:24:19', '2025-09-22 01:24:19'),
(101, NULL, NULL, NULL, NULL, NULL, 'โครงการ 1', NULL, NULL, NULL, NULL, NULL, '2568', NULL, NULL, 'Nititdsk', 'Pending', NULL, NULL, NULL, NULL, NULL, '2025-09-22 01:25:25', '2025-09-22 01:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2025_02_27_150610_create_markers_table', 1),
(14, '2025_02_28_104155_create_images_table', 1),
(15, '2025_02_28_114538_add__nactivity_to_imgmodels_table', 1),
(16, '2025_03_06_185726_create_numbers_table', 1),
(17, '2025_03_07_085429_drop_numbers_table', 2),
(18, '2025_03_11_184614_create_detail_activity', 2),
(19, '2025_03_12_095337_create_select_group', 3),
(20, '2025_03_12_101632_create_responsible_person_pj', 3),
(22, '2025_03_16_181715_create_person_pj_table', 4),
(23, '2025_03_16_182210_create_person_pjs_table', 5),
(24, '2025_03_16_182210_create_target_pjs_table', 5),
(25, '2025_03_16_182211_create_activity_pjs_table', 5),
(26, '2025_03_16_182211_create_main_target_pjs_table', 5),
(27, '2025_03_16_182211_create_result_pjs_table', 5),
(28, '2025_03_16_182212_create_benefit_pjs_table', 5),
(29, '2025_03_16_182315_create_pj_people_table', 5),
(30, '2025_03_16_182315_create_pj_targets_table', 5),
(31, '2025_03_16_182316_create_pj_activities_table', 5),
(32, '2025_03_16_182316_create_pj_main_targets_table', 5),
(33, '2025_03_16_182316_create_pj_results_table', 5),
(34, '2025_03_16_182641_create_pj_benefits_table', 5),
(35, '2025_03_17_163215_recreate_markers_table', 5),
(36, '2025_06_21_073619_create_notifications_table', 6),
(37, '2025_06_23_152524_create_teachers_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0406de38-d0cc-40de-90b6-edaacccfcae8', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 26, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: Niosadw\",\"id\":95}', NULL, '2025-06-30 23:57:26', '2025-06-30 23:57:26'),
('0c87d242-5159-454d-8118-3fab77cc00ec', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: Nissx\",\"id\":97}', NULL, '2025-07-01 00:00:12', '2025-07-01 00:00:12'),
('0f7daccc-d257-4a31-bc77-d8308995571c', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: pretest1\",\"id\":91}', NULL, '2025-06-30 23:18:44', '2025-06-30 23:18:44'),
('10a39d8f-4c1e-425f-ae1f-068289da99dd', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: asdadaawww\",\"id\":86}', NULL, '2025-06-22 01:42:55', '2025-06-22 01:42:55'),
('34e37933-fefa-4818-ba8b-9e5c64d415df', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: \\u0e01\\u0e34\\u0e08\\u0e01\\u0e23\\u0e23\\u0e21\\u0e17\\u0e14\\u0e2a\\u0e2d\\u0e1a\\u0e41\\u0e08\\u0e49\\u0e07\\u0e40\\u0e15\\u0e37\\u0e2d\\u0e191111\",\"id\":93}', NULL, '2025-06-30 23:21:02', '2025-06-30 23:21:02'),
('3c118358-dac8-41c4-a81b-31b1853bc265', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: Niosadw\",\"id\":95}', NULL, '2025-06-30 23:57:21', '2025-06-30 23:57:21'),
('4413ef93-bd33-43f7-b45c-4f28d4959a42', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: qwodjaff\",\"id\":94}', NULL, '2025-06-30 23:51:18', '2025-06-30 23:51:18'),
('4e072393-f223-4f8c-b545-7eeb0738e29d', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: fdffweweq\",\"id\":87}', NULL, '2025-06-22 02:08:12', '2025-06-22 02:08:12'),
('6ee0c438-e7db-47bc-b44c-176a2bf69c8e', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: sadeee\",\"id\":85}', NULL, '2025-06-22 01:03:36', '2025-06-22 01:03:36'),
('a69651e9-1e23-4e68-8653-615706b90731', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 26, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: sadkaa\",\"id\":96}', NULL, '2025-06-30 23:58:29', '2025-06-30 23:58:29'),
('a83aa785-a6ca-4825-94ca-e0acf4fdef60', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: sadkaa\",\"id\":96}', NULL, '2025-06-30 23:58:25', '2025-06-30 23:58:25'),
('ab168ab8-872f-4d5d-991f-f41eb088ddb8', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: rokvowoqq\",\"id\":89}', NULL, '2025-06-30 23:09:27', '2025-06-30 23:09:27'),
('b54d2983-cf03-4424-920f-d314e4d1939f', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: ohjhk\",\"id\":88}', NULL, '2025-06-24 00:20:19', '2025-06-24 00:20:19'),
('ca381d40-0699-4767-8078-10cc08fb5533', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: rokvowoqq\",\"id\":90}', NULL, '2025-06-30 23:10:16', '2025-06-30 23:10:16'),
('dea7f81c-9f85-4e16-97a8-782ce478cdcb', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 26, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: qwodjaff\",\"id\":94}', NULL, '2025-06-30 23:51:23', '2025-06-30 23:51:23'),
('f600a495-2736-4b56-a91d-e9da1f47ac59', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 26, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: Nissx\",\"id\":97}', NULL, '2025-07-01 00:00:18', '2025-07-01 00:00:18'),
('f81ca077-d196-42fd-afad-fb873c78196c', 'App\\Notifications\\NewMarkerCreated', 'App\\Models\\User', 18, '{\"title\":\"\\u0e21\\u0e35\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23\\u0e43\\u0e2b\\u0e21\\u0e48\",\"message\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e42\\u0e04\\u0e23\\u0e07\\u0e01\\u0e32\\u0e23: \\u0e01\\u0e34\\u0e08\\u0e01\\u0e23\\u0e23\\u0e21\\u0e17\\u0e14\\u0e2a\\u0e2d\\u0e1a\\u0e41\\u0e08\\u0e49\\u0e07\\u0e40\\u0e15\\u0e37\\u0e2d\\u0e19\",\"id\":92}', NULL, '2025-06-30 23:20:00', '2025-06-30 23:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `numbers`
--

CREATE TABLE `numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batthai` int(11) DEFAULT NULL,
  `Nactivity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `numbers`
--

INSERT INTO `numbers` (`id`, `batthai`, `Nactivity`, `created_at`, `updated_at`) VALUES
(44, 33, 'gg', '2025-03-21 13:03:43', '2025-03-21 13:03:43'),
(45, NULL, 'ฟหกฟ', '2025-03-21 13:20:38', '2025-03-21 13:20:38'),
(54, 11111, 'Npst', '2025-06-14 04:22:05', '2025-06-15 00:59:48'),
(55, 1111, 'testx', '2025-06-15 03:34:43', '2025-06-15 03:34:43'),
(56, NULL, NULL, '2025-06-15 04:20:19', '2025-06-15 04:20:19'),
(57, NULL, NULL, '2025-06-15 04:24:18', '2025-06-15 04:24:18'),
(58, NULL, NULL, '2025-06-15 04:31:12', '2025-06-15 04:31:12'),
(59, NULL, NULL, '2025-06-15 04:33:17', '2025-06-15 04:33:17'),
(60, NULL, NULL, '2025-06-15 04:38:05', '2025-06-15 04:38:05'),
(61, NULL, NULL, '2025-06-15 04:38:36', '2025-06-15 04:38:36'),
(62, NULL, NULL, '2025-06-15 04:39:33', '2025-06-15 04:39:33'),
(63, NULL, 'sadssada', '2025-06-15 04:40:16', '2025-06-15 04:40:16'),
(64, 39000, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', '2025-06-16 23:51:47', '2025-06-16 23:51:47'),
(65, 1000, 'TTTT_s', '2025-06-21 01:08:01', '2025-06-21 01:08:01'),
(66, 231321, 'pppppx', '2025-06-21 01:37:30', '2025-06-21 01:37:30'),
(67, 231321, 'pppppxxdd', '2025-06-22 00:12:07', '2025-06-22 00:12:07'),
(68, 1211, 'ojsishos', '2025-06-22 00:20:55', '2025-06-22 00:20:55'),
(69, NULL, 'asdadaawww', '2025-06-22 01:42:55', '2025-06-22 01:42:55'),
(70, NULL, 'fdffweweq', '2025-06-22 02:08:12', '2025-06-22 02:08:12'),
(71, 1000, 'Nissx', '2025-07-01 00:00:20', '2025-07-01 00:00:20'),
(72, NULL, 'xcvxff', '2025-07-04 03:39:02', '2025-07-04 03:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pj_activity`
--

CREATE TABLE `pj_activity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nactivity` varchar(255) DEFAULT NULL,
  `name_activity` varchar(255) DEFAULT NULL,
  `person_pj` varchar(255) DEFAULT NULL,
  `resultx` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pj_activity`
--

INSERT INTO `pj_activity` (`id`, `Nactivity`, `name_activity`, `person_pj`, `resultx`, `created_at`, `updated_at`) VALUES
(19, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'กิจกรรมที่1 อบรมเชิงปฏิบัติการ ทักษะด้านการจัดการสุขภาพ ผู้สูงอายุในมาตรฐานสากล', 'นิติธร ครองห้วยบง', 'นักศึกษามีความรู้ ความเข้าใจและมีทักษะด้านการจัดการสุขภาพ ผู้สูงอายุในมาตรฐานสากล', '2025-06-16 23:51:47', '2025-06-16 23:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `pj_benefit`
--

CREATE TABLE `pj_benefit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nactivity` varchar(255) DEFAULT NULL,
  `benefit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pj_maintarget`
--

CREATE TABLE `pj_maintarget` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nactivity` varchar(255) DEFAULT NULL,
  `result_main` varchar(255) DEFAULT NULL,
  `goal_unit` varchar(255) DEFAULT NULL,
  `goal_amount` int(11) DEFAULT NULL,
  `performance_unit` varchar(255) DEFAULT NULL,
  `performance_amount` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pj_maintarget`
--

INSERT INTO `pj_maintarget` (`id`, `Nactivity`, `result_main`, `goal_unit`, `goal_amount`, `performance_unit`, `performance_amount`, `created_at`, `updated_at`) VALUES
(110, 'Npst', NULL, NULL, NULL, NULL, NULL, '2025-06-14 04:22:05', '2025-06-14 04:22:05'),
(111, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-15 04:20:19', '2025-06-15 04:20:19'),
(112, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-15 04:24:18', '2025-06-15 04:24:18'),
(113, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-15 04:31:12', '2025-06-15 04:31:12'),
(114, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-15 04:33:17', '2025-06-15 04:33:17'),
(115, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-15 04:38:05', '2025-06-15 04:38:05'),
(116, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-15 04:38:36', '2025-06-15 04:38:36'),
(117, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-15 04:39:33', '2025-06-15 04:39:33'),
(118, 'sadssada', NULL, NULL, NULL, NULL, NULL, '2025-06-15 04:40:16', '2025-06-15 04:40:16'),
(119, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'จำนวนนักศึกษาที่เข้าร่วมโครงการ', 'ร้อยละ', 80, 'ร้อยละ', 100, '2025-06-16 23:51:47', '2025-06-16 23:51:47'),
(120, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'นักศึกษามีความรู้ ความเข้าใจและ\r\nมีทักษะด้านการจัดการสุขภาพ\r\nผู้สูงอายุ', 'คน', 35, 'คน', 35, '2025-06-16 23:51:47', '2025-06-16 23:51:47'),
(121, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'ความพึงพอใจของนักศึกษาที่เข้า\r\nร่วมกิจกรรมภายใต้โครงการ', 'ร้อยละ', 80, 'ร้อยละ', 100, '2025-06-16 23:51:47', '2025-06-16 23:51:47'),
(122, 'TTTT_s', 'qeqdqw', '21', 234, '12', 2131, '2025-06-21 01:08:01', '2025-06-21 01:08:01'),
(123, 'pppppx', 'e332', '21', 234, '12', 2131, '2025-06-21 01:37:30', '2025-06-21 01:37:30'),
(124, 'pppppxxdd', 'sadfbd', '21', 234, '12', 2131, '2025-06-22 00:12:07', '2025-06-22 00:12:07'),
(125, 'ojsishos', 'dfbd', '21', 234, '12', 2131, '2025-06-22 00:20:55', '2025-06-22 00:20:55'),
(126, 'asdadaawww', NULL, NULL, NULL, NULL, NULL, '2025-06-22 01:42:55', '2025-06-22 01:42:55'),
(127, 'fdffweweq', NULL, NULL, NULL, NULL, NULL, '2025-06-22 02:08:12', '2025-06-22 02:08:12'),
(128, 'Nissx', NULL, NULL, NULL, NULL, NULL, '2025-07-01 00:00:20', '2025-07-01 00:00:20'),
(129, 'xcvxff', NULL, NULL, NULL, NULL, NULL, '2025-07-04 03:39:02', '2025-07-04 03:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `pj_person`
--

CREATE TABLE `pj_person` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nactivity` varchar(255) DEFAULT NULL,
  `name_lastname` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pj_person`
--

INSERT INTO `pj_person` (`id`, `Nactivity`, `name_lastname`, `position`, `created_at`, `updated_at`) VALUES
(32, 'pex', 'Nitithornx', 'Onwe', '2025-03-18 22:16:31', '2025-03-18 22:16:31'),
(33, 'pex', 'pop', 'ksq', '2025-03-18 22:16:31', '2025-03-18 22:16:31'),
(34, 'testz', 'Kronx', 'Admin', '2025-03-18 23:37:54', '2025-03-18 23:37:54'),
(35, 'testz', 'Nititnorn', 'op', '2025-03-18 23:37:54', '2025-03-18 23:37:54'),
(141, 'acc', '2', '123', '2025-03-20 12:28:57', '2025-03-20 12:28:57'),
(143, 'optest', 'Kron s', 'admin', '2025-03-20 23:38:23', '2025-03-20 23:38:23'),
(144, 'optest', 'Kronx', 'admin', '2025-03-20 23:38:23', '2025-03-20 23:38:23'),
(145, 'optest', 'cct', 'admin', '2025-03-20 23:38:23', '2025-03-20 23:57:24'),
(147, 'asdad', '313', '2222', '2025-03-21 13:35:45', '2025-03-21 13:35:45'),
(148, 't7', 'นิติธร ครองห้วยบง', 'นักศึกษา', '2025-03-25 23:51:41', '2025-03-25 23:51:41'),
(149, 't7', 'กร กร', 'แอดมิน', '2025-03-25 23:51:41', '2025-03-25 23:51:41'),
(150, 't7', 'กรกร', 'แอดมิน', '2025-03-25 23:51:41', '2025-03-25 23:51:41'),
(151, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมสำหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'อาจารย์ ดร.วราวุฒิ มหามิตร', 'ประธานหลักสูตรสาธารณสุขศาสตรบัณฑิต', '2025-03-26 08:19:38', '2025-03-26 08:19:38'),
(153, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมสำหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'อาจารย์ปุญญาพร พูลบวรรักษ', 'อาจารย์ประจำวิชาเอกการจัดการสุขภาพผู้สูงอาย', '2025-03-26 08:19:38', '2025-03-26 08:19:38'),
(154, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมสำหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'อาจารย์ ดร.วราวุฒิ มหามิตร', 'ประธานหลักสูตรสาธารณสุขศาสตรบัณฑิต', '2025-03-26 23:57:05', '2025-03-26 23:57:05'),
(156, 'metest', 'กร', 'admin', '2025-05-01 03:32:22', '2025-05-01 03:32:22'),
(157, 's11', 'Nitithorn_test', NULL, '2025-06-10 03:30:48', '2025-06-10 03:30:48'),
(158, 'dddx', 'Nitithorn_test', 'sss', '2025-06-10 03:49:14', '2025-06-11 12:02:39'),
(159, 'Npst', 'นิติธร ครองห้วยบง', 'เก่ง', '2025-06-14 04:22:05', '2025-06-14 04:22:05'),
(160, NULL, '00000000', NULL, '2025-06-15 04:20:19', '2025-06-15 04:20:19'),
(161, NULL, '00000000', NULL, '2025-06-15 04:24:18', '2025-06-15 04:24:18'),
(162, NULL, '00000000', NULL, '2025-06-15 04:31:12', '2025-06-15 04:31:12'),
(163, NULL, 'นิติธร ครองห้วยบง', 'เก่ง', '2025-06-15 04:33:17', '2025-06-15 04:33:17'),
(164, NULL, '00000000', NULL, '2025-06-15 04:38:05', '2025-06-15 04:38:05'),
(165, NULL, 'นิติธร ครองห้วยบง', 'เก่ง', '2025-06-15 04:38:05', '2025-06-15 04:38:05'),
(166, NULL, 'นิติธร ครองห้วยบง', 'เก่ง', '2025-06-15 04:38:36', '2025-06-15 04:38:36'),
(167, NULL, 'นิติธร ครองห้วยบง', 'เก่ง', '2025-06-15 04:39:33', '2025-06-15 04:39:33'),
(168, 'sadssada', 'นิติธร ครองห้วยบง', 'เก่ง', '2025-06-15 04:40:16', '2025-06-15 04:40:16'),
(169, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', '00000000', 'ประธานหลักสูตรสาธารณสุขศาสตรบัณฑิต', '2025-06-16 23:51:47', '2025-06-16 23:51:47'),
(170, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'นิติธร ครองห้วยบง', 'เก่ง', '2025-06-16 23:51:47', '2025-06-16 23:51:47'),
(171, 'xcvxff', 'Nititdsk', 'sammww', '2025-07-04 03:39:02', '2025-07-04 03:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `pj_result`
--

CREATE TABLE `pj_result` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nactivity` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pj_result`
--

INSERT INTO `pj_result` (`id`, `Nactivity`, `target`, `created_at`, `updated_at`) VALUES
(61, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'จำนวนนักศึกษาได้รับการส่งเสริมทักษะด้านการจัดการสุขภาพผู้สูงอายุ', '2025-06-16 23:51:47', '2025-06-16 23:51:47'),
(62, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'ความพึงพอใจของนักศึกษาที่เข้าร่วมกิจกรรมภายใต้โครงการในระดับมาก-มากที่สุด', '2025-06-16 23:51:47', '2025-06-16 23:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `pj_target`
--

CREATE TABLE `pj_target` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nactivity` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pj_target`
--

INSERT INTO `pj_target` (`id`, `Nactivity`, `target`, `created_at`, `updated_at`) VALUES
(26, 'pex', '0021', '2025-03-18 22:16:31', '2025-03-18 22:16:31'),
(27, 'pex', '3002', '2025-03-18 22:16:31', '2025-03-18 22:16:31'),
(28, 'testz', 'nonex', '2025-03-18 23:37:54', '2025-03-18 23:37:54'),
(29, 'testz', 'ทำโปรแกรม', '2025-03-18 23:37:54', '2025-03-18 23:37:54'),
(70, 'acc', '121', '2025-03-20 12:28:57', '2025-03-20 12:28:57'),
(71, 'optest', 'ss', '2025-03-20 23:38:23', '2025-03-20 23:38:23'),
(72, 'optest', '111', '2025-03-21 00:07:49', '2025-03-21 00:07:49'),
(73, 'optest', '111', '2025-03-21 00:07:49', '2025-03-21 00:07:49'),
(74, 'asdad', '92849284238928208429084290482042483490292384234249242834239423asdad3334rghjyyujyjweewqqwdqwergrgr', '2025-03-21 11:17:29', '2025-03-21 11:17:29'),
(75, 'asdad', '112', '2025-03-21 11:17:29', '2025-03-21 11:17:29'),
(76, '111', '5521', '2025-03-21 11:35:15', '2025-03-21 11:35:15'),
(77, '222', '1231', '2025-03-21 12:57:09', '2025-03-21 12:57:09'),
(78, 'asdad', '22333', '2025-03-21 13:23:15', '2025-03-21 13:23:15'),
(79, 't7', 'ทำโปรเจ็ค', '2025-03-25 23:51:41', '2025-03-25 23:51:41'),
(80, 't7', 'โปรเจ็ค2', '2025-03-25 23:51:41', '2025-03-25 23:51:41'),
(81, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมสำหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'เพื่อเสริมทักษะด้านการจัดการสุขภาพผู้สูงอายุในมาตรฐานสากล', '2025-03-26 08:19:38', '2025-03-26 08:19:38'),
(82, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมสำหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'เพื่อส่งเสริมนักศึกษาให้มีทักษะในการดูแลสุขภาพและการส่งเสริมสุขภาพผู้สูงอายุ', '2025-03-26 08:19:38', '2025-03-26 08:19:38'),
(83, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมสำหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'เพื่อเสริมทักษะด้านการจัดการสุขภาพผู้สูงอายุในมาตรฐานสากล', '2025-03-26 23:57:05', '2025-03-26 23:57:05'),
(85, 'metest', 'ยังไม่มี', '2025-05-01 03:32:22', '2025-05-01 03:32:22'),
(86, 'dddx', '1ssf', '2025-06-11 12:02:39', '2025-06-11 12:02:39'),
(87, 'testx', '322fcaca', '2025-06-15 04:03:00', '2025-06-15 04:03:00'),
(88, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'เพื่อเสริมทักษะด้านการจัดการสุขภาพผู้สูงอายุในมาตรฐานสากล', '2025-06-16 23:51:47', '2025-06-16 23:51:47'),
(89, 'โครงการพัฒนาศักยภาพบัณฑิตสาธารณสุขศาสตร์ด้านการจัดการสุขภาพผู้สุงอายุเพื่อเตรียม ความพร้อมส าหรับการเข้าสู่ตลาดแรงงานในมาตรฐานสากล', 'เพื่อส่งเสริมนักศึกษาให้มีทักษะในการดูแลสุขภาพและการส่งเสริมสุขภาพผู้สูงอายุ', '2025-06-16 23:51:47', '2025-06-16 23:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `responsible_person_pj`
--

CREATE TABLE `responsible_person_pj` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nactivity` varchar(255) NOT NULL,
  `name_pepo` varchar(255) NOT NULL,
  `position` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `title`, `name`, `position`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Nititdsk', 'sammww', '2025-06-23 08:50:13', '2025-06-23 08:50:13'),
(2, NULL, 'hgfmsdsdss', 'sfsdk', '2025-07-04 03:42:47', '2025-07-04 03:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `my_name` varchar(100) NOT NULL,
  `level` varchar(25) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `my_name`, `level`, `position`, `remember_token`, `created_at`, `updated_at`) VALUES
(18, 'Nitithornx', 'Fullcharlotte@gmail.com', NULL, '$2y$12$pt/y16tOLrpCigmoIPvOxOk.MTIvs2ohjbvMTYTCcT2pjlMp4eAGa', 'test', 'admin', 'แอดมิน', NULL, '2025-06-10 00:52:14', '2025-06-22 08:21:41'),
(26, 'Nitithorn_pss', 'fullkifilo@gmail.com', NULL, '$2y$12$pt/y16tOLrpCigmoIPvOxOk.MTIvs2ohjbvMTYTCcT2pjlMp4eAGa', 'Nititdsk', 'user', 'เจ้าหน้าที่', NULL, '2025-06-30 23:19:51', '2025-06-30 23:19:51'),
(27, 'PPPP', 'ISDOLS@gmail.com', NULL, '$2y$12$wKyJH9KG892fONOh4JZ0FeVYs6CmIHDRETlcAHxD8WoBVzn/bz3hy', 'hgfmsdsdss', 'user', 'sfsdk', NULL, '2025-09-19 01:27:08', '2025-09-19 01:27:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imgmodels`
--
ALTER TABLE `imgmodels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `numbers`
--
ALTER TABLE `numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pj_activity`
--
ALTER TABLE `pj_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pj_benefit`
--
ALTER TABLE `pj_benefit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pj_maintarget`
--
ALTER TABLE `pj_maintarget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pj_person`
--
ALTER TABLE `pj_person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pj_result`
--
ALTER TABLE `pj_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pj_target`
--
ALTER TABLE `pj_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responsible_person_pj`
--
ALTER TABLE `responsible_person_pj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imgmodels`
--
ALTER TABLE `imgmodels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `numbers`
--
ALTER TABLE `numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pj_activity`
--
ALTER TABLE `pj_activity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pj_benefit`
--
ALTER TABLE `pj_benefit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `pj_maintarget`
--
ALTER TABLE `pj_maintarget`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `pj_person`
--
ALTER TABLE `pj_person`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `pj_result`
--
ALTER TABLE `pj_result`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `pj_target`
--
ALTER TABLE `pj_target`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `responsible_person_pj`
--
ALTER TABLE `responsible_person_pj`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
