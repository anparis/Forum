<?php

$posts = $result["data"]['posts'];
?>
<h1>Posts</h1>
<div class="post-list">
<?php
foreach($posts as $post){
    ?>
    <div class="single-post">
        <p>Posted by <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?=$post->getUtilisateur()->getId()?>"><?=$post->getUtilisateur()->getPseudo()?></a></p>
        <div class="post-text-date">
            <p class="txt"><a href="index.php?ctrl=forum&action=listPosts&id=<?=$post->getTopic()->getId() ?>"><?=$post->getText()?></a></p>
            <p class="date"><?=$post->getDatePost()?></p>
        </div>
    </div>
    <?php
}?>
</div>

