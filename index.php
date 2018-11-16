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
    
    
    session_start();

    //LANCEMENT DU SYSTEME
    include("arl_system/arl_System.php");
	
    //CHARGEMENT DE LA ROUTE MAINTENACE PAR DEFAULT
    $route = arl_routeMaintenance;
	
    //RECUPERATION DU LA ROUTE
    if(arl_start && null !== arl_configLoad && function_exists("arl_callRoute")){
        $get = array();
        
        if(isset($_SERVER["PATH_INFO"])){
            $get = explode("/", substr($_SERVER["PATH_INFO"], 1));
        }
        
	if(function_exists("arl_checkRoute") && function_exists("arl_stringSecure")){
                $get = arl_clearGet($get);
                $get[0] = count($get) > 0 && !empty($get[0]) ? $get[0] : arl_defaultCall;
                $route = $get[0];
                
		if(!arl_stringSecure($route) || !arl_checkRoute($route)){
			//CHARGEMENT DE LA ROUTE ERROR
			$route = arl_routeError;
		}
	}else{
		//CHARGEMENT DE LA ROUTE ERROR
		$route = arl_routeError;
	}
                
        $_SESSION["get"] = $get;
    }
    $_SESSION["route"] = $route;
    arl_callRoute();
?>