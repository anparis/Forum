<?php

$topics = $result["data"]['topics'];
?>


<h1>liste topics</h1>

<?php if(isset($_SESSION['user'])){?>
    <a href='index.php?ctrl=forum&action=addTopics'>Ajouter un sujet</a>
    
<?php } foreach ($topics as $topic) {
?>
    <section id="topiclist">
        <a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'>
            <p><?= $topic->getTitle() ?></p>
        </a>
        <p>Created by <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?=$topic->getUtilisateur()->getId()?>"><?=$topic->getUtilisateur()->getPseudo()?></a></p>
        <p><?= $topic->getDateCreation() ?></p>
        <section id="categorielist">
            <a href='index.php?ctrl=forum&action=listCategories&id=<?= $topic->getCategorie()->getId() ?>'>
                <?= $topic->getCategorie()->getNom() ?>
            </a>
        </section>
        <section id="statut">
            <p><?php 
            if($topic->getStatut()){
                echo "<p><span class='fas fa-lock-open'></span> publique</p>";
            }
            else
                echo "<p><span class='fas fa-lock'></span> privée</p>";
              ?>
            </p>
        </section>
    </section>
<?php
}
?>