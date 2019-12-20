<?php

/*======= M O D E L E ====================================================================================
 fichier				: ./mvc/modele/user/deconnexion.inc.php
 auteur				: Cloé GAGET
 date de création	: Novembre 2018
 date de modification:
 rôle				: le modèle de la déconnexion
 ================================================================================================================*/


class modeleUserDeconnexion extends modele {


/**
 * Récupère la durée de la connexion de l'utilisateur qui vient de se déconnecter
 * @param string $loginUser : le login de l'utilisateur
 * @return object : un objet anonyme composé du nombre d'heures, du nombre de minutes et du 
                    nombre de secondes de la connexion de l'utilisateur
 */
public function getDureeConnexion($loginUser) {
	$params = array($loginUser);
	$PDOStat = $this->executerRequete("SELECT (60 - DATE_FORMAT(TIMEDIFF(dateHeureDerniereConnexionUser, NOW()), '%s')) as dureeCoSec,
										DATE_FORMAT(DATEDIFF(dateHeureDerniereConnexionUser, NOW()), '%j') as dureeCoDate
										FROM user 
										WHERE loginUser = ?", $params);
	$resultat = $PDOStat->fetchObject();
	return $resultat;
}




















	
	
} // class

?>