<?php


    class register{

        private $email;
        private $password;
        private $code;

      
        
        public function __construct($param_code,$param_password,$param_email) {
            if(self::validPasswordHasing($param_password) && self::validEmailRegex($param_email)){

                $this->code = $param_code;
                $this->password = $param_password;
                $this->email = $param_email;
                try{
                $sql = new SQL();

               if( $sql->InsertUserData( $this->code,$this->password,$this->email)){
                        echo "Sikeres reg ";
                }else{
                    echo "nope";
                }
                    }catch(Exception $e){
                        echo $e -> getMessage();
                    }
            }else{
                echo "Valami hiba történt az autentikálás közben! Kérem próbálja újból. 2";
            }

        }

        public function index(Type $var = null)
        {
            load::Models("sql");
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

        

    }
?>