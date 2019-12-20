<?php
/*================================================================================================================
	fichier				: class.requete.inc.php
	auteur				: Christophe Goidin (christophe.goidin@ac-grenoble.fr)
	date de création	: juin 2017
	date de modification:  
	rôle				: modéliser la requête HTTP
  ================================================================================================================*/

/**
 * Classe permettant de modéliser la requête HTTP
 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
 * @version 1.0
 * @copyright Christophe Goidin - juin 2017
 */
class requete {

	private $parametres;	// le tableau associatif rassemblant les paramètres de la requête HTTP

	/**
	 * Le constructeur de la classe
	 * @param array $parametres : Un tableau associatif contenant les paramètres de la requêtes HTTP
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - juin 2017
	 */
	public function __construct($parametres) {
		$this->parametres = $parametres;
	}

	/**
	 * Renvoie le booléan vrai si le paramètre existe dans la requête HTTP
	 * @param string $nom : le nom du paramètre dont on veut tester l'existence
	 * @return boolean : true si le paramètre existe et qu'il ne vaut pas "" dans la requete HTTP. False sinon
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - juin 2017
	 */
	public function existeParametre($nom) {
		return (isset($this->parametres[$nom]) && ($this->parametres[$nom] != ""));
	}

	/**
	 * Renvoie la valeur du paramètre demandé. Une exception est levée si le paramètre est introuvable
	 * @param string $nom : le nom du paramètre dont on veut récupérer la valeur
	 * @return string : la valeur du paramètre
	 * @throws
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - juin 2017
	 */
	public function getParametre($nom) {
		if ($this->existeParametre($nom)) {
			return $this->parametres[$nom];
		}else {
			throw new Exception("[fichier] : " . __FILE__ . "<br/>[classe] : " . __CLASS__ . "<br/>[méthode] : " . __METHOD__ . "<br/>[message] : le paramètre '$nom' est absent de la requête HTTP");
		}
	}

} // class

?>
