<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/film/fiche.inc.php
 auteur					: Cloé GAGET
 date de création		: Octobre 2018
 date de modification	:
 rôle					: permet de générer le code xhtml de la page des fiches des films'un film
 ================================================================================================================= -->
 
<div id='content2'>
	
	 <div>
	   <div id="Affiche">

		<?php if (!$photosFilm) {
			echo "<acronym title='Aucune photo disponible pour ce film'> <img id='affiche' src='" . $afficheFilm . "' alt=''> </acronym>";
		} else {
			foreach ($photosFilm as $key => $unePhoto) {
				echo "<a href=\"" . $unePhoto . "\" rel=\"lightbox[g1]\">";
				if ($key == 0){
					echo "<acronym title='Voir les " . count($photosFilm) . " photos disponible(s) pour ce film'> <img id='affiche' src=\"" . $afficheFilm ."\" alt=''> </acronym> </a>";
				}
				echo "</a>";	
			}
		}?>
	  	</div>
	  	
		<ul id="Onglet">
			 <?php echo ($action=="informations" || $action=="defaut" ? "<li class='actif'> informations </li>" : "<li> <a href='./index.php?module=film&page=fiche&action=informations&section=" . $numFilm . "'> informations </a> </li>");?> 
			 <?php echo ($action=="histoire" ? "<li class='actif'> histoire </li>" : "<li> <a href='./index.php?module=film&page=fiche&action=histoire&section=" . $numFilm . "'> histoire </a> </li>");?> 
			 <?php echo ($action=="acteurs" ? "<li class='actif'> acteurs</li>" : "<li> <a href='./index.php?module=film&page=fiche&action=acteurs&section=" . $numFilm . "'> acteurs </a> </li>");?> 
			 <?php echo ($action=="notation" ? "<li class='actif'> notation</li>" : "<li> <a href='./index.php?module=film&page=fiche&action=notation&section=" . $numFilm . "'> notation </a> </li>");?> 
			 <?php echo ($action=="commentaires" ? "<li class='actif'> commentaires</li>" : "<li> <a href='./index.php?module=film&page=fiche&action=commentaires&section=" . $numFilm . "'> commentaires </a> </li>");?> 
		</ul>
	  		
	</div>
	
	<div>
		<?php 
			switch ($onglet) {
				case "informations":
					echo "<span class='italic'>" . $titreFilm . "</span> est le ";
					if ($positionFilm > 1){
						echo $positionFilm . "<sup>ème</sup>";
					} else {
						echo 1 . "<sup>er</sup>";
					}
					echo " film dans notre cinémathèque du réalisateur " . $nationaliteRea . "<span id='realisateur' class='italic'>" . " " . $realisateur . "</span>
 					<div id='filmographie'
 						<ul id='listeFilms'>
 							<li> filmographie de <span class='italic'>" . $realisateur . "</span>
						</ul>
					</div>" 
					. ". C'est un film " . $libelleGenre . " " . $nationaliteFilm . " d'une durée de " . $dureeHeure . ($dureeHeure==1 ? " heure" : " heures") . " et "
					. $dureeMinute . ($dureeMinute==1 ? " minute" : " minutes") . " qui est sorti dans les salles de cinéma en France le " . $dateSortie . ".";				
					

					break;
				case "histoire":
					echo $synopsis;
					break;
				case "acteurs":
					while ($unActeur = $listeActeurs->getUnElement()) {
						echo "<div class='unacteur'>
							<img id='laphoto' src='" . $unActeur->cheminPhoto . "'/>";
						if ($unActeur->sexe == 'M') {$ee = "" ;} else {$ee = "e" ;}
						if ($unActeur->sexe == 'M') {$ilelle = "il" ;} else {$ilelle = "elle" ;}
						echo "
				 			" . $unActeur->prenomNom . "<br/>
 							" . $unActeur->Age . " ans<br/>
							né" . $ee . " le " . $unActeur->dateNaissance . "<br/>
				 			à " . $unActeur->villeNaissance . "
 				 			" . $unActeur->paysNaissance . "
				 			Dans ce film, " . $unActeur->prenomNom . " joue le rôle de " . $unActeur->role . ". 
							" . ucfirst($ilelle) . " était agé" . $ee . " de " . $unActeur->ageDansFilm . " lors de la sortie du film en France.
				 		</div>";
					}
					break;
				case "notation":
 					echo "<img src='./image/divers/enTravaux.png' alt='travaux'>";
 					break;
				case "commentaires":
					echo "<img src='./image/divers/enTravaux.png' alt='travaux'>";
					break;
			}
		?>								   	
	
	</div>
	
	<span class='contentInfos'>
	
	
	</span>
</div><!-- content2 -->