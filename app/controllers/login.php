<?php  
   include_once "Source_Files/app/models/sql.php";
   
    class login {

            private $code;
            private $password;

            public function __construct($code,$password)
            {
                  
                if(self::validPasswordHasing($password) ){

                    $this->code = $code;
                    $this->password = $password;
                    if(self::checkingDB($this->code,$this->password)){
                        session_name("SESSION_ID");
                        session_start();
                        $_SESSION["code"] = $this->code;
                         
                        return true;
                    }else{
                        echo "Nem találtunk ilyen kód-jelszó párost a rendszerünkben!";
                        return false;
                    }
                    
                }else{
                    echo "Valami hiba történt az autentikálás közben! Kérem próbálja újból.";
                    return false;
                }
                
            }

                public static function checkingDB($code,$password)
                {
                   $sql = new SQL();
                    if(  $sql->LoginParameters($code,$password) ){
                        return true;
                    }else{
                        return false;
                    }

                }
                
             // ## Validation Methods ##
            
                //Password validation
            public static function validPasswordHasing($sha1){
                    return (bool) preg_match('/^[0-9a-f]{40}$/i', $sha1); 
            }

                //Email Validation
            public static function validEmailRegex($email) {
                    return (bool) preg_match('/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $email);
            } // soon...

            /*
                    For preg_match:
                            /        Opening Delimiter
                            ^        Start Of String Anchor
                            [0-9a-f] Any of the following characters: 0123456789abcdef
                            {40}     Repeated 40 times
                            $        End Of String Anchor
                            /        Closing Delimiter
                            i        Modifier: Case-Insensitive Search

            */
        }
?>