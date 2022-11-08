<?php
$posts = $result["data"]['posts'];
$topics = $result["data"]['topics'];
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
    <?php
}

