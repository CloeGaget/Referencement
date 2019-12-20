<?php
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/film/accueil.inc.php
	auteur				: Lucas GOMIS
	date de création	: Octobre 2018
	date de modification:
	rôle				: le contrôleur de la page d'accueil des films
  ================================================================================================================*/

/**
 * Classe relative à l'accueil de la page des films de Cinepassion38
 * @author Lucas Gomis
 * @version 1.0
 */

class controleurFilmAccueil extends controleur {
	

	/**
	 * Le constructeur de la classe modele permet d'initialiser tous les attributs de la classe
	 * @return null
	 * @author Cloé Gaget
	 * @version 1.0
	 */
	public function __construct() {		
		$this->modele = new modeleFilmAccueil();
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
		$this->titreHeader = "Page d'accueil de nos films";
		$this->titreMain = "Bienvenue sur la page d'accueil de nos films";
		
		// ===============================================================================================================
		// encarts
		// ===============================================================================================================
		$this->encartsGauche = "partenaires.txt";
		$this->encartsDroite = "meteo.txt";
		
		// ===============================================================================================================
		// texte défilant
		// ===============================================================================================================
		// rien
		
		// ===============================================================================================================
		// lien à intégrer dans la page
		// ===============================================================================================================
		$this->enteteLien = $this->getEnteteLien("simpleSlideShow");
		
		
		
		// ===============================================================================================================
		// alimentation des données COMMUNES à toutes les pages
		// ===============================================================================================================	
		parent::setDonnees();
	}
	
	
	/**
	 * Récupère aléatoirement et sans doublons des affiches de film
	 * @param int $nombreImages le nombre d'images que l'on souhaite récupérer
	 * @return un tableau d'images jpg
	 * @author Lucas Gomis
	 * @version 1.0
	 */
	public function imagesAleatoires($nombreImages) {
		$fileName = configuration::get("cheminAffiches");
		$i = 0;
		if (file_exists($fileName)) {
			$fileName = opendir($fileName);
			
			
			// ==================================================================
			// alimetation du tableau
			// ==================================================================
			
			while (false !== ($fichier = readdir($fileName))) {
				if ($fichier != configuration::get("fichiersExclus") && pathinfo($fichier, PATHINFO_EXTENSION) == "jpg") {
					$tableauImages[$i] = $fichier;
					$i++;
				}
			}
			closedir($fileName);
			
			
			// ==================================================================
			// sélection aléatoire des images
			// ==================================================================
			$total = count($tableauImages);
			$aleatoire = mt_rand(0, $total - 1);
			$tableauImagesAleatoires[0] = array($this->modele->getNumFilm(str_replace("'", utf8_encode(pathinfo($tableauImages[$aleatoire], PATHINFO_FILENAME)), "\'")) => $tableauImages[$aleatoire]);
			//$tableauImagesAleatoires[0] = $tableauImages[$aleatoire];
			//$tableauImagesAleatoires[0] = array("numFilm" => )
			for ($k = 1; $k < $nombreImages; $k++) {  // gérer les doublons
				//$aleatoire = mt_rand(0, $total - 1);
				//$imageAffiche = $tableauImages[$aleatoire];
				Do {
					$aleatoire = mt_rand(0, $total - 1);
				} while (in_array($tableauImages[$aleatoire], $tableauImagesAleatoires));
				$imageAffiche = $tableauImages[$aleatoire];
				//$tableauImagesAleatoires[$k] = $imageAffiche;
				$tableauImagesAleatoires[$k] = array($this->modele->getNumFilm(str_replace("'", utf8_encode(pathinfo($tableauImages[$aleatoire], PATHINFO_FILENAME)), "\'")) => $imageAffiche);
			}			
			return $tableauImagesAleatoires;
		}
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
		$this->nbFilms = $this->modele->getNbFilms();
		
		
		$this->tabImagesAleatoires = $this->imagesAleatoires(5);
		parent::genererVue();	
	}

} 

?>

