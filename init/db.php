<?php
    require_once('db_credentials.php');
	try {
	
		//$connection = new PDO("mysql:host=localhost;dbname=intranet;charset=utf8", "root", "root");
        //$connection = new PDO("mysql:host=localhost;dbname=p-321368_intranet;charset=utf8", "p-321368_intranet", "p-321368_intranet");
        //$connection = new PDO("mysql:host=localhost;dbname=p-321368_intranet;charset=utf8", "root", "");
        $connection = new PDO("mysql:host=srv-pleskdb18.ps.kz:3306;dbname=qcodeaca_database;charset=utf8", "qcodeaca_admin", "vOj9En@99");


//        $connection = new PDO("mysql:host=localhost;dbname=laravel;charset=utf8", "laraveluser", "password");
        //$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        $connected = true;
	    
	}catch(Exception $e){
	
		$connected = false;
		echo " ERROR IN CONNECTION : ".$e;
	    
	}    
    
    define("CONNECTED", $connected);

?>