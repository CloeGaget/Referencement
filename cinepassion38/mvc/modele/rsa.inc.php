<?php

/*======= M O D E L E ====================================================================================
 fichier				: ./mvc/modele/film/accueil.inc.php
 auteur				: Lucas GOMIS
 date de création	: Mars 2019
 date de modification:
 rôle				: le modèle pour récupérer les clés RSA
 ================================================================================================================*/

class modeleRSA extends modele {

/**
 * Récupère la clé publique RSA
 * @param integer $num : le numéro du couple de clé RSA
 * @return string : la clé publique du couple de clé RSA dont le numéro est passé en paramètre
 */
public function getPublicKeyRsa($num) {
	$PDOStat = $this->executerRequete("SELECT publicKeyRsa FROM rsa WHERE numKeyRsa = \"" . $num . "\"");
	$resultat = $PDOStat->fetchObject();
	return $resultat->publicKeyRsa;
}


/**
 * Récupère la clé privée RSA
 * @param integer $num : le numéro du couple de clé RSA
 * @return string : la clé privée du couple de clé RSA dont le numéro est passé en paramètre
 */
public function getPrivateKeyRsa($num) {
	$PDOStat = $this->executerRequete("SELECT privateKeyRsa FROM rsa WHERE numKeyRsa = \"" . $num . "\"");
	$resultat = $PDOStat->fetchObject();
	return $resultat->privateKeyRsa;
}


}


?>