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
        <section id="postllist">
            <p>===</p>
            <p><?=$post->getDatePost()?></p>
            <p><?=$post->getText()?></p>
        </section>
        <?php
    }
}
