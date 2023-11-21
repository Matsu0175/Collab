-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 12:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `batangas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `district_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `district_name`) VALUES
(1, '1st District'),
(2, '2nd District'),
(3, '3rd District'),
(4, '4th District'),
(5, '5th District'),
(6, '6th District');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date_inserted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `email`, `name`, `subject`, `message`, `date_inserted`) VALUES
(1, 'marbenbenetez@gmail.com', 'Jennifer Roberts', 'coffee promo', 'asd asd asd asd asdasd as dasdadasd', '2023-11-09 09:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `randomid` int(23) NOT NULL DEFAULT 0,
  `dir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `randomid`, `dir`) VALUES
(1, 2267, './files/2.png'),
(2, 2267, './files/1.png'),
(3, 2267, './files/3.png'),
(4, 2267, './files/4.png'),
(5, 4546, './files/336590056_610361703861419_1002410544525404559_n.png'),
(6, 4546, './files/336634013_893475101922523_4945511778843899470_n.png'),
(7, 4546, './files/336762104_1034400574187849_7074898124569269555_n.png'),
(8, 4546, './files/336151555_586055610229868_4634406089563842961_n.png'),
(9, 4546, './files/336998474_202015519095949_9211130956090307262_n.png'),
(10, 7512, './files/1111111.jpg'),
(11, 7512, './files/3333333.jpg'),
(12, 7512, './files/6666666.jpg'),
(13, 7512, './files/55555555.jpg'),
(14, 7512, './files/creativity-1024x576.jpg'),
(15, 3761, './files/1111111.jpg'),
(16, 3761, './files/3333333.jpg'),
(17, 3761, './files/6666666.jpg'),
(18, 3761, './files/7777777.jpg'),
(19, 3761, './files/55555555.jpg'),
(20, 3761, './files/creativity-1024x576.jpg'),
(21, 4358, './files/Kids Wallpaper _ Peel & Stick Murals _ Hovia UK.jpg'),
(22, 4358, './files/HUIVS (6).png'),
(23, 4358, './files/Nintendo developing movies based on its iconic games like Super Mario Bros.jpg'),
(24, 4358, './files/Untitled design (21).png'),
(25, 4047, './files/the_super_mario_gang_test_render_by_Nibroc-Rock_on_DeviantArt-removebg-preview.png'),
(26, 4047, './files/Princess_Daisy_screenshots__images_and_pictures_-_Giant_Bomb-removebg-preview.png'),
(27, 4047, './files/Princess Daisy screenshots, images and pictures - Giant Bomb.jpg'),
(28, 4047, './files/the super mario gang test render by Nibroc-Rock on DeviantArt.jpg'),
(29, 4869, './files/aaaa.png'),
(30, 4869, './files/aaaaaaa.png'),
(31, 4869, './files/FlD5bugaUAA66pc.jpg'),
(32, 4869, './files/aaaaaaaa.png'),
(33, 496, './files/jjjfgh.png');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `dir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `dir`) VALUES
(6, './files/10-Cultural-Festivities-of-Batangas-1024x536.jpg'),
(7, './files/best-batangas-tourist-spots.jpg'),
(8, './files/img-20170212-223321-557.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `history` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `transpo_info` varchar(255) DEFAULT NULL,
  `user_id` int(4) NOT NULL DEFAULT 0,
  `district` int(4) NOT NULL DEFAULT 0,
  `date_inserted` datetime NOT NULL DEFAULT current_timestamp(),
  `file_id` int(255) NOT NULL DEFAULT 0,
  `status` int(4) NOT NULL DEFAULT 0 COMMENT '0 - pending\r\n1 - approve\r\n2 - rejected',
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `category` varchar(233) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `history`, `address`, `transpo_info`, `user_id`, `district`, `date_inserted`, `file_id`, `status`, `latitude`, `longitude`, `category`) VALUES
(1, 'Candle City', ' asdas asdasd asdasdasd asd asdasdasd asdadasdadadadsa  asdas asdasd asdasdasd asd asdasdasd asdadasdadadadsa  asdas asdasd asdasdasd asd asdasdasd asdadasdadadadsa', ' asdas asdasd asdasdasd asd asdasdasd asdadasdadadadsa  asdas asdasd asdasdasd asd asdasdasd asdadasdadadadsa  asdas asdasd asdasdasd asd asdasdasd asdadasdadadadsa', 'Wolf street Super Province', 'asd asd asdasdasd', 2, 1, '2023-11-07 17:49:35', 4546, 1, 13.755189, 121.076521, 'Historical'),
(2, 'Wonder Land', 'asdasd asdasd asdsadas asd asdas dasdasdas asdasdasdasd asda sdas dasdas asdas asd asdas dasd asdasdad asdasdasd assdasd asdas dasdas asdasda asdasd asdasd asdsadas asd asdas dasdasdas asdasdasdasd asda sdas dasdas asdas asd asdas dasd asdasdad asdasdasd assdasd asdas dasdas asdasda', 'asdasd asdasd asdsadas asd asdas dasdasdas asdasdasdasd asda sdas dasdas asdas asd asdas dasd asdasdad asdasdasd assdasd asdas dasdas asdasda asdasd asdasd asdsadas asd asdas dasdasdas asdasdasdasd asda sdas dasdas asdas asd asdas dasd asdasdad asdasdasd assdasd asdas dasdas asdasda', 'test street, Barangay Trial Province of Batangas', 'Bus, Tricycle, jeep and sikad', 2, 2, '2023-11-08 14:13:34', 3761, 1, 13.7560072, 121.0774436, 'Restaurant'),
(4, 'Paraiso', 'asdas sdsadsadasdsadsadsad assd asd sadsadsad asdas sdsadsadasdsadsadsad assd asd sadsadsad asdas sdsadsadasdsadsadsad assd asd sadsadsad asdas sdsadsadasdsadsadsad assd asd sadsadsad', 'asdas sdsadsadasdsadsadsad assd asd sadsadsad asdas sdsadsadasdsadsadsad assd asd sadsadsad asdas sdsadsadasdsadsadsad assd asd sadsadsad asdas sdsadsadasdsadsadsad assd asd sadsadsad', 'asd sad asdsad sadsa da', 'asdas sdsadsada', 2, 1, '2023-11-12 08:05:50', 4869, 2, 13.695590427751913, 120.91065713394839, 'Resorts'),
(5, 'Cafe Koreano', 'dasd sad sadsada dasd asd sad sad a dasd sad sadsada dasd asd sad sad a dasd sad sadsada dasd asd sad sad a dasd sad sadsada dasd asd sad sad a dasd sad sadsada dasd asd sad sad a', 'dasd sad sadsada dasd asd sad sad a dasd sad sadsada dasd asd sad sad a dasd sad sadsada dasd asd sad sad a dasd sad sadsada dasd asd sad sad a dasd sad sadsada dasd asd sad sad a', 'asd asd asdas dasd', 'asd asdasd sadsad', 2, 3, '2023-11-12 08:16:24', 496, 0, 13.75661824372407, 121.06243339226732, 'Coffee Shop');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `post_id` int(23) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `rate` int(23) NOT NULL DEFAULT 0,
  `user_id` int(22) NOT NULL DEFAULT 0,
  `date_inserted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `post_id`, `comment`, `rate`, `user_id`, `date_inserted`) VALUES
(5, 1, 'asdddddddddddas dasssssssssssssss', 5, 2, '2023-11-08 14:39:40'),
(6, 2, 'hahaha this is a good place to stay', 4, 2, '2023-11-08 17:38:03'),
(7, 4, 'Weak hero is so amazing hahahahahaa', 5, 2, '2023-11-12 08:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `resettable` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `roles_mask` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `registered` int(10) UNSIGNED NOT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL,
  `force_logout` mediumint(7) UNSIGNED NOT NULL DEFAULT 0,
  `role` int(4) NOT NULL DEFAULT 0 COMMENT 'Admin - 1\r\nUser - 0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `role`) VALUES
(1, 'admin@gmail.com', '$2y$10$Skwy.P022XiC8IoDZeDSwekhTKcn5lwWyVyFgrYlNsqyL.a7OEZAG', 'Admin Master', 0, 1, 1, 0, 1699317858, 1700522371, 0, 1),
(2, 'benetez1998@gmail.com', '$2y$10$gcyU8yaFvy0nEKScLRLvouCama51wIxUZhpaUlVtIp3KwUVCCa/cy', 'Marben Benetez', 0, 1, 1, 0, 1699326355, 1700522452, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_confirmations`
--

CREATE TABLE `users_confirmations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_confirmations`
--

INSERT INTO `users_confirmations` (`id`, `user_id`, `email`, `selector`, `token`, `expires`) VALUES
(1, 1, 'admin@gmail.com', '05Xw5UuDNNPbQVWn', '$2y$10$dIWsRfbhyA8nBCaHIf.QoeQQP09ZWeuZCiic1c8LzpOMRB2TyQg4G', 1699404258),
(2, 2, 'benetez1998@gmail.com', 'cACF7niHC339sFmZ', '$2y$10$R8DsYILAsTaRgMXijU7.n.mTQudEDG9mrmmPzixcODn.VIyU.p/hm', 1699412755);

-- --------------------------------------------------------

--
-- Table structure for table `users_remembered`
--

CREATE TABLE `users_remembered` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_resets`
--

CREATE TABLE `users_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_throttling`
--

CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float UNSIGNED NOT NULL,
  `replenished_at` int(10) UNSIGNED NOT NULL,
  `expires_at` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_throttling`
--

INSERT INTO `users_throttling` (`bucket`, `tokens`, `replenished_at`, `expires_at`) VALUES
('ejWtPDKvxt-q7LZ3mFjzUoIWKJYzu47igC8Jd9mffFk', 73.0225, 1700522452, 1701062452),
('CUeQSH1MUnRpuE3Wqv_fI3nADvMpK_cg6VpYK37vgIw', 3.19669, 1699326355, 1699758355),
('2X063fuVjbUg4UeSmRXAC530SCE_QUW5Djet1KqnKMg', 11, 1699438335, 1699467134),
('Jjl8HEbTSJpZBWoyXOajJXqciuUdngUbah061jwhliE', 19, 1699772742, 1699808742),
('PjjNRSnirFPbKG1QbUDTnHEQyqaRlS59vSGT-2LqeBI', 499, 1699772742, 1699945542);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_confirmations`
--
ALTER TABLE `users_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `email_expires` (`email`,`expires`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_remembered`
--
ALTER TABLE `users_remembered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `users_resets`
--
ALTER TABLE `users_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user_expires` (`user`,`expires`);

--
-- Indexes for table `users_throttling`
--
ALTER TABLE `users_throttling`
  ADD PRIMARY KEY (`bucket`),
  ADD KEY `expires_at` (`expires_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_confirmations`
--
ALTER TABLE `users_confirmations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_remembered`
--
ALTER TABLE `users_remembered`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_resets`
--
ALTER TABLE `users_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
