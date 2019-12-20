<?php 
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/user/accueil.inc.php
	auteur				: Lucas GOMIS
	date de création	: Mars 2019
	date de modification:
	rôle				: le contrôleur d'authentification
  ================================================================================================================*/

/**
 * Classe relative au contrôleur de la page accueil du domaine cinepassion38
 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
 * @version 1.0
 * @copyright Christophe Goidin - juin 2017
 */
class controleurUserDeconnexion extends controleur {
	

	/**
	 * Le constructeur de la classe modele permet d'initialiser tous les attributs de la classe
	 * @return null
	 * @author Cloé Gaget
	 * @version 1.0
	 */
	public function __construct() {
		$this->modele = new modeleUserDeconnexion();
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
		//$this->titreHeader = "présentation de la section user";
		//$this->titreMain = "Ce site propose certaines fonctionnalités qui ne sont accessibles qu'aux personnes ayant un compte. 3 niveaux de compte sont proposés.";
				
		// ===============================================================================================================
		// encarts
		// ===============================================================================================================
		$this->encartsGauche = "partenaires.txt";
		$this->encartsDroite = "partenaires.txt";
		$this->encartsDroite = "partenaires.txt";
		
		// ===============================================================================================================
		// texte défilant
		// ===============================================================================================================
		// rien
		
		
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
		
		
		$this->prenomNomUser = $_SESSION['user']->prenomNomUser;
		$this->dureeCo = $this->modele->getDureeConnexion($_SESSION['user']->login);
		$this->dureeCoSec = $this->dureeCo->dureeCoSec;
		$this->dureeCoDate = $this->dureeCo->dureeCoDate;
		$this->sexeUser = $_SESSION['user']->sexeUser;
		$this->deconnexion();
		// on genere la vue
		parent::genererVue();
	}

	
	
	public function deconnexion() {
		session_destroy();
	}
	
	
	
} // class

?>















