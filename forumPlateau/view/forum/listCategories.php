<?php

$categories = $result["data"]['categorie'];
?>

<h1>liste Categories</h1>

<?php
foreach($categories as $categorie ){
    ?>
    <p><?=$categorie->getNom()?></p>
    <?php
}
