CREATE TABLE visiteur(
   id_visiteur int NOT NULL AUTO_INCREMENT,
   mdp VARCHAR(255) NOT NULL,
   pseudo VARCHAR(50) NOT NULL,
   date_inscription DATE NOT NULL,
   role VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_visiteur)
);

CREATE TABLE categorie(
   id_categorie int NOT NULL AUTO_INCREMENT,
   nom VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_categorie)
);

CREATE TABLE topic(
   id_topic int NOT NULL AUTO_INCREMENT,
   titre VARCHAR(50) NOT NULL,
   date_creation DATE NOT NULL,
   id_categorie INT NOT NULL,
   id_visiteur INT NOT NULL,
   PRIMARY KEY(id_topic),
   FOREIGN KEY(categorie_id) REFERENCES categorie(id_categorie),
   FOREIGN KEY(visiteur_id) REFERENCES visiteur(id_visiteur)
);

CREATE TABLE post(
   id_post int NOT NULL AUTO_INCREMENT,
   text TEXT NOT NULL,
   date_post VARCHAR(50),
   id_visiteur INT NOT NULL,
   id_topic INT NOT NULL,
   PRIMARY KEY(id_post),
   FOREIGN KEY(visiteur_id) REFERENCES visiteur(id_visiteur),
   FOREIGN KEY(topic_id) REFERENCES topic(id_topic)
);
