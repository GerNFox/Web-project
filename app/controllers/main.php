<?php

    class main {
       
        function index(){
                
                global $login_code ;
                global $login_password;
                load::view("main::index");
                load::Controllers("login");
                
                include_once "ajaxcalls.php";
    }
            
    }

?>