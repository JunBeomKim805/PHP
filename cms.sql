-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- 생성 시간: 22-01-10 04:15
-- 서버 버전: 5.6.26
-- PHP 버전: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `cms`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'Javascript'),
(3, 'PHP'),
(9, 'JAVA'),
(10, 'JQUERY');

-- --------------------------------------------------------

--
-- 테이블 구조 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(14, 8, 'junbeom', 'junbeom@junbeom.com', 'comment', 'unapproved', '2021-12-31');

-- --------------------------------------------------------

--
-- 테이블 구조 `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(34, 1, 'Coding is awesome', '', 'demo3000 ', '2022-01-09', 'image_3.jpg', 's        ', 'Junbeom, javascript, php1', 0, 'published', 0),
(36, 1, 'Coding is awesome', '', 'demo3000 ', '2022-01-09', 'image_3.jpg', 's        ', 'Junbeom, javascript, php1', 0, 'published', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(1, 'ricoa', '123', 'Ricoa', 'Suaves', 'ricosuave@gmail.com', '', 'admin', ''),
(2, 'rico', '123', 'jun', 'kim', 'jun@jun.com', '', 'admin', ''),
(3, 'JKK', '123', 'J', 'K', 'jk@jk.com', '', 'subscriber', ''),
(8, 'demo3000', '$1$VM..4d3.$CH5l.BKgVyt1jdDdRJWyj1', '', '', 'demo4000@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(9, 'demo123', '$1$.Y0.tI0.$qZthm9JmIc34l5NAbJkxB1', '', '', 'demo123@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(10, 'demo1234', '$1$oL3.R20.$hKAATJwZmC8HqMoBdGbXQ/', '', '', 'demo1234@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(11, 'demo5555', '$1$sr2.F95.$guooQNgUHMlw2tNIj8Pri1', '', '', 'demo@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(12, 'new', '$2y$12$.V2/YWS4RM7e68NeucdnxeSTA5LedsgfSaLQ9oTuu/X5fT9mhKfVO', '', '', 'new@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(13, 'newa', '$2y$12$g2RcFzGuAlWXSQA72dyJgOLTz3dNxlSLihVVwfzvoaRtNT95XjkEC', '', '', 'newa@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(14, 'newb', '$2y$12$sSzmCQJvpZCTGO9riaIssukBX.wFN.nKqp1qIE1.IqrNbgV7Tn6g2', 'J', 'K', 'jkim@launchfire.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- 테이블 구조 `users_online`
--

CREATE TABLE IF NOT EXISTS `users_online` (
  `users_online_id` int(3) NOT NULL,
  `users_online_session` varchar(255) NOT NULL,
  `users_online_time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `users_online`
--

INSERT INTO `users_online` (`users_online_id`, `users_online_session`, `users_online_time`) VALUES
(9, 'sui2994cr9vmvcvhfstai37q17', 1641532316),
(10, 'pueljd8gf46m04hnt3burqeco3', 1641526123),
(11, 'vlk2rkjuc7h9gbks5fu3aship1', 1641529648),
(12, 'n99j5bppe1pa4fr9go68guavg5', 1641531165),
(13, 'jvqr5ou2hrck8e4vl2rtginkl4', 1641531178),
(14, 'v0c0cvnjui2t2gvggaksa791n0', 1641531704),
(15, 'ha5ec6oo782af2c8jp17ourv35', 1641531807),
(16, '6iphmh37beb3cjak49lh0gdvl7', 1641532270),
(17, '76vh67fnol8trd7jig0hjkm5b3', 1641532302),
(18, 'pq7eqqpv82g2gtlotc42q3fa92', 1641562973),
(19, 'gaulg0kl6vufvgme301kfgt0p7', 1641733648),
(20, '3017pb6ice7g0626fpq2a61af6', 1641784529);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- 테이블의 인덱스 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- 테이블의 인덱스 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- 테이블의 인덱스 `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`users_online_id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- 테이블의 AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- 테이블의 AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- 테이블의 AUTO_INCREMENT `users_online`
--
ALTER TABLE `users_online`
  MODIFY `users_online_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
