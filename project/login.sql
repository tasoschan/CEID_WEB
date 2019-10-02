-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1:3306
-- Χρόνος δημιουργίας: 28 Ιουλ 2019 στις 13:59:05
-- Έκδοση διακομιστή: 5.7.23
-- Έκδοση PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
SET CHARSET 'utf8';


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `login`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `kampilizitisis`
--

DROP TABLE IF EXISTS `kampilizitisis`;
CREATE TABLE IF NOT EXISTS `kampilizitisis` (
  `polygon_name` text CHARACTER SET utf8 NOT NULL,
  `timezone` int(11) NOT NULL,
  `timi` double(20,10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `polygons`
--

DROP TABLE IF EXISTS `polygons`;
CREATE TABLE IF NOT EXISTS `polygons` (
  `name` text CHARACTER SET utf8 NOT NULL,
  `coords` text CHARACTER SET utf8 NOT NULL,
  `parking_spaces` int(11) NOT NULL,
  `center` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `population` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`) VALUES
(2, 'admin', 'admin', 'admin'),
(3, 'user', 'user', 'user'),
(4, 'sss', 'sss', 'sss'),
(5, 'Διαχειριστης', 'καλημερα', 'Διαχειριστης'),
(6, '123', '123', '123'),
(7, 'ααα', 'ααα', 'ααα');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
