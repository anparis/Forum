<?php 
    $users = $result["data"]['user'];
?>

<article class="user-list">
<h1>Les Utilisateurs du forum</h1>

<?php
foreach($users as $user){ ?>
<ul>
    <li>
    <?php 
    if($_SESSION['user']->getId() == $user->getId()){ ?>
        -> [<?= $user->getRole() ?>] <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?= $user->getId()?>"><?= $user->getPseudo()." (".$user->getEmail().")" ?></a>

    <?php }
    else{ 
        if($user->getBan()){ ?>
            [<?= $user->getRole() ?>] <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?= $user->getId()?>"><?= $user->getPseudo()." (".$user->getEmail().")" ?></a>
            <a href="index.php?ctrl=security&action=debanUsers&id=<?= $user->getId()?>">Débannir</a>
        <?php }
        else if($user->getRole() == 'admin'){ ?>
            [<?= $user->getRole() ?>] <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?= $user->getId()?>"><?= $user->getPseudo()." (".$user->getEmail().")" ?></a>
        <?php }
        else{ ?>
            [<?= $user->getRole() ?>] <a href="index.php?ctrl=forum&action=listPostsByUsers&id=<?= $user->getId()?>"><?= $user->getPseudo()." (".$user->getEmail().")" ?></a>
            <a class="ban-btn" href="index.php?ctrl=security&action=banUsers&id=<?= $user->getId()?>">Bannir</a>
    <?php } 
    } ?>
    </li>
</ul>
<?php } ?>
</article>


