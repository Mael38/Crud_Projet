-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 18 sep. 2024 à 09:53
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crud_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password123');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `failed_attempts` int DEFAULT '0',
  `last_attempt` timestamp NULL DEFAULT NULL,
  `lock_until` timestamp NULL DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `created_at`, `password`, `failed_attempts`, `last_attempt`, `lock_until`, `role`) VALUES
(1, 'Alice', 'alice@example.com', '2024-09-16 11:39:27', '$2y$10$saltypassword', 0, NULL, NULL, 'user'),
(2, 'Bob', 'bob@example.com', '2024-09-16 11:39:27', '$2y$10$tOF35.548ZaxNR3FC2R21.qKSLKnfAJExSrAo5ajb6N9K46zj0P2q', 0, NULL, NULL, 'user'),
(3, 'Charlie', 'charlie@example.com', '2024-09-16 11:39:27', '', 0, NULL, NULL, 'user'),
(4, 'David', 'david@example.com', '2024-09-16 11:39:27', '$2y$10$EsqcW8QF1qX/sS6EEpj7K.aIFE3viOy43htrcvy21NpdEwUBODLEi', 0, NULL, NULL, 'user'),
(5, 'Eva', 'eva@example.com', '2024-09-16 11:39:27', '', 0, NULL, NULL, 'user'),
(6, 'Frank', 'frank@example.com', '2024-09-16 11:39:27', '$2y$10$TFdoaTAMYK6K1wPp49ySmOBVcrtasLjwsFCCCqXqncNRr9r2/rrSu', 0, NULL, NULL, 'user'),
(7, 'Grace', 'grace@example.com', '2024-09-16 11:39:27', '', 0, NULL, NULL, 'user'),
(8, 'Hannah', 'hannah@example.com', '2024-09-16 11:39:27', '', 0, NULL, NULL, 'user'),
(9, 'Ivy', 'ivy@example.com', '2024-09-16 11:39:27', '$2y$10$7tgsgeqmOY4Jff6s.Qkd5e4JaQgz5zFb18KADfCxGriKnEb1ETQZ.', 0, NULL, NULL, 'user'),
(10, 'Jack', 'jack@example.com', '2024-09-16 11:39:27', '', 0, NULL, NULL, 'user'),
(11, 'mael', 'mael@test.com', '2024-09-16 11:44:43', '$2y$10$iNA2t9e8XuepGHpWcIIrju8yM/UpVX77uBtBwwT8UA9swLgBMMBp.', 0, NULL, NULL, 'user'),
(12, 'mael1', 'test@test.com', '2024-09-16 11:45:21', '$2y$10$jlm.wx9uUDFOxhrT9T4v5ODIRxNTebi5UxAA8X365C1U/1VlS1tzy', 0, '2024-09-17 07:44:26', NULL, 'admin'),
(15, 'admin', 'test1@test.com', '2024-09-17 07:50:33', '$2y$10$KsNXrYDLAy30hWa4Ijvu8OU8zpb3JDOirzl7gNipXAm2ZXsU/4yme', 0, '2024-09-17 09:56:27', NULL, 'admin'),
(14, 'admin', 'azerty@azerty.com', '2024-09-16 12:04:57', '$2y$10$rvU30V1F7t8Cdu8/n6wQF.bxeflENjaYOhhysgnl60LCUJqwFB2cm', 0, '2024-09-17 14:24:12', NULL, 'admin'),
(16, 'admin', 'admin@admin.com', '2024-09-17 07:56:15', '$2y$10$HBSB46Y1q/WZyhfzJbMSmeQRUIOpvJCx68oq4sKmeCQ2rGTUPVT7i', 3, '2024-09-17 12:28:55', NULL, 'admin'),
(17, 'test1235', 'test123@test.com', '2024-09-17 12:48:39', '$2y$10$q.UdhHdpdzWViUuw1/HR..15aGEQsWXl.ZHtxzVXz9rnp0GKo/W.i', 0, NULL, NULL, 'user'),
(18, 'test125656545656565', 'test1234@test.com', '2024-09-17 12:56:00', '$2y$10$PZMYrkZX9pJkVaC1l32Lb.zJe/weAqeGD.w0O9eQ.scGW5SUutG52', 0, NULL, NULL, 'admin'),
(19, 'test', 'azerty38@gmail.com', '2024-09-17 14:26:57', '$2y$10$KOSd2gRMVqU9pfxh7SmC7uKjxww.mIGiWxEgOIXKRPKSY8o9a5gD6', 0, '2024-09-17 14:30:44', NULL, 'admin'),
(20, 'mael', 'mael.mael@gmail.com', '2024-09-18 07:24:02', '$2y$10$Tr7kfbTyukCL.NEArniab.oOAy8dAc0VRqIeppsrk.svHvMCo0xDy', 0, NULL, NULL, 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
