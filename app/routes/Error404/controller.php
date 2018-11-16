<?php
	class Error404{
                
                public function index(){
                        $_SESSION["document"]->addHeader('<link href="'.arl_searchLinkRoute("css/style.css", true).'" rel="stylesheet" />');
                        arl_showElementTemplate("includes/header.php");
                        
			arl_showRouteView();
                        
                        arl_showElementTemplate("includes/footer.php");
		}
	}
?>