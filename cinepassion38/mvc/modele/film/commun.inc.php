<?php

/*======= M O D E L E ====================================================================================
 fichier				: ./mvc/modele/film/commun.inc.php
 auteur				: Cloé GAGET
 date de création	: Novembre 2018
 date de modification:
 rôle				: le modèle commun aux pages concernant les films
 ================================================================================================================*/


class modeleFilm extends modele {


	/**
	 * Renvoie le nombre total de films
	 * @param null
	 * @return integer : le nombre total de films
	 * @author Cloé Gaget
	 */
	public function getNbFilms() {
		$PDOStat = $this->executerRequete("SELECT COUNT(*) as nb FROM film");
		$resultat = $PDOStat->fetchObject();
		return $resultat->nb;
	}




} // class

?>