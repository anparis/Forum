<?php
$categories = $result["data"]['categories'];
$topics = $result["data"]['topics'];
?>
<a href="index.php?ctrl=forum&action=listCategories"><-Revenir aux catégories</a>
<h1 class="form-title"><?=$categories->getNom()?></h1>
<a href='index.php?ctrl=forum&action=addTopics&id=<?= $categories->getId() ?>'><button class="add-topic-post">+ Ajouter un sujet</button></a>

<?php 
if($topics){
if (isset($_SESSION['user']) && !$_SESSION['user']->getBan()) {
?>
    <?php
    foreach ($topics as $topic) {
    ?>
        <article id="topic-list">
            <section class="topic-head">
                <a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'>
                    <p class="topic-title"><?= $topic->getTitle() ?></p>
                </a>
                <?php if ($topic->getUtilisateur()->getEmail() === $_SESSION['user']->getEmail() || $_SESSION['user']->hasRole('admin')) { ?>
                    <section id="statut">
                        <p><?= $topic->getNbPosts() ?> <span class="fas fa-comment"></span></p>
                        <?php if ($topic->getStatut()) { ?>
                            <a href='index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId() ?>'><span class='fas fa-lock-open'></span></a>
                        <?php } else {
                        ?>
                            <a href='index.php?ctrl=forum&action=unlockTopic&id=<?= $topic->getId() ?>'><span class='fas fa-lock'></span></a>
                        <?php } ?>
                    </section>
                <?php } else { ?>
                    <section id="statut">
                        <?php if ($topic->getStatut()) {
                            echo "<p><span class='fas fa-lock-open'></span></p>"; ?>
                    <?php } else {
                            echo "<p><span class='fas fa-lock'></span></p>";
                        }
                    } ?>
                    </section>
            </section>

            <?php if ($topic->getUtilisateur()->getEmail() === $_SESSION['user']->getEmail() || $_SESSION['user']->hasRole('admin')) { ?>
                <section id="edit-del-post">
                    <a href='index.php?ctrl=forum&action=editTopics&id=<?= $topic->getId() ?>'>Editer</a>
                    <a class="delete-btn" href="index.php?ctrl=forum&action=delTopics&id=<?= $topic->getId() ?>">Supprimer</a>
                </section>
            <?php } ?>
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
    }
 } else {
    foreach ($topics as $topic) {
    ?>
        <article id="topic-list">
            <section class="topic-head">
                <a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'>
                    <p class="topic-title f-w"><?= $topic->getTitle() ?></p>
                </a>
                <section id="statut">
                    <?php if ($topic->getStatut()) {
                        echo "<p><span class='fas fa-lock-open'></span></p>"; ?>
                    <?php } else {
                        echo "<p><span class='fas fa-lock'></span></p>";
                    }
                    ?>
                </section>
            </section>
            <p>Posted by <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?= $topic->getUtilisateur()->getId() ?>"><?= $topic->getUtilisateur()->getPseudo() ?></a></p>
            <p><?= $topic->getDateCreation() ?></p>
            <section class="f-s" id="categorielist">
                <a href='index.php?ctrl=forum&action=listCategories&id=<?= $topic->getCategorie()->getId() ?>'>
                    <?= $topic->getCategorie()->getNom() ?>
                </a>
            </section>
        </article>
<?php }
    } 
} ?>

