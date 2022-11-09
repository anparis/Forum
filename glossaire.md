# To do
- [X] Faire une liste categories pour ajout topic
- [] pouvoir éditer / supprimer les topics / messages dont on est l'auteur
- [] pouvoir verrouiller un topic dont on est l'auteur
    - [] mettre une icone cadenas quand topic est lock
- [] pouvoir se connecter en tant qu'admin (champ rôle dans la BDD) et faire tout ce qu'on veut : gérer les users (notamment pouvoir en bannir un), modérer les messages / topics (edit / suppresion)






# keeper

```php
<div id="nav-left">
    <a href="/">Accueil</a>
    <?php
    if(App\Session::isAdmin()){
        ?>
        <a href="index.php?ctrl=home&action=users">Voir 
        
        la liste des gens</a>
        
        <?php
    }
    ?>
</div>
```