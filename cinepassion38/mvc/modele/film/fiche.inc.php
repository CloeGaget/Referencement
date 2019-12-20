<?php

/*======= M O D E L E ====================================================================================
 fichier				: ./mvc/modele/film/fiche.inc.php
 auteur				: Cloé GAGET
 date de création	: Novembre 2018
 date de modification:
 rôle				: le modèle de la page qui affiche la fiche d'un film
 ================================================================================================================*/


class modeleFilmFiche extends modeleFilm {


	
	
/**
 * Renvoie l'histoire du film à partir de son titre
 * @param integer $titreFilm : le num du film
 * @return string : l'histoire du film
 * @author Lucas GOMIS
 */
public function getHistoireFilm($numFilm) {
	$PDOStat = $this->executerRequete("SELECT synopsisFilm FROM film WHERE numFilm = " . $numFilm);
	$resultat = $PDOStat->fetchObject();
	return $resultat->synopsisFilm;
}
	

/**
 * Renvoie les informations du film àp de son numéro
 * @param integer $numFilm : le num du film
 * @return object : objet anonyme contenant les infos relatives au film
 * @author Cloé Gaget
 */
public function getInformationsFilm($numFilm) {
	$PDOStat = $this->executerRequete("SELECT 
										CASE p.sexePersonne
											WHEN 'M' THEN py2.nationaliteHomme
											WHEN 'F' THEN py2.nationaliteFemme
											END as nationaliteRealisateur,
										DATE_FORMAT(f.dateSortieFilm, '%M %d %Y') as dateSortie,
										HOUR(f.dureeFilm) as dureeHeure,
										MINUTE(f.dureeFilm) as dureeMinute,
										g.libelleGenre,
										py.nationaliteHomme as nationaliteFilm,
										p.nomPersonne as nomRealisateur, 
										p.prenomPersonne as prenomRealisateur,
										CONCAT(p.prenomPersonne, ' ', p.nomPersonne) as realisateur,
										f.numFilm as num,
										f.numRealisateurFilm as numRea,
										p.sexePersonne as sexeRealisateur,
										f.titreFilm as titre
										FROM film f 
										INNER JOIN realisateur r ON f.numRealisateurFilm = r.numRealisateur 
										INNER JOIN genre g ON f.numGenreFilm = g.numGenre
										INNER JOIN personne p ON r.numRealisateur = p.numPersonne
										INNER JOIN pays py ON py.numPays = f.numPaysFilm
										INNER JOIN pays py2 ON py2.numPays = p.numPaysPersonne
										WHERE numFilm = " . $numFilm . "
										ORDER BY f.titreFilm ASC");
	$film = $PDOStat->fetchObject();
	$film->positionFilm = $this->getPositionFilmParRealisateur($film->numRea, $film->num);
	return $film;
}





/**
 * Renvoie la position du film $film parmi tous les films du réalisateur dont le numéro est $realisateur
 * @param integer $realisateur : le numéro du réalisateur
 * @param integer $film : le numéro du film dont on recherche la position
 * @return integer : la position du film : 1er, 2ème, ...
 * @throws : une exception est lancée si aucun film n'est trouvé
 * @author : Cloe GAGET
 */
public function getPositionFilmParRealisateur($realisateur, $film) {
	$PDOStat1 = $this->executerRequete("SET @row_number = 0;");
	$PDOStat = $this->executerRequete("SELECT (@row_number:=@row_number + 1) AS num, numFilm
									FROM film
									WHERE numRealisateurFilm = ".$realisateur."
									ORDER BY dateSortieFilm ASC");
	$resultat = $PDOStat->fetchObject();
	
	while ($resultat = $PDOStat->fetchObject()) {
		if ($resultat->numFilm == $film) {
			$resultat = $resultat->num;
			break;
		} else {
			$resultat = "erreur";
		}
	}
	return $resultat;
}









/**
 * Renvoie les acteurs ayant participés au film dont le numéro est passé en paramètre
 * @param integer $titreFilm : le num du film
 * @return une collection d'objets anonymes contenant les informations sur les acteurs ayant participés
 * au film dont le numéro est passé en paramètre
 * @author Lucas GOMIS
 */
public function getListeActeurs($numFilm) {
	$PDOStat = $this->executerRequete("SELECT getAge(pe.dateNaissancePersonne) as Age, 
       								  		  getAge(pe.dateNaissancePersonne)- getNbAnneesEcart(CurDate(), f.dateSortieFilm) as ageDansFilm,
       								  		  pe.dateNaissancePersonne as dateNaissance,
       										  p.libellePays as paysNaissance,
       										  CONCAT(pe.prenomPersonne, ' ', pe.nomPersonne) as prenomNom,
       										  pa.role as role,
       										  pe.sexePersonne as sexe,
       										  pe.villeNaissancePersonne as villeNaissance
									  FROM Personne pe 
									  INNER JOIN acteur a ON pe.numPersonne = a.numActeur
									  INNER JOIN participer pa ON a.numActeur = pa.numActeur
									  INNER JOIN film f ON pa.numFilm = f.numFilm
									  INNER JOIN pays p ON p.numPays = pe.numPaysPersonne
									  WHERE f.numFilm = " . $numFilm);
	$this->listeActeurs = new collection();
	while ($resultat = $PDOStat->fetchObject()) {
		$this->listeActeurs->ajouter($resultat);
	}
	
	return $this->listeActeurs;
}


/**
 * Renvoie les fims réalisés par le réalisateur passé en paramètre
 * @param integer $numRea: le num du réalisateur
 * @return un tableau contenant les films d'un réalisateur
 * @author Lucas GOMIS
 */
public function getListeFilmsRealisateur($numRea){
	$PDOStat = $this->executerRequete("SELECT titreFilm FROM film");
	//A continuer 
}





	
} // class

?>