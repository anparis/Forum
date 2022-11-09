<?php
$posts = $result["data"]['posts'];
$topics = $result["data"]['topics'];
$statutTopic = $topics->getStatut();
$idTopic = $topics->getId();
?>

<h1><?=$topics->getTitle()?></h1>
<p>Created by <?=$topics->getUtilisateur()->getPseudo()?> the <?=$topics->getDateCreation()?></p>
<hr>
<?php
foreach($posts as $post){
    ?>
    <section id="postllist">
        <p>Posted by <?=$post->getUtilisateur()->getPseudo()?></p>
        <p><?=$post->getDatePost()?></p>
        <p><?=$post->getText()?></p>
    </section>
    <?php }?>
    <br>

<?php if(isset($_SESSION['user'])){ ?>
    <section id="modify">
        <a href="edit">Editer</a>
        <a href="delete">Supprimer</a>
    </section>

<?php } else{
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
    <?php } }?>

