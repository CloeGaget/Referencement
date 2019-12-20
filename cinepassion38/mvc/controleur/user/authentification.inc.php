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
class controleurUserAuthentification extends controleur {
	

	/**
	 * Le constructeur de la classe modele permet d'initialiser tous les attributs de la classe
	 * @return null
	 * @author Cloé Gaget
	 * @version 1.0
	 */
	public function __construct() {
		$this->modele = new modeleUserAuthentification();
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
	 * retourne l'adresse relative de l'image de l'avatar de l'utilisateur connecté
	 * @param null
	 * @return null
	 * @author Lucas GOMIS
	 * @version 1.0
	 */
	public function recupAffiche($avatar) {
		$iterator = new DirectoryIterator(dirname(configuration::get("cheminAvatar")));
		
		if ($avatar == "H") {
			return configuration::get("cheminAvatar") . "/homme.png";
		} elseif ($avatar == "F"){
			return configuration::get("cheminAvatar") . "/femme.png";
		} else {
			foreach ($iterator as $fileInfo1) {
				if ((!$fileInfo1->isDot()) and ($fileInfo1->isDir())) {
					$dir = configuration::get("cheminAvatar") . "/" . $fileInfo1->getBasename();
					foreach (new DirectoryIterator(dirname($dir)) as $fileInfo2) {
						//if (pathinfo($fichier, PATHINFO_FILENAME) == $avatar &&  pathinfo($fichier, PATHINFO_EXTENSION) == "png") {
						if (strtolower($fileInfo2->getFileName()) == strtolower($avatar)) {
								
							return $dir . "/" . $fileInfo2->getFilename();
						}
					}
				}
			}
		}
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
		// on recupère la clé privée
		require_once './mvc/modele/rsa.inc.php';
		$this->privateKeyRSA = (new modeleRSA())->getPrivateKeyRsa(configuration::get("numCleRSA"));
		
		// on decrypte
		
		
		include('./librairie/phpSeclib/Crypt/RSA.php');
		set_include_path(get_include_path(). PATH_SEPARATOR . getcwd() . DIRECTORY_SEPARATOR ."librairie\phpSeclib");
		$rsa = new Crypt_RSA();
		$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
		$rsa->loadKey($this->privateKeyRSA);
		
		$this->loginDecode = $rsa->decrypt(base64_decode($_POST['Login']));
		$this->mdpDecode = $rsa->decrypt(base64_decode($_POST['Password']));
		
		// recup data user
		$this->infosUser = $this->modele->getInformationsUser($this->loginDecode, $this->mdpDecode);
		
				
		
		// test connexion
		if(!$this->infosUser) {
			$this->modele->setNbEchecConnexionUser($this->loginDecode, "incrementer");
		} else {
			$this->modele->setNbEchecConnexionUser($this->loginDecode, "reinitialiser");
			$this->modele->setDateHeureDerniereConnexionUser($this->loginDecode);
			$this->modele->setNbTotalConnexionUser($this->loginDecode);
			$_SESSION['user'] = (object) array("avatarUser" => $this->recupAffiche($this->infosUser->avatarUser),
											   "libelleTypeUser" => $this->infosUser->libelleTypeUser,
											   "login" => $this->loginDecode,
											   "prenomNomUser" => $this->infosUser->nomUser . " " . $this->infosUser->prenomUser,
											   "sexeUser" => $this->infosUser->sexeUser);
			$this->dateFirstCo = $this->infosUser->dateCreationUser;
			$this->heureLastCo = $this->infosUser->heureDerniereConnexionUser;
			$this->dateLastCo = $this->infosUser->dateDerniereConnexionUser;
			$this->nbTotalCo = $this->infosUser->nbTotalConnexionUser;
			$this->nbEchecCo = $this->infosUser->nbEchecConnexionUser;
			// génération d'un nouveau grain de sel
			$this->modele->setNewGrainDeSelUser($this->loginDecode, $this->mdpDecode);
		}
		
		
		
		
		// on genere la vue
		parent::genererVue();
	}

} // class

?>















