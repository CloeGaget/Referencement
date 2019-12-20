<?php
/*=============================================================================================================
	fichier				: index.php
	auteur				: Christophe Goidin (christophe.goidin@ac-grenoble.fr)
	date de création	: juin 2017
	date de modification:  
	rôle				: le front contrôleur. C'est le point d'entrée de l'application 
===============================================================================================================*/

/**
 * Permet d'inclure le fichier définissant la classe $classe dont le nom est passé en paramètre
 * @param string $classe : le nom de la classe qui n'a pas été trouvée et dont il faut inclure le fichier la définissant
 * @return null
 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
 * @version 1.2
 * @copyright Christophe Goidin - juin 2017
 */
 function chargerClasse($classe) {
	// ===============================================================================================================
	// inclusion du fichier définissant la classe $classe s'il fait partie de notre framework
	// ===============================================================================================================
	if (file_exists("./framework/class." . $classe . ".inc.php")) {
		require_once "./framework/class." . $classe . ".inc.php";
// 	}elseif (file_exists("./mvc/modele/film/" . $classe . ".inc.php")) {
// 		require_once "./mvc/modele/film/" . $classe . ".inc.php";
// 	}
	}else {
		$tab = preg_split("/(?=[A-Z])/", $classe);
		$chemin = "./mvc";
		foreach ($tab as $morceauChemin) {
			$chemin .= "/" . $morceauChemin;
		}
		if (file_exists($chemin . ".inc.php")) {
			require_once $chemin . ".inc.php";
		}else {
			if (file_exists($chemin . "/commun.inc.php")) {
				require_once $chemin . "/commun.inc.php";
			}
		}
	}
	
}

// ===============================================================================================================
// la fonction spl_autoload_register permet d'exécuter automatiquement la fonction passée en paramètre (ici la fonction "chargerClasse")
// dès qu'on essaie d'instancier une classe si le fichier qui la défini n'a pas été inclus.
// Le nom de la classe est passé automatiquement en paramètre à la fonction "chargerClasse".
// ===============================================================================================================
spl_autoload_register('chargerClasse');

// ===============================================================================================================
// démarrage d'une session + positionnement de divers paramètres
// ===============================================================================================================
session_start();						// démarrage d'une session. A positionner APRES autoload
setlocale(LC_TIME, "fra");				// pour que les dates/heures s'affichent en français

// ===============================================================================================================
// routage de la requête http entrante
// ===============================================================================================================
$routeur = new routeur();
$routeur->routerRequete();

/*
                                                                                                                                                                                                                                                                                                                                                                                                                                                                     bbbbbbbb                                        
lllllll                                                                                       LLLLLLLLLLL                                                  iiii                                            MMMMMMMM               MMMMMMMMIIIIIIIIII      CCCCCCCCCCCCCHHHHHHHHH     HHHHHHHHHEEEEEEEEEEEEEEEEEEEEEELLLLLLLLLLL                                                GGGGGGGGGGGGG                                                                          b::::::b            lllllll                     
l:::::l                                                                                       L:::::::::L                                                 i::::i                                           M:::::::M             M:::::::MI::::::::I   CCC::::::::::::CH:::::::H     H:::::::HE::::::::::::::::::::EL:::::::::L                                             GGG::::::::::::G                                                                          b::::::b            l:::::l                     
l:::::l                                                                                       L:::::::::L                                                  iiii                                            M::::::::M           M::::::::MI::::::::I CC:::::::::::::::CH:::::::H     H:::::::HE::::::::::::::::::::EL:::::::::L                                           GG:::::::::::::::G                                                                          b::::::b            l:::::l                     
l:::::l                                                                                       LL:::::::LL                                                                                                  M:::::::::M         M:::::::::MII::::::IIC:::::CCCCCCCC::::CHH::::::H     H::::::HHEE::::::EEEEEEEEE::::ELL:::::::LL                                          G:::::GGGGGGGG::::G                                                                           b:::::b            l:::::l                     
 l::::lyyyyyyy           yyyyyyy cccccccccccccccc    eeeeeeeeeeee        eeeeeeeeeeee           L:::::L                  ooooooooooo   uuuuuu    uuuuuu  iiiiiii     ssssssssss       eeeeeeeeeeee         M::::::::::M       M::::::::::M  I::::I C:::::C       CCCCCC  H:::::H     H:::::H    E:::::E       EEEEEE  L:::::L                                           G:::::G       GGGGGGrrrrr   rrrrrrrrr       eeeeeeeeeeee    nnnn  nnnnnnnn       ooooooooooo   b:::::bbbbbbbbb     l::::l     eeeeeeeeeeee    
 l::::l y:::::y         y:::::ycc:::::::::::::::c  ee::::::::::::ee    ee::::::::::::ee         L:::::L                oo:::::::::::oo u::::u    u::::u  i:::::i   ss::::::::::s    ee::::::::::::ee       M:::::::::::M     M:::::::::::M  I::::IC:::::C                H:::::H     H:::::H    E:::::E               L:::::L                                          G:::::G              r::::rrr:::::::::r    ee::::::::::::ee  n:::nn::::::::nn   oo:::::::::::oo b::::::::::::::bb   l::::l   ee::::::::::::ee  
 l::::l  y:::::y       y:::::yc:::::::::::::::::c e::::::eeeee:::::ee e::::::eeeee:::::ee       L:::::L               o:::::::::::::::ou::::u    u::::u   i::::i ss:::::::::::::s  e::::::eeeee:::::ee     M:::::::M::::M   M::::M:::::::M  I::::IC:::::C                H::::::HHHHH::::::H    E::::::EEEEEEEEEE     L:::::L                                          G:::::G              r:::::::::::::::::r  e::::::eeeee:::::een::::::::::::::nn o:::::::::::::::ob::::::::::::::::b  l::::l  e::::::eeeee:::::ee
 l::::l   y:::::y     y:::::yc:::::::cccccc:::::ce::::::e     e:::::ee::::::e     e:::::e       L:::::L               o:::::ooooo:::::ou::::u    u::::u   i::::i s::::::ssss:::::se::::::e     e:::::e     M::::::M M::::M M::::M M::::::M  I::::IC:::::C                H:::::::::::::::::H    E:::::::::::::::E     L:::::L                     ---------------      G:::::G    GGGGGGGGGGrr::::::rrrrr::::::re::::::e     e:::::enn:::::::::::::::no:::::ooooo:::::ob:::::bbbbb:::::::b l::::l e::::::e     e:::::e
 l::::l    y:::::y   y:::::y c::::::c     ccccccce:::::::eeeee::::::ee:::::::eeeee::::::e       L:::::L               o::::o     o::::ou::::u    u::::u   i::::i  s:::::s  ssssss e:::::::eeeee::::::e     M::::::M  M::::M::::M  M::::::M  I::::IC:::::C                H:::::::::::::::::H    E:::::::::::::::E     L:::::L                     -:::::::::::::-      G:::::G    G::::::::G r:::::r     r:::::re:::::::eeeee::::::e  n:::::nnnn:::::no::::o     o::::ob:::::b    b::::::b l::::l e:::::::eeeee::::::e
 l::::l     y:::::y y:::::y  c:::::c             e:::::::::::::::::e e:::::::::::::::::e        L:::::L               o::::o     o::::ou::::u    u::::u   i::::i    s::::::s      e:::::::::::::::::e      M::::::M   M:::::::M   M::::::M  I::::IC:::::C                H::::::HHHHH::::::H    E::::::EEEEEEEEEE     L:::::L                     ---------------      G:::::G    GGGGG::::G r:::::r     rrrrrrre:::::::::::::::::e   n::::n    n::::no::::o     o::::ob:::::b     b:::::b l::::l e:::::::::::::::::e 
 l::::l      y:::::y:::::y   c:::::c             e::::::eeeeeeeeeee  e::::::eeeeeeeeeee         L:::::L               o::::o     o::::ou::::u    u::::u   i::::i       s::::::s   e::::::eeeeeeeeeee       M::::::M    M:::::M    M::::::M  I::::IC:::::C                H:::::H     H:::::H    E:::::E               L:::::L                                          G:::::G        G::::G r:::::r            e::::::eeeeeeeeeee    n::::n    n::::no::::o     o::::ob:::::b     b:::::b l::::l e::::::eeeeeeeeeee  
 l::::l       y:::::::::y    c::::::c     ccccccce:::::::e           e:::::::e                  L:::::L         LLLLLLo::::o     o::::ou:::::uuuu:::::u   i::::i ssssss   s:::::s e:::::::e                M::::::M     MMMMM     M::::::M  I::::I C:::::C       CCCCCC  H:::::H     H:::::H    E:::::E       EEEEEE  L:::::L         LLLLLL                            G:::::G       G::::G r:::::r            e:::::::e             n::::n    n::::no::::o     o::::ob:::::b     b:::::b l::::l e:::::::e           
l::::::l       y:::::::y     c:::::::cccccc:::::ce::::::::e          e::::::::e               LL:::::::LLLLLLLLL:::::Lo:::::ooooo:::::ou:::::::::::::::uui::::::is:::::ssss::::::se::::::::e               M::::::M               M::::::MII::::::IIC:::::CCCCCCCC::::CHH::::::H     H::::::HHEE::::::EEEEEEEE:::::ELL:::::::LLLLLLLLL:::::L                             G:::::GGGGGGGG::::G r:::::r            e::::::::e            n::::n    n::::no:::::ooooo:::::ob:::::bbbbbb::::::bl::::::le::::::::e          
l::::::l        y:::::y       c:::::::::::::::::c e::::::::eeeeeeee   e::::::::eeeeeeee       L::::::::::::::::::::::Lo:::::::::::::::o u:::::::::::::::ui::::::is::::::::::::::s  e::::::::eeeeeeee       M::::::M               M::::::MI::::::::I CC:::::::::::::::CH:::::::H     H:::::::HE::::::::::::::::::::EL::::::::::::::::::::::L                              GG:::::::::::::::G r:::::r             e::::::::eeeeeeee    n::::n    n::::no:::::::::::::::ob::::::::::::::::b l::::::l e::::::::eeeeeeee  
l::::::l       y:::::y         cc:::::::::::::::c  ee:::::::::::::e    ee:::::::::::::e       L::::::::::::::::::::::L oo:::::::::::oo   uu::::::::uu:::ui::::::i s:::::::::::ss    ee:::::::::::::e       M::::::M               M::::::MI::::::::I   CCC::::::::::::CH:::::::H     H:::::::HE::::::::::::::::::::EL::::::::::::::::::::::L                                GGG::::::GGG:::G r:::::r              ee:::::::::::::e    n::::n    n::::n oo:::::::::::oo b:::::::::::::::b  l::::::l  ee:::::::::::::e  
llllllll      y:::::y            cccccccccccccccc    eeeeeeeeeeeeee      eeeeeeeeeeeeee       LLLLLLLLLLLLLLLLLLLLLLLL   ooooooooooo       uuuuuuuu  uuuuiiiiiiii  sssssssssss        eeeeeeeeeeeeee       MMMMMMMM               MMMMMMMMIIIIIIIIII      CCCCCCCCCCCCCHHHHHHHHH     HHHHHHHHHEEEEEEEEEEEEEEEEEEEEEELLLLLLLLLLLLLLLLLLLLLLLL                                   GGGGGG   GGGG rrrrrrr                eeeeeeeeeeeeee    nnnnnn    nnnnnn   ooooooooooo   bbbbbbbbbbbbbbbb   llllllll    eeeeeeeeeeeeee  
             y:::::y                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
            y:::::y                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
           y:::::y                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
          y:::::y                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
         yyyyyyy                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
*/
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
