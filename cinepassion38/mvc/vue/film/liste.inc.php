<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/film/liste.inc.php
 auteur					: Cloé GAGET
 date de création		: Octobre 2018
 date de modification	:
 rôle					: permet de générer le code xhtml de la page des fiches des films'un film
 ================================================================================================================= -->
 
<div id='content1'>
	<span class='contentTitre'>
		la liste des films de notre cinémathèque
	</span>
	Le tableau ci-dessous présente l'intégralité des films référencés dans notre cinémathèque (119 films actuellement). Les films sont triés selon l'ordre alphabétique. En survolant le titre d'un film, le réalisateur correspondant s'affiche dans une note. En cliquant sur une ligne du tableau, la page présentant les informations détaillées du film sera affichée.
</div><!-- content1 -->
 
 
 
<div id='content2'>
		<table> 
				<tr>
					<th> Les  <?php echo $nbFilms;?> films de notre cinémathèque </th>
					<th> Section n°<?php echo $sectionCourante; ?>/<?php echo $nbSections; ?> </th>
					<th colspan="2"> Films n°<?php echo $numPremierFilm + 1; ?> à <?php echo $numDernierFilm; ?> </th>				
				</tr>
			    <tr>
					<th> titre </th>
					<th> genre </th>
					<th> année </th>
					<th> durée </th>
				</tr>
				<?php 
				while ($unFilm = $listeFilms->getUnElement()) {
					echo "<tr onclick='window.location.href = \"./index.php?module=film&page=fiche&section=" . $unFilm->num . "\"'> 
						  	<td id='titreFilm'> <acronym title='un film de " . $unFilm->prenomRealisateur . " " . $unFilm->nomRealisateur . "'> " . $unFilm->titre . "</acronym> </td>
							<td>" . $unFilm->libelleGenre . "</td>
							<td>" . $unFilm->anneeSortie . "</td>
 							<td>" . $unFilm->duree . "</td>
 						 </tr>";
				//balise acronym pour le lien qui apparaît avec le réalisateur
				} ?>
				
				
		</table>
		<div id='navigation'>
			<div id='navigationBoutons'>
				<?php echo $XhtmlBoutons; ?>
			</div>
			<div id='navigationNumeros'>
				<?php echo $XhtmlNumeros; ?>
			</div> 
		</div>
	<span class='contentInfos'>
	
	
	</span>
</div><!-- content2 -->

