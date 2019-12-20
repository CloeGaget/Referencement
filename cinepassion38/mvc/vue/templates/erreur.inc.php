<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/templates/erreur.inc.php
 auteur					: Christophe Goidin (christophe.goidin@ac-grenoble.fr)
 date de création		: juin 2017
 date de modification	:
 rôle					: gestion des erreurs
 ================================================================================================================= -->
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		cinepassion38
	</title>
	<link rel='stylesheet' type='text/css' href='./css/structure.css' />
	<link rel='stylesheet' type='text/css' href='./css/menu.css' />
</head>
<body>
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
			Authentification
		</div>
		<div id='titre'>
			Erreur
		</div>
		<div id='filAriane'>
			<a href="./index.php">home</a>
		</div>
		<div id='version'>
			version : 2.0
		</div>
	</div>
	
	<div id='menu'>
		<ul class='nv1'>
			<li id='accueil'><a href='./index.php?module=home&amp;page=accueil'>&nbsp;</a></li>
			<li class='plus'>cinepassion38</a>
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
					<li> <a href='./index.php?module=user&amp;page=accueil'> accueil </a><li>	
				</ul>
			</li>
		</ul>
	</div>
	
	<div id='main'>
		<span id="titrePage">
			Une erreur est survenue dans le code l' application
		</span>

		<div id="content2">
			<span class='centrer'>
				<img alt='erreur' src='./image/divers/erreur.png' />
			</span>
			Une erreur est survenue dans le code de l'application :<br/> <?php echo $messageErreur; ?>
		</div>
		<hr/>
	</div>
	
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
		<div class='blocGauche'>
			<span class='centrer'>...</span>
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
	</div>

	<div id='footer'>
		<img alt='' id='fondFooter' src='./image/divers/fondFooter.jpg' />
		<img alt='' src='./image/divers/cinepassion38LogoMini.png' id='cinepassion38LogoMini' />
		<div id='w3c'>
			<img alt='' src='./image/divers/w3cXhtml1.0.png' />&nbsp;&nbsp;&nbsp;&nbsp;
			<img alt='' src='./image/divers/w3cCss.png' />
		</div>
	</div>

	<div id='copyright'>
		cinepassion38 - l 'association grenobloise pour la promotion du cinéma<br/>@Copyright 2017 Genesys - Tous droits réservés
	</div>
</body>
</html>
