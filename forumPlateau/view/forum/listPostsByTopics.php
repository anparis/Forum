<?php
$posts = $result["data"]['posts'];
$topics = $result["data"]['topics'];
$statutTopic = $topics->getStatut();
?>
<a href="index.php?ctrl=forum&action=listTopics"><- Revenir à la liste</a>
<h1 class="form-title"><?=$topics->getTitle()?></h1>
<p>by <?=$topics->getUtilisateur()->getPseudo()?> the <?=$topics->getDateCreation()?></p>

<?php if(isset($_SESSION['user']) && !($_SESSION['user']->getBan())){ ?>
    <?php ?>
    <?php if($posts){
    $i = 0;
    foreach($posts as $post){
       if($i==0){ ?>
            <section id="first-post">
                <p><?=$post->getText()?></p>
                <?php if(($_SESSION['user']->getEmail() == $topics->getUtilisateur()->getEmail()) || $_SESSION['user']->hasRole('admin')) {?>
                    <section id="modify">
                        <a href="index.php?ctrl=forum&action=editPosts&id=<?= $post->getId()?>">Editer</a>
                    </section>
                <?php } ?>
            </section>
            <p class="answer">Réponses</p>
       <?php } 
       else {?>
        <section class="post-list">
            <p><?=$post->getText()?></p>
            <section id="edit-del-post">
            <p>Posted by <?=$post->getUtilisateur()->getPseudo()?></p>
            <p><?php echo $post->getDatePost();?>
            </p>
            <!-- If connected user OR admin => can edit or delete his posts -->
            <?php if(($_SESSION['user']->getEmail() == $topics->getUtilisateur()->getEmail()) || $_SESSION['user']->hasRole('admin')) {?>
                    <a href="index.php?ctrl=forum&action=editPosts&id=<?= $post->getId()?>">Editer</a>
                    <a href="index.php?ctrl=forum&action=delPosts&id=<?= $post->getId()?>" class="delete-btn">Supprimer</a>
                </section>
            <?php } ?>
        </section>
    <?php } $i++; } 
    } else echo "Aucun messages sur ce sujet" ?>
    <?php 
    if($statutTopic){ ?>
    <form action="index.php?ctrl=forum&action=addPosts&id=<?= $topics->getId() ?>" method="post">
    <div class="add-post">
        <label for="post">Message :</label>
        <textarea name="text" id="post" rows="5" cols="40" placeholder="écrire sur ce sujet" required></textarea>        
    </div>
    <input class="add-topic-post" type="submit" name="submitPost" value="Répondre">
    </form>
    <?php }
    else{ ?>
    <h1>Statut Topic : private</h1>
    <?php } ?>
    <br>
<?php } 
else{ ?>
    <hr>
    <?php
    foreach($posts as $post){
    ?>
    <section class="post-topic">
        <p><?=$post->getText()?></p>
        <p>Posted by <?=$post->getUtilisateur()->getPseudo()?></p>
        <p><?=$post->getDatePost()?></p>
    </section>
    <?php }?>
    <br>
<?php } ?>

