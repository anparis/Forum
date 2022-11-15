<article class="public-article">
<h1 class="form-title">Formulaire de connexion</h1>
<form action="index.php?ctrl=security&action=loginUtilisateurs" method="post">
    <div class="log-form">
        <label for="email" class="form-label">
           <p class="f-w">Email :</p> 
        </label>
            <input type="email" name="email" id="email">
    </div>
    <div class="log-form">
        <label for="password" class="form-label">
            <p class="f-w">Mot de passe :</p>
        </label>
            <input type="password" name="mdp" id="password" minlength=8>
    </div>
    <input type="submit" name="submitLogin" value="Connexion" class="login-btn">
</form>
</article>