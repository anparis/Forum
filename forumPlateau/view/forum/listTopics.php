<?php

$topics = $result["data"]['topics'];
?>

<h1>liste topics</h1>

<?php
foreach ($topics as $topic) {
?>
    <section id="topiclist">
        <a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'>
            <p><?= $topic->getTitle() ?></p>
        </a>
        <p>Created by <?= $topic->getUtilisateur()->getPseudo() ?></p>
        <p><?= $topic->getDateCreation() ?></p>
        <section id="categorielist">
            <a href='index.php?ctrl=forum&action=listCategories&id=<?= $topic->getCategorie()->getId() ?>'>
                <?= $topic->getCategorie()->getNom() ?>
            </a>
        </section>
    </section>
<?php
}
?>
<a href='index.php?ctrl=forum&action=addTopics'>Ajouter un sujet</a>
