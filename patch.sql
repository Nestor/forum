-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Lun 10 Juillet 2017 à 16:55
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `forumDB`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `sous_categories` (
  `id` int(12) NOT NULL,
  `id_categories` int(12) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(17, 3, 'Demande d\'aide'),
(18, 4, 'Demande d\'aide'),
(19, 5, 'Demande d\'aide'),
(20, 6, 'Demande d\'aide');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `sujet_id` int(12) NOT NULL,
  `sujet_id_sous_categorie` int(12) NOT NULL,
  `sujet_titre` varchar(255) NOT NULL,
  `sujet_contenue` text NOT NULL,
  `sujet_date` varchar(8) NOT NULL,
  `sujet_user_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sujet`
--

INSERT INTO `sujet` (`sujet_id`, `sujet_id_sous_categorie`, `sujet_titre`, `sujet_contenue`, `sujet_date`, `sujet_user_id`) VALUES
(2, 5, 'teste des sujet', 'ceci est un teste afin de remplir le forum est de le design', '10/07/17', 1),
(3, 5, 'ssalut à tous', '<p>bonjour &agrave; tous comment allez vous ?</p>', '10/07/17', 1),
(4, 5, 'ssalut à tous', '<p>bonjour &agrave; tous comment allez vous ?</p>', '10/07/17', 1),
(5, 14, '[TUTO] CSS les sélecteur', '<p>En css il existe diff&eacute;rent s&eacute;lecteurs</p>\r\n<p>en voici quelque-un</p>\r\n<p style=\"padding-left: 30px;\">#div</p>\r\n<p style=\"padding-left: 30px;\">.class</p>\r\n<p style=\"padding-left: 30px;\">:hover</p>', '10/07/17', 1),
(6, 7, 'tuto javascript', '<p>NONNN !</p>', '10/07/17', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sujet_response`
--

CREATE TABLE `sujet_response` (
  `msg_id` int(12) NOT NULL,
  `msg_sujet_id` int(12) NOT NULL,
  `msg_contenue` text NOT NULL,
  `msg_date` varchar(8) NOT NULL,
  `msg_user_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sujet_response`
--

INSERT INTO `sujet_response` (`msg_id`, `msg_sujet_id`, `msg_contenue`, `msg_date`, `msg_user_id`) VALUES
(1, 2, '&lt;p&gt;bonjour &amp;agrave; tous&lt;/p&gt;', '10/07/17', 1),
(6, 2, '&lt;p&gt;sqfdsfdsfdf&lt;/p&gt;', '10/07/17', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `path_avatar` varchar(255) NOT NULL,
  `date_creation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `path_avatar`, `date_creation`) VALUES
(1, 'zouki', 'admin', 'zouki.dev@gmail.com', 'images/empty_avatar.png', '07/07/17'),
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
-- Index pour la table `sujet_response`
--
ALTER TABLE `sujet_response`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `msg_sujet_id` (`msg_sujet_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `sujet_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `sujet_response`
--
ALTER TABLE `sujet_response`
  MODIFY `msg_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `sujet_ibfk_1` FOREIGN KEY (`sujet_id_sous_categorie`) REFERENCES `sous_categories` (`id`);

--
-- Contraintes pour la table `sujet_response`
--
ALTER TABLE `sujet_response`
  ADD CONSTRAINT `sujet_response_ibfk_1` FOREIGN KEY (`msg_sujet_id`) REFERENCES `sujet` (`sujet_id`);
