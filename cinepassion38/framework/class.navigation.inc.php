<?php
/*================================================================================================================
 fichier				: class.navigation.inc.php
 auteur				: Cloé GAGET
 date de création	: novembre 2018
 rôle				: la classe qui permet de gérer les barres de navigation.
 ================================================================================================================*/

/**
 * Classe permettant de gérer les barres de navigation
 * @author Cloé GAGET
 * @version 1.0
 */
class navigation {

	private $infos = array();
	

	/**
	 * Le constructeur de la classe
	 * @param array $parametres : Un tableau associatif contenant les paramètres de la requêtes HTTP
	 * @return null
	 * @author Cloé GAGET
	 * @version 1.0
	 */
	public function __construct($module, $page, $action, $sectionCourante, $nbSections, $numSection) {
		
		$this->infos = ["module" => $module, "page" => $page, "action" => $action, "sectionCourante" => $sectionCourante, "nbSections" => $nbSections, "numSection" => $numSection];
	}
	
	
/**
	 * Méthode MAGIQUE permettant de retourner la valeur de l'élément correspondant à la clé $cle dans le tableau $infos. Cette méthode se déclenche AUTOMATIQUEMENT lorsqu'on essaie de récupérer la valeur d'un attribut INEXISTANT
	 * @param string $cle : La cle de l'élément
	 * @return string : La valeur de l'élément correspondant à la clé $cle dans le tableau $donnees. Déclenche une exception si non trouvé
	 * @author Cloé GAGET
	 */
	public function __get($cle) {
		if (array_key_exists($cle, $this->infos)) {
			return $this->infos[$cle];
		}else {
			throw new Exception("[fichier] : " . __FILE__ . "<br/>[classe] : " . __CLASS__ . "<br/>[méthode] : " . __METHOD__ . "<br/>[message] : l 'élément dont la clé est " . $cle . " est introuvable");
		}
	}
	
	
	/**
	 * Méthode MAGIQUE permettant d'alimenter le tableau $infos qui se déclenche AUTOMATIQUEMENT lorsqu'on fait référence à un attribut INEXISTANT
	 * @param string $cle : la clé de l'élément à ajouter au tableau
	 * @param string $valeur : la valeur de l'élément à ajouter au tableau
	 * @return null
	 * @author Cloé GAGET
	 */
	public function __set($cle, $valeur) {
		$this->infos[$cle] = $valeur;
	}
	
	
	
	/**
	 * Fonction qui retourne le code Xhtml relatif à une barre de navigation
	 * @param 
	 * @return string
	 * @author Lucas GOMIS
	 * @version 1.0
	 */
	public function getXhtmlBoutons() {
		if ($this->sectionCourante == 1) {
			return "<img alt='' src='./framework/image/btPremInactif.png'/> 
					<img alt='' src='./framework/image/btPrecInactif.png'/>  
					<a href='index.php?module=" . ($this->module) . "&page=" . ($this->page) . "&section=" . ($this->sectionCourante + 1) . "'> 
						<img alt='' id='monImage' src='./framework/image/btSuivActif.png'
							 onmouseover = \"window.document.getElementById('monImage').src = './framework/image/btSuivSurvol.png'\"
							 onmouseout = \"window.document.getElementById('monImage').src = './framework/image/btSuivActif.png'\"/> 
					</a> 
					<a href='index.php?module=" . ($this->module) . "&page=" . ($this->page) . "&section=" . ($this->nbSections) . "'> 
						<img alt='' id='monImage2' src='./framework/image/btDerActif.png' 
							 onmouseover = \"window.document.getElementById('monImage2').src = './framework/image/btDerSurvol.png'\"
							 onmouseout = \"window.document.getElementById('monImage2').src = './framework/image/btDerActif.png'\"/> 
					</a>" ;
		} elseif ($this->sectionCourante == $this->nbSections) {
			return "<a href='index.php?module=" . ($this->module) . "&page=" . ($this->page) . "&section=1'> 
						<img alt='' id='imagePrem' src='./framework/image/btPremActif.png'
							 onmouseover = \"window.document.getElementById('imagePrem').src = './framework/image/btPremSurvol.png'\"
							 onmouseout = \"window.document.getElementById('imagePrem').src = './framework/image/btPremActif.png'\"/> 
					</a> 
					<a href='index.php?module=" . ($this->module) . "&page=" . ($this->page) . "&section=" . ($this->sectionCourante - 1) . "'>
						<img alt='' id='imagePrec' src='./framework/image/btPrecActif.png'
							 onmouseover = \"window.document.getElementById('imagePrec').src = './framework/image/btPrecSurvol.png'\"
							 onmouseout = \"window.document.getElementById('imagePrec').src = './framework/image/btPrecActif.png'\"/>
					</a> 
					<img alt='' src='./framework/image/btSuivInactif.png'/> 
					<img alt='' src='./framework/image/btDerInactif.png' />" ;
		} else {
			return "<a href='index.php?module=" . ($this->module) . "&page=" . ($this->page) . "&section=1'> 
						<img alt='' id='imagePrem' src='./framework/image/btPremActif.png'
						 	 onmouseover = \"window.document.getElementById('imagePrem').src = './framework/image/btPremSurvol.png'\"
							 onmouseout = \"window.document.getElementById('imagePrem').src = './framework/image/btPremActif.png'\"/> 
					</a> 
					<a href='index.php?module=" . ($this->module) . "&page=" . ($this->page) . "&section=" . ($this->sectionCourante - 1) . "'>
						<img alt='' id='imagePrec' src='./framework/image/btPrecActif.png'
							 onmouseover = \"window.document.getElementById('imagePrec').src = './framework/image/btPrecSurvol.png'\"
							 onmouseout = \"window.document.getElementById('imagePrec').src = './framework/image/btPrecActif.png'\"/>
					</a>
					<a href='index.php?module=" . ($this->module) . "&page=" . ($this->page) . "&section=" . ($this->sectionCourante + 1) . "'> 
						<img alt='' id='imageSuiv' src='./framework/image/btSuivActif.png'
							 onmouseover = \"window.document.getElementById('imageSuiv').src = './framework/image/btSuivSurvol.png'\"
							 onmouseout = \"window.document.getElementById('imageSuiv').src = './framework/image/btSuivActif.png'\"/> 
					</a> 
					<a href='index.php?module=" . ($this->module) . "&page=" . ($this->page) . "&section=" . ($this->nbSections) . "'> 
						<img alt='' id='imageDer' src='./framework/image/btDerActif.png'
							 onmouseover = \"window.document.getElementById('imageDer').src = './framework/image/btDerSurvol.png'\"
							 onmouseout = \"window.document.getElementById('imageDer').src = './framework/image/btDerActif.png'\"/> 
					</a>";
		}
				
		
	}
	
	
	
	
	
	
	
	
	
	
	/**
	 *
	 * @param
	 * @return string
	 * @author Cloé GAGET
	 * @version 1.0
	 */
	public function getXhtmlNumeros() {
		
		$section = $this->sectionCourante;
		$nbNumSections = $this->numSection;
		$resultat = "";
		
		for ($i = 1; $i <= $this->nbSections; $i++) {
			if ((($section-$i >= 0) && ($section-$i <= $nbNumSections)) || ((($i-$section >=0) && ($i-$section <= $nbNumSections)) && ($section != $i) || ($i == 1) || ($i == $this->nbSections))) {
				if ($section != $i) {
					$resultat .= '<a href="index.php?module=' . ($this->module) . '&page=' . ($this->page) . '&section=' . $i . '">'.$i.'</a>';
				} else {
					$resultat .= '<span>'.$i.'</span>' ;
				}
			} elseif (($i == $nbNumSections) || ($i == $this->nbSections - 1)) { //affichage des trois petits points
				$resultat .= '...' ;
			}
		}
		return $resultat;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
} // class