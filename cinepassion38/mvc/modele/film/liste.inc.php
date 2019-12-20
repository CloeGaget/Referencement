<?php

/*======= M O D E L E ====================================================================================
 fichier				: ./mvc/modele/film/liste.inc.php
 auteur				: Cloé GAGET
 date de création	: Novembre 2018
 date de modification:
 rôle				: le modèle de la page de la liste des films
 ================================================================================================================*/


class modeleFilmListe extends modeleFilm {


/**
 * Renvoie une collection contenant les films existants
 * @param integer $numFilm : le numero du premier film à récupérer
 * @param integer $nbFilms : le nombre de films par section
 * @return collection lesFilms : les films de la db
 * @author Cloé Gaget
 */
public function getListeFilms($premierFilm, $nb) {
	$PDOStat = $this->executerRequete("SELECT f.numFilm as num, 
										f.titreFilm as titre, 
										g.libelleGenre, 
										YEAR(f.dateSortieFilm) as anneeSortie, 
										f.dureeFilm as duree, 
										p.nomPersonne as nomRealisateur, 
										p.prenomPersonne as prenomRealisateur 
										FROM film f 
										INNER JOIN realisateur r ON f.numRealisateurFilm = r.numRealisateur 
										INNER JOIN genre g ON f.numGenreFilm = g.numGenre
										INNER JOIN personne p ON r.numRealisateur = p.numPersonne
										ORDER BY f.titreFilm ASC
										LIMIT " . $premierFilm . ", " . $nb);
	$this->listeFilms = new collection();
	while ($resultat = $PDOStat->fetchObject()) {
		$this->listeFilms->ajouter($resultat);
	}

	return $this->listeFilms;
}
	
	

	
	
} // class

?>