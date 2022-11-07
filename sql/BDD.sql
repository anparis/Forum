CREATE DATABASE `Forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

CREATE TABLE `appartenir` (
  `topic_id` int NOT NULL,
  `categorie_id` int NOT NULL,
  PRIMARY KEY (`topic_id`,`categorie_id`),
  KEY `appartenir_FK` (`categorie_id`),
  CONSTRAINT `appartenir_FK` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `appartenir_FK_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `datePost` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `utilisateur_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `post_FK` (`utilisateur_id`),
  KEY `post_FK_1` (`topic_id`),
  CONSTRAINT `post_FK` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_FK_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Forum.topic definition

CREATE TABLE `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` tinyint(1) NOT NULL,
  `utilisateur_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `topic_FK_1` (`utilisateur_id`),
  CONSTRAINT `topic_FK_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `mdp` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `dateInscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
