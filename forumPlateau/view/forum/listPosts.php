<?php

$posts = $result["data"]['posts'];
?>
<h1>liste Posts</h1>

<?php
foreach($posts as $post){
    ?>
    <section id="postllist">
        <p>Posted by <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?=$post->getUtilisateur()->getId()?>"><?=$post->getUtilisateur()->getPseudo()?></a></p>
        <p><?=$post->getDatePost()?></p>
        <p><?=$post->getText()?></p>
    </section>
    <?php
}

