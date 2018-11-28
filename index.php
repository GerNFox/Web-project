<?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    $GLOBALS["config"] = array(
        "site"=> array(
            "name" => "name",
            "motto" => "motto",
            "version" => "Beta ver.1.0",
            "domain" => "http://localhost/",
            "codename"=>"cd",
        ),
        "path" => array(
            "app" => "Source_Files/app/",
            "core" => "Source_Files/core/",
            "index" => "index.php"
        ),
        "defaults" => array(
            "controller" => "main",
            "method" => "index",
            "param" => ""
        ),
        "routes" => array()
    );
   
    require_once "autoload.php";
    new router();
    
        
   



?>