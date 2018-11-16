  
Copyright 2018, This file is part of Framework ARL.    

Framework ARL is free software: you can redistribute it and/or modify  
it under the terms of the GNU General Public License as published by  
the Free Software Foundation, either version 3 of the License, or  
(at your option) any later version.    

Framework ARL is distributed in the hope that it will be useful,  
but WITHOUT ANY WARRANTY; without even the implied warranty of  
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the  
GNU General Public License for more details.    

You should have received a copy of the GNU General Public License  
along with Framework ARL.  If not, see <https://www.gnu.org/licenses/>.      


FRAMEWORK ARL  
Autheur : sebRL  
Version : 1.0  
https://github.com/sebRL      


-- COMMENT CREER UNE ROUTE --  
Rien de plus simple !  
Dans le dossier "app/routes/" créez un dossier avec le nom de votre route, à l'intérieur,  
en fonction de votre configuration, créez votre fichier php qui sera appelé par défaut.  
Maintenant vous pouvez utiliser les fonctions du framework pour compléter votre route.      


-- LES FONCTIONS ARL --  
Fichier contenant les fonctions "arl_system/arl_GlobalFunction.php".  
    -> arl_baseUrl  
        Récupère l'url du site web et l'applique sur une base interne.  
    -> arl_searchLink  
        Récupère l'adresse complète vers un document en fonction de l'indicateur passé en paramètre.  
    -> arl_searchLinkRoute  
        Récupère l'adresse complète vers un document placer dans le dossier router.  
    -> arl_showElementTemplate  
        Inclus un élément du template.  
    -> arl_showRouteView  
        Inclus le fichier "viewer.php" de la route.  
    -> arl_showElementRoute  
        Inclus un des fichiers de la route.  
    -> arl_callModel  
        Retourne l'objet "model" demandé.  
    -> arl_changeRoute  
        Change de route en fonction de la nouvelle route et ces arguments.  
    -> arl_stringSecure  
        Vérification de la valeur d'entrée.      


-- ACTION SUR LE DOCUMENT --  
Le document est un conteneur qui va par la suite être appelé pour afficher la page.  
Pour utiliser le document vous devez l'appeler depuis son espace dans le tableau  
associatif des valeurs stockées dans les sessions "$_SESSION["document"]".  
Techniquement le document est une classe qui contient 10 méthodes.  
    -> setHtml  
        Change le mode de la page, True pour avoir une page au format HTML, False pour tout autre page.  
    -> addHeader  
        Ajoute une balise dans la bloc head.  
    -> addCss  
        Ajoute d'une page css.  
    -> addJs  
        Ajoute une page js.  
    -> addImg  
        Converti une image en base64 et la charge dans le tableau.  
        Posibilité de forcer l'enregistrement d'une image avec deux deuxième paramètre.  
    -> getImg  
        Récupère une image en fonction de son nom.  
    -> getOneLine  
        Retourne la valeur actuelle de la variable OneLine.  
    -> setOneLine  
        Modifie la variable OneLine.  
    -> render  
        Affiche la page.      


-- Architecture --  
    ->  
	index.php  
	.htacess (Ne pas toucher)  
		app (Votre terrain de jeu) ->  
			configs (Espace de configuration) ->  
			routes (Les pages web) ->  
			templates (Espace de partage pour les pages web) ->  
			.htacess (Ne pas toucher)  
		arl_system (Dossier système) ->  
			arl_Function.php (Function php du système)  
			arl_GlobalFunction.php (Function php framework)  
			arl_System.php (Coeur du système)  
			bin (Fichier css et javascript du framework) ->  
			class (Classe du système) ->  
			extends (Espace de partage de classe) ->  
			.htacess (Ne pas toucher)  
		open (Dossier accés extèrieur)  
		close (Dossier accés intèrieur) ->  
			.htacess (Ne pas toucher)