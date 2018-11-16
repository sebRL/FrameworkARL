<?php
    /**
     * Copyright 2018, This file is part of Framework ARL.
     * 
     * Framework ARL is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     * 
     * Framework ARL is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     * GNU General Public License for more details.
     * 
     * You should have received a copy of the GNU General Public License
     * along with Framework ARL.  If not, see <https://www.gnu.org/licenses/>.
     * 
     * FRAMEWORK ARL
     * @author sebRL
     * @version 1.0
     * https://github.com/sebRL
    */


    /**
     * Récupère l'url du site web et l'applique sur une base interne.
     * 
     * @param STRING $data La base de l'url
     * @param BOOLEAN $index Permet d'ajouter le prefixe "index.php"
     * 
     * @return STRING
    */
    function arl_baseUrl($data, $index = false){
        $base = @"http://";
        if(!empty($_SERVER["HTTPS"])) {
		$base = @"https://";
	}
        $tabScript_name = explode("/",$_SERVER["SCRIPT_NAME"]);
        $script_name = "";
        for($i = 0; $i < count($tabScript_name)-1; $i++){
            $script_name .= $tabScript_name[$i]."/";
        }
        
        $output = @$base.$_SERVER["HTTP_HOST"].$script_name;
        $output .= $index ? "index.php/".$data : $data;
	return $output;
    }

    /**
     * Récupère l'adresse complète vers un document en fonction de l'indicateur passé en paramètre.
     *
     * @param STRING $key Indice du tableau arl_links (Fichier de configuration)
     * @param STRING $file Fichier à atteindre
     * @param BOOLEAN $baseUrl Afficher ou pas l'url complète
     *
     * @return STRING
     */
    function arl_searchLink($key, $file, $baseUrl = true) {
	if(null !== unserialize(arl_links)[$key]){
		if($baseUrl){
			return arl_baseUrl(unserialize(arl_links)[$key].$file, false);
		}else{
			return unserialize(arl_links)[$key].$file;
		}
	}
        return "";
    }
    
    /**
     * Récupère l'adresse complète vers un document placer dans le dossier router.
     *
     * @param STRING $file Emplacement du document
     * @param BOOLEAN $baseUrl Afficher ou pas l'url complète
     *
     * @return STRING
     */
    function arl_searchLinkRoute($file, $baseUrl = false){
		if($baseUrl){
			return arl_baseUrl(arl_internalBaseUrl."app/routes/".$_SESSION["route"]."/".$file, false);
		}else{
			return arl_internalBaseUrl."app/routes/".$_SESSION["route"]."/".$file;
		}
    }
	
    /**
     * Inclus un élément du template.
     * 
     * @param STRING $elem Nom du fichier
     * @param ARRAY $data Données à inclures
    */
    function arl_showElementTemplate($elem, $data = []){
            controlAndShow(arl_internalBaseUrl."app/template/".$elem, $data);
    }

    /**
     * Inclus le fichier "viewer.php" de la route.
     * 
     * @param ARRAY $data Données à inclures
    */
    function arl_showRouteView($data = []){
            controlAndShow(arl_internalBaseUrl."app/routes/".$_SESSION["route"]."/view.php", $data);
    }

    /**
     * Inclus un des fichiers de la route.
     * 
     * @param STRING $elem Nom du fichier
     * @param ARRAY $data Données à inclures
    */
    function arl_showElementRoute($elem, $data = []){
            controlAndShow(arl_internalBaseUrl."app/routes/".$_SESSION["route"]."/".$elem.".php", $data);
    }

    /**
     * Retourne l'objet model demandé.
     *
     * @param STRING $model Nom du modèle à inclure
     *
     * @return OBJET/NULL
    */
    function arl_callModel($model) {
		$path = arl_internalBaseUrl."app/routes/".$_SESSION["route"]."/model.php";
		if(is_file($path)){
			require_once($path);
			return new $model();
		}
		return null;
    }
	
    /**
     * Redirectionne en fonction de la nouvelle route et ces argument.
     * 
     * @param STRING $route Nom de nouvelle route
    */
    function arl_changeRoute($route){
            $_SESSION["route"] = $route;
            header("location:".arl_baseUrl($route));
    }

    /**
     * Vérification de la valeur d'entrée.
     * 
     * @param STRING $data Données à controller
     * 
     * @return BOOLEAN
    */
    function arl_stringSecure($data){
            foreach(unserialize(arl_listCharsStringSecure) as $value){
                    $list = str_split($data);
                    foreach($list as $char){
                            if(strcasecmp($char, $value) === true){
                                    return false;
                            }
                            if(strtolower($char) === strtolower($value)){
                                    return false;
                            }
                    }
            }

            return true;
    }
?>