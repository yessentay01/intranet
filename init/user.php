<?php

    session_start();
    
    $USER_DATA = null;
    $online = false;
    $is_admin = false;

    if(!isset($_SESSION['user'])&&isset($_COOKIE['auth_user_data'])){
        
        $user = get_user_by_cookie_value($_COOKIE['auth_user_data'], 'bitlab');
        if($user!=null){
            $_SESSION['user'] = $user;
        }

    }
    
    if(isset($_SESSION['user'])){
        
        $USER_DATA = get_user_by_id_password($_SESSION['user']['id'],$_SESSION['user']['password']);
        
        if($USER_DATA!=null){
            
            $online = true;
            if($USER_DATA['role_id']==1){
                $is_admin = true;
            }
            
        }
        
    }
    
    define("IS_ADMIN", $is_admin);
    

?>