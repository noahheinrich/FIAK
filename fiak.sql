-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 14 juin 2023 à 13:38
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
(4, 'Mauvaise état'),
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
(30, 'Toshiba');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prix` int(11) NOT NULL,
  `image_path` varchar(45) NOT NULL,
  `marques_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `stock_disponible` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `image_path`, `marques_id`, `categories_id`, `stock_disponible`) VALUES
(1, 'Iphone 14 Pro', 1229, ' img/products/Iphone 14 Pro.png', 10, 5, 2),
(2, 'Iphone 13', 859, ' img/products/Iphone 13.png', 10, 5, 1),
(3, 'Samsung Galaxy A72', 614, ' img/products/Samsung Galaxy A72.png', 15, 5, 0),
(4, 'Samsung Galaxy S23', 959, ' img/products/Samsung Galaxy S23.png', 18, 5, 0),
(5, 'Xiaomi Redmi Note 12', 249, ' img/products/Xiaomi Redmi Note 12.png', 5, 5, 0),
(6, 'Xiaomi 13', 999, ' img/products/Xiaomi 13.png', 8, 5, 0),
(7, 'Oppo Find X5 ', 544, ' img/products/Oppo Find X5.png', 3, 5, 0),
(8, 'Oppo A94', 329, ' img/products/Oppo A94.png', 11, 5, 0),
(9, 'Huawei P30 Pro', 385, ' img/products/Huawei P30 Pro.png', 14, 5, 0),
(10, 'Huawei P50 Pocket', 707, ' img/products/Huawei P50 Pocket.png', 7, 5, 0),
(11, 'Asus Zenbook 13', 1140, ' img/products/Asus Zenbook 13.png', 7, 2, 0),
(12, 'HP Pavillon 14', 900, ' img/products/HP Pavillon 14.png', 17, 2, 0),
(13, 'Lenovo Yoga Slim 7 Pro', 1000, ' img/products/Lenovo Yoga Slim 7 Pro.png', 10, 2, 0),
(14, 'MSI Optix G241', 185, ' img/products/MSI Optix G241.png', 12, 2, 0),
(15, 'Ipad Pro 11 M2', 1069, ' img/products/Ipad Pro 11 M2.png', 7, 2, 0),
(16, 'Logitech Ergo K860', 95, ' img/products/Logitech Ergo K860.png', 1, 2, 0),
(17, 'Razer BlackWidow V3 Tenkeyless', 80, ' img/products/Razer BlackWidow V3 Tenkeyl', 3, 2, 0),
(18, 'Corsair K70 RGB ', 190, ' img/products/Corsair K70 RGB.png', 6, 2, 0),
(19, 'HP OMEN 600', 68, ' img/products/HP OMEN 600.png', 13, 2, 0),
(20, 'Apple Magic Mouse', 110, ' img/products/Apple Magic Mouse.png', 9, 2, 0),
(21, 'Sony A7 III', 1900, 'img/products/Sony A7 III.png', 8, 3, 1),
(22, 'Panasonic DC-FZ82 EF-K', 340, 'img/products/Panasonic DC-FZ82 EF-K.png', 7, 3, 0),
(23, 'Fujifilm Instax Mini 40', 110, 'img/products/Fujifilm Instax Mini 40.png', 5, 3, 0),
(24, 'Panasonic DMC-FZ300', 500, 'img/products/Panasonic DMC-FZ300.png', 10, 3, 0),
(25, 'Panasonic DC-GX9', 749, 'img/products/Panasonic DC-GX9.png', 12, 3, 0),
(26, 'Canon EOS R50', 829, 'img/products/Canon EOS R50.png', 14, 3, 0),
(27, 'Sony Alpha 7C', 1899, 'img/products/Sony Alpha 7C.png', 9, 3, 0),
(28, 'Nikon Kit Z 30', 900, 'img/products/Nikon Kit Z 30.png', 4, 3, 0),
(29, 'Nikon Z6', 1791, 'img/products/Nikon Z6.png', 6, 3, 0),
(30, 'Panasonic Lumix S5', 1756, 'img/products/Panasonic Lumix S5.png', 4, 3, 0),
(31, 'Sony WH-1000XM4', 330, 'img/products/WF-1000XM4.png', 15, 1, 2),
(32, 'Bose QC45', 260, 'img/products/Bose QC45.png', 12, 1, 0),
(33, 'Apple AirPods Max', 593, 'img/products/Apple AirPods Max.png', 18, 1, 0),
(34, 'Sony WF-1000XM4', 230, 'img/products/Sony WH-1000XM4.png', 11, 1, 0),
(35, 'Bose QC Earbuds II', 285, 'img/products/Bose QC Earbuds II.png', 8, 1, 0),
(36, 'Apple AirPods Pro 2', 269, 'img/products/Apple AirPods Pro 2.png', 13, 1, 0),
(37, 'Jbl Flip 5', 100, 'img/products/JBL Flip 5.png', 9, 1, 0),
(38, 'Marshall Acton II', 270, 'img/products/Marshall Acton II.png', 19, 1, 0),
(39, 'Marshall Emberton', 126, 'img/products/Marshall Emberton.png', 12, 1, 0),
(40, 'Sony WH-1000XM5', 420, 'img/products/Sony WH-1000XM5.png', 20, 1, 0),
(41, 'TCL 55P638', 399, 'img/products/TCL 55P638.png', 3, 4, 1),
(42, 'Sony Bravia XR-55A80J', 1190, 'img/products/Sony Bravia XR-55A80J.png', 5, 4, 0),
(43, 'LG OLED55CS', 1210, 'img/products/LG OLED55CS.png', 12, 4, 0),
(44, 'LG OLEDOLED48C2', 1199, 'img/products/LG OLED48C2.png', 4, 4, 0),
(45, 'Samsung TU75CU7105', 899, 'img/products/Samsung TU75CU7105.png', 8, 4, 0),
(46, 'Sony XR75X94K', 1490, 'img/products/Sony XR75X94K.png', 9, 4, 0),
(47, 'TCL 65C735', 849, 'img/products/TCL 65C735.png', 3, 4, 0),
(48, 'Samsung TQ75Q80C', 2075, 'img/products/Samsung TQ75Q80C.png', 11, 4, 0),
(49, 'LG OLED65C2', 1990, 'img/products/LG OLED65C2.png', 6, 4, 0),
(50, 'Samsung QE55Q82B', 499, 'img/products/Samsung QE55Q82B.png', 7, 4, 0);

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
(1, 0, 3, 1, 1),
(2, 0, 1, 1, 11),
(3, 1, 2, 1, 21),
(4, 0, 2, 4, 31),
(5, 1, 4, 1, 41),
(6, 1, 3, 1, 1),
(7, 1, 3, 1, 1),
(8, 1, 3, 1, 2),
(9, 0, 1, 5, 31),
(10, 1, 4, 4, 31),
(11, 1, 4, 4, 31),
(12, 0, 5, 4, 31);

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
(2, 'User 1'),
(3, 'User 2'),
(4, 'User 3'),
(5, 'User 4'),
(6, 'User 5');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `etats`
--
ALTER TABLE `etats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
