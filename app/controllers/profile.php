<?php 
session_name("SESSION_ID");
session_start();
    

    if(!isset($_SESSION["code"])){
            header("Location: http://localhost/");
    }



class profile{
    
        public function index(Type $var = null)
        {
            $login_code = $_SESSION["code"];
            $sql= new SQL();
            $login_array = array();
             $login_array = $sql->Userdata($login_code); $array = array();
             foreach($login_array as $field => $value) { $array= $value;}
             
            $local_valid_code = $array[0];
            $local_valid_email = $array[1];
            $local_valid_password = $array[2];
            
            $GLOBALS["profile"] = array(
                    "name" => $local_valid_code,
                    "email" => $local_valid_email,
                    "password" => $local_valid_password

            );

            load::view("Templates::index-header");
            load::view("Templates::assets::Profile::view.profile.settings.php");
            load::view("Templates::index-footer");
        }

        public function logout(Type $var = null)
        {
            sleep(2);
            if(isset($_COOKIE[session_name()])):
                setcookie(session_name(), '', time()-7000000, '/');
            endif;
            if(isset($_COOKIE['SESSION_ID'])):
                setcookie('SESSION_ID', '', time()-7000000, '/');
            endif;

            $_SESSION["code"] = NULL;
            session_unset($_SESSION["code"]);
            session_destroy();
            header("Location: /");
            exit;
        }
}
?>