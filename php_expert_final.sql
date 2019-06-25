-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 02 avr. 2019 à 13:54
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `php_expert_final`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(45) NOT NULL,
  `catDescript` mediumtext NOT NULL,
  PRIMARY KEY (`catId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`catId`, `catName`, `catDescript`) VALUES
(1, 'Prospect', 'Premier contact établi'),
(2, 'Client', 'Prospect ayant fait au moins 1 achat'),
(16, 'Ancien client', 'Clients ayant déposé le bilan');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `usId` int(11) NOT NULL AUTO_INCREMENT,
  `usFirstname` varchar(45) NOT NULL,
  `usLastname` varchar(45) NOT NULL,
  `usAddress` varchar(45) NOT NULL,
  `usPostcode` varchar(11) NOT NULL,
  `usCity` varchar(45) NOT NULL,
  `usComment` mediumtext NOT NULL,
  `catId` int(11) NOT NULL,
  `usModifTime` datetime NOT NULL,
  PRIMARY KEY (`usId`),
  KEY `user_category_FK` (`catId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`usId`, `usFirstname`, `usLastname`, `usAddress`, `usPostcode`, `usCity`, `usComment`, `catId`, `usModifTime`) VALUES
(1, 'Gautier', 'Le Hir                                       ', ' rue de la Loire', '44030      ', 'Le Loroux', 'Yep', 1, '2019-03-31 22:04:37'),
(2, 'Julie', 'Padileau', 'Pas trop loin', '44000      ', 'Nantes', 'Long time no see', 2, '2019-04-01 09:56:08'),
(25, 'prospect 2', 'prospect 2                                   ', 'prospect 2', '14000', 'prospect 2', 'prospect 2', 1, '2019-04-02 10:46:50'),
(26, 'client 2', 'client 2                                     ', 'client 2', '29000', 'client 2', 'client 2', 2, '2019-04-02 10:47:23'),
(27, 'jhgjhgj', 'jhg                                          ', 'jhgjh', '12345', 'hgfhgf', '', 2, '2019-04-02 12:33:15'),
(28, 'gfdgf', 'fgdgfd', 'gfdgfd', '12345', 'hjgjhgjh', '', 2, '2019-04-02 12:29:51');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_category_FK` FOREIGN KEY (`catId`) REFERENCES `category` (`catId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
