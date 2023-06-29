-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 28 juin 2023 à 09:10
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
-- Base de données : `gestions_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Travail'),
(2, 'Personnel'),
(3, 'Études'),
(4, 'Famille'),
(5, 'Loisirs'),
(6, 'Santé'),
(7, 'Finances'),
(8, 'Voyages'),
(9, 'Projet'),
(10, 'Administration'),
(11, 'Sport'),
(12, 'Social'),
(13, 'Cuisine'),
(14, 'Technologie'),
(15, 'Art'),
(16, 'Musique'),
(17, 'Livres'),
(18, 'Film'),
(19, 'Mode'),
(20, 'Nature');

-- --------------------------------------------------------

--
-- Structure de la table `priorites`
--

CREATE TABLE `priorites` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `priorites`
--

INSERT INTO `priorites` (`id`, `nom`) VALUES
(1, 'Très faible'),
(2, 'Faible'),
(3, 'Moyenne'),
(4, 'Élevée'),
(5, 'Très élevée');

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `debut` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `priorite_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `taches`
--

INSERT INTO `taches` (`id`, `titre`, `description`, `debut`, `fin`, `categorie_id`, `priorite_id`) VALUES
(2, 'jus d\'orange', 'je veux le coca ', '2023-06-27 22:20:00', '2023-06-28 10:20:00', 18, 2),
(3, 'jus d\'orange', 'wjszhhkhekzhehkshzhdhxhhzdhkhdkzdkhkhdkhkhdkhzkhdkz', '2023-06-27 23:38:00', '2023-06-27 23:40:00', 7, 3),
(4, 'jus d\'orange', 'wjszhhkhekzhehkshzhdhxhhzdhkhdkzdkhkhdkhkhdkhzkhdkz', '2023-06-27 23:38:00', '2023-06-27 23:40:00', 7, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `priorites`
--
ALTER TABLE `priorites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `priorite_id` (`priorite_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `taches`
--
ALTER TABLE `taches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `taches`
--
ALTER TABLE `taches`
  ADD CONSTRAINT `taches_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `taches_ibfk_2` FOREIGN KEY (`priorite_id`) REFERENCES `priorites` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
