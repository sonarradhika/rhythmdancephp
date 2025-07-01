-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 30, 2025 at 07:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rhythm`
--

-- --------------------------------------------------------

--
-- Table structure for table `dance_styles`
--

CREATE TABLE `dance_styles` (
  `style_id` int(11) NOT NULL,
  `style_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance_styles`
--

INSERT INTO `dance_styles` (`style_id`, `style_name`, `description`, `image`) VALUES
(1, 'Our Classical Lessons 1', 'Kathak, one of India\'s classical dance styles, is a beautiful blend of rhythm, grace, and storytelling. Rooted in ancient traditions, it features intricate footwork, mesmerizing spins, and expressive gestures that narrate timeless tales of devotion, love, and mythology. With its rich cultural heritage, Kathak bridges the past and present, offering a captivating experience of art and emotion.\r\nbla bla', 'images/kathak.jpg'),
(2, 'Our Semi classical Lessons', 'Semi-classical dance is a fusion of traditional classical dance forms with modern expressions and movements. It blends the grace, technique, and storytelling of classical styles like Bharatanatyam, Kathak, or Odissi with more contemporary music and choreography. This style offers flexibility, allowing dancers to showcase their creativity while maintaining the elegance and poise of classical dance, making it accessible to a wider audience. Semi-classical dance is an exciting and dynamic way to experience the beauty of classical traditions while adding a modern twist.', 'images/semiclassical.jpg'),
(4, 'Our Contemporary Lessons', 'Indian contemporary dance is a dynamic and expressive style that blends traditional Indian dance forms with modern techniques and global influences. It focuses on individual expression, emotional depth, and fluid movement, often incorporating elements of ballet, jazz, and modern dance. With an emphasis on storytelling and personal interpretation, Indian contemporary dancers explore themes of identity, society, and culture while maintaining a connection to India\'s rich dance heritage. This style allows for greater freedom of movement and creativity, making it a powerful and evolving art form that resonates with audiences worldwide.', 'images/contemporary.jpg'),
(5, 'Our Folk Lessons', 'Indian folk dance styles are a vibrant reflection of the country\'s diverse cultures, traditions, and celebrations. Each region of India boasts its own unique folk dance, often performed during festivals, weddings, and community events. From the energetic Garba and Dandiya of Gujarat to the graceful Bhangra from Punjab, the rhythmic Kathakali from Kerala to the joyous Ghoomar from Rajasthan, Maharashtra’s folk dances like Lavani and Tamasha add a dynamic and energetic flair to the rich cultural tapestry, showcasing powerful rhythms and expressive movements. These dances are deeply rooted in the local customs and stories. With colorful costumes, lively music, and joyful movements, Indian folk dances offer a beautiful and engaging way to experience the rich cultural heritage of India.', 'images/folk.jpg'),
(6, 'Our Western Dance Lessons', 'Western dance styles encompass a wide range of vibrant and energetic forms, including jazz, hip-hop, contemporary, and ballroom. Originating in Europe and the Americas, these styles are characterized by their dynamic movements, rhythmic precision, and expressive artistry. Whether it\'s the fluid grace of contemporary dance, the structured elegance of waltz, or the electrifying energy of hip-hop, Western dance offers a platform for creativity and storytelling through movement, appealing to diverse audiences and dancers alike.', 'images/western.jpg'),
(8, 'Our Classical Lessons1', 'asdasds', 'asdf'),
(9, 'Test New Userqwqw', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
('Account Administrator', 'Add, remove, and edit Users'),
('Content Editor', 'Add, remove, and edit Dance Styles'),
('User', 'Read only User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `interest` varchar(5) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `phone`, `interest`, `message`, `register_date`, `password`) VALUES
(1, 'sag', 'son', 'sag@son.com', '043312110', 'CD', 'asdasdasd', '2025-06-25 07:32:13', 'afbaae830184c07c04a9f795492c4e2f'),
(2, 'Radhika', 'Sonar', 'sonar.radhika@gmail.com', '0411211877', 'BD', 'interested', '2025-06-25 07:56:41', 'afbaae830184c07c04a9f795492c4e2f'),
(3, 'max', 'web', 'max@web.com', '0411211877', 'BD', 'asdasd', '2025-06-30 12:28:46', 'afbaae830184c07c04a9f795492c4e2f'),
(24, 's', 'g', 's@g.com', '0411211877', 'SC', 'asdf', '2025-06-30 15:32:35', 'afbaae830184c07c04a9f795492c4e2f'),
(25, 'joan', 'example', 'joan@example.com', '12112', 'SC', 'sdf', '2025-06-30 16:31:40', 'afbaae830184c07c04a9f795492c4e2f');

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `userid` int(11) NOT NULL,
  `roleid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`userid`, `roleid`) VALUES
(1, 'Account Administrator'),
(2, 'Content Editor'),
(3, 'Account Administrator'),
(24, 'Account Administrator'),
(25, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dance_styles`
--
ALTER TABLE `dance_styles`
  ADD PRIMARY KEY (`style_id`),
  ADD UNIQUE KEY `style_name` (`style_name`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`userid`,`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dance_styles`
--
ALTER TABLE `dance_styles`
  MODIFY `style_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
