-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2022 at 04:34 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trello`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `workspace_id` int(10) UNSIGNED DEFAULT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `color` varchar(7) COLLATE utf8_slovenian_ci NOT NULL DEFAULT '#ff0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `name`, `workspace_id`, `creator_id`, `color`) VALUES
(1, 'asd', 5, 7, '#FF0000'),
(3, 'asfasff', 5, 7, '#008000'),
(4, 'ahahah', 8, 7, '#FFFF00'),
(5, 'asdaasd', 5, 7, '#FF00FF'),
(6, 'adgsdgsdf', 5, 7, '#FF00FF'),
(7, 'First Board!', 10, 7, '#33FF33');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `description` text COLLATE utf8_slovenian_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` datetime DEFAULT NULL,
  `list_id` int(10) UNSIGNED NOT NULL,
  `order_num` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `title`, `description`, `created`, `modified`, `due_date`, `list_id`, `order_num`) VALUES
(1, 'asdsaf', 'asdasd', '2022-05-28 12:12:05', '2022-05-28 12:12:05', '0000-00-00 00:00:00', 1, 0),
(2, 'dsfs', 'sdf', '2022-05-28 12:13:39', '2022-05-28 12:13:39', '0000-00-00 00:00:00', 1, 1),
(3, 'test', 'asfasd', '2022-05-28 12:33:59', '2022-05-28 12:33:59', '0000-00-00 00:00:00', 1, 2),
(4, 'fads', 'gfsdfd', '2022-05-28 12:34:28', '2022-05-28 16:33:08', '2022-05-31 00:00:00', 1, 3),
(5, 'sfgfd', 'sfd', '2022-05-28 12:35:01', '2022-05-28 12:35:01', '0000-00-00 00:00:00', 1, 4),
(6, 'dsfsdfasd', 'sdf', '2022-05-28 12:35:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 0),
(7, 'asfdasd', 'adssa', '2022-05-28 12:37:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 1),
(8, 'testasd', 'asdasd', '2022-05-28 16:08:52', '2022-05-28 16:32:49', '2022-05-31 00:00:00', 2, 2),
(9, 'asdasd', 'asdasfsaf', '2022-05-28 16:24:57', '2022-05-28 16:24:57', '0000-00-00 00:00:00', 3, 0),
(10, 'test', 't', '2022-05-28 20:27:04', '2022-05-28 20:27:04', '0000-00-00 00:00:00', 2, 3),
(11, 'dasdas', 'tasd', '2022-05-28 20:27:07', '2022-05-28 20:27:07', '0000-00-00 00:00:00', 2, 4),
(12, 'adsads', 'tasdads', '2022-05-28 20:27:10', '2022-05-28 20:27:10', '0000-00-00 00:00:00', 2, 5),
(13, 'asd', 'tasdads', '2022-05-28 20:27:13', '2022-05-28 20:27:13', '0000-00-00 00:00:00', 2, 6),
(14, 'asd', 'tasdads', '2022-05-28 20:27:16', '2022-05-28 20:27:16', '0000-00-00 00:00:00', 2, 7),
(15, 'asd', 'tasdads', '2022-05-28 20:27:18', '2022-05-28 20:27:18', '0000-00-00 00:00:00', 2, 8),
(16, 'fasdas', 'tasdads', '2022-05-28 20:27:20', '2022-05-28 20:27:20', '0000-00-00 00:00:00', 2, 9),
(17, 'asf', 'tasdads', '2022-05-28 20:27:22', '2022-05-28 20:27:22', '0000-00-00 00:00:00', 2, 10),
(18, 'asf', 'tasdads', '2022-05-28 20:27:24', '2022-05-28 20:27:24', '0000-00-00 00:00:00', 2, 11),
(19, 'asfdsa', 'tasdads', '2022-05-28 20:27:27', '2022-05-28 20:27:27', '0000-00-00 00:00:00', 2, 12),
(20, 'asfasd', 'tasdads', '2022-05-28 20:27:29', '2022-05-28 20:27:29', '0000-00-00 00:00:00', 2, 13),
(21, 'asfasd', 'tasdads', '2022-05-28 20:27:41', '2022-05-28 20:27:41', '0000-00-00 00:00:00', 2, 14),
(25, 'asda', 'asdas', '2022-05-29 12:40:39', '2022-05-29 12:40:39', '0000-00-00 00:00:00', 8, 0),
(26, 'gsfdf', 'asdasdsfds', '2022-05-29 12:40:42', '2022-05-29 12:40:42', '0000-00-00 00:00:00', 8, 1),
(27, 'sdfs', 'sdf', '2022-05-29 13:47:36', '2022-05-29 13:47:36', '2022-05-31 00:00:00', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `order_num` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `board_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `name`, `order_num`, `board_id`) VALUES
(1, 'ahahaha', 2, 1),
(2, 'asfads', 1, 1),
(3, 'gsdf', 3, 1),
(4, 'ahahaha', 4, 1),
(5, 'test', 5, 1),
(8, 'test', 0, 3),
(9, 'asfasd', 0, 6),
(10, 'sdasd', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `workspace_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `workspace_id`, `role_id`) VALUES
(4, 13, 7, 0),
(18, 7, 5, 0),
(32, 10, 5, 1),
(33, 12, 5, 1),
(34, 8, 5, 1),
(36, 7, 8, 0),
(38, 7, 10, 0),
(39, 14, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `member_roles`
--

CREATE TABLE `member_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `member_roles`
--

INSERT INTO `member_roles` (`id`, `name`) VALUES
(0, 'ADMIN'),
(1, 'GUEST');

-- --------------------------------------------------------

--
-- Table structure for table `starred`
--

CREATE TABLE `starred` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `board_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `starred`
--

INSERT INTO `starred` (`id`, `user_id`, `board_id`) VALUES
(19, 7, 6),
(20, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `bio` text COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `display_name`, `bio`) VALUES
(7, 'admin', 'b53b8d7af3d0e820d4aed43134e6a8ec0d010a16', 'admin@admin.com', 'Admin', NULL),
(8, 'user1', 'd96a5cb3d87ffc88d970fd16ab7a97964448d8f8', 'luka@gmail.com', 'User 1', NULL),
(9, 'user2', '33ce8409709219fd9ef8831a33f5e3562c21b884', 'lukaasasdd@gmail.com', 'User 2', NULL),
(10, 'user3', '80ff8765f9d026ae582df4005db835a9c7ffc94e', 'lu@gmail.com', 'user 3', NULL),
(11, 'user33', '8ebeeb5707835dff8340fed96d0afaae60c225b6', 'luasd@gmail.com', 'user4', NULL),
(12, 'user35', 'f11bff0a474c487159594168c2c969709d61497b', 'luasasdd@gmail.com', 'user5', NULL),
(13, 'asdasd', '6be2629a9f909954fdd19e12093dc1218698f730', 'lukaasd@gmail.com', 'asdasd', NULL),
(14, 'test', 'd76978458da1ea72b8a8128be96133f27722d61d', 'test@gasd.com', 'testek', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workspaces`
--

CREATE TABLE `workspaces` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `description` text COLLATE utf8_slovenian_ci DEFAULT NULL,
  `owner_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `workspaces`
--

INSERT INTO `workspaces` (`id`, `name`, `description`, `owner_id`) VALUES
(5, 'test', '', 7),
(7, 'My Workspace', 'This is your first workspace', 13),
(8, 'second workspac', 'asfasdasd', 7),
(10, 'tesadasf', 'sadads', 7),
(11, 'My Workspace', 'This is your first workspace', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workspace_id` (`workspace_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `board_id` (`board_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `workspace_id` (`workspace_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `member_roles`
--
ALTER TABLE `member_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `starred`
--
ALTER TABLE `starred`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `board_id` (`board_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workspaces`
--
ALTER TABLE `workspaces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `starred`
--
ALTER TABLE `starred`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `workspaces`
--
ALTER TABLE `workspaces`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boards`
--
ALTER TABLE `boards`
  ADD CONSTRAINT `boards_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boards_ibfk_2` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `member_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `members_ibfk_3` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `starred`
--
ALTER TABLE `starred`
  ADD CONSTRAINT `starred_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `starred_ibfk_2` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workspaces`
--
ALTER TABLE `workspaces`
  ADD CONSTRAINT `workspaces_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
