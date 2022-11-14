<?php

$topics = $result["data"]['topics'];
?>


<h1>liste topics</h1>

<?php if (isset($_SESSION['user']) && !$_SESSION['user']->getBan()) {
?>
    <a href='index.php?ctrl=forum&action=addTopics'>Ajouter un sujet</a>

    <?php

    foreach ($topics as $topic) {
    ?>
        <section id="topiclist">
            <a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'>
                <p><?= $topic->getTitle() ?></p>
            </a>
            <p>Created by <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?= $topic->getUtilisateur()->getId() ?>"><?= $topic->getUtilisateur()->getPseudo() ?></a></p>
            <p><?= $topic->getDateCreation() ?></p>
            <section id="categorielist">
                <a href='index.php?ctrl=forum&action=listCategories&id=<?= $topic->getCategorie()->getId() ?>'>
                    <?= $topic->getCategorie()->getNom() ?>
                </a>
            </section>
            <section id="statut">
                <p>
                    <?php if ($topic->getUtilisateur()->getEmail() == $_SESSION['user']->getEmail() || $_SESSION['user']->hasRole('admin')) {
                        if ($topic->getStatut()) {
                            echo "<p><span class='fas fa-lock-open'></span> publique</p>"; ?>
                            <a href='index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId() ?>'>lock</a>
                        <?php } else {
                            echo "<p><span class='fas fa-lock'></span> privée</p>"; ?>
                            <a href='index.php?ctrl=forum&action=unlockTopic&id=<?= $topic->getId() ?>'>unlock</a>
                        <?php } ?>

                <section id="modify">
                    <p>
                        <a href='index.php?ctrl=forum&action=editTopics&id=<?= $topic->getId() ?>'>Editer</a>
                        <a href="index.php?ctrl=forum&action=delTopics&id=<?= $topic->getId() ?>">Supprimer</a>
                    </p>
                </section>
            <?php } else { ?>
                <?php if ($topic->getStatut()) {
                            echo "<p><span class='fas fa-lock-open'></span> publique</p>"; ?>
            <?php } else {
                            echo "<p><span class='fas fa-lock'></span> privée</p>";
                        }
                    } ?>
            </p>
            </section>
        </section>
<?php
    }
}
else{
foreach ($topics as $topic) {
    ?>
        <section id="topiclist">
            <a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'>
                <p><?= $topic->getTitle() ?></p>
            </a>
            <p>Created by <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?= $topic->getUtilisateur()->getId() ?>"><?= $topic->getUtilisateur()->getPseudo() ?></a></p>
            <p><?= $topic->getDateCreation() ?></p>
            <section id="categorielist">
                <a href='index.php?ctrl=forum&action=listCategories&id=<?= $topic->getCategorie()->getId() ?>'>
                    <?= $topic->getCategorie()->getNom() ?>
                </a>
            </section>
            <section id="statut">
                    
                <?php if ($topic->getStatut()) {
                            echo "<p><span class='fas fa-lock-open'></span> publique</p>"; ?>
            <?php } else {
                            echo "<p><span class='fas fa-lock'></span> privée</p>";
                        }
                 ?>
            </p>
            </section>
        </section>
    <?php } } ?>