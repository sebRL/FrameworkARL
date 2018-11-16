<?php
	class Accueil{
		public function index(){
                        arl_showElementTemplate("includes/header.php");
                        
                        $_SESSION["document"]->addCss(arl_searchLinkRoute("css/accueil.css"));
                        $_SESSION["document"]->setOneLine(false);
                        
                        $pathReadme = "./README.md";
                        $readme = is_file($pathReadme) ? file_get_contents($pathReadme) : "";
                        
                        arl_showRouteView(["readmeContent"=>$readme]);
                        
                        arl_showElementTemplate("includes/footer.php");
		}
	}
?>