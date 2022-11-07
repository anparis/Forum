<?php

$posts = $result["data"]['posts'];

?>

<h1>liste Posts</h1>

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

