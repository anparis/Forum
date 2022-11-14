<?php
$posts = $result["data"]['posts'];
$topics = $result["data"]['topics'];
$statutTopic = $topics->getStatut();
?>

<h1><?=$topics->getTitle()?></h1>
<p>Created by <?=$topics->getUtilisateur()->getPseudo()?> the <?=$topics->getDateCreation()?></p>

<?php if(isset($_SESSION['user']) && !($_SESSION['user']->getBan())){ ?>
    <?php ?>
    <hr>
    <?php if($posts){
    foreach($posts as $post){
        ?>
        <section id="postllist">
            <p><?=$post->getText()?></p>
            <p>Posted by <?=$post->getUtilisateur()->getPseudo()?></p>
            <p><?php echo $post->getDatePost();?>
            </p>
            <!-- If connected user OR admin => can edit or delete his posts -->
            <?php if(($_SESSION['user']->getEmail() == $topics->getUtilisateur()->getEmail()) || $_SESSION['user']->hasRole('admin')) {?>
                <section id="modify">
                    <a href="index.php?ctrl=forum&action=editPosts&id=<?= $post->getId()?>">Editer</a>
                    <a href="index.php?ctrl=forum&action=delPosts&id=<?= $post->getId()?>">Supprimer</a>
                </section>
            <?php } ?>
        </section>
    <?php } 
    } else echo "Aucun messages sur ce sujet" ?>
    <?php 
    if($statutTopic){ ?>
    <form action="index.php?ctrl=forum&action=addPosts&id=<?= $topics->getId() ?>" method="post">
    <p>
        <label>
            Message :<br>
            <textarea name="text" rows="5" cols="45" placeholder="écrire sur ce sujet" required></textarea>        
        </label>
    </p>
    <input type="submit" name="submitPost" value="Answer">
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
    <section id="postllist">
        <p><?=$post->getText()?></p>
        <p>Posted by <?=$post->getUtilisateur()->getPseudo()?></p>
        <p><?=$post->getDatePost()?></p>
        <!-- If connected the user can edit or delete his posts -->
    </section>
    <?php }?>
    <br>


<?php } ?>

