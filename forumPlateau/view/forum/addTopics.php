<?php

?>
<h1>Nouveau Sujet</h1>

<form action="index.php?ctrl=forum&action=addTopics" method="post" class="formulaire">
    <p>
        <label>
            Titre :<br>
            <input type="text" name="titre">
        </label>
    </p>
    <p>
        <label>
            Message :<br>
            <textarea name="text" rows="5" cols="33"></textarea>        
        </label>
    </p>

        <input type="submit" name="submitTopic" value="Valider" class="submit">

</form>