<?php

	try {
	
		//$connection = new PDO("mysql:host=localhost;dbname=intranet;charset=utf8", "root", "root");
        //$connection = new PDO("mysql:host=localhost;dbname=p-321368_intranet;charset=utf8", "p-321368_intranet", "p-321368_intranet");
        //$connection = new PDO("mysql:host=localhost;dbname=p-321368_intranet;charset=utf8", "root", "");


   //     $connection = new PDO("mysql:host=localhost;dbname=laravel;charset=utf8", "laraveluser", "password");
        $dbhost = "localhost";
        $dbuser = "laraveluser";
        $dbpass = "password";
        $db = "laravel";
        $connection = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $connection -> error);
        $connected = true;
	    
	}catch(Exception $e){
	
		$connected = false;
		echo " ERROR IN CONNECTION : ".$e;
	    
	}    
    
    define("CONNECTED", $connected);

?>