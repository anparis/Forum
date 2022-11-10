<?php 
$post = $result["data"]['post'];

$idPost = $post->getId();
?>

<h1>Editeur</h1>

<form action="index.php?ctrl=forum&action=updatePost&id=<?= $idPost ?>" method="post">
<p>
    <label>Message a editer : </label>
    <br>
    <textarea name="text" cols="45" rows="5"><?= $post->getText()?></textarea>
</p>
    <input type="hidden" name="idTopic" value=<?= $post->getTopic()->getId() ?> >
<input type="submit" name="submitChangedPost" value="Valider">

</form>