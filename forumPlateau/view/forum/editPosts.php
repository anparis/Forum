<?php 
$post = $result["data"]['post'];

$idPost = $post->getId();
?>

<h1>Editeur</h1>

<form action="index.php?ctrl=forum&action=update&id=<?= $idPost ?>" method="post">
<p>
    <label>Message a editer : </label>
    <br>
    <textarea name="text" cols="30" rows="10">
        <?= $post->getText()?>
    </textarea>
</p>
<input type="submit" name="submitPost" value="Valider">


</form>