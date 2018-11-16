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
        
	function existAndIsFile($path){
		return is_file($path);
	}
	
	if(existAndIsFile("app/configs/config.php")){
		//CHARGEMENT DE LA CONFIGURATION
                include("app/configs/config.php");
		
		if(existAndIsFile(arl_internalBaseUrl."app/configs/configPerso.php")){
			//CHARGEMENT DE LA CONFIGURATION PERSONNEL
                        include(arl_internalBaseUrl."app/configs/configPerso.php");
			
			if(existAndIsFile(arl_internalBaseUrl."arl_system/arl_Function.php") && existAndIsFile(arl_internalBaseUrl."arl_system/arl_GlobalFunction.php")){
                                //SYSTEME
                                include(arl_internalBaseUrl."arl_system/arl_Function.php");
                                include(arl_internalBaseUrl."arl_system/arl_GlobalFunction.php");
				
				//CHARGEMENT DES EXTENTIONS
				foreach(unserialize(arl_extends) as $el){
					$tempPathExtends = arl_internalBaseUrl."arl_system/extends/".$el.".class.php";
					if(existAndIsFile($tempPathExtends)){
						require_once($tempPathExtends);
					}
				}
				
				
				if(existAndIsFile(arl_internalBaseUrl."arl_system/class/Page.class.php")){
					//CHAGEMENT DES CLASSE IC
					require_once(arl_internalBaseUrl."arl_system/class/Page.class.php");
					
					if(arl_configLoad !== null){
						//CONFIGURATION DU SYSTEME
						@ini_set('display_errors',arl_debugMod);
					}
				}
			}
		}
	}
?>