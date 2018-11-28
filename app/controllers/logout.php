<?php
    class logout{

            public function index(Type $var = null)
            {
                session_name("SESSION_ID");
                session_start();
                sleep(2);
                session_destroy();
                header("Location: http://localhost/");
               
            }

    }
?>