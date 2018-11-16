<?php
	class Maintenance{
		public function index(){
                        $_SESSION["document"]->addHeader('<link href="'.arl_searchLinkRoute("css/style.css", true).'" rel="stylesheet" />');
                        
			arl_showRouteView();
		}
	}
?>