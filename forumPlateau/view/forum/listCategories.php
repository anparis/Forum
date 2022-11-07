<?php

$categories = $result["data"]['categories'];
?>

<h1>liste Categories</h1>

<?php
foreach($categories as $categorie ){
    var_dump($categorie);

    ?>
    <p><a href="index.php?ctrl=forum&action=listTopics&id=<?=$categorie->getId()?>"><?=$categorie->getNom()?></a></p>
    <?php
}?>
<a href="ctrl=forum&action=addCategories">Ajouter une categorie</a>
