<?php
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/film/accueil.inc.php
	auteur				: Lucas GOMIS
	date de création	: Novembre 2018
	date de modification:
	rôle				: le contrôleur de la page de la fiche d'un film
  ================================================================================================================*/

/**
 * Classe relative à au controleur de la page de la fiche d'un film
 * @author Lucas Gomis
 * @version 1.0
 */

class controleurFilmFiche extends controleur {
	

	/**
	 * Le constructeur de la classe modele permet d'initialiser tous les attributs de la classe
	 * @return null
	 * @author Cloé Gaget
	 * @version 1.0
	 */
	public function __construct() {
		$this->modele = new modeleFilmFiche();
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
		// Informations communes de la page
		// ===============================================================================================================
		$this->infosFilm = $this->modele->getInformationsFilm($this->section);
		$this->titreFilm = $this->infosFilm->titre;
		$this->numFilm = $this->requete->getParametre("section");
		$this->afficheFilm = $this->getAffiche($this->infosFilm->titre);
		$this->photosFilm = $this->getPhotos($this->infosFilm->titre);
		$this->action = $this->requete->existeParametre("action") == null ? "defaut" : $this->requete->getParametre("action");
		
		
		// ===============================================================================================================
		// titres de la page
		// ===============================================================================================================
		$this->titreHeader = $this->titreFilm;
		$this->titreMain = "Fiche descriptive du film : " . $this->titreFilm;
		
		// ===============================================================================================================
		// encarts
		// ===============================================================================================================
		// rien
		// ===============================================================================================================
		// texte défilant
		// ===============================================================================================================
		// rien
		
		
		
		// ===============================================================================================================
		// lien à intégrer dans la page
		// ===============================================================================================================
		$this->enteteLien = $this->getEnteteLien("onglet");
		$this->enteteLien .= $this->getEnteteLien("ficheFilm");
		
		// ===============================================================================================================
		// galerie photos lightbox
		// ===============================================================================================================
		
		$this->enteteLien .= $this->getEnteteLien("lightbox");
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
	 * @copyright Christophe Goidin - juin 2017
	 */
	public function defaut() {
		$this->informations();
	}
	
	/**
	 * Récupère les informations de la vue histoire
	 * @param //
	 * @return //
	 * @author Lucas GOMIS
	 */
	public function histoire(){
	
		$this->synopsis = $this->modele->getHistoireFilm($this->infosFilm->num);
		$this->onglet = "histoire";
		parent::genererVue();
	}
	
	
	
	/**
	 * Récupère les informations de la vue acteurs
	 * @param //
	 * @return //
	 * @author Cloé GAGET
	 */
	public function acteurs(){
		$this->listeActeurs = $this->modele->getListeActeurs($this->section);
		for ($i = 0; $i < $this->listeActeurs->getTaille(); $i++) {
			$unActeur = $this->listeActeurs->getUnElement($i);
			$chemin = configuration::get("cheminPhotoActeur") . "/" . $unActeur->prenomNom . ".jpg";
			$unActeur->cheminPhoto = $chemin;
		}
	
		$this->onglet = "acteurs";
		parent::genererVue();
	}
	
	
	
	/**
	 * Récupère les informations de la vue informations
	 * @param //
	 * @return //
	 * @author Lucas GOMIS
	 */
	public function informations(){
	
	
		$this->positionFilm = $this->modele->getPositionFilmParRealisateur($this->infosFilm->numRea, $this->infosFilm->num);
		$this->realisateur = $this->infosFilm->realisateur;
		$this->nationaliteRea = $this->infosFilm->nationaliteRealisateur;
		$this->libelleGenre = $this->infosFilm->libelleGenre;
		$this->nationaliteFilm = $this->infosFilm->nationaliteFilm;
		$this->dureeHeure = $this->infosFilm->dureeHeure;
		$this->dureeMinute = $this->infosFilm->dureeMinute;
		$this->dateSortie = $this->infosFilm->dateSortie;
		//$this->synopsis = $this->modele->getHistoireFilm($this->infosFilm->num);
		$this->onglet = "informations";
		parent::genererVue();
	}
	
	
	/**
	 * Récupère les informations de la vue notation
	 * @param //
	 * @return //
	 * @author Lucas GOMIS
	 */
	public function notation(){
		$this->onglet = "notation";
		parent::genererVue();
	}
	
	
	/**
	 * Récupère les informations de la vue commentaires
	 * @param //
	 * @return //
	 * @author Lucas GOMIS
	 */
	public function commentaires(){
		$this->onglet = "commentaires";
		parent::genererVue();
	}
	
	
	
	
	
	
	
	/**
	 * Renvoie l'adresse de l'affiche du film dont le titre est passé en paramètre
	 * @param string $titreFilm : le titre du film
	 * @return string : l'adresse de l'affiche du film
	 * @author Lucas GOMIS
	 * @version 1.0
	 * @copyright Lucas GOMIS - Novembre 2018
	 */

	private function getAffiche($titreFilm){
	
		$dossierAffiches = configuration::get("cheminAffiches");
		$cheminAffiche = $dossierAffiches . "/" . $titreFilm . ".jpg";
		if (!file_exists(utf8_decode($cheminAffiche))) {
			$cheminAffiche = $dossierAffiches . "/Aucune affiche.jpg";
		}
	
		return $cheminAffiche;
	}
		
	
	
	/**
	 * Renvoie les adresses des photos du film dont le titre est passé en paramètre
	 * @param string $titreFilm : le titre du film
	 * @return array : tableau composé des adresses des photos
	 * @author Cloé GAGET
	 */
	private function getPhotos($titreFilm){
		$lesPhotos = array();
		$dir = configuration::get("cheminPhotos") . "/" . $titreFilm;
		$chemin = $dir;
		$i = 0;
		if ((file_exists($dir)) && (sizeof(scandir($dir))>2)) {
			$dir = opendir($dir);
			while (false !== ($fichier = readdir($dir))) {
				if (pathinfo($fichier, PATHINFO_EXTENSION) == "jpg") {
					$lesPhotos[$i] = $chemin . "/" . $fichier;
					$i++;
				}
			}
			closedir($dir);
			return $lesPhotos;
		} else {
			return false;
		}
	}
	
	


} // class

?>

