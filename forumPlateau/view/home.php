<?php
$topics = $result["data"]['topics'];
?>
<div class="home">
<h1>Bienvenue sur le forum!</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>
</div>
<h2 class="form-title">Sujets ajoutés récemment : </h2>
<div class="home-topics">
    <?php
    foreach ($topics as $topic) {
    ?>
        <article class="first5-topics">
            <section class="topic-head">
                <a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'>
                    <p class="topic-title"><?= $topic->getTitle() ?></p>
                </a>
            </section>

            <section class="topic-info">
                <p>Posted by <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?= $topic->getUtilisateur()->getId() ?>"><?= $topic->getUtilisateur()->getPseudo() ?></a></p>
                <p><?= $topic->getDateCreation() ?></p>
            </section>
            <section id="categorielist">
                <a href='index.php?ctrl=forum&action=listCategories&id=<?= $topic->getCategorie()->getId() ?>'>
                    <?= $topic->getCategorie()->getNom() ?>
                </a>
            </section>
        </article>
    <?php
    } ?>
</div>