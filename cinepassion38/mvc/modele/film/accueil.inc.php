<?php

/*======= M O D E L E ====================================================================================
 fichier				: ./mvc/modele/film/accueil.inc.php
 auteur				: Cloé GAGET
 date de création	: Novembre 2018
 date de modification:
 rôle				: le modèle de la page d'accueil des films
 ================================================================================================================*/


class modeleFilmAccueil extends modeleFilm {


/**
 * Renvoie le numéro du film à partir de son titre
 * @param string $titreFilm : le titre du film
 * @return integer : le numéro du film
 * @author Cloé Gaget
 */
public function getNumFilm($titreFilm) {
	$PDOStat = $this->executerRequete("SELECT numFilm FROM film WHERE titreFilm = \"" . $titreFilm . "\"");
	$resultat = $PDOStat->fetchObject();
	return $resultat->numFilm;
}
	
	
	
	
	
} // class

?>