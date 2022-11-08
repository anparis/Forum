<h1>Formulaire de connexion</h1>
<form action="index.php?ctrl=security&action=loginUtilisateurs" method="post">
    <p>
        <label>
            email :
            <input type="email" name="email">
        </label>
    </p>
    <p>
        <label>
            mot de passe :
            <input type="password" name="mdp" minlength=8>
        </label>
    </p>
    <input type="submit" name="submitLogin" value="Valider">
</form>