<?php
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/user/accueil.inc.php
	auteur				: Lucas GOMIS
	date de création	: Mars 2019
	date de modification:
	rôle				: le contrôleur de la page d'accueil de l'onglet user
  ================================================================================================================*/

/**
 * Classe relative au contrôleur de la page accueil du domaine cinepassion38
 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
 * @version 1.0
 * @copyright Christophe Goidin - juin 2017
 */
class controleurUserAccueil extends controleur {
	
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
		$this->titreHeader = "présentation de la section user";
		$this->titreMain = "Ce site propose certaines fonctionnalités qui ne sont accessibles qu'aux personnes ayant un compte. 3 niveaux de compte sont proposés.";
				
		// ===============================================================================================================
		// encarts
		// ===============================================================================================================
		$this->encartsGauche = "partenaires.txt";
		$this->encartsGauche = "dernieresActualites.txt";
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
		parent::genererVue();
	}

} // class

?>

