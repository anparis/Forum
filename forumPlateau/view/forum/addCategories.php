<?php

?>
<h1> Ajouter une categorie</h1>
<form action="?ctrl=securty&action=addCategories" method="post" enctype="multipart/form-data">
        <p>
            <label>
                Categories :
                <input type="text" name="nom" maxlength="20">
            </label>
        </p>
       
        <p>
            <input type="submit" name="submitCategorie" value="Ajouter la categorie">
        </p>
</form>

