-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1:3306
-- Généré le :  Lun 10 Juillet 2017 à 05:49
-- Version du serveur :  5.6.34-log
-- Version de PHP :  7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `categorie`) VALUES
(3, 'HTML'),
(4, 'CSS'),
(5, 'Javascript'),
(6, 'PHP');

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

CREATE TABLE IF NOT EXISTS `sous_categories` (
  `id` int(12) NOT NULL,
  `id_categories` int(12) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id`, `id_categories`, `name`) VALUES
(5, 3, 'Discution Général'),
(6, 4, 'Discution Général'),
(7, 5, 'Discution Général'),
(8, 6, 'Discution Général'),
(9, 3, 'Cours'),
(10, 4, 'Cours'),
(11, 5, 'Cours'),
(12, 6, 'Cours'),
(13, 3, 'Tutoriels'),
(14, 4, 'Tutoriels'),
(15, 5, 'Tutoriels'),
(16, 6, 'Tutoriels'),
(17, 3, 'Demande d''aide'),
(18, 4, 'Demande d''aide'),
(19, 5, 'Demande d''aide'),
(20, 6, 'Demande d''aide');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE IF NOT EXISTS `sujet` (
  `sujet_id` int(12) NOT NULL,
  `sujet_id_sous_categorie` int(12) NOT NULL,
  `sujet_titre` varchar(255) NOT NULL,
  `sujet_contenue` text NOT NULL,
  `sujet_date` varchar(8) NOT NULL,
  `sujet_user_id` int(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `path_avatar` varchar(255) NOT NULL,
  `date_creation` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `path_avatar`, `date_creation`) VALUES
(1, 'zouki', 'admin', 'zouki.dev@gmail.com', 'images/empty_avatar.png', ''),
(2, 'test', 'test', 'test@gmail.com', 'images/empty_avatar.png', '07/07/17'),
(3, 'admin', 'admin', 'admin@gmail.com', 'images/empty_avatar.png', '07/07/17'),
(5, 'sffsddsf', 'admin', 'admin@gmail.com', 'images/empty_avatar.png', '07/07/17'),
(6, 'sqdksqdk', 'ksdqkdkls', 'kskqldklqds', 'images/empty_avatar.png', '07/07/17');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categories` (`id_categories`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`sujet_id`),
  ADD KEY `id_sous_categorie` (`sujet_id_sous_categorie`),
  ADD KEY `user_id` (`sujet_user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `sujet_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `sujet_ibfk_1` FOREIGN KEY (`sujet_id_sous_categorie`) REFERENCES `sous_categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
