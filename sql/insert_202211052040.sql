INSERT INTO Forum.categorie (nom) VALUES
	 ('javascript'),
	 ('php');
INSERT INTO Forum.post (`text`,datePost,utilisateur_id,topic_id) VALUES
	 ('How do i create an array where deconstructed or deleted objects are saved in. I wrote the code below but it doesnt work.The goal is to add usernames of deconstructed users into the array deletedUsers.','2022-11-05 20:11:55',1,2),
	 ('good afternoon, I have tried to make a mini app where when you click the button a fetch is made to the backend and it returns a little information. But my problem is that the call goes well, since it returns a 200 as status, but the information does not arrive.','2022-11-05 20:14:04',1,1);
INSERT INTO Forum.topic (titre,dateCreation,statut,utilisateur_id,categorie_id) VALUES
	 ('Send data from server to client with vanilla nodejs and javascript','2022-11-05 19:59:08',0,1,1),
	 ('How to place "deleted" objects into an array?','2022-11-05 20:01:21',1,1,2);
INSERT INTO Forum.utilisateur (mdp,pseudo,dateInscription,`role`) VALUES
	 ('harden','james','2022-11-05 18:05:57','user');
