-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2016 at 11:57 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tinyMVC`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL COMMENT 'Clé primaire',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'indique si la conversation est active',
  `theme` varchar(40) CHARACTER SET latin1 NOT NULL COMMENT 'Thème de la conversation'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `active`, `theme`) VALUES
(1, 1, 'Le Web en EBM'),
(2, 1, 'Les qualifs de foot pour la France');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL COMMENT 'Identifiant du message',
  `idConversation` int(11) NOT NULL COMMENT 'Clé étrangère vers la table des conversations',
  `idAuteur` int(11) NOT NULL COMMENT 'clé étrangère vers la table des auteurs',
  `contenu` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Contenu du message'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `idConversation`, `idAuteur`, `contenu`) VALUES
(1, 1, 3, 'Que penses-tu de la nouvelle organisation des cours en EBM ? Pas mal, non ?'),
(2, 2, 4, 'Que va faire la France, cette fois-ci ?'),
(3, 2, 3, 'Elle se qualifiera pour le mondial !'),
(6, 2, 4, 'Hum... Pas sûr... espérons-le ! '),
(5, 1, 4, 'Oui, tu as raison');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'clé primaire, identifiant numérique auto incrémenté',
  `pseudo` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'pseudo',
  `passe` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'mot de passe',
  `blacklist` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indique si l''utilisateur est en liste noire',
  `admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indique si l''utilisateur est un administrateur',
  `couleur` varchar(10) CHARACTER SET latin1 NOT NULL DEFAULT 'black' COMMENT 'indique la couleur préférée de l''utilisateur, en anglais'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `passe`, `blacklist`, `admin`, `couleur`) VALUES
(3, 'tom', 'ebm', 0, 1, 'orange'),
(4, 'jpb', 'maestro', 0, 0, 'green');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du message', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'clé primaire, identifiant numérique auto incrémenté', AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
