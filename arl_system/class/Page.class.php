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
    
    
	class Page{
		/**
		 * @var STRING $headers Les balises du bloque head
		*/
		protected $headers;
                /**
		 * @var STRING $headersEnd Les balises du bloque head mise à la fin
		*/
		protected $headersEnd;
		/**
		 * @var STRING $css Code css du bloque style
		*/
		protected $css;
		/**
		 * @var STRING $js Code javascript du bloque script
		*/
		protected $js;
		/**
		 * @var ARRAY(STRING=>STRING) $imgs Liste d'image au format base64
		*/
		protected $imgs;
		/**
		 * @var STRING $route corps de la page.
		*/
		protected $route;
		/**
		 * @var BOOLEAN $html True : page html, False : page autre.
		*/
		protected $html;
                /**
		 * @var BOOLEAN $oneLine Ture : code html sur une seul ligne, False : indentation normal.
		*/
		protected $oneLine;
		
		
		/**
		 * Constructeur de la classe
		*/
		public function __construct(){
			$this->route = "";
			$this->headers = "";
                        $this->headersEnd = "";
			$this->css = "";
			$this->js = "";
			$this->imgs = array();
			$this->html = true;
                        $this->oneLine = true;
                        
                        $this->addHeader("<meta charset='UTF-8'>");
                        $this->addHeader("<meta http-equiv='X-UA-Compatible' content='IE=edge'>");
                        $this->addHeader("<meta name='viewport' content='width=device-width, initial-scale=1'>");
                        
                        $this->addHeader("<link href='".arl_baseUrl("open/Skeleton-2.0/normalize.css")."' rel='stylesheet' />");
                        $this->addHeader("<link href='".arl_baseUrl("open/Skeleton-2.0/skeleton.css")."' rel='stylesheet' />");
                        
                        $this->addCss(arl_internalBaseUrl."arl_system/bin/arl_style.css");
                        $this->addJs(arl_internalBaseUrl."arl_system/bin/arl_globalsActions.js");
		}
		
		/**
		 * Change le mode de la page, True pour avoir une page au format HTML, False pour tout autre page.
		 *
		 * @param BOOLEAN $html Choix du type d'affichage
		*/
		public function setHtml($html){
			$this->html = $html;
		}
		
		/**
		 * Ajoute une balise dans la bloque head.
		 *
		 * @param STRING $el Balise à ajouter
                 * @param BOOLEAN $end TRUE la balise sera placée à la fin
		*/
		public function addHeader($el, $end = false){
                    if($end){
			$this->headersEnd .= $el;
                    }else{
                        $this->headers .= $el;
                    }
		}
		
		/**
		 * Ajoute d'une page css.
		 *
		 * @param STRING $el Emplacement du fichier ou balise css.
                 * @param BOOLEAN $content Affiche le contenue, FALSE ajoute le text
		*/
		public function addCss($el, $content = false){
                        if(!$content){
                                if(is_file($el)){
                                        $this->css .= "/*--".basename($el)."--*/";
                                        $this->css .= file_get_contents($el);
                                }
                        }else{
                                $this->css .= "/*----*/";
                                $this->css .= $el;
                        }
		}
		
		/**
		 * Ajoute une page js.
		 *
		 * @param STRING $el Emplacement du fichier javascript ou balise javascript.
                 * @param BOOLEAN $debut Ajouter le code au début
                 * @param BOOLEAN $content TRUE Affiche le contenue, FALSE ajoute le text
		*/
		public function addJs($el, $debut=false, $content = false){
                    if(!$content){
			if(is_file($el)){
				$out = "/*--".basename($el)."--*/";
				$out .= file_get_contents($el);
				if($debut){
					$this->js = $out . $this->js;
				}else{
					$this->js .= $out;
				}
			}
                    }else{
                            $out = "/*----*/";
                            if($debut){
                                    $this->js = $el . $this->js;
                            }else{
                                    $this->js .= $el;
                            }
                    }
		}
		
		/**
		 * Converti une image en base64 et la charge dans le tableau.
		 * Posibilité de forcer l'enregistrement d'une image avec deux deuxième paramètre.
		 *
		 * @param STRING $el Emplacement du fichier
		 * @param BOOLEAN $erase TRUE Ecrase la données si déjà présente
		*/
		public function addImg($el, $erase = false){
			if(is_file($el)){
				if(!isset($this->imgs[basename($el)]) || $erase){
					$type = pathinfo($el, PATHINFO_EXTENSION);
					$this->imgs[basename($el)] = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($el));
				}
			}
		}
		
		
		/**
		 * Récupère une image en fonction de son nom.
		 *
		 * @param STRING $name Nom de l'image
                 * 
                 * @return STRING
		*/
		public function getImg($name){
			return isset($this->imgs[$name]) ? $this->imgs[$name] : "";
		}
                
                /**
                 * Retourne la valeur actuel de la variable OneLine.
                 * 
                 * @return BOOLEAN
                */
                public function getOneLine(){
                    return $this->oneLine;
                }
                
                /**
                 * Modifie la variable OneLine.
                 * 
                 * @param BOOLEAN $value Nouvelle valeur
                */
                public function setOneLine($value){
                    $this->oneLine = is_bool($value) ? $value : $this->oneLine;
                }
		
		
		/**
		 * Affiche la page.
		*/
		public function render(){
			$this->renderRoute();
			$out = "";
			
			if($this->html){
                                //HEADER
				$out = "<!DOCTYPE html><html><head>";
				$out .= $this->headers;
				//STYLE
                                $out .= "<style>";
				$out .= $this->css;
				$out .= "</style>";
                                //END HEAD
                                $out .= $this->headersEnd;
                                $out .= "</head><body>";
				//ROUTE
				$out .= $this->route;
                                //JS
                                $out .= "<script>";
				$out .= $this->js;
				$out .= "</script></body></html>";
			}else{
				$out = $this->route;
			}
			ob_clean();
                        
			echo $this->oneLine ? preg_replace("#\n|\t|\r#","",$out) : $out;
		}

		
		/**
		 * Récupère l'html retourné par le controleur.
                 * 
                 * @param MIXED $route Nom de la route
                 * @param BOOLEAN $return Utilise la méthode indiqué dans l'url
		*/
		protected function renderRoute($route = null, $return = true){
                        $route = $route === null ? $_SESSION["route"] : $route;
                        $_SESSION["route"] = $route;
                        
			ob_start();
                        
                        $includeMode = arl_starter == "controller";
                        
                        controlAndShow(arl_internalBaseUrl."app/routes/".$route."/".arl_starter.".php");
                        
                        if($includeMode){
                            $class = ucfirst($route);
                            if(class_exists($class)){
                                $class = new $class();
                                $method = "index";
                                
                                if(count($_SESSION["get"]) > 1 && $return){
                                    $method = $_SESSION["get"][1];
                                }

                                if(method_exists($class, $method)){
                                    $class->$method();
                                }else{
                                    $this->renderRoute(arl_routeError, false);
                                }
                            }else{
                                $this->renderRoute(arl_routeError, false);
                            }
                        }
                        
			$result = ob_get_contents();
			ob_end_clean();
                        
                        if($return)
                            $this->route = $result;
                        else
                            echo $result;
		}
	}

?>