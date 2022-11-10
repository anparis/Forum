<?php
$posts = $result["data"]['posts'];
$topics = $result["data"]['topics'];
$statutTopic = $topics->getStatut();
$idTopic = $topics->getId();
?>

<h1><?=$topics->getTitle()?></h1>
<p>Created by <?=$topics->getUtilisateur()->getPseudo()?> the <?=$topics->getDateCreation()?></p>

<?php if(isset($_SESSION['user'])){ ?>
    <?php if(($_SESSION['user']->getEmail() == $topics->getUtilisateur()->getEmail())){ ?>
    <hr>
    <?php if($posts){
    foreach($posts as $post){
        ?>
        <section id="postllist">
            <p><?=$post->getText()?></p>
            <p>Posted by <?=$post->getUtilisateur()->getPseudo()?></p>
            <p><?=$post->getDatePost()?></p>
            <!-- If connected the user can edit or delete his posts -->
                <section id="modify">
                    <a href="index.php?ctrl=forum&action=editPosts&id=<?= $post->getId()?>">Editer</a>
                    <a href="index.php?ctrl=forum&action=delPosts&id=<?= $post->getId()?>">Supprimer</a>
                </section>
        </section>
    <?php } 
    } else echo "Aucun messages sur ce sujet" ?>
    <?php } 
    if($statutTopic){ ?>
    <form action="index.php?ctrl=forum&action=addPosts&id=<?=$idTopic?>" method="post">
    <p>
        <label>
            Message :<br>
            <textarea name="text" rows="5" cols="45"></textarea>        
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
        <?php if(isset($_SESSION['user']) && ($_SESSION['user']->getEmail() == $post->getUtilisateur()->getEmail())){ ?>
            <section id="modify">
                <a href="index.php?ctrl=forum&action=editPosts&id=<?= $post->getId()?>">Editer</a>
                <a href="delete">Supprimer</a>
            </section>
        <?php } ?>
    </section>
    <?php }?>
    <br>


<?php } ?>

