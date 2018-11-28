<?php 

 if(file_exists("./Source_Files/app/controllers/login.php")){
    require_once "./Source_Files/app/controllers/login.php";
}else{
    die("Does not exists {$_SERVER["REQUEST_URI"]}");
}
if(file_exists("./Source_Files/app/controllers/register.php")){
    require_once "./Source_Files/app/controllers/register.php";
}else{
    die("Does not exists {$_SERVER["REQUEST_URI"]}");
} 


$code = isset($_POST["code"]) ? $_POST["code"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";

$params = array(
        "code" => "{$code}",
        "password" =>"{$password}",
        "email" => "{$email}"
);
if($code != NULL){
new Ajax($params);
}

class Ajax 
{

    protected $code ; //User's entry code
    protected $password; //User's password
    protected $email; //User's email
    protected $pid; //Profile ID

    public function __construct(array $params)
    {   
        if( !empty( $params["code"] ) )$this->code = $params["code"]; else $this->code = NULL;

        if( !empty( $params["password"] ) ) $this->password = $params["password"]; else $this->password = NULL;
        
        if( !empty( $params["email"] ) ) $this->email = $params["email"]; else $this->email = NULL;
        if($this->email == NULL && ($this->code != NULL && $this->password != NULL ) ){
                self::Call_Login_class($this->code,$this->password);
        }elseif($this->email != NULL && $this->code != NULL && $this->password != NULL  ){
                self::Call_Register_class($this->code,$this->password,$this->email);
        }
      
    }
    public static function Call_Login_class($code,$password)
    {
       new login($code,$password);
    }
  
    public static function Call_Register_class($code,$password,$email)
    {  
        new register($code,$password,$email);
        
    }
}
           
        
        


    

        

?>