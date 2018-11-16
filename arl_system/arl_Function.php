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
	 * Nettoie les données récupéraient en GET
         * 
         * @param ARRAY $get Tableau à nettoyer
         * 
         * @return MIXED
	*/
        function arl_clearGet($get){
                if(!is_array($get)){
                    return $get;
                }
                
                $get = array_filter($get);
                
                if(count($get) > 0 && !empty($get[0])){
                        if($get[0] == "index.php"){
                                array_shift($get);
                        }
                }
            
                return $get;
        }

	/**
	 * Controle si le fichier exist puis l'inclus
         * 
         * @param STRING $path Emplacement du controlleur
         * @param ARRAY $data Liste des données à envoyer au controlleur
	*/
	function controlAndShow($path, $data = []){
		if(is_file($path)){
                        if(is_array($data)){
                            foreach($data as $key => $var){
                                    $$key = $var;
                            }
                        }
			require_once($path);
		}
	}
	
	/**
	 * Converti un text format underscore en format camel
	 *
	 * @param STRING $name Données à modifier
	 *
	 * @return STRING
	*/
	function arl_underscoreToCamel($name){
		$out = "";
		if($name){
			$tempArray = explode("_", $name);
			if(count($tempArray) > 0){
				foreach($tempArray as $el){
					if($el === $tempArray[0]){
						$out = $el;
                                        }else{
						$out .= ucfirst($el);
                                        }
				}
			}
		}
		return $out;
	}
	
	/**
         * Vérifier si la route exist
         * 
         * @param STRING $route Nom de la route à tester
         * 
	 * @return BOOLEAN
	*/
	function arl_checkRoute($route){
		$path = arl_internalBaseUrl."app/routes/".$route;
		$checkFolder = is_dir($path);
		$checkController = is_file($path."/".arl_starter.".php");
                return  $checkFolder && $checkController;
	}
	
	/**
         * Appel le controleur de la route
	*/
	function arl_callRoute(){
		$_SESSION["document"] = new Page();
		$_SESSION["document"]->render();
	}
?>