<?php

    class router{
            private $routes;
            function __construct(){
                
                $this ->routes = $GLOBALS["config"]["routes"];
                $route = $this->findRoute();
                
                if(class_exists($route["controller"])){
                        $controller = new $route["controller"]();
                        $method = $route["method"];
                        if(method_exists($controller, $method)){
                            $controller->$method();
                        }else{
                              error::show(404);
                        }
                }else{
                   error::show(405); 
                    
                }
            }
            
           
       private function routePart($route){
                if(is_array($route)){
                    $route = $route["url"]; 
                }

               $parts = explode("/",$route);
               return $parts;
            }

           static function uri($part){ 
                    $parts =explode('/', trim($_SERVER['REQUEST_URI'], '/'));  
                      
                    return (isset($parts[$part])) ? $parts[$part] : "";
            
            }

            private  function findRoute()
            {
                foreach($this->routes as $route){
                    $parts = $this->routePart($route);
                    $allMatch = true;

                    foreach($parts as $key => $value){
                        if($value != "*"){
                                if(router::uri($key) != $value){
                                    $allMatch = false;
                                }
                        }
                    }

                    if($allMatch){
                        return $route;      
                    }
                }
              $uri_1 = router::uri(0); 
              $uri_2 = router::uri(1); 
              

                if($uri_1 == ""){
                    $uri_1 = $GLOBALS["config"]["defaults"]["controller"];
                }else if($uri_1 == "index.php"){
                    $uri_1 = $GLOBALS["config"]["defaults"]["controller"];
                }
                if($uri_2 == ""){
                    $uri_2 = $GLOBALS["config"]["defaults"]["method"];
                }
                $route = array(
                    "controller" => $uri_1,
                    "method" => $uri_2
                );
                return $route;
            }
    }

?>
