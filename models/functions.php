<?php

    function base_url($uri=NULL){
        
        //$base_url = "http://intranet.bitlab.kz/";
        //$base_url = "https://intranet.bitlab.kz/";
        //$base_url = "https://intranet.webzone.kz/";
        //$base_url = "http://195.49.210.140/";
        //$base_url = "http://localhost/rebuild/";
        $base_url = "https://qcodeacademy.kz/";

        if(isset($uri)){
            
            return $base_url."".$uri;
        
        }else{
        
            return $base_url;    
            
        }
        
    }

?>