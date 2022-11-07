<?php

$topics = $result["data"]['topics'];

?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){
    ?>
    <section id="topiclist">
        <p><?=$topic->getTitle()?></p>
        <p>Created by <?=$topic->getUtilisateur()->getPseudo()?></p>
        <p><?=$topic->getDateCreation()?></p>
    </section>
    <?php
}


  
