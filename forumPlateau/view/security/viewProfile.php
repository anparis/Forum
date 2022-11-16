<?php
$posts = $result["data"]["posts"];
$topics = $result["data"]["topics"];

?>
<h1>Profil</h1>
<p>Pseudo : <?= $_SESSION['user'] ?></p>
<p>Email : <?= $_SESSION['user']->getEmail() ?></p>
<?php 
if($posts == NULL) {?>
    <p>Nombre de participations : 0</p>
    <p>Voir les sujets : <a href="index.php?ctrl=forum&action=listPostsByTopics"><button class="add-topic-post" >Voir les sujets</button></a></p>
<?php } else { ?>
    <p>Nombre de participations :
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
    <h3>Vous avez crée les sujets suivants :</h3>
    <?php $count = 0;
    foreach($topics as $topic){?>
        <a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'>
            <p><?= $topic->getTitle() ?></p>
        </a>
    <?php  $count++;
     } ?>
     <p>Total de mes sujets = <?= $count ?>.</p>
<?php } ?>