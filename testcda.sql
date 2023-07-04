-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 04 juil. 2023 à 11:49
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `testcda`
--

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `Id_products` int(11) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`Id_products`, `productname`, `price`) VALUES
(1, 'Samsung Galaxy S22', '450.00'),
(2, 'Iphone 14', '820.00'),
(3, 'Xiaomi 12 Pro', '300.00'),
(4, 'Honor Magic 4 Pro', '971.00');

-- --------------------------------------------------------

--
-- Structure de la table `sell`
--

CREATE TABLE `sell` (
  `Id_sellers` int(11) NOT NULL,
  `Id_products` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sell`
--

INSERT INTO `sell` (`Id_sellers`, `Id_products`, `quantity`) VALUES
(1, 1, 0),
(1, 2, 2),
(1, 3, 2),
(1, 4, 1),
(2, 1, 2),
(2, 2, 1),
(2, 3, 1),
(2, 4, 0),
(3, 1, 3),
(3, 2, 2),
(3, 3, 0),
(3, 4, 3),
(4, 1, 1),
(4, 2, 3),
(4, 3, 3),
(4, 4, 4),
(5, 1, 4),
(5, 2, 0),
(5, 3, 5),
(5, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `seller`
--

CREATE TABLE `seller` (
  `Id_sellers` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `seller`
--

INSERT INTO `seller` (`Id_sellers`, `name`) VALUES
(1, 'Alexis'),
(3, 'Emmanuelle'),
(4, 'Grégory'),
(2, 'Paul'),
(5, 'Théo');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id_products`),
  ADD UNIQUE KEY `productname` (`productname`);

--
-- Index pour la table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`Id_sellers`,`Id_products`),
  ADD KEY `Id_products` (`Id_products`);

--
-- Index pour la table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`Id_sellers`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `Id_products` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `seller`
--
ALTER TABLE `seller`
  MODIFY `Id_sellers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sell`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `sell_ibfk_1` FOREIGN KEY (`Id_sellers`) REFERENCES `seller` (`Id_sellers`),
  ADD CONSTRAINT `sell_ibfk_2` FOREIGN KEY (`Id_products`) REFERENCES `products` (`Id_products`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
