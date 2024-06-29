-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 02:57 AM
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
-- Database: `schedule_generation`
--

-- --------------------------------------------------------

--
-- Table structure for table `presentation`
--

CREATE TABLE `presentation` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `author` varchar(255) NOT NULL,
  `FN` varchar(11) NOT NULL,
  `hour` varchar(11) DEFAULT NULL,
  `room` varchar(255) NOT NULL,
  `interests` varchar(20) NOT NULL DEFAULT 'нямам интерес'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presentation`
--

INSERT INTO `presentation` (`id`, `title`, `date`, `author`, `FN`, `hour`, `room`, `interests`) VALUES
(1, 'Уеб Технологии', '2024-06-20', 'Теодор Цанков', '0MI8000658', '10:15-12:00', 'ФМИ 325', ''),
(2, 'Програмиране на Java', '2024-08-30', 'Пламена Илиева', '6MI3990010', '08:45', 'ФМИ 200', ''),
(3, 'Обектно-ориентирано програмиране - Класове и Обекти', '2024-06-22', 'Рая Симеонова', '4MI0099481', '11:00-14:00', 'ФМИ 325', ''),
(4, 'Истовия на Java Script', '2024-05-13', 'Антония Савова', '6MI345899', '08:33', 'ФМИ 325', ''),
(5, 'Изкуството на разговора', '2024-06-28', 'Алекс Василев', '1MI2000010', '16:30-18:30', 'ФМИ 01', ''),
(9, 'Въведение в PHP ', '2024-06-30', 'Пламена Илиева', '6MI3990010', '08:45', 'ФМИ 200', ''),
(10, 'CoffeeScript', '2024-05-15', 'Антония Христова', '8MI6003006', '13:00-16:30', 'ФМИ 325', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `firstName`, `lastName`, `isAdmin`) VALUES
(1, 'iva@google.com', '$2y$10$WojckZo1nQEYiEKMogDFI..A.TFJUYgbSUKGB/JX1h6iZrDeFRogW', 'Ива', 'Иванова', 0),
(2, 'magdalena@google.com', '$2y$10$9CAt2PYplwH0yHqdo9ypvuS8Dv7EA7RMVw4UCN1JYiFQaxaB1DC5G', 'Магдалена', 'Петрова', 1),
(3, 'petur@yahoo.com', '$2y$10$PRJxSF/r9nZ0gaWhT7lqiehUutODOFlfNgRoQLU0deRVK23/pncgS', 'Петър', 'Александров', 0),
(4, 'ivan@yahoo.com', '$2y$10$Jza4csX1qeSPTg.FxdDs0.bfdNePiIDeDjG2OFx76FE0pXY47s.a6', 'Иван', 'Иванов', 0),
(5, 'zoya@yahoo.com', '$2y$10$WAguaZPUngeQn5Vxta46HO8UQFgWQEmQ6Rg/SRf.DUyhF8csp5jWK', 'Зоя', 'Захариева', 0),
(6, 'phillip@yahoo.com', '$2y$10$q9/Jj4E5AqeZvTyvlZNihOav3In.CkJ7Lpb6VY81CLcYzX/R19lC.', 'Филип', 'Миленов', 0),
(8, 'brankastojeva@gmail.com', '$2y$10$Ge8/kviR8D4CFhugcLGGZeCxTujqo1loOj8ecW20nahg9WH9shfOW', 'Branka', 'Stojeva', 0),
(18, 'brankastojeva@yahoo.com', '$2y$10$Hz6h3Ohc5Q8QaCtWzTQbsOVFAZyxv9TiIlK3tOUqHPwX972/Tf4he', 'Branka', 'Stojeva', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `presentation`
--
ALTER TABLE `presentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
