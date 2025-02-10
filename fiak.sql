-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 25 mars 2024 à 10:45
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fiak`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categorie` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `categorie`) VALUES
(1, 'Audio'),
(2, 'Informatique'),
(3, 'Photographie'),
(4, 'TV'),
(5, 'Smartphone');

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

CREATE TABLE `etats` (
  `id` int(11) NOT NULL,
  `etat` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etats`
--

INSERT INTO `etats` (`id`, `etat`) VALUES
(1, 'Neuf'),
(2, 'Bon état'),
(3, 'Endommagé'),
(4, 'Mauvais état'),
(5, 'Inutilisable');

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `id` int(11) NOT NULL,
  `marque` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`id`, `marque`) VALUES
(1, 'Sony'),
(2, 'Canon'),
(3, 'Samsung'),
(4, 'Apple'),
(5, 'Panasonic'),
(6, 'Bose'),
(7, 'Jabra'),
(8, 'Marshall'),
(9, 'Sennheiser'),
(10, 'JBL'),
(11, 'TCL'),
(12, 'LG'),
(13, 'Google'),
(14, 'Xiaomi'),
(15, 'Huawei'),
(16, 'OPPO'),
(17, 'Nikon'),
(18, 'Fujifilm'),
(19, 'Acer'),
(20, 'Asus'),
(21, 'HP'),
(22, 'Lenovo'),
(23, 'Dell'),
(24, 'MSI'),
(25, 'Ducky Channel'),
(26, 'Logitech'),
(27, 'Razer'),
(28, 'Corsair'),
(29, 'Philips'),
(30, 'Toshiba'),
(33, 'test'),
(34, 'test2');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `image_path` varchar(99) NOT NULL,
  `marques_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `stock_disponible` int(11) NOT NULL DEFAULT 0,
  `disponible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `image_path`, `marques_id`, `categories_id`, `stock_disponible`, `disponible`) VALUES
(1, 'Iphone 14 Pro', 'img/products/Iphone 14 Pro.png', 4, 5, 12, 1),
(2, 'Iphone 13', 'img/products/Iphone 13.png', 4, 5, 9, 0),
(3, 'Samsung Galaxy A72', 'img/products/Samsung Galaxy A72.png', 3, 5, 0, 1),
(4, 'Samsung Galaxy S23', 'img/products/Samsung Galaxy S23.png', 3, 5, 0, 1),
(5, 'Xiaomi Redmi Note 12', 'img/products/Xiaomi Redmi Note 12.png', 14, 5, 0, 1),
(6, 'Xiaomi 13', 'img/products/Xiaomi 13.png', 14, 5, 0, 1),
(7, 'Oppo Find X5 ', 'img/products/Oppo Find X5.png', 16, 5, 0, 1),
(8, 'Oppo A94', 'img/products/Oppo A94.png', 16, 5, 0, 1),
(9, 'Huawei P30 Pro', 'img/products/Huawei P30 Pro.png', 15, 5, 0, 1),
(10, 'Huawei P50 Pocket', 'img/products/Huawei P50 Pocket.png', 15, 5, 0, 1),
(11, 'Asus Zenbook 13', 'img/products/Asus Zenbook 13.png', 20, 2, 0, 1),
(12, 'HP Pavillon 14', 'img/products/HP Pavillon 14.png', 21, 2, 0, 1),
(13, 'Lenovo Yoga Slim 7 Pro', 'img/products/Lenovo Yoga Slim 7 Pro.png', 22, 2, 0, 1),
(14, 'MSI Optix G241', 'img/products/MSI Optix G241.png', 24, 2, 0, 1),
(15, 'Ipad Pro 11 M2', 'img/products/Ipad Pro 11 M2.png', 4, 2, 0, 1),
(16, 'Logitech Ergo K860', 'img/products/Logitech Ergo K860.png', 26, 2, 0, 1),
(17, 'Razer BlackWidow V3 Tenkeyless', 'img/products/Razer BlackWidow V3 Tenkeyless.png', 27, 2, 0, 1),
(18, 'Corsair K70 RGB ', 'img/products/Corsair K70 RGB.png', 28, 2, 0, 1),
(19, 'HP OMEN 600', 'img/products/HP OMEN 600.png', 21, 2, 0, 1),
(20, 'Apple Magic Mouse', 'img/products/Apple Magic Mouse.png', 4, 2, 0, 1),
(21, 'Sony A7 III', 'img/products/Sony A7 III.png', 1, 3, 1, 1),
(22, 'Panasonic DC-FZ82 EF-K', 'img/products/Panasonic DC-FZ82 EF-K.png', 5, 3, 0, 1),
(23, 'Fujifilm Instax Mini 40', 'img/products/Fujifilm Instax Mini 40.png', 18, 3, 0, 1),
(24, 'Panasonic DMC-FZ300', 'img/products/Panasonic DMC-FZ300.png', 5, 3, 0, 1),
(25, 'Panasonic DC-GX9', 'img/products/Panasonic DC-GX9.png', 5, 3, 0, 1),
(26, 'Canon EOS R50', 'img/products/Canon EOS R50.png', 2, 3, 0, 1),
(27, 'Sony Alpha 7C', 'img/products/Sony Alpha 7C.png', 1, 3, 0, 1),
(28, 'Nikon Kit Z 30', 'img/products/Nikon Kit Z 30.png', 17, 3, 0, 1),
(29, 'Nikon Z6', 'img/products/Nikon Z6.png', 17, 3, 0, 1),
(30, 'Panasonic Lumix S5', 'img/products/Panasonic Lumix S5.png', 5, 3, 0, 1),
(31, 'Sony WH-1000XM4', 'img/products/WF-1000XM4.png', 1, 1, 15, 1),
(32, 'Bose QC45', 'img/products/Bose QC45.png', 6, 1, 7, 1),
(33, 'Apple AirPods Max', 'img/products/Apple AirPods Max.png', 4, 1, 0, 1),
(34, 'Sony WF-1000XM4', 'img/products/Sony WH-1000XM4.png', 1, 1, 0, 1),
(35, 'Bose QC Earbuds II', 'img/products/Bose QC Earbuds II.png', 6, 1, 0, 1),
(36, 'Apple AirPods Pro 2', 'img/products/Apple AirPods Pro 2.png', 4, 1, 0, 1),
(37, 'Jbl Flip 5', 'img/products/JBL Flip 5.png', 10, 1, 8, 1),
(38, 'Marshall Acton II', 'img/products/Marshall Acton II.png', 8, 1, 0, 1),
(39, 'Marshall Emberton', 'img/products/Marshall Emberton.png', 8, 1, 1, 1),
(40, 'Sony WH-1000XM5', 'img/products/Sony WH-1000XM5.png', 1, 1, 0, 1),
(41, 'TCL 55P638', 'img/products/TCL 55P638.png', 11, 4, 1, 1),
(42, 'Sony Bravia XR-55A80J', 'img/products/Sony Bravia XR-55A80J.png', 1, 4, 0, 1),
(43, 'LG OLED55CS', 'img/products/LG OLED55CS.png', 12, 4, 0, 1),
(44, 'LG OLEDOLED48C2', 'img/products/LG OLED48C2.png', 12, 4, 0, 1),
(45, 'Samsung TU75CU7105', 'img/products/Samsung TU75CU7105.png', 3, 4, 0, 1),
(46, 'Sony XR75X94K', 'img/products/Sony XR75X94K.png', 1, 4, 0, 1),
(47, 'TCL 65C735', 'img/products/TCL 65C735.png', 11, 4, 0, 1),
(48, 'Samsung TQ75Q80C', 'img/products/Samsung TQ75Q80C.png', 3, 4, 0, 1),
(49, 'LG OLED65C2', 'img/products/LG OLED65C2.png', 12, 4, 0, 1),
(50, 'Samsung QE55Q82B', 'img/products/Samsung QE55Q82B.png', 3, 4, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `dispo` tinyint(1) NOT NULL,
  `etats_id` int(11) NOT NULL,
  `utilisateurs_id` int(11) NOT NULL,
  `produits_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stocks`
--

INSERT INTO `stocks` (`id`, `dispo`, `etats_id`, `utilisateurs_id`, `produits_id`) VALUES
(1, 1, 2, 1, 1),
(3, 1, 2, 1, 21),
(5, 1, 4, 1, 41),
(6, 1, 3, 1, 1),
(7, 1, 3, 1, 1),
(8, 1, 3, 1, 2),
(9, 1, 1, 1, 31),
(10, 1, 4, 1, 31),
(11, 1, 4, 1, 31),
(12, 1, 5, 1, 31),
(13, 1, 2, 1, 1),
(14, 1, 3, 1, 1),
(15, 1, 1, 1, 1),
(16, 1, 1, 1, 31),
(17, 1, 1, 1, 31),
(18, 1, 1, 1, 31),
(19, 1, 1, 1, 31),
(20, 1, 2, 1, 31),
(21, 1, 2, 1, 31),
(22, 1, 2, 1, 31),
(23, 1, 3, 1, 31),
(24, 1, 3, 1, 31),
(25, 1, 4, 1, 31),
(26, 1, 4, 1, 31),
(27, 1, 1, 1, 2),
(28, 1, 1, 1, 2),
(29, 1, 1, 1, 2),
(30, 1, 2, 1, 2),
(31, 1, 2, 1, 2),
(32, 1, 3, 1, 2),
(33, 1, 4, 1, 2),
(34, 1, 4, 1, 2),
(35, 1, 4, 1, 2),
(36, 1, 5, 1, 2),
(37, 1, 5, 1, 2),
(38, 1, 1, 1, 3),
(39, 1, 2, 1, 3),
(40, 1, 2, 1, 3),
(41, 1, 3, 1, 3),
(42, 1, 3, 1, 3),
(43, 1, 4, 1, 3),
(44, 1, 4, 1, 3),
(45, 1, 4, 1, 3),
(46, 1, 1, 1, 4),
(47, 1, 2, 1, 4),
(48, 1, 2, 1, 4),
(49, 1, 2, 1, 4),
(50, 1, 3, 1, 4),
(51, 1, 2, 1, 5),
(52, 1, 2, 1, 5),
(53, 1, 3, 1, 5),
(54, 1, 3, 1, 5),
(55, 1, 3, 1, 5),
(56, 1, 4, 1, 5),
(57, 0, 5, 1, 5),
(58, 0, 5, 1, 5),
(59, 0, 5, 1, 5),
(60, 0, 5, 1, 5),
(61, 1, 1, 1, 32),
(62, 1, 1, 1, 32),
(63, 1, 2, 1, 32),
(64, 1, 2, 1, 32),
(65, 1, 2, 1, 32),
(66, 1, 2, 1, 32),
(67, 1, 4, 1, 32),
(68, 1, 4, 1, 32),
(69, 1, 1, 1, 33),
(70, 1, 1, 1, 33),
(71, 1, 1, 1, 33),
(72, 1, 1, 1, 33),
(73, 1, 2, 1, 33),
(74, 1, 2, 1, 33),
(75, 0, 5, 1, 33),
(76, 1, 1, 1, 34),
(77, 1, 1, 1, 34),
(78, 1, 1, 1, 34),
(79, 1, 1, 1, 34),
(80, 1, 1, 1, 34),
(81, 1, 2, 1, 34),
(82, 1, 2, 1, 34),
(83, 1, 3, 1, 34),
(84, 0, 5, 1, 34),
(85, 0, 5, 1, 34),
(86, 0, 5, 1, 34),
(87, 1, 1, 1, 35),
(88, 1, 3, 1, 35),
(89, 1, 3, 1, 35),
(90, 1, 3, 1, 35),
(91, 1, 3, 1, 35),
(92, 0, 5, 1, 35),
(93, 1, 1, 1, 36),
(94, 1, 1, 1, 36),
(95, 1, 2, 1, 36),
(96, 1, 2, 1, 36),
(97, 1, 2, 1, 36),
(98, 1, 2, 1, 36),
(99, 1, 3, 1, 36),
(100, 1, 4, 1, 36),
(101, 1, 4, 1, 36),
(102, 0, 5, 1, 36),
(103, 0, 5, 1, 36),
(104, 0, 5, 1, 36),
(105, 0, 5, 1, 36),
(106, 0, 2, 8, 37),
(107, 1, 2, 1, 37),
(108, 1, 2, 1, 37),
(109, 1, 3, 1, 37),
(110, 1, 3, 1, 37),
(111, 1, 4, 1, 37),
(112, 1, 4, 1, 37),
(113, 1, 4, 1, 37),
(114, 1, 4, 1, 37),
(115, 1, 1, 1, 38),
(116, 1, 1, 1, 38),
(117, 1, 1, 1, 38),
(118, 1, 1, 1, 38),
(119, 1, 3, 1, 38),
(120, 1, 3, 1, 38),
(121, 0, 1, 8, 39),
(122, 0, 1, 8, 39),
(123, 0, 3, 8, 39),
(124, 0, 3, 8, 39),
(125, 0, 3, 8, 39),
(126, 1, 5, 1, 39),
(127, 1, 2, 1, 40),
(128, 1, 2, 1, 40),
(129, 1, 2, 1, 40),
(130, 1, 4, 1, 40),
(131, 1, 4, 1, 40),
(132, 1, 4, 1, 40),
(133, 0, 5, 1, 40),
(134, 0, 5, 1, 40),
(135, 1, 1, 1, 11),
(136, 1, 1, 1, 11),
(137, 1, 2, 1, 11),
(138, 1, 2, 1, 11),
(139, 1, 2, 1, 11),
(140, 1, 2, 1, 11),
(141, 1, 3, 1, 11),
(142, 1, 3, 1, 11),
(143, 0, 5, 1, 11),
(144, 1, 1, 1, 12),
(145, 1, 1, 1, 12),
(146, 1, 1, 1, 12),
(147, 1, 2, 1, 12),
(148, 1, 2, 1, 12),
(149, 1, 4, 1, 12),
(150, 1, 4, 1, 12),
(151, 1, 4, 1, 12),
(152, 1, 1, 1, 13),
(153, 1, 2, 1, 13),
(154, 1, 2, 1, 13),
(155, 1, 4, 1, 13),
(156, 1, 4, 1, 13),
(157, 1, 4, 1, 13),
(158, 1, 2, 1, 14),
(159, 1, 2, 1, 14),
(160, 1, 2, 1, 14),
(161, 1, 3, 1, 14),
(162, 1, 3, 1, 14),
(163, 1, 4, 1, 14),
(164, 1, 4, 1, 14),
(165, 0, 5, 1, 14),
(166, 1, 1, 1, 15),
(167, 1, 1, 1, 15),
(168, 1, 1, 1, 15),
(169, 1, 3, 1, 15),
(170, 1, 3, 1, 15),
(171, 1, 3, 1, 15),
(172, 0, 5, 1, 15),
(173, 0, 5, 1, 15),
(174, 1, 2, 1, 16),
(175, 1, 2, 1, 16),
(176, 1, 3, 1, 16),
(177, 1, 3, 1, 16),
(178, 1, 3, 1, 16),
(179, 1, 4, 1, 16),
(180, 0, 5, 1, 16),
(181, 1, 1, 1, 17),
(182, 1, 1, 1, 17),
(183, 1, 1, 1, 17),
(184, 1, 2, 1, 17),
(185, 1, 2, 1, 17),
(186, 1, 2, 1, 17),
(187, 1, 4, 1, 17),
(188, 1, 4, 1, 17),
(189, 1, 1, 1, 18),
(190, 1, 3, 1, 18),
(191, 1, 3, 1, 18),
(192, 1, 3, 1, 18),
(193, 0, 5, 1, 18),
(194, 0, 5, 1, 18),
(195, 1, 1, 1, 19),
(196, 1, 1, 1, 19),
(197, 1, 2, 1, 19),
(198, 1, 2, 1, 19),
(199, 1, 2, 1, 19),
(200, 1, 2, 1, 19),
(201, 1, 2, 1, 19),
(202, 1, 3, 1, 19),
(203, 1, 3, 1, 19),
(204, 1, 3, 1, 19),
(205, 0, 5, 1, 19),
(206, 1, 1, 1, 20),
(207, 1, 1, 1, 20),
(208, 1, 3, 1, 20),
(209, 1, 3, 1, 20),
(210, 1, 3, 1, 20),
(211, 1, 3, 1, 20),
(212, 1, 3, 1, 20),
(213, 1, 4, 1, 20),
(214, 1, 4, 1, 20),
(215, 1, 4, 1, 20),
(216, 1, 1, 1, 21),
(217, 1, 1, 1, 21),
(218, 1, 1, 1, 21),
(219, 1, 3, 1, 21),
(220, 1, 3, 1, 21),
(221, 1, 1, 1, 22),
(222, 1, 1, 1, 22),
(223, 1, 3, 1, 22),
(224, 1, 4, 1, 22),
(225, 1, 4, 1, 22),
(226, 1, 4, 1, 22),
(227, 1, 1, 1, 23),
(228, 1, 3, 1, 23),
(229, 1, 3, 1, 23),
(230, 1, 3, 1, 23),
(231, 0, 5, 1, 23),
(232, 0, 5, 1, 23),
(233, 1, 1, 1, 24),
(234, 1, 1, 1, 24),
(235, 1, 1, 1, 24),
(236, 1, 4, 1, 24),
(237, 1, 4, 1, 24),
(238, 0, 5, 1, 24),
(239, 1, 1, 1, 25),
(240, 1, 3, 1, 25),
(241, 1, 3, 1, 25),
(242, 1, 3, 1, 25),
(243, 1, 4, 1, 25),
(244, 1, 4, 1, 25),
(245, 0, 5, 1, 25),
(246, 0, 5, 1, 25),
(247, 0, 5, 1, 25),
(248, 0, 5, 1, 25),
(249, 1, 1, 1, 26),
(250, 1, 2, 1, 26),
(251, 1, 2, 1, 26),
(252, 1, 2, 1, 26),
(253, 1, 4, 1, 26),
(254, 1, 4, 1, 26),
(255, 0, 5, 1, 26),
(256, 1, 1, 1, 27),
(257, 1, 1, 1, 27),
(258, 1, 2, 1, 27),
(259, 1, 2, 1, 27),
(260, 1, 2, 1, 27),
(261, 1, 2, 1, 27),
(262, 1, 3, 1, 27),
(263, 0, 5, 1, 27),
(264, 0, 5, 1, 27),
(265, 0, 5, 1, 27),
(266, 1, 1, 1, 28),
(267, 1, 2, 1, 28),
(268, 1, 2, 1, 28),
(269, 1, 2, 1, 28),
(270, 1, 3, 1, 28),
(271, 1, 3, 1, 28),
(272, 1, 4, 1, 28),
(273, 1, 4, 1, 28),
(274, 1, 4, 1, 28),
(275, 1, 4, 1, 28),
(276, 0, 5, 1, 28),
(277, 1, 1, 1, 29),
(278, 1, 2, 1, 29),
(279, 1, 2, 1, 29),
(280, 1, 2, 1, 29),
(281, 1, 3, 1, 29),
(282, 1, 3, 1, 29),
(283, 0, 5, 1, 29),
(284, 0, 5, 1, 29),
(285, 0, 5, 1, 29),
(286, 1, 1, 1, 30),
(287, 1, 1, 1, 30),
(288, 1, 1, 1, 30),
(289, 1, 2, 1, 30),
(290, 1, 2, 1, 30),
(291, 1, 4, 1, 30),
(292, 0, 5, 1, 30),
(293, 0, 5, 1, 30),
(294, 1, 2, 1, 41),
(295, 1, 2, 1, 41),
(296, 1, 2, 1, 41),
(297, 1, 3, 1, 41),
(298, 1, 3, 1, 41),
(299, 0, 5, 1, 41),
(300, 1, 1, 1, 42),
(301, 1, 1, 1, 42),
(302, 1, 1, 1, 42),
(303, 1, 1, 1, 42),
(304, 1, 2, 1, 42),
(305, 1, 2, 1, 42),
(306, 1, 3, 1, 42),
(307, 1, 4, 1, 42),
(308, 1, 4, 1, 42),
(309, 1, 1, 1, 43),
(310, 1, 1, 1, 43),
(311, 1, 1, 1, 43),
(312, 1, 1, 1, 43),
(313, 1, 2, 1, 43),
(314, 1, 2, 1, 43),
(315, 1, 2, 1, 43),
(316, 1, 3, 1, 43),
(317, 0, 5, 1, 43),
(318, 0, 5, 1, 43),
(319, 0, 5, 1, 43),
(320, 1, 1, 1, 44),
(321, 1, 1, 1, 44),
(322, 1, 1, 1, 44),
(323, 1, 3, 1, 44),
(324, 1, 4, 1, 44),
(325, 1, 4, 1, 44),
(326, 1, 4, 1, 44),
(327, 1, 2, 1, 45),
(328, 1, 2, 1, 45),
(329, 1, 2, 1, 45),
(330, 1, 3, 1, 45),
(331, 1, 3, 1, 45),
(332, 0, 5, 1, 45),
(333, 1, 1, 1, 46),
(334, 1, 1, 1, 46),
(335, 1, 1, 1, 46),
(336, 1, 1, 1, 46),
(337, 1, 2, 1, 46),
(338, 1, 2, 1, 46),
(339, 1, 3, 1, 46),
(340, 0, 5, 1, 46),
(341, 0, 5, 1, 46),
(342, 1, 1, 1, 47),
(343, 1, 1, 1, 47),
(344, 1, 1, 1, 47),
(345, 1, 2, 1, 47),
(346, 1, 2, 1, 47),
(347, 1, 4, 1, 47),
(348, 0, 5, 1, 47),
(349, 0, 5, 1, 47),
(350, 1, 1, 1, 48),
(351, 1, 1, 1, 48),
(352, 1, 1, 1, 48),
(353, 1, 2, 1, 48),
(354, 1, 2, 1, 48),
(355, 1, 3, 1, 48),
(356, 1, 4, 1, 48),
(357, 1, 4, 1, 48),
(358, 1, 4, 1, 48),
(359, 1, 4, 1, 48),
(360, 0, 5, 1, 48),
(361, 0, 5, 1, 48),
(362, 0, 5, 1, 48),
(363, 1, 1, 1, 49),
(364, 1, 1, 1, 49),
(365, 1, 2, 1, 49),
(366, 1, 3, 1, 49),
(367, 1, 3, 1, 49),
(368, 1, 3, 1, 49),
(369, 1, 3, 1, 49),
(370, 1, 4, 1, 49),
(371, 1, 4, 1, 49),
(372, 1, 4, 1, 49),
(373, 0, 5, 1, 49),
(374, 0, 5, 1, 49),
(375, 1, 1, 1, 50),
(376, 1, 1, 1, 50),
(377, 1, 2, 1, 50),
(378, 1, 3, 1, 50),
(379, 1, 3, 1, 50),
(380, 1, 3, 1, 50),
(381, 1, 3, 1, 50),
(382, 1, 4, 1, 50),
(383, 1, 4, 1, 50),
(384, 0, 5, 1, 50),
(385, 1, 1, 1, 6),
(386, 1, 1, 1, 6),
(387, 1, 2, 1, 6),
(388, 1, 2, 1, 6),
(389, 1, 2, 1, 6),
(390, 1, 2, 1, 6),
(391, 1, 3, 1, 6),
(392, 1, 3, 1, 6),
(393, 1, 4, 1, 6),
(394, 1, 1, 1, 7),
(395, 1, 1, 1, 7),
(396, 1, 1, 1, 7),
(397, 1, 2, 1, 7),
(398, 1, 2, 1, 7),
(399, 1, 4, 1, 7),
(400, 1, 4, 1, 7),
(401, 1, 4, 1, 7),
(402, 1, 4, 1, 7),
(403, 1, 4, 1, 7),
(404, 0, 5, 1, 7),
(405, 1, 1, 1, 8),
(406, 1, 1, 1, 8),
(407, 1, 2, 1, 8),
(408, 1, 3, 1, 8),
(409, 1, 3, 1, 8),
(410, 1, 3, 1, 8),
(411, 1, 3, 1, 8),
(412, 1, 3, 1, 8),
(413, 1, 4, 1, 8),
(414, 1, 4, 1, 8),
(415, 1, 4, 1, 8),
(416, 1, 1, 1, 9),
(417, 1, 1, 1, 9),
(418, 1, 2, 1, 9),
(419, 1, 3, 1, 9),
(420, 1, 3, 1, 9),
(421, 1, 3, 1, 9),
(422, 1, 3, 1, 9),
(423, 1, 3, 1, 9),
(424, 0, 5, 1, 9),
(425, 0, 5, 1, 9),
(426, 0, 5, 1, 9),
(427, 1, 1, 1, 10),
(428, 1, 1, 1, 10),
(429, 1, 2, 1, 10),
(430, 1, 3, 1, 10),
(431, 1, 3, 1, 10),
(432, 1, 3, 1, 10),
(433, 1, 3, 1, 10),
(434, 0, 5, 1, 10),
(435, 0, 5, 1, 10),
(436, 1, 5, 1, 1),
(437, 1, 5, 1, 1),
(438, 1, 5, 1, 1),
(439, 1, 1, 1, 1),
(440, 1, 3, 1, 1),
(441, 1, 3, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`) VALUES
(1, 'None'),
(7, 'Noah'),
(8, 'Matheo'),
(9, 'Mathieu'),
(10, 'Jocelyn'),
(11, 'Michel');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Index pour la table `etats`
--
ALTER TABLE `etats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idmarques_UNIQUE` (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`,`marques_id`,`categories_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_produits_categories_idx` (`categories_id`),
  ADD KEY `fk_produits_marques1_idx` (`marques_id`);

--
-- Index pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`,`etats_id`,`utilisateurs_id`,`produits_id`),
  ADD UNIQUE KEY `dispo_UNIQUE` (`id`),
  ADD KEY `fk_stocks_etats1_idx` (`etats_id`),
  ADD KEY `fk_stocks_utilisateurs1_idx` (`utilisateurs_id`),
  ADD KEY `fk_stocks_produits1_idx` (`produits_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idtable1_UNIQUE` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `etats`
--
ALTER TABLE `etats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=442;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_produits_categories` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produits_marques1` FOREIGN KEY (`marques_id`) REFERENCES `marques` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `fk_stocks_etats1` FOREIGN KEY (`etats_id`) REFERENCES `etats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stocks_produits1` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stocks_utilisateurs1` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
