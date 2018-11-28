<?php 
     include_once "Source_Files/app/models/connection.php";
    
    define("DB_USERNAME","root");
    define("DB_HOST","localhost");
    define("DB_PASSWORD","");
    define("DB_NAME","new");

    class SQL{
       
        private $db;
        //Constructor --> Define all parameters for the connection
        public function __construct()
        {     
           
                $this->db = new Connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
                $this->db = $this->db->sql_conn(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
                    
        }
    
        
         //Get all the user informations from the database .
        // Parameter is : User session Email for identification . 
         public  function UserData($logincode)
         {
             
             $sql = $this->db->prepare("SELECT logincode,email,password FROM datas_new WHERE logincode =?");
             $sql -> bindParam(1,$logincode);
             $sql->execute();
             $result = $sql->fetchALL(\PDO::FETCH_BOTH);
             //print_r($result);
             return $result;
            
         }

        // Parameters are :  Given password and email . 
        public function LoginParameters($login_code,$password){
                
            try{
            
                $sql = $this->db->prepare("SELECT logincode,password FROM datas_new WHERE logincode=? AND password=? ");
                
                $sql->bindParam(1,$login_code);
                $sql->bindParam(2,$password);
                $sql->execute();
                
                if($sql->rowCount() == 1){
                    return true;
                }else{
                    return false;
                }

            }catch(Exception $err){
                echo $err->getMessage();
                return false;
            }
        }
        
        public  function EmailControl($email)
        {
            try{
                $sql = $this->db->prepare("SELECT email FROM datas_new WHERE email=?");
                $sql -> bindParam(1,$email);
                $sql -> execute();

                if($sql->rowCount() == 1){
                    return true;
                }else{
                    return false;
                }
            }catch(Exception $err){
                echo $err -> getMessage();
                return false;
            } 
        }

        //Insert all the given data to the database from registration form.
        public function InsertUserData($code,$password,$email)
        {
            try{
            if(!$this->EmailControl($email) ){
                
                    $sql = $this->db->prepare("INSERT INTO ax_profile_datas_new (logincode, password, email) VALUES (?, ?, ?)");
                    $sql->bindParam(1, $code);
                    $sql->bindParam(2, $password);
                    $sql->bindParam(3, $email);
                    $sql->execute();
                 return true;
            }else{
                echo "This email is already in use!";
                return false;
            }
        }catch(Exection $e){
            echo $err -> getMessage();
            return false;
        }
        }
    }
?>