<?php
$categories = $result["data"]['categories'];

?>
<h1 class="form-title">Nouveau Sujet</h1>

<form class="form-topic" action="index.php?ctrl=forum&action=addTopics&id=<?= $_SESSION['user']->getId() ?>" method="post">
    <p>
        <label class="f-w">
            Titre :<br></label>
            <input type="text" name="titre">
    </p>
    <p>
    <label class="f-w">
            Catégories :<br></label>
        <select name="idCategorie" id="listCategories">
            <?php
                foreach($categories as $categorie ){?>
                    <option value=<?= $categorie->getId() ?>><?=$categorie->getNom()?></option>
            <?php }?>
        </select>
    </p>
    <p>
        <label class="f-w" for="message">
            Message :
        </label><br>
            <textarea name="text" id="message" rows="5" cols="33" placeholder="Description" require></textarea>        
    </p>
    <p>
        <fieldset>
            <label class="f-w">Statut :</label><br>
            <label for="private">privée</label>
            <input type="radio" id="private" name="statut" value="0" checked>        

            <label for="public">publique</label>
            <input type="radio" id="public" name="statut" value="1" checked>        
        </fieldset>
    </p>

        <input type="submit" name="submitTopic" value="Valider">

</form>