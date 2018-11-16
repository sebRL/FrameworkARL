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
     * 
     * SecureControl contient plusieurs filtres applicables sur différentes sources.
     */

    /**
     * Liste des controle possible
    */
    class SecureControlType{
        const EMAIL = 0;
        const IP = 1;
        const URL = 2;
        const ZIPCODE = 3;
        const PHONE = 4;
        const HEXECOLOR = 5;
    }

    class SecureControl{
            /**
            * Liste des expressions égulières utilisées
           */
            const LISTREGEX = array(
                    "/^[^\W][a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/",
                    "/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/",
                    "#^http://([\w]*)\.[a-zA-Z]{2,6}#i",
                    "/^[0-9]{5,5}$/",
                    "/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/",
                    "/^#(?:(?:[a-f\d]{3}){1,2})$/i"
            );

            /**
             * Permet de controler une donnée
             * 
             * @param STRING $context Donnée à controler
             * @param INTEGER $filtre Type de controle utilisé
             * 
             * @return STRING
            */
            static public function filtre($context, $filtre){
                    return !empty($context) && is_numeric($filtre) && $filtre > -1 && $filtre < count(SELF::LISTREGEX) ? preg_match(SELF::LISTREGEX[$filtre], $context) : -1;
            }
    }

?>