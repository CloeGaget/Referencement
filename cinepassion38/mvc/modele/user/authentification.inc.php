<?php

/*======= M O D E L E ====================================================================================
 fichier				: ./mvc/modele/user/authentification.inc.php
 auteur				: Cloé GAGET
 date de création	: Novembre 2018
 date de modification:
 rôle				: le modèle de l'authentification
 ================================================================================================================*/


class modeleUserAuthentification extends modele {


/**
 * renvoie un objet anonyme comportant les informations sur l'utilisateur qui vient de 
   s'authentifier ou le bool�an false si la tentative d'authentification se solde par un 
   �chec.
 * @param string $loginUser : le login de l'utilisateur
 * @param string $motDePasseUser : le mot de passe de l'utilisateur
 * @return object : un objet anonyme comportant les informations sur l'utilisateur qui vient 
   de s'authentifier (si son login et son mot de passe sont bons). Le bool�en false est 
   renvoy� si le login et/ou le mot de passe sont incorrects (car la m�thode fetch renvoie le 
   bool�en false lorsqu'il n'y a plus de tuples � lire)
 * @author Clo� Gaget
 */
public function getInformationsUser($loginUser, $motDePasseUser) {
	$grainDeSel = $this->getGrainDeSelUser($loginUser);
	$params = array("mdp" => $motDePasseUser, "login" => $loginUser, "grainDeSel" => $grainDeSel);
	$PDOStat = $this->executerRequete("SELECT *, 
										DATE(u.dateHeureCreationUser) as dateCreationUser, 
										TIME(u.dateHeureDerniereConnexionUser) as heureDerniereConnexionUser, 
										DATE(u.dateHeureDerniereConnexionUser) as dateDerniereConnexionUser
										FROM user u INNER JOIN typeUser tu ON u.typeUser = tu.numTypeUser
										WHERE u.loginUser = :login AND u.motDePasseUser = SHA2(CONCAT(MD5(CONCAT(:grainDeSel, :mdp)), :grainDeSel, MD5(CONCAT(:mdp, :grainDeSel))), 512)", $params);
	$resultat = $PDOStat->fetchObject();
	return $resultat;
}
	
	


/**
 * Met � jour la date et l'heure de derni�re connexion de l'utilisateur
 * @param string $loginUser : le login de l'utilisateur
 * @return null
 * @author Clo� Gaget
 */
public function setDateHeureDerniereConnexionUser($loginUser) {
	$params = array($loginUser);
	$PDOStat = $this->executerRequete("UPDATE user
										SET dateHeureDerniereConnexionUser = NOW()
										WHERE loginUser = ?", $params);
}



/**
 * Met à jour le nombre d'échecs de connexion
 * @param string $loginUser : le login de l'utilisateur
 * @param string $operation : le type d'opération : "incrementer" ou "reinitialiser".
 * @return null
 * @author Lucas GOMIS
 */
public function setNbEchecConnexionUser($loginUser, $operation) {
	$params = array($loginUser);
	if ($operation == 'incrementer'){
		$PDOStat = $this->executerRequete("UPDATE user
										   SET nbEchecConnexionUser = nbEchecConnexionUser + 1
										   WHERE loginUser = ?", $params);
	} else { //reinitialiser
		$PDOStat = $this->executerRequete("UPDATE user SET nbEchecConnexionUser = 0 WHERE loginUser = ?", $params);
	}
}

/**
 * Met à jour le nombre total de connexions de l'utilisateur
 * @param string $loginUser : le login de l'utilisateur
 * @return null
 * @author Lucas GOMIS
 */
public function setNbTotalConnexionUser($loginUser) {
	$params = array($loginUser);
	$PDOStat = $this->executerRequete("UPDATE user
									   SET nbTotalConnexionUser = (nbTotalConnexionUser + 1)
									   WHERE loginUser = ?", $params);
}


/**
 * Renvoie le grain de sel de l'utilisateur
 * @param string $loginUser : le login de l'utilisateur
 * @return string
 * @author Cloé GAGET
 */
public function getGrainDeSelUser($loginUser) {
	$params = array($loginUser);
	$PDOStat = $this->executerRequete("SELECT grainDeSelUser
									   FROM user
									   WHERE loginUser = ?", $params);
	$resultat = $PDOStat->fetchObject();
	return $resultat->grainDeSelUser;
}



/**
 * Met à jour le grain de sel de l'utilisateur
 * @param string $loginUser : le login de l'utilisateur
* @param string $motDePasseUser : le mot de passe de l'utilisateur
 * @return null
 * @author Cloé GAGET
 */
public function setNewGrainDeSelUser($loginUser, $motDePasseUser) {
	$grainDeSel = $this->getGrainDeSelUser($loginUser);
	$params = array("mdp" => $motDePasseUser, "login" => $loginUser, "grainDeSel" => $grainDeSel);
	$PDOStat = $this->executerRequete("UPDATE user
									   SET grainDeSelUser = getGrainDeSel(),
									   motDePasseUser = getMotDePasseHache(:mdp, grainDeSelUser)
									   WHERE loginUser = :login AND motDePasseUser = SHA2(CONCAT(MD5(CONCAT(:mdp, :grainDeSel)), :grainDeSel, MD5(CONCAT(:grainDeSel, :mdp))), 512)", $params);
}











	
	
} // class

?>