-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2020 at 07:57 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `programming_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answer`
--

CREATE TABLE `tbl_answer` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_answer` text,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_answer`
--

INSERT INTO `tbl_answer` (`answer_id`, `question_id`, `user_id`, `question_answer`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 1, 1, 'On Quora, you can write an answer to a question from your feed or a question page by clicking the â€œAnswerâ€ button.\n\nYou can write answers from the Write Answer page, when you see questions in your feed, and from topic pages.\n\nFor more information about how to write helpful answers on Quora, check out this answer.', 1, 0, '2020-02-04 01:22:46', NULL),
(2, 1, 2, 'Make sure to format your answers.\nKnow when to space out things into short paragraphs.\nKnow when to use bold or italics, or donâ€™t. You donâ€™t have to use it in all of your answers, but it can help in many situations.\nSame thing with bullet points or numbering down. You donâ€™t have to always use them, but they sometimes help.', 1, 0, '2020-02-04 01:23:43', NULL),
(3, 1, 3, 'If you jumble everything into one huge paragraph, itâ€™ll look like a really long mess. Nobody will want to read it. You gotta space it out.\nTest out different writing techniques, and see what works for you.\nYou should answer questions that you have knowledge on.\nDonâ€™t answer questions that you have absolutely no knowledge on. Iâ€™ve made this mistake before. Write what you know a lot about.\nWrite what you think and whatâ€™s on your mind.', 1, 0, '2020-02-04 01:23:51', NULL),
(4, 1, 3, 'Double check your answer before publishing.\nDid you write everything you wanted to write? Do you think your answer was written to the best of your ability? Did you make any spelling or grammar mistakes? YOU GOTTA DOUBLE CHECK!\n1 or 2 mistakes is fine, but when there are mistake', 1, 0, '2020-02-04 01:34:53', NULL),
(5, 1, 3, 'Donâ€™t jumble everything into one huge paragraph.\nIf you jumble everything into one huge paragraph, itâ€™ll look like a really long mess. Nobody will want to read it. You gotta space it out.\nTest out different writing techniques, and see what works for you.', 1, 0, '2020-02-04 01:36:32', NULL),
(6, 1, 3, 'Write what you think and whatâ€™s on your mind.\nKnow when to keep your answers short, or have them longer.\nAs you go forward, youâ€™ll have more knowledge on how to do this.', 1, 0, '2020-02-04 01:37:28', NULL),
(7, 1, 3, 'Write what you think and whatâ€™s on your mind.\nKnow when to keep your answers short, or have them longer.\nAs you go forward, youâ€™ll have more knowledge on how to do this.', 1, 0, '2020-02-04 01:37:55', NULL),
(8, 1, 3, 'Write what you think and whatâ€™s on your mind.\nKnow when to keep your answers short, or have them longer.\nAs you go forward, youâ€™ll have more knowledge on how to do this.', 1, 0, '2020-02-04 01:39:03', NULL),
(9, 1, 3, 'Write what you think and whatâ€™s on your mind.\nKnow when to keep your answers short, or have them longer.\nAs you go forward, youâ€™ll have more knowledge on how to do this.', 1, 0, '2020-02-04 01:42:04', NULL),
(10, 1, 3, 'Write what you think and whatâ€™s on your mind.\nKnow when to keep your answers short, or have them longer.\nAs you go forward, youâ€™ll have more knowledge on how to do this.', 1, 0, '2020-02-04 01:42:15', NULL),
(11, 1, 3, 'Write what you think and whatâ€™s on your mind.\nKnow when to keep your answers short, or have them longer.\nAs you go forward, youâ€™ll have more knowledge on how to do this.', 1, 0, '2020-02-04 01:42:50', NULL),
(12, 1, 3, 'Write what you think and whatâ€™s on your mind.\nKnow when to keep your answers short, or have them longer.\nAs you go forward, youâ€™ll have more knowledge on how to do this.', 1, 0, '2020-02-04 01:44:32', NULL),
(13, 1, 3, 'Write what you think and whatâ€™s on your mind.\nKnow when to keep your answers short, or have them longer.\nAs you go forward, youâ€™ll have more knowledge on how to do this.', 1, 0, '2020-02-07 04:49:39', NULL),
(14, 5, 1, '<html><body><p>Testing Answer to an question.</p>\n</body></html>', 1, 0, '2020-02-06 19:48:19', NULL),
(15, 5, 1, '<html><body><p>Test Answer</p>\n</body></html>', 1, 0, '2020-02-06 20:31:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_title` text,
  `blog_details` text NOT NULL,
  `blog_img` text,
  `upvote` int(50) NOT NULL,
  `downvote` int(50) NOT NULL,
  `is_upvote` int(11) NOT NULL DEFAULT '0',
  `pass_count` int(11) NOT NULL,
  `remove_count` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`blog_id`, `user_id`, `blog_title`, `blog_details`, `blog_img`, `upvote`, `downvote`, `is_upvote`, `pass_count`, `remove_count`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 1, '5 Ideas on Building Wealth Outside the Stock Market', 'If you are reading this article, you might already be contributing monthly to a 401K or IRA. \r\n', 'default-user.png', 0, 0, 0, 0, 0, 1, 0, '2020-02-04 13:36:56', NULL),
(2, 2, 'demo', 'test123', 'Chrysanthemum.jpg', 0, 0, 0, 0, 0, 1, 0, '2020-02-04 02:04:46', NULL),
(3, 2, 'test', 'test123', 'Chrysanthemum.jpg', 0, 0, 0, 0, 1, 1, 0, '2020-02-04 02:08:36', NULL),
(4, 2, 'test', 'test123', 'Chrysanthemum.jpg', 0, 0, 0, 0, 0, 1, 0, '2020-02-04 02:09:29', NULL),
(5, 2, 'test', 'test123', 'Chrysanthemum.jpg', 0, 0, 0, 0, 0, 1, 0, '2020-02-04 02:15:00', NULL),
(6, 2, 'test', 'test123', 'Chrysanthemum.jpg', 0, 0, 0, 0, 0, 1, 0, '2020-02-04 02:15:24', NULL),
(7, 2, 'test', 'test123', 'Chrysanthemum.jpg', 0, 0, 0, 0, 0, 1, 0, '2020-02-04 02:16:16', NULL),
(8, 2, 'When should I useAnimatedBuilder or AnimatedWidget?', 'We know you have many choices when you fly, I mean animate, in Flutter, so thank you for choosing AnimatedBuilder and AnimatedWidget. Wait, what? No! Flutter has many different animation widgets, but unlike commercial airlines, each type of widget is right for a different type of job. Sure, you can accomplish the same animation in a couple of different ways, but using the right animation widget for the job will make your life much easier.\nThis article covers why you might want to use AnimatedBuilder or AnimatedWidget versus other animation widgets, and how to use them. Suppose you want to add an animation to your app. This article is part of a series, walking through why you might want to use each type of animation widget. The particular animation you want to do repeats a couple of times or needs to be able to pause and resume in response to something, like a finger tap. Because your animation needs to repeat, or stop and start, youâ€™ll need to use an explicit animation.\nAs a reminder, we have two broad categories of animations in Flutter: explicit and implicit. For explicit animations, you need an animation controller. For implicit animations, you donâ€™t. We introduced animation controllers in the previous article about built-in explicit animations. If youâ€™d like to learn more about those, please check that out first.\nSo, if youâ€™ve determined that you need an explicit animation, there are a whole host of explicit animation classes for you to choose from. Those are the classes generally named FooTransition, where Foo is the name of the property you are trying to animate. I recommend seeing if you can use one of those widgets to accomplish your needs first, before diving into the deep world of AnimatedWidget and AnimatedBuilder. Thereâ€™s an amazing selection of widgets for pretty much anything you can think of â€” rotation, position, alignment, fading, text style, and many more. Plus, you can compose these widgets, so that you can rotate and fade. But, if none of those built-in widgets can do what youâ€™re looking for, itâ€™s time to build your own using AnimatedWidget or AnimatedBuilder.', 'flutter-ui-framework-google-620x349.jpg', 0, 0, 0, 0, 0, 1, 0, '2020-02-07 07:01:20', NULL),
(9, 2, 'Test Blog Title', 'Test Blog Description', '1581064684IMG_20200110_165126.jpg', 0, 1, 0, 0, 0, 1, 0, '2020-02-06 20:38:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog_action`
--

CREATE TABLE `tbl_blog_action` (
  `blog_action_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_upvote_downvote` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blog_action`
--

INSERT INTO `tbl_blog_action` (`blog_action_id`, `blog_id`, `user_id`, `is_upvote_downvote`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 9, 1, 0, 1, 0, '2020-02-08 04:08:37', '2020-02-08 04:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog_remove`
--

CREATE TABLE `tbl_blog_remove` (
  `blog_remove_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_remove` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blog_remove`
--

INSERT INTO `tbl_blog_remove` (`blog_remove_id`, `blog_id`, `user_id`, `is_remove`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 3, 1, 1, 1, 0, '2020-02-08 08:04:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

CREATE TABLE `tbl_questions` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` text,
  `optional_link` text,
  `is_follow` int(11) NOT NULL,
  `pass_count` int(50) NOT NULL,
  `remove_count` int(50) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_questions`
--

INSERT INTO `tbl_questions` (`question_id`, `user_id`, `question`, `optional_link`, `is_follow`, `pass_count`, `remove_count`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 2, 'What are some screenshots that can get xyz no of upvotes?', '', 0, 0, 0, 1, 0, '2020-02-04 05:56:58', NULL),
(2, 2, 'What are the best food items cooked by you?', '', 0, 0, 0, 1, 0, '2020-02-04 05:57:11', NULL),
(3, 2, 'Can you share some of your drawings?', '', 0, 1, 0, 1, 0, '2020-02-04 05:57:20', NULL),
(4, 2, 'What should I date you?/What are the benefits of dating you?', 'https://www.quora.com/What-are-the-top-10-questions-in-Quora', 0, 0, 0, 1, 0, '2020-02-04 05:57:30', NULL),
(5, 2, 'How hard does puberty hit you?', '', 0, 1, 0, 1, 0, '2020-02-04 05:57:44', NULL),
(6, 2, 'What is a common feature in a car but most people donâ€™t know what itâ€™s used for?', '', 0, 0, 0, 1, 0, '2020-02-06 05:22:43', NULL),
(7, 2, 'What are some awesome examples of simple yet innovative designs?', '', 0, 1, 0, 1, 0, '2020-02-06 05:23:02', NULL),
(8, 2, 'What is the impeccable experience of your life that you would like to share?', '', 0, 0, 1, 1, 0, '2020-02-06 05:23:13', NULL),
(10, 2, 'What is one random thing you know about a computer that most people donâ€™t?', '', 0, 0, 0, 1, 0, '2020-02-06 05:23:29', NULL),
(11, 2, 'What is Flutter?', '', 0, 0, 0, 1, 0, '2020-02-06 07:44:44', NULL),
(12, 2, 'How hard does puberty hit you?', '', 0, 0, 0, 1, 0, '2020-02-07 10:19:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_remove_user_question`
--

CREATE TABLE `tbl_remove_user_question` (
  `remove_question_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_remove` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_remove_user_question`
--

INSERT INTO `tbl_remove_user_question` (`remove_question_id`, `question_id`, `user_id`, `is_remove`, `insert_datetime`) VALUES
(1, 8, 1, 1, '2020-02-08 08:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_mobile` bigint(20) NOT NULL,
  `mobile_otp` varchar(50) NOT NULL,
  `is_login` int(11) NOT NULL,
  `is_mobile_verify` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `unique_no` varchar(250) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_email`, `user_mobile`, `mobile_otp`, `is_login`, `is_mobile_verify`, `user_type_id`, `unique_no`, `user_password`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 'Student', 'st@gamil.com', 9586248516, '958624', 1, 1, 1, 'ST1234', 'raju123', 1, 0, '2020-02-04 11:24:16', NULL),
(2, 'Teacher', 'teacher@gamil.com', 8980325048, '898032', 1, 1, 2, 'AT5687', 'ram123', 1, 0, '2020-02-04 11:32:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(100) NOT NULL,
  `user_type_name_initials` varchar(30) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `insert_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`user_type_id`, `user_type_name`, `user_type_name_initials`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 'Student', 'S', 1, 0, '2020-02-04 10:22:18', NULL),
(2, 'Faculty', 'F', 1, 0, '2020-02-04 10:22:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `tbl_blog_action`
--
ALTER TABLE `tbl_blog_action`
  ADD PRIMARY KEY (`blog_action_id`);

--
-- Indexes for table `tbl_blog_remove`
--
ALTER TABLE `tbl_blog_remove`
  ADD PRIMARY KEY (`blog_remove_id`);

--
-- Indexes for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `tbl_remove_user_question`
--
ALTER TABLE `tbl_remove_user_question`
  ADD PRIMARY KEY (`remove_question_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_blog_action`
--
ALTER TABLE `tbl_blog_action`
  MODIFY `blog_action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_blog_remove`
--
ALTER TABLE `tbl_blog_remove`
  MODIFY `blog_remove_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_remove_user_question`
--
ALTER TABLE `tbl_remove_user_question`
  MODIFY `remove_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
