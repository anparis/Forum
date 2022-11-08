<?php

$categories = $result["data"]['categories'];
?>

<h1>liste Categories</h1>

<?php
foreach($categories as $categorie ){

    ?>
    <section id="categorielist"> 
        <a href='index.php?ctrl=forum&action=listCategories&id=<?=$categorie->getId()?>'>
            <?=$categorie->getNom()?>
        </a>
    </section>
    <?php
}?>
<a href="index.php?ctrl=forum&action=addCategories">Ajouter une categorie</a>
