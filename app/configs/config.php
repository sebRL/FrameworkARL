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
	 * Autorisation du lancement de l'application
	 *
	 * @var arl_start Boolean
	*/
	define("arl_start", true);

	/**
	 * Route par default en cas d'erreur
	 *
	 * @var arl_routeError String
	*/
	define("arl_routeError", "Error404");
        
        /**
	 * Base url internet du site web si le framework se situe dans un dossier qui n'est pas la base serveur
	 *
	 * @var arl_internalBaseUrl String
	*/
	define("arl_internalBaseUrl", "");
	
	/**
	 * Route par default en cas de maintenance
	 *
	 * @var arl_routeMaintenance String
	*/
	define("arl_routeMaintenance", "maintenance");
	
	/**
	 * Variable de vérification du chargement de la configuration
	 *
	 * @var arl_configLoad Boolean
	*/
	define("arl_configLoad", true);
	
	/**
	 * Fichier de route appelé
         * "controller" / MIXED
	 *
	 * @var arl_starter String
	*/
	define("arl_starter", "controller");
	
	/**
	 * Lien vers des emplacements interne
	 *
	 * @var arl_links ARRAY(STRING => STRING)
	*/
	define("arl_links", serialize(array(
        "BASE" => "",
		"TEMPLATE" => arl_internalBaseUrl."app/template/",
		"TEMPLATE_CSS" => arl_internalBaseUrl."app/template/css/",
		"TEMPLATE_JS" => arl_internalBaseUrl."app/template/js/",
		"TEMPLATE_IMG" => arl_internalBaseUrl."app/template/imgs/"
	)));
        
        /**
	 * Configuration de la base de donnée
	 *
	 * @var arl_links ARRAY(STRING => STRING)
	*/
	define("arl_bdd", serialize(array(
                "HOST" => "",
		"DATABASE" => "",
		"USER" => "",
		"PASSWORD" => "",
		"CHARSET" => ""
	)));
	
	/**
	 * Liste des extention à récupérer pour n'importe quelle route
	 *
	 * @var arl_extends ARRAY(INT => STRING)
	*/
	define("arl_extends", serialize(array(
            "HeaderMessage",
            "SecureControl"
        )));
	
	/**
	 * Liste des élément vérifiés dans de l'appel de la fonction "arl_stringSecure"
	 *
	 * @var arl_listCharsStringSecure ARRAY(STRING)
	*/
	define("arl_listCharsStringSecure", serialize(array(
                "..",
		"%",
		"\\",
		"|",
		"'",
		"\"",
		"/"
	)));
	
	/**
	 * Route par default de l'application
	 *
	 * @var arl_defaultCall String
	*/
	define("arl_defaultCall", "accueil");
	
	/**
	 * Mode débug de l'application
	 *
	 * @var arl_debugMod Boolean
	*/
	define("arl_debugMod", true);
?>