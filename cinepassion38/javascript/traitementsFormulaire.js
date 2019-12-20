/**
 * détermine si le caractère dont le code ASCII est passé en paramètre est autorisé ou non
 * @param codeAscii : le code ascii du caractère à tester
 * @return true si le caractère est autorisé, false sinon
 */

function validerCaractere(touche) {
	  if (touche >= 65 && touche <= 90) { // lettre en majuscule
		     return true;
		  }else if (touche >= 97 && touche <= 122) { // lettre en minuscule
		     return true;
		  }else if (touche >= 48 && touche <= 57) { // chiffre
		     return true;
		  }else if (touche == 45 || touche == 46 || touche == 95) { // caractère - . ou _ 
		     return true;
		  }else {
		     window.document.getElementById("Erreur").innerHTML="Le caractère saisi n'est pas valide";
		     window.setTimeout("window.document.getElementById('Erreur').innerHTML='';",2000);
		     return false;
		  }
}



/**
 * Chiffrement des informations du formulaire d'authentification
 * @return true (le formulaire sera envoyé) ou false (le formulaire ne sera pas envoyé)
 */
function verifierAuthentificationUser(pForm) {
	if (pForm.Login.value == "") {
        alert("Le login doit être renseigné");
        pForm.Login.focus();
        return false;
    } else if (pForm.Password.value == "") {
        alert("Le mot de passe doit être renseigné");
        pForm.Password.focus();
        return false;
    } else {
    	var jse = new JSEncrypt();
    	var publicKey = 'MCwwDQYJKoZIhvcNAQEBBQADGwAwGAIRANQSV0QfeHuhjPe9gPRSeE0CAwEAAQ==';
    	jse.setPublicKey(publicKey);
        pForm.Login.value = jse.encrypt(pForm.Login.value);
        pForm.Password.value = jse.encrypt(pForm.Password.value);

        return true;
    }
}



/**
* Changement de la couleur au focus de la zone de texte 
*/
function gestionCouleur() {
	  if (window.event.type == "focus") {
		  window.document.getElementById(window.event.srcElement.id).style.backgroundColor="#BEA2CF";
	  }else { // blur
		  window.document.getElementById(window.event.srcElement.id).style.backgroundColor="#DDD7AF";
	  }
}




