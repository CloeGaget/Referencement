<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/user/authentification.inc.php
 auteur					: Cloé GAGET
 date de création		: Mars 2019
 date de modification	:
 rôle					: permet de générer le code xhtml de la page d'authentification du module user
 ================================================================================================================= -->

<div id='content2'>
	<?php if (isset($_SESSION['user'])) { ?>
		<span class='contentTitre'>
			Authentification réalisée avec succès
		</span>
		<span class='contentInfos'>
			• C'est votre <?php if ($nbTotalCo > 0) {echo $nbTotalCo . 'e';} else {echo'première';} ?> connexion depuis la création de votre compte le <?php echo $dateFirstCo; ?>.<br/>
		<?php if ($nbTotalCo > 0) { ?>
			• Votre dernière connexion a eu lieu le <?php echo $dateLastCo; ?> à <?php echo $heureLastCo; ?>.<br/>
		<?php } ?>
		<?php if ($nbEchecCo > 0) { ?>
			• Attention, il y a eu <?php echo $nbEchecCo; ?> tentatives incorrectes de connexion avec votre login depuis votre dernière connexion.<br/>
		<?php } ?>
			• Pour des raisons de sécurité, pensez à changer régulièrement votre mot de passe. Vous pouvez le modifier <a href="#">ici</a><br/>
		</span>
		
	<?php } else { ?>
		<span class='contentTitre'>
			Echec de la tentative d'authentification
		</span>
		<span class='contentInfos'>
			• Votre tentative d'authentification est en échec. Votre identifiant et/ou votre mot de passe sont icorrects.<br/>
			• Vérifiez les informations saisies et essayez à nouveau.<br/>
		</span>
	<?php } ?>
	
	
</div><!-- content2 -->