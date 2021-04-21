-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2021 at 09:32 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lls_test`
--
CREATE DATABASE IF NOT EXISTS `lls_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lls_test`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `address_user` varchar(255) NOT NULL,
  `birthdate_user` bigint(255) NOT NULL,
  `occupation_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `name_user`, `email_user`, `password_user`, `address_user`, `birthdate_user`, `occupation_user`) VALUES
(4, 'admin', 'admin@admin.admin', '$2y$10$/qgO9wzUpXASngy9YX4BAOd15jDKtA50RmwJfyBlN/Yo3MfGQP18S', 'admin', 1355266800, 'admin'),
(5, 'admin2', 'admin2@admin.admin', '$2y$10$/qgO9wzUpXASngy9YX4BAOd15jDKtA50RmwJfyBlN/Yo3MfGQP18S', 'admin', -61409926408, 'administry'),
(6, 'admin3', 'admin3@admin.admin', '$2y$10$/qgO9wzUpXASngy9YX4BAOd15jDKtA50RmwJfyBlN/Yo3MfGQP18S', 'ok\r\n', -23225964808, 'admin'),
(7, 'admin4', 'admin4@admin.admin', '$2y$10$/qgO9wzUpXASngy9YX4BAOd15jDKtA50RmwJfyBlN/Yo3MfGQP18S', 'admin', 1639263600, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
