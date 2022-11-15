<?php
$posts = $result["data"]["posts"];

?>
<h1>Profil de <?= $_SESSION['user'] ?></h1>
<p>Email <?= $_SESSION['user']->getEmail() ?></p>
<?php 
if($posts == NULL) {?>
    <p>Nombre de posts : 0</p>
<?php } else { ?>
    <p>Nombre de posts :
    <?php $count = 0;
    foreach($posts as $post){
        $count++;
    } echo $count; ?>
    </p>
<?php } ?>