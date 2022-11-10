<?php 
$topic = $result["data"]['topic'];

$idTopic = $topic->getId();
?>

<h1>Editeur</h1>

<form action="index.php?ctrl=forum&action=updateTopic&id=<?= $idPost ?>" method="post">
<p>
    <label>Nouveau titre : 
    <input type="text" name="titre" value=<?=$topic->getTitre()?>>
    </label>
</p>
<input type="submit" name="submitChangedTopic" value="Valider">

</form>