<?php

	try {
	
		//$connection = new PDO("mysql:host=localhost;dbname=intranet;charset=utf8", "root", "root");
        //$connection = new PDO("mysql:host=localhost;dbname=p-321368_intranet;charset=utf8", "p-321368_intranet", "p-321368_intranet");
        $connection = new PDO("mysql:host=localhost;dbname=p-321368_intranet;charset=utf8", "root", "");

        $connected = true;
	    
	}catch(Exception $e){
	
		$connected = false;
		echo " ERROR IN CONNECTION : ".$e;
	    
	}    
    
    define("CONNECTED", $connected);

?>