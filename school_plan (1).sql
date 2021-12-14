-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2021 at 12:22 AM
-- Server version: 5.6.51-cll-lve
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_plan`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `batch_type` int(2) NOT NULL DEFAULT '1' COMMENT '1=online,2=offline',
  `batch_city` varchar(250) DEFAULT NULL,
  `batch_day` varchar(250) DEFAULT NULL,
  `day_name` text,
  `batch_date` date DEFAULT NULL,
  `start_time` varchar(100) DEFAULT NULL,
  `end_time` varchar(100) DEFAULT NULL,
  `batch_status` int(3) NOT NULL DEFAULT '1',
  `trash` int(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `batch_type`, `batch_city`, `batch_day`, `day_name`, `batch_date`, `start_time`, `end_time`, `batch_status`, `trash`, `created_at`, `updated_at`) VALUES
(16, 1, 'Bengaluru', 'Weekdays', 'Mon,Wed', '2021-12-02', '00:26', '12:26', 1, 0, '2021-11-30 19:14:26', NULL),
(17, 1, 'Bengaluru', 'Weekdays', 'Mon,Wed', '2021-12-02', '00:26', '12:26', 1, 0, '2021-11-30 19:15:22', NULL),
(18, 1, 'Bengaluru', 'Weekdays', 'Mon,Wed', '2021-12-02', '00:26', '12:26', 1, 0, '2021-11-30 19:15:25', NULL),
(19, 1, 'Bengaluru', 'Weekdays', 'Mon,Wed', '2021-12-02', '00:26', '12:26', 1, 0, '2021-11-30 19:18:26', NULL),
(20, 1, 'Bengaluru', 'Weekdays', 'Mon,Wed', '2021-12-02', '00:26', '12:26', 1, 0, '2021-11-30 19:18:54', NULL),
(21, 1, 'Bengaluru', 'Weekdays', 'Mon,Wed', '2021-12-02', '00:26', '12:26', 1, 0, '2021-11-30 19:18:56', NULL),
(22, 1, 'Bengaluru', 'Weekdays', 'Mon,Wed', '2021-12-02', '00:26', '12:26', 1, 0, '2021-11-30 19:20:21', NULL),
(23, 1, 'Bengaluru', 'Weekdays', 'Mon,Wed', '2021-12-02', '00:26', '12:26', 1, 0, '2021-11-30 19:23:14', NULL),
(24, 1, 'Bengaluru', 'Weekdays', 'Mon,Wed', '2021-12-02', '00:26', '12:26', 1, 0, '2021-11-30 19:24:18', NULL),
(26, 2, 'Pune', 'Weekends', 'Mon,Wed', '2021-12-02', '16:50', '04:50', 1, 0, '2021-12-01 11:21:00', NULL),
(27, 2, 'Pune', 'Weekends', 'Mon,Wed,Thu', '2021-12-02', '16:50', '04:50', 1, 0, '2021-12-03 14:04:44', NULL),
(28, 2, 'Pune', 'Weekends', 'Mon,Tue,Wed,Thu', '2021-12-02', '16:50', '04:50', 1, 0, '2021-12-03 14:04:50', NULL),
(29, 2, 'Hyderabad', 'Weekends', 'Sun', '2021-12-02', '18:00', '06:50', 1, 0, '2021-12-07 13:58:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `topic` varchar(250) DEFAULT NULL,
  `thumbnail_title` varchar(250) DEFAULT NULL,
  `blog_date` date DEFAULT NULL,
  `author_name` varchar(250) DEFAULT NULL,
  `description` text,
  `reading_time` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `blog_status` int(2) NOT NULL DEFAULT '1',
  `trash` int(2) NOT NULL DEFAULT '0',
  `extratext` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `image`, `topic`, `thumbnail_title`, `blog_date`, `author_name`, `description`, `reading_time`, `created_at`, `updated_at`, `blog_status`, `trash`, `extratext`) VALUES
(6, '1638466784dreamstime_xxl_65780868_small.jpeg', 'topic', 'title', '2021-12-12', 'author', '', '7', '2021-12-02 17:30:04', '2021-12-12 18:33:46', 1, 0, '[{\"heading\":\"Idealogy\",\"images\":\"./upload_file/16393309790career-main.svg\",\"description\":\"desc22\"}]'),
(7, '1639196968WhatsApp Image 2021-12-03 at 1.06.08 PM.jpeg', 'topic', 'title', '2021-12-12', 'author', '', '7', '2021-12-09 06:08:14', '2021-12-12 18:33:51', 1, 0, '[{\"heading\":\"Idealogy\",\"images\":\"./upload_file/16393309790career-main.svg\",\"description\":\"desc22\"}]'),
(12, '', 'UX CAREER', 'My first journey to be a successful UXUI designer.', '2021-12-12', 'Marie Fernandez', 'Tata consultancy services enriches the London marathon experience with figma.with figmaaaa Tata consultancy services enriches the London marathon experience with figma.with figmaaaa Tata consultancy services enriches the London marathon experience with figma.with figmaaaa', '45 Min', '2021-12-12 18:05:30', '2021-12-12 18:58:52', 1, 0, '[{\"heading\":\"Visual Language\",\"image\":\"16393346931blog-brainstorm-1.png\",\"description\":\"Looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source, . Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word.\"},{\"image\":\"16393355321blog-brainstorm-1.png\"}]'),
(13, '1639335743career-main.svg', 'UI CAREER', 'My first journey to be a successful UI designer.', '2021-12-08', 'Fernandez Marie', NULL, '12 Min', '2021-12-12 19:02:23', NULL, 1, 0, '[{\"heading\":\"Brainstorming\",\"description\":\"Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source, . Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word.\",\"image\":\"16393357430blog-brainstorm-1.png\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_counter`
--

CREATE TABLE `dashboard_counter` (
  `id` int(11) NOT NULL,
  `students_enrolled` int(11) DEFAULT NULL,
  `cities` int(11) DEFAULT NULL,
  `students_placed` int(11) DEFAULT NULL,
  `workshop` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dashboard_counter`
--

INSERT INTO `dashboard_counter` (`id`, `students_enrolled`, `cities`, `students_placed`, `workshop`, `created_at`, `updated_at`) VALUES
(1, 6000, 15, 6500, 150, '2021-12-04 19:15:13', '2021-12-09 06:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_start_time` varchar(50) DEFAULT NULL,
  `event_end_time` varchar(50) DEFAULT NULL,
  `event_price` double DEFAULT NULL,
  `event_img` varchar(250) DEFAULT NULL,
  `event_status` int(3) NOT NULL DEFAULT '1',
  `trash` int(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `event_date`, `event_start_time`, `event_end_time`, `event_price`, `event_img`, `event_status`, `trash`, `created_at`, `updated_at`) VALUES
(2, 'tyu', '2021-12-03', '00:57', '01:00', 78, 'Demo_02.png', 1, 0, '2021-11-30 19:27:53', '2021-12-04 19:10:04'),
(3, 'tyu', '2021-12-03', '00:57', '01:00', 78, 'Demo_01.png', 1, 0, '2021-11-30 19:28:43', '2021-12-04 19:10:10'),
(4, 'tyudfgdfgdfg', '2021-12-03', '00:57', '01:00', 78, 'Demo_02.png', 1, 0, '2021-11-30 19:32:26', '2021-12-04 19:10:00'),
(5, 'tyu', '2021-12-03', '00:57', '01:00', 78, 'Demo_01.png', 1, 0, '2021-11-30 19:34:24', '2021-12-04 19:09:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboard_counter`
--
ALTER TABLE `dashboard_counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dashboard_counter`
--
ALTER TABLE `dashboard_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
