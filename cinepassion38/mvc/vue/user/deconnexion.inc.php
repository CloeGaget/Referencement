<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/user/accueil.inc.php
 auteur					: Cloé GAGET
 date de création		: Mars 2019
 date de modification	:
 rôle					: permet de générer le code xhtml de la page de déconnexion du module user
 ================================================================================================================= -->

<div id='content2'>
	
	<span class='contentTitre'>
			Vous êtes maintenant déconnecté<?php if ($sexeUser == "F"){echo 'e';}?>
	</span>
	<span class='contentInfos'>
			• La durée de votre connexion a été de <?php if ($dureeCoDate > 0) {echo $dureeCoDate . ' jour(s) et ';} echo $dureeCoSec . "s" ?>.<br/>
			• Vous pouvez vous reconnecter à tout moment à partir du formulaire d'identification.<br/>
			• Merci de votre visite <?php echo $prenomNomUser; ?>.<br/>
	</span>

</div><!-- content2 -->