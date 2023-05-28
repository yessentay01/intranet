<?php

    function base_url($uri=NULL){
        
        //$base_url = "http://intranet.bitlab.kz/";
        //$base_url = "https://intranet.bitlab.kz/";
        $base_url = "https://intranet.webzone.kz/";
        
        if(isset($uri)){
            
            return $base_url."".$uri;
        
        }else{
        
            return $base_url;    
            
        }
        
    }

?>