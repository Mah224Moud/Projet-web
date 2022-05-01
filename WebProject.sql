-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 21 avr. 2022 à 19:48
-- Version du serveur :  8.0.28-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `WebProject`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `questionID` int NOT NULL,
  `userID` int NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `questionID`, `userID`, `comment`, `comment_date`) VALUES
(2, 7, 4, 'vvvnvn', '2022-04-19 15:07:40'),
(3, 7, 6, 'abc', '2022-04-21 12:28:00'),
(4, 7, 6, 'je ne sais pas', '2022-04-21 12:53:58'),
(5, 7, 4, 'je test avec Ily', '2022-04-21 17:18:46'),
(6, 5, 6, 'Contact l\'admin', '2022-04-21 18:35:13'),
(7, 4, 6, 'De quelle documentation tu parles ?', '2022-04-21 18:35:56');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `inscription_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `firstName`, `lastName`, `birthday`, `email`, `username`, `password_`, `inscription_date`, `gender`, `picture`) VALUES
(1, 'Gérant', 'Administrateur', '1997-06-18', 'admin@site.com', 'admin', '$2y$10$CJqnWo6xxZ7dGV5GQcup/.0tXz3z8GHPb4w1EaodwWPQQ7Qc8o54K', '2022-04-17 15:53:26', 'Mr', './Public/Image/hacker-g936fe0f51_1280.png'),
(2, 'DIALLO', 'Mamoudou', '2003-04-24', 'mamoudou@test.com', 'mamoudou', '$2y$10$/PIYhpjvPJ.dh8/fKRGCmOfy02yPGKrp1pvYy94z/0aY6B/9QR0Si', '2022-04-17 18:10:52', 'Mr', './Public/Image/man-gcf7c6bc73_1920.jpg'),
(3, 'DIALLO', 'Mariam', '2001-07-05', 'mariam@test.com', 'mariam', '$2y$10$yhUeB/OrmJla8uThEpR5NuULq0PDFsp7Sf.ccT9BwkfmDgmX7L9HC', '2022-04-17 19:53:14', 'Mlle/Mme', './Public/Image/woman-g6284e71ab_1920.jpg'),
(4, 'DIALLO', 'Abdoul', '2003-04-25', 'abdoul@test.com', 'abdoul', '$2y$10$XDt96rdEg5.1rril79.KDufLYhX1KdGCuouRhryUvrQMXtjgzF6IC', '2022-04-17 19:54:36', 'Mr', './Public/Image/essai4.jpg'),
(5, 'Josh', 'Brandon', '2000-01-01', 'brandon@test.com', 'brandon', '$2y$10$M4KeyB0DSBMLSJ5wlIGXqO7ea.Oa.Nn1q.2mOPqnukV5ZruiHgSZq', '2022-04-18 16:24:46', 'default', './Public/Image/unknow.png'),
(6, 'DIALLO', 'Mamoudou', '2000-01-01', 'doumouma113@gmail.com', 'mamoudou', '$2y$10$HEmwREEseC7XPV7nH7.lf.tWatwDSEnTPnpLdkDGjHtzfxz0/6PAK', '2022-04-18 16:27:48', 'default', './Public/Image/unknow.png'),
(11, 'bah', 'saikou', '2000-01-01', 'hello@gmail.com', 'hello', '$2y$10$76TWY43BXqPBYfr3KQ70EuSkSnjtPg/T8.iT1zlw3wOURLlQuEoua', '2022-04-21 12:33:13', 'default', './Public/Image/unknow.png'),
(12, 'John', 'Barry', '2000-01-01', 'john@test.com', 'john', '$2y$10$egQ4YUDVtZyxbYz4qBFVf.q9wIweglF2I2diHiZOT7X4WNY14fkgO', '2022-04-21 12:59:16', 'default', './Public/Image/unknow.png');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `firstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `message_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `messages` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status_` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'not_verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `firstName`, `lastName`, `email`, `username`, `message_date`, `messages`, `status_`) VALUES
(5, 'Josh', 'Brandon', 'brandon@test.com', 'brandon', '2022-04-18 13:41:52', 'Salut, je vous ecris parce que je n\'arrive pas a creer mon compte. Vous voulez bien m\'aider svp ?', 'verified'),
(7, 'DIALLO', 'Mamoudou', 'doumouma113@gmail.com', 'mamoudou', '2022-04-18 16:55:54', 'J\'aimerais juste confimer que tout marche', 'verified'),
(18, 'bah', 'saikou', 'hello@gmail.com', 'hello', '2022-04-21 12:31:36', 'je n\'arrive pas à créer de compte', 'verified'),
(19, 'DIALLO', 'Mamoudou', 'doumouma113@gmail.com', 'mamoudou', '2022-04-21 12:54:32', 'je ne veux rien', 'verified'),
(20, 'John', 'Barry', 'john@test.com', 'john', '2022-04-21 12:57:03', 'je veux creer un compte', 'verified'),
(21, 'John', 'Barry', 'john@test.com', 'john', '2022-04-21 13:33:57', '&lt;script&gt;alert(\'home\')&lt;/script&gt;<br />\r\n', 'not_verified');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `question_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `userID`, `title`, `content`, `question_date`) VALUES
(1, 3, 'Comment aller en france ?', 'Je me demande comment on fait expliquez-moi svp ', '2022-04-19 01:01:05'),
(2, 5, 'Comment faire du MVC', 'Depuis un moment je me demande', '2022-04-19 01:02:56'),
(3, 4, 'Aller en Egypte', 'Quels sont les documents et la demarche ?', '2022-04-19 01:02:56'),
(4, 6, 'Comment creer une fonction ?', 'Je n\'arrive pas à comprendre la doc en ligne. Qqn pourrait m\'aider', '2022-04-19 12:15:04'),
(5, 6, 'Comment se connecter sur l\'ent ?', 'Je n\'arrive pas acceder à mon compte', '2022-04-19 12:21:02'),
(6, 6, 'Java', 'Quelle est la difference entre JDK et JRE ?', '2022-04-19 12:22:07'),
(7, 3, 'MVC', 'Quelqu\'un pourrait m\'expliquer comment fonctionne le mvc ?', '2022-04-19 13:42:05');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionID` (`questionID`),
  ADD KEY `idUser` (`userID`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `questionID_fk` FOREIGN KEY (`questionID`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `userID_fk` FOREIGN KEY (`userID`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
