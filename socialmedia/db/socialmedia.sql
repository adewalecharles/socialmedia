-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2019 at 08:13 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialmedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `post_id`, `user_id`, `comment`, `comment_author`, `date`) VALUES
(1, 11, 1, 'well try and fix it', 'ogundiran-charles-706547', '2019-06-21 22:11:03'),
(2, 11, 1, 'i think i finally fixed it', 'ogundiran-charles-706547', '2019-06-21 22:14:50'),
(3, 13, 1, 'but i think it worked', 'ogundiran-charles-706547', '2019-06-21 22:18:55'),
(4, 13, 1, 'it worked', 'ogundiran-charles-706547', '2019-06-21 22:34:29'),
(5, 14, 1, 'will be done in a day or two just two more sleepless night then i am gonna get what i want', 'ogundiran-charles-706547', '2019-06-21 22:35:11'),
(6, 15, 2, 'welcome bro, i have been here for some time', 'ogundiran-charles-706547', '2019-06-21 23:22:24'),
(7, 14, 1, 'GOOD WORK BRO, YOU WILL BE PAID SOON', 'gbolahan-ajisegiri-245163', '2019-06-22 00:54:10'),
(8, 23, 1, 'boss enugbe ooo', 'ogundiran-charles-706547', '2019-06-24 01:18:23'),
(9, 23, 1, 'go work na, omo ole', 'gbolahan-ajisegiri-245163', '2019-06-24 01:19:20'),
(10, 24, 2, 'soon baba', 'ogundiran-charles-706547', '2019-06-24 07:56:15'),
(11, 24, 2, 'baddest', 'ogundiran-charles-706547', '2019-06-24 07:56:25'),
(12, 24, 2, 'i just wan add some sweet stuffs', 'ogundiran-charles-706547', '2019-06-29 09:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `follower_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` varchar(255) NOT NULL,
  `upload_image` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `upload_image`, `post_date`) VALUES
(21, 1, 'ok lets start this again', '', '2019-06-24 01:08:28'),
(22, 1, 'No', 'CHIOMA.jpg.100', '2019-06-24 01:08:40'),
(24, 2, 'guy when u go finish my project', '', '2019-06-24 01:18:59'),
(25, 2, 'school 2\r\n', '', '2019-06-24 08:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `user_name` text NOT NULL,
  `describe_user` varchar(255) NOT NULL,
  `Relationship` text NOT NULL,
  `user_status` varchar(255) NOT NULL,
  `user_level` varchar(255) NOT NULL,
  `user_dept` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_country` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_birthday` text NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_cover` varchar(255) NOT NULL,
  `user_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` text NOT NULL,
  `posts` text NOT NULL,
  `recovery_account` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `user_name`, `describe_user`, `Relationship`, `user_status`, `user_level`, `user_dept`, `user_pass`, `user_email`, `user_country`, `user_gender`, `user_birthday`, `user_image`, `user_cover`, `user_reg_date`, `status`, `posts`, `recovery_account`) VALUES
(1, 'Ogundiran', 'Charles', 'ogundiran-charles-706547', 'Hello Laspo Connect, This is my default status!', '...', '', '', '', 'daddyboy@', 'shyprince1@gmail.com', 'Nigeria', 'Male', '1995-03-10', 'Screenshot_20190211-231519.jpg.19', 'Jellyfish.jpg.41', '0000-00-00 00:00:00', 'verified', 'yes', 'Iwanttodosomethinggreat'),
(2, 'Gbolahan', 'Ajisegiri', 'gbolahan-ajisegiri-245163', 'Hello Laspo Connect, This is my default status!', '...', '', '', '', 'laspotech2', 'test@test.com', 'Nigeria', 'Male', '2009-01-01', '47586112_223732935196754_4105158848082344916_n1.jpg.14', 'beach-blue-water-desktop-wallpapers-wallpaper-pixels-ocean-sea-image-coast-waves.jpg.41', '2019-06-21 23:08:51', 'verified', 'yes', 'Iwanttodosomethinggreat'),
(3, 'Adovon', 'David', 'adovon-david-212748', 'Hello Laspo Connect, This is my default status!', '...', '', '', '', 'blogger1', 'test123@test.com', 'Nigeria', 'Male', '1995-03-02', 'head_black.png', 'default_cover.jpg', '2019-06-22 19:00:23', 'verified', 'no', 'Iwanttodosomethinggreat');

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `id` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `msg_body` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `msg_seen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_messages`
--

INSERT INTO `user_messages` (`id`, `user_to`, `user_from`, `msg_body`, `date`, `msg_seen`) VALUES
(1, 2, 1, 'hello hmax, hope you get this message, reply asap!', '2019-06-23 22:58:23', 'no'),
(2, 2, 1, 'hello hmax, hope you get this message, reply asap!', '2019-06-23 23:00:05', 'no'),
(3, 1, 2, 'yea, i got it..i think you finally got it right..yippee!', '2019-06-23 23:30:53', 'no'),
(4, 1, 2, 'yea, i got it..i think you finally got it right..yippee!', '2019-06-23 23:30:59', 'no'),
(5, 1, 2, 'yea, i got it..i think you finally got it right..yippee!', '2019-06-23 23:33:16', 'no'),
(6, 2, 1, 'i think i should not let him know i am thru,let me make him wait a little or even cry', '2019-06-23 23:34:37', 'no'),
(7, 1, 2, 'bro do you know you just sent this to me, give me my project jhoor!', '2019-06-23 23:36:14', 'no'),
(8, 3, 1, 'hello nigga!', '2019-06-28 21:21:27', 'no'),
(9, 3, 1, 'hello nigga!', '2019-06-28 21:22:19', 'no'),
(10, 1, 3, 'i de ooo, how ur side', '2019-06-28 21:24:35', 'no'),
(11, 1, 3, 'i de ooo, how ur side', '2019-06-28 21:24:41', 'no'),
(12, 3, 1, 'hello nigga!', '2019-06-28 21:24:57', 'no'),
(13, 2, 1, 'the error i was talking about is finally fixed', '2019-06-28 22:33:00', 'no'),
(14, 2, 1, 'the error i was talking about is finally fixed', '2019-06-28 22:33:15', 'no'),
(15, 1, 2, 'good job bro', '2019-06-28 22:35:00', 'no'),
(16, 2, 1, 'this is good', '2019-07-03 08:47:51', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
