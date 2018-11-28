<?php 
    class signin{
        public function __construct(Type $var = null) {

        }

        public function index(Type $var = null)
        {
            load::view("Templates::index-header");
            load::view("Templates:::assets::SignIn::index-login-content");
            load::view("Templates:::index-footer");
        }     
    }
?>