<?php
    class load{

        static function view($viewFile, $viewVars=array() ){
                extract($viewVars);
            
                $viewFileCheck = explode(".", $viewFile);
                
                if(!isset($viewFileCheck[1])){
                    $viewFile .= ".php";
                }
                
                $viewFile = str_replace("::","/",$viewFile);
                require_once $GLOBALS["config"]["path"]["app"]."views/{$viewFile}";
        }

        static function Controllers($viewFile, $viewVars=array() ){
            extract($viewVars);
        
            $viewFileCheck = explode(".", $viewFile);
            
            if(!isset($viewFileCheck[1])){
                $viewFile .= ".php";
            }
            
            $viewFile = str_replace("::","/",$viewFile);
            require_once $GLOBALS["config"]["path"]["app"]."controllers/{$viewFile}";
         }

         static function Interfaces($viewFile, $viewVars=array() ){
            extract($viewVars);
        
            $viewFileCheck = explode(".", $viewFile);
            
            if(!isset($viewFileCheck[1])){
                $viewFile .= ".php";
            }
            
            $viewFile = str_replace("::","/",$viewFile);
            require_once $GLOBALS["config"]["path"]["app"]."interfaces/{$viewFile}";
         }

         static function Models($viewFile, $viewVars=array() ){
            extract($viewVars);
        
            $viewFileCheck = explode(".", $viewFile);
            
            if(!isset($viewFileCheck[1])){
                $viewFile .= ".php";
            }
            
            $viewFile = str_replace("::","/",$viewFile);
            require_once $GLOBALS["config"]["path"]["app"]."models/{$viewFile}";
         }
  


    }
?>