<h1>Formulaire d'inscription</h1>
<form action="index.php?ctrl=security&action=addUtilisateurs" method="post" class="formulaire">
    <p>
        <label>
            email :
            <input type="email" name="email">
        </label>
    </p>
    <bp>
        <label>
            pseudo :
            <input type="text" name="pseudo">
        </label>
    </p>
    <p>
        <label>
            mot de passe :
            <input type="password" name="mdp" minlength=8>
        </label>
    </p>
    <p>
        <label>
            veuillez confirmer le Mot de Passe :
            <input type="password" name="mdp2" minlength=8>
        </label>
    </p>
    <input type="submit" name="submitUser" value="Valider" class="submit">
</form>