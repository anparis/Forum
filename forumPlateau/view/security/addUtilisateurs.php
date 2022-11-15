<article class="public-article">
<h1 class="form-title">Formulaire d'inscription</h1>
<form action="index.php?ctrl=security&action=addUtilisateurs" method="post">
    <div class="log-form">
        <label for="email">
            <p class="f-w">Email :</p> 
        </label>
        <input type="email" name="email" id="email" tabindex="1">
    </div>
    <div class="log-form">
        <label for="pseudo">
           <p class="f-w">Pseudo :</p> 
        </label>
        <input type="text" name="pseudo" id="pseudo">
    </div>
    <div class="log-form">
        <label for="password1">
            <p class="f-w">Mot de passe :</p> 
        </label>
        <input type="password" name="mdp" id="password" minlength=8>
    </div>
    <div class="log-form">
        <label for="password2">
           <p class="f-w">Confirmer le Mot de Passe :</p> 
        </label>
            
            <input type="password" name="mdp2" id="password2" minlength=8>
    </div>
    <input type="submit" name="submitUser" value="S'inscrire" class="login-btn">
</form>
</article>
