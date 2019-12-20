<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/templates/layout.inc.php
 auteur					: Christophe Goidin (christophe.goidin@ac-grenoble.fr)
 date de création		: juin 2017
 date de modification	:
 rôle					: le layout permet de générer le code xhtml commun à TOUTES les pages du site
 						  le contenu principal de chaque page est généré par des vues qui dépendent de leurs contrôleurs respectifs
 ================================================================================================================= -->
<?php echo $doctype . PHP_EOL; ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		<?php echo $titreSiteWeb . PHP_EOL; ?>
	</title>
	<link rel='stylesheet' type='text/css' href='./css/structure.css' />
	<link rel='stylesheet' type='text/css' href='./css/menu.css' />
	<link rel='stylesheet' type='text/css' href='./css/formulaire.css'/>
	<link rel='icon' type='image/png' href='./image/divers/bobine.png' />
	<script type='text/javascript' src='./librairie/jquery/jquery1.7.2.js'></script>
	<script type='text/javascript' src='./javascript/traitementsFormulaire.js'></script>
	<?php 
		if (isset($texteDefilant)) {
			echo "<link rel='stylesheet' type='text/css' href='./librairie/liscroll/css/liscroll.css' />
				  <script type='text/javascript' src='./librairie/liscroll/js/liscroll.js'></script>" . PHP_EOL;
		}
		if (isset($enteteLien)) {
			echo $enteteLien . PHP_EOL;
		}

		if(isset($publicKeyRsa)) {
			echo $publicKeyRsa;
			echo '<script type="text/javascript" src="./librairie/jsencrypt/bin/jsencrypt.js"></script>
 				<script type="text/javascript" src="./librairie/valid/valid.js"></script>';
		}
	?>
</head>
<body>

<?php if(isset($PublicKeyRsa)) {
	echo "<script type='text/javascript'>
              var publicKey = \"" . $PublicKeyRsa . "\";
          </script>";
}?>

	<div> <!-- La flèche permettant de revenir en haut de la page -->
		<img alt = 'retour en haut de la page'
			 id = 'retourHautPage'
			 src = './image/divers/flecheHautPage.png'
			 onmouseover = "window.document.getElementById('retourHautPage').src='./image/divers/flecheHautPageSurvol.png'"
			 onmouseout = "window.document.getElementById('retourHautPage').src='./image/divers/flecheHautPage.png'"
			 onclick = "$('html, body').animate({scrollTop:$('body').offset().top}, 'slow');"
		/>
	</div>
	<!-- code permettant de figer le menu en haut de la page lors du défilement avec l'ascenseur vertical
		 Affichage dynamique de l'image (flèche) permettant de revenir en haut de la page -->
	<script type='text/javascript'>
		$(function () {
			$(window).scroll(function () {
				var vPositionMenuGauche = window.document.getElementById('header').offsetLeft + 11; // +11 car il y a 10 pixels de marge interne gauche + 1 pixel de bordure gauche
				if ($(window).scrollTop() > 200) { 	// on fait défiler l'ascenseur vertical de plus de 200 pixels vers le bas
					$('div#menu ul.nv1').css('position', 'fixed');
					$('div#menu ul.nv1').css('top', '0px');
					$('div#menu ul.nv1').css('left', vPositionMenuGauche + 'px');
					$('img#retourHautPage').css('visibility', 'visible');
				}else {
					$('div#menu ul.nv1').css('position', 'relative');
					$('div#menu ul.nv1').css('top', '0px');
			 		$('div#menu ul.nv1').css('left', '0px');
					$('img#retourHautPage').css('visibility', 'hidden');
			 	}
			});
		});
	</script>
	
	
	<div id='llm'>
		<a onclick='window.open(this.href); return false;' href='http://www.ac-grenoble.fr/lycee/louise.michel'>
			<img alt='' src='./image/partenaire/logoLLM.jpg' />
		</a>
	</div>
	
	<div id='lien'>
		<a onclick='window.open(this.href); return false;' href='http://www.allocine.fr'>
			<img alt='allocine' src='./image/partenaire/logoAllocineMini.png' />
		</a>&nbsp;&nbsp;
		<a onclick='window.open(this.href); return false;' href='http://www.empirecinemas.co.uk'>
			<img alt='empire' src='./image/partenaire/logoEmpireMini.png' />
		</a>&nbsp;&nbsp;
		<a onclick='window.open(this.href); return false;' href='http://www.sky.com/tv/channel/skycinema'>
			<img alt='skymovies' src='./image/partenaire/logoSkyMoviesMini.png' />
		</a>
	</div>
	
	<div id='header'>
		<img alt='' id='fondHeader' src='./image/divers/fondHeader.jpg' />
		<img alt='' src='./image/divers/cinepassion38Logo.png' id='cinepassion38' />
		<div id='authentification'>
			<?php 
					if(!is_object($authentification)){
						echo $authentification;
					}else{
						//print_r($authentification); 
						
						/*echo "<p>" . $authentification->prenomNomUser . "</p>
 							  <p> profil : " . $authentification->libelleTypeUser ." </p>";*/
						
						echo "<p>" . $authentification->prenomNomUser . "</p>
 							  <p> profil : " . $authentification->libelleTypeUser ." </p>
 							  <img src='" .$authentification->avatarUser . "' alt=''> </img>";
					}
					?>
		</div>
		<div id='titre'>
			<?php echo $titreHeader . PHP_EOL; ?>
		</div>
		<div id='filAriane'>
			<?php echo $filAriane . PHP_EOL; ?>
		</div>
		<div id='version'>
			<?php echo $version. PHP_EOL; ?>
		</div>
		<div id='dateDuJour'>
			<?php echo $dateDuJour . PHP_EOL; ?>
		</div>
		<!-- Texte défilant -->
		<?php 
			if (isset($texteDefilant)) {
				echo "<ul id='texteDefilant'><li>" . $texteDefilant['titre'] . "</li>";
				foreach ($texteDefilant['contenu'] as $cle => $valeur) {
					echo "<li><span class='titre'>" . $cle . "</span>" . $valeur . "</li>";
				}
				echo "</ul>" . PHP_EOL;
			}
		?>
		<script type='text/javascript'>
			$(function(){
				$("ul#texteDefilant").liScroll({travelocity: 0.02});
			});
		</script>
	</div><!-- header -->
	
	<div id='menu'>
		<ul class='nv1'>
			<li id='accueil'><a href='./index.php?module=home&amp;page=accueil'>&nbsp;</a></li>
			<li class='plus'>cinepassion38
				<ul class='nv2'>
					<li><a href='./index.php?module=cinepassion38&amp;page=accueil'>accueil</a></li>
					<li><a href='./index.php?module=cinepassion38&amp;page=partenaire'>nos partenaires</a></li>
					<li><a href='./index.php?module=cinepassion38&amp;page=plan'>plan</a></li>
				</ul>
			</li>
			<li class='plus'> film 
				<ul class='nv2'>
					<li> <a href='./index.php?module=film&amp;page=accueil'> accueil </a></li>
					<li> <a href='./index.php?module=film&amp;page=liste'> liste</a></li>
				</ul>
			</li>	
			<li class='plus'> user
				<ul class='nv2'>
					<li> <a href='./index.php?module=user&amp;page=accueil'> accueil </a></li>	
					<?php 
					if (isset($_SESSION['user'])) {
					?>
					<li> modifier
						<ul class='nv3'>
							<li> <a href='#'> mot de passe </a></li>
							<li> <a href='#'> informations </a></li>
						</ul>
					</li>
					<li> <a href='./index.php?module=user&amp;page=deconnexion'> déconnexion </a></li> <?php
					} else {
					?>
					<li> <a href='./index.php?module=user&amp;page=inscription'> inscription </a></li> <?php					
					}
					?>
				</ul>
			</li>
	</div><!-- menu -->
	
	<div id='main'>
		<span id="titreMain">
			<?php echo $titreMain . PHP_EOL; ?>
		</span>
		<?php 
		echo (!isset($content1) ? "" : $content1 . "<hr class='marge' />");
		if (isset($lesEncartsGauche)) {
			echo "<div id='encartsGauche'>";
			while (!$lesEncartsGauche->estVide()) {
				$unEncart = $lesEncartsGauche->getUnElement();
				echo $unEncart->getXhtml();
			}
			echo "</div><!-- encartsGauche -->\n";
		}
		if (isset($lesEncartsDroite)) {
			echo "<div id='encartsDroite'>";
			while (!$lesEncartsDroite->estVide()) {
				echo $lesEncartsDroite->getUnElement()->getXhtml();
			}
			echo "</div><!-- encartsDroite -->\n";
		}
		echo $content2;
		?>
		<hr/>
	</div><!-- main -->
	
	<div id='planSite'>
		<div class='blocGauche'>
			l' association
			<ul>
				<li><a href='./index.php?module=cinepassion38&amp;page=accueil'>accueil</a></li>
				<li><a href='./index.php?module=cinepassion38&amp;page=partenaire'>nos partenaires</a></li>
				<li><a href='./index.php?module=cinepassion38&amp;page=plan'>plan</a></li>
			</ul>
		</div>
		<div class='blocGauche'>
		les films
			<ul>
				<li> <a href='./index.php?module=film&amp;page=accueil'> accueil </a></li>
				<li> <a href='./index.php?module=film&amp;page=liste'> liste</a></li>
			</ul>
			<span class='centrer'>...</span>
		</div>
		<div class='blocGauche'>
		user
			<ul>
				<li> <a href='./index.php?module=user&amp;page=accueil'> accueil </a></li>
			</ul>
		</div>
		<div class='blocDroite'>
			<span class='centrer'>...</span>
		</div>
		<div class='blocDroite'>
			<span class='centrer'>...</span>
		</div>
		<div class='blocCentre'>			
			<span class='centrer'>...</span>
		</div>	
		<hr/>
	</div><!-- planSite -->

	<div id='footer'>
		<img alt='' id='fondFooter' src='./image/divers/fondFooter.jpg' />
		<img alt='' id='cinepassion38LogoMini' src='./image/divers/cinepassion38LogoMini.png'  />
		<div id='w3c'>
			<img alt='' src='./image/divers/w3cXhtml1.0.png' />&nbsp;&nbsp;&nbsp;&nbsp;
			<img alt='' src='./image/divers/w3cCss.png' />
		</div>
	</div><!-- footer -->

	<div id='copyright'>
		cinepassion38 - l 'association grenobloise pour la promotion du cinéma<br/>@Copyright 2018 Genesys - Tous droits réservés
	</div>
</body>
</html>