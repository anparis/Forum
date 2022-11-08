<?php
$categories = $result["data"]['categories'];
$topics = $result["data"]['topics'];
?>
<h1><?=$categories->getNom()?></h1>
<hr>
<?php
foreach($topics as $topic){
    ?>
    <section id="topiclist">
        <a href='index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>'>
        <p><?=$topic->getTitle()?></p>
        </a>
        <p>Created by <?=$topic->getUtilisateur()->getPseudo()?></p>
        <p><?=$topic->getDateCreation()?></p>
    </section>
    <?php
}
