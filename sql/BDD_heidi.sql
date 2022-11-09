-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table forum. categorie
DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table forum.categorie : ~3 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
	(1, 'javascript'),
	(2, 'php'),
	(17, 'ocaml');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table forum. post
DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `datePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `utilisateur_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `post_FK` (`utilisateur_id`),
  KEY `post_FK_1` (`topic_id`),
  CONSTRAINT `post_FK` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_FK_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table forum.post : ~3 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id_post`, `text`, `datePost`, `utilisateur_id`, `topic_id`) VALUES
	(8, 'How do i create an array where deconstructed or deleted objects are saved in. I wrote the code below but it doesnt work.The goal is to add usernames of deconstructed users into the array deletedUsers.', '2022-11-05 20:11:55', 1, 2),
	(9, 'good afternoon, I have tried to make a mini app where when you click the button a fetch is made to the backend and it returns a little information. But my problem is that the call goes well, since it returns a 200 as status, but the information does not arrive.', '2022-11-05 20:14:04', 1, 1),
	(13, 'help java fonction get', '2022-11-09 15:39:33', 1, 15);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Listage de la structure de la table forum. topic
DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  `utilisateur_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `topic_FK_1` (`utilisateur_id`),
  KEY `topic_FK_2` (`categorie_id`),
  CONSTRAINT `topic_FK_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `topic_FK_2` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table forum.topic : ~3 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `titre`, `dateCreation`, `statut`, `utilisateur_id`, `categorie_id`) VALUES
	(1, 'Send data from server to client with vanilla nodejs and javascript', '2022-11-05 19:59:08', 0, 1, 1),
	(2, 'How to place "deleted" objects into an array?', '2022-11-05 20:01:21', 1, 1, 2),
	(15, 'java problem', '2022-11-09 15:39:33', 1, 1, 17);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum. utilisateur
DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table forum.utilisateur : ~2 rows (environ)
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`id_utilisateur`, `email`, `mdp`, `pseudo`, `dateInscription`, `role`) VALUES
	(1, 'james@orange.fr', 'harden', 'james', '2022-11-05 18:05:57', 'user'),
	(4, 'll@s.fr', '$2y$10$Mwmawr7xadrEmZE0ScjvR.8wmgsysPE25HrEsTbsGWv0TR1xug5OW', 'hello', '2022-11-09 09:22:43', 'user');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
