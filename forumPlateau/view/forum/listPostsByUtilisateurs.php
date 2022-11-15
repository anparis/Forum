<?php
$posts = $result["data"]['posts'];
$users = $result["data"]['users'];
?>
<h1>Posts of <?=$users->getPseudo()?></h1>
<hr>
<?php
if(empty($posts)){
    echo "Aucuns posts";
}
else{
foreach($posts as $post){ ?>
        <section class="post-list">
            <p><?=$post->getDatePost()?></p>
            <p><a href="index.php?ctrl=forum&action=listPosts&id=<?=$post->getTopic()->getId()?>">Aller vers sujet</a></p>
            <p><?=$post->getText()?></p>
        </section>
        <?php
    }
}
