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
     * HeaderMessage permet de garder de coté des messages d'information à destination de l'utilisateur.
     * La partie graphique doit se placer dans le dossier "open" à la racine de l'application.
     */
    
    
    class MessageTypeException extends Exception {}
    
    /*
     * Liste des différents type de message
    */
    class MessageType {
        const ERROR = "danger";
        const INFO = "info";
        const WARNING = "warning";
        const SUCCESS = "success";
        const NONE = "";
    }
	
    class HeaderMessage {
        /**
         * @var STRING Contenue du message
        */
        private $message;
        /**
         * @var STRING Type du message
        */
        private $type;
        
        /**
         * Création du message
         * 
         * @param STRING $message Contenue du message
         * @param STRING/NULL $type Type du message
        */
        public function __construct($message = "", $type = null) {
            if(isset($_SESSION["document"])){
                $this->addHeader("<link href='".arl_baseUrl("open/HeaderMessage.css")."' rel='stylesheet' />");
            }
            
            $type = ($type) ? $type : MessageType::NONE;
            $this->message = $message;
            if($this->checkMessageType($type)){
                $this->type = $type;
            }
        }
        
        /**
         * Changement du contenue du message
         * 
         * @param STRING $v Contenue du message
        */
        public function setMessage($v){
            $this->message = $v;
        }
        
        /**
         * Changement du type du message
         * 
         * @param STRING $v Type du message
        */
        public function setType($v){
            if($this->checkMessageType($v)){
                $this->type = $v;
            }
        }
        
        /**
         * Permet de placer le message en mémoire pour être lu à la prochaine utiliation
        */
        public function send(){
            $out = (string) $this;
            if(isset($_SESSION['libHeaderMessage']) && is_array($_SESSION['libHeaderMessage'])){
                array_push($_SESSION['libHeaderMessage'], $out);
            }else{
                $_SESSION['libHeaderMessage'] = [$out];
            }
        }
        
        /**
         * Affichage du message format HTML
        */
        public static function showMessages(){
            if(isset($_SESSION['libHeaderMessage'])){
                if(is_array($_SESSION['libHeaderMessage'])){
                    echo "<div class='error'>";
                    foreach($_SESSION['libHeaderMessage'] as $message){
                        echo $message;
                    }
                    echo "</dev>";
                }
                unset($_SESSION['libHeaderMessage']);
            }
        }
        
        /**
         * Overrride de la fonction toString pour afficher le message format HTML
        */
        public function __toString(){
            $out = "<div class='textCenter ".$this->getBackgroundColor()."'>";
            $out .= htmlspecialchars($this->message);
            $out .= "</div>";//<span class='close'>X</span>
            
            return $out;
        }
        
        /**
         * Vérifie si le type de message utilisé existe bien
         * 
         * @param STRING $v Type de message
         * 
         * @return BOOLEAN
        */
        private function checkMessageType($v){
            return $v == MessageType::NONE || $v == MessageType::ERROR || $v == MessageType::INFO || $v == MessageType::WARNING || $v == MessageType::SUCCESS;
        }
        
        /**
         * Récupère la couleur de fond utilisée
         * 
         * @return STRING
        */
        private function getBackgroundColor(){
            $out = "alert-";
            
            if($this->type == MessageType::NONE){
                $out = "";
            }else{
                $out .= $this->type;
            }
            
            return $out;
        }
    }
?>