<form action='./index.php?module=user&page=authentification' id='connexion' onsubmit='return verifierAuthentificationUser(this);' method='post' >
	<label> Login : </label> <input id='login' type='text' onfocus='gestionCouleur();' onblur='gestionCouleur();' onkeypress="return validerCaractere(window.event.which);" name='Login'  placeholder='Entrez votre login...'/> <br/>
	<label> Mot de passe : </label> <input id='password' onfocus='gestionCouleur();' onblur='gestionCouleur();' type='password' name='Password'  />
	<input type='submit' value='Envoyer' /> <span id='Erreur'></span>
</form>	