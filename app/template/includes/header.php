<?php
	//INFO
	$_SESSION["document"]->addHeader("<title>TEMPLATE</title>");
        
        
        //EXTENTION HEADERMESSAGE
        HeaderMessage::showMessages();
?>

<!---- MENU ---->
<div class="navBar" id="mainNavBar">
    <a href="<?php echo arl_baseUrl("accueil"); ?>">ACCUEIL</a>
    <a href="javascript:void(0);" class="icon" onClick="openDrawerMenu()">&#9776;</a>
</div>

<div class="container">