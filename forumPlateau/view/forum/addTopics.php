<?php
$categories = $result["data"]['categories'];

?>
<h1>Nouveau Sujet</h1>

<form action="index.php?ctrl=forum&action=addTopics&id=<?= $_SESSION['user']->getId() ?>" method="post">
    <p>
        <label>
            Titre :<br>
            <input type="text" name="titre">
        </label>
    </p>
    <p>
        <label for="listCategories">
        <select name="idCategorie" id="listCategories">
            <?php
                foreach($categories as $categorie ){?>
                    <option value=<?= $categorie->getId() ?>><?=$categorie->getNom()?></option>
            <?php }?>
            </select>
        </label>
    </p>
    <p>
        <label>
            Message :<br>
            <textarea name="text" rows="5" cols="33"></textarea>        
        </label>
    </p>
    <p>
        <fieldset>
            Statut :<br>
            <label for="private">privée</label>
            <input type="radio" id="private" name="statut" value="0" checked>        

            <label for="public">publique</label>
            <input type="radio" id="public" name="statut" value="1" checked>        
        </fieldset>
    </p>

        <input type="submit" name="submitTopic" value="Valider">

</form>