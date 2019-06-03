-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 03 juin 2019 à 08:31
-- Version du serveur :  10.3.13-MariaDB
-- Version de PHP :  7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tiny_mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL COMMENT 'Clé primaire',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'indique si la conversation est active',
  `theme` varchar(40) CHARACTER SET latin1 NOT NULL COMMENT 'Thème de la conversation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `active`, `theme`) VALUES
(2, 1, 'Les qualifs de foot pour la France'),
(14, 1, 'Sport'),
(18, 1, 'La Philosophie');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL COMMENT 'Identifiant du message',
  `idConversation` int(11) NOT NULL COMMENT 'Clé étrangère vers la table des conversations',
  `idAuteur` int(11) NOT NULL COMMENT 'clé étrangère vers la table des auteurs',
  `contenu` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Contenu du message'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `idConversation`, `idAuteur`, `contenu`) VALUES
(2, 2, 4, 'Que va faire la France, cette fois-ci ?'),
(3, 2, 3, 'Elle se qualifiera pour le mondial !'),
(6, 2, 4, 'Hum... Pas sûr... espérons-le ! '),
(7, 14, 2, 'Coucou'),
(13, 2, 7, '<h1>Coucou</h1>'),
(17, 14, 7, 'zefze'),
(20, 14, 7, '&lt;h1&gt;gg&lt;/h1&gt;'),
(21, 18, 7, 'Coucou'),
(22, 18, 7, 'comment ca va'),
(25, 2, 8, 'allez zidane');

-- --------------------------------------------------------

--
-- Structure de la table `parrainage`
--

CREATE TABLE `parrainage` (
  `id` int(11) NOT NULL,
  `pseudo_parrain` varchar(255) NOT NULL,
  `email_ami` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `parrainage`
--

INSERT INTO `parrainage` (`id`, `pseudo_parrain`, `email_ami`) VALUES
(1, 'root', 'test@gmail.com'),
(2, 'root', 'toma@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'clé primaire, identifiant numérique auto incrémenté',
  `pseudo` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'pseudo',
  `passe` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'mot de passe',
  `blacklist` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'indique si l''utilisateur est en liste noire',
  `admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'indique si l''utilisateur est un administrateur',
  `couleur` varchar(10) CHARACTER SET latin1 NOT NULL DEFAULT 'black' COMMENT 'indique la couleur préférée de l''utilisateur, en anglais'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `passe`, `blacklist`, `admin`, `couleur`) VALUES
(3, 'tom', 'ebm', 0, 1, 'blue'),
(4, 'jpb', 'maestro', 0, 0, 'green'),
(6, 'Adrien', 'ebm', 1, 0, 'orange'),
(7, 'root', 'root', 0, 1, 'orange'),
(8, 'toto', 'tt', 0, 0, 'red'),
(10, 'test', 'test', 0, 0, 'red'),
(11, 'adrien', 'adrien', 0, 0, 'black');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idConversation` (`idConversation`);

--
-- Index pour la table `parrainage`
--
ALTER TABLE `parrainage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du message', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `parrainage`
--
ALTER TABLE `parrainage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire, identifiant numérique auto incrémenté', AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`idConversation`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
