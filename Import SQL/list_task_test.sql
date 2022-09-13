-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 sep. 2022 à 12:33
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `list_task`
--

-- --------------------------------------------------------

--
-- Structure de la table `contain`
--

DROP TABLE IF EXISTS `contain`;
CREATE TABLE IF NOT EXISTS `contain` (
  `id_task` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  PRIMARY KEY (`id_task`,`id_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contain`
--

INSERT INTO `contain` (`id_task`, `id_theme`) VALUES
(1, 4),
(1, 10),
(2, 3),
(2, 5),
(3, 2),
(4, 1),
(4, 4),
(4, 5),
(5, 3),
(5, 8),
(6, 1),
(6, 3),
(7, 2),
(7, 3),
(8, 7),
(9, 1),
(9, 8),
(10, 5);

-- --------------------------------------------------------

--
-- Structure de la table `share`
--

DROP TABLE IF EXISTS `share`;
CREATE TABLE IF NOT EXISTS `share` (
  `id_users` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  PRIMARY KEY (`id_users`,`id_task`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id_task` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `color` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `date_reminder` date NOT NULL,
  `done` tinyint(1) NOT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id_task`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id_task`, `description`, `color`, `priority`, `date_reminder`, `done`, `id_users`) VALUES
(1, 'Bact smear-eye', 3, 3, '2022-09-07', 0, 2),
(2, 'Aorta resection & anast', 7, 3, '2022-09-14', 0, 6),
(3, 'Urethral dx proc NEC', 1, 4, '2022-09-13', 1, 6),
(4, 'Detach ret photocoag NOS', 2, 1, '2022-09-11', 0, 3),
(5, 'Pressure dressing applic', 4, 4, '2022-09-12', 0, 7),
(6, 'Excision of elbow NEC', 8, 4, '2022-09-09', 0, 7),
(7, 'Remov trunk packing NEC', 5, 3, '2022-09-07', 1, 3),
(8, 'Respiratory measure NEC', 2, 5, '2022-09-13', 0, 4),
(9, 'Myelomeningocel repair', 6, 5, '2022-09-08', 1, 10),
(10, 'Excis cyst duct remnant', 3, 3, '2022-09-11', 0, 8);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `theme_name`) VALUES
(1, 'Travail'),
(2, 'Projet Web'),
(3, 'Maison'),
(4, 'Recherche de stage'),
(5, 'Sport'),
(6, 'Divertissement'),
(7, 'Vacances'),
(8, 'Apprentissage');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `user_name`, `password`) VALUES
(1, 'mcruz0', 'yUyncQgfge'),
(2, 'nlippard1', 'aWpBJq'),
(3, 'sfoynes2', '0zQUpNfXRM'),
(4, 'ewindus3', '5KN2tz6FD'),
(5, 'abaniard4', '261TGKO'),
(6, 'mgrealey5', 'N9dWJRKTB'),
(7, 'dbru6', 'z046EwpCquXv'),
(8, 'worrill7', '1kGJxC5l8'),
(9, 'clamont8', 'aFKKQeNLIo'),
(10, 'jcreigan9', '0HxLqrhB');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
