<?php

/*======= C O N T R O L E U R ====================================================================================
 fichier				: ./mvc/controleur/film/liste.inc.php
auteur				: Lucas GOMIS
date de création	: Novembre 2018
date de modification:
rôle				: le contrôleur de la page de la liste des films
================================================================================================================*/

/**
 * Classe relative au contrôleur de la page de la liste des films
* @author Lucas GOMIS 
* @version 1.0
* @copyright Lucas GOMIS - Novembre 2018
*/
class controleurFilmListe extends controleur {

	
	
	
	/**
	 * Le constructeur de la classe modele permet d'initialiser tous les attributs de la classe
	 * @return null
	 * @author Lucas GOMIS
	 * @version 1.0
	 */
	public function __construct() {
		$this->modele = new modeleFilmListe();
	}
	
	
	
	/**
	 * Met à jour le tableau $donnees de la classe mère avec les informations spécifiques de la page
	 * @param null
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.1
	 * @copyright Christophe Goidin - juin 2017
	 */
	public function setDonnees() {
		// ===============================================================================================================
		// titres de la page
		// ===============================================================================================================
		$this->titreHeader = "présentation de l'association";
		$this->titreMain = "Présentation de l'association cinepassion38";

		// ===============================================================================================================
		// encarts
		// ===============================================================================================================
		$this->encartsGauche = "partenaires.txt";
		$this->encartsGauche = "dernieresActualites.txt";

		
		$this->enteteLien = $this->getEnteteLien("tableau.css");
		$this->enteteLien .= $this->getEnteteLien("navigation.css");

		//$this->navigation = parent::getNavigation();
		// ===============================================================================================================
		// alimentation des données COMMUNES à toutes les pages
		// ===============================================================================================================
		parent::setDonnees();
	}





	/**
	 * Génère l'affichage de la vue pour l'action par défaut de la page
	 * @param null
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - Juin 2017
	 */
	public function defaut() {
		$this->nbFilms = $this->modele->getNbFilms();
		$this->nbLignes = configuration::get("nbLignesSection");
		
		$this->nbSections = $this->getNbSections(configuration::get("nbLignesSection"), $this->nbFilms);
		$this->sectionCourante = $this->getParametreHTTP("section");
		
		//$this->sectionCourante = $this->requete->getParametre("section");

		$this->numPremierFilm = ($this->sectionCourante - 1)*($this->nbLignes);
		$this->numDernierFilm = ($this->sectionCourante)*($this->nbLignes);
		$this->listeFilms = $this->modele->getListeFilms(($this->numPremierFilm), ($this->nbLignes));
		
		//$this->infosEnPlus = array("nbNumSections" => configuration::get("nbNumSections"));
		
		$this->navigation = new navigation($this->module, $this->page, $this->action, $this->sectionCourante, $this->nbSections, configuration::get("nbNumSections"));
		
		$this->XhtmlBoutons = $this->navigation->getXhtmlBoutons();
		$this->XhtmlNumeros = $this->navigation->getXhtmlNumeros();
		
		parent::genererVue();
	}

	
	
	

	
	
	
	
	
	
} // class

?>

