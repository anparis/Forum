<?php
$posts = $result["data"]["posts"];
$topics = $result["data"]["topics"];
$user = $result["data"]["user"];
?>
<div class="profil-container">
<figure>
    <div class="img-overflow">
        <a class="avatar-upload" href="index.php?ctrl=security&action=viewProfile&id=<?= $user->getId() ?>"><span class="fas fa-file-upload"></span></a>
        <img src="<?= $user->getAvatar() ?>" alt="pixel-art as default user avatar">
    </div>
    <!-- Want to upload the file using ajax but I only use php -->
    <form id="target" action="index.php?ctrl=security&action=fileUpload&id=<?= $user->getId() ?>" method="POST" enctype="multipart/form-data">
        <input id="img-upload" type="file" name="img">
        <input id="img-send" type="submit" name="submitAvatar">
    </form>
</figure>
<h1>Profil</h1>
<p>Pseudo : <?= $_SESSION['user'] ?></p>
<p>Email : <?= $_SESSION['user']->getEmail() ?></p>
<?php 
if($posts == NULL) {?>
    <p>Nombre de participations : 0</p>
    <p>Voir les sujets : <a href="index.php?ctrl=forum&action=listPostsByTopics"><button class="add-topic-post" >Voir les sujets</button></a></p>
<?php } else { ?>
    <p>Nombre de Messages :
    <?php $count = 0;
    foreach($posts as $post){
        $count++;
    } echo $count; ?>
    </p>
<?php } ?>

<?php 
if($topics == NULL) {?>
    <p>Vous avez crée 0 sujets.</p>
    <p>Créer mon premier sujet : <a href="index.php?ctrl=forum&action=addTopics"><button class="add-topic-post" >+ Ajouter un sujet</button></a></p>
<?php } else { ?>
    <?php $count = 0;
    foreach($topics as $topic){
        $count++;
     } ?>
     <p>Vous avez crée <?= $count ?> sujets</p>
<?php } ?>
</div>