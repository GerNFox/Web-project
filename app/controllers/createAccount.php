<?php
    class  createAccount{

            public  function index(Type $var = null)
            {
                load::view("Templates::index-header");
                load::view("Templates::assets::CreateAccount::index-reg-content");
                load::view("Templates::index-footer");

            }

    }
?>