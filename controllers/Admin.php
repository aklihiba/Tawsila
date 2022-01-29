<?php

    class Admin extends ControllerAdmin{

        public function __construct()
        {
            session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='anonyme';

            }
            if( $_SESSION['connexion']!='admin'){
                echo " vous n'avez pas l'access";
            }
        }

        public function index(){
            if( $_SESSION['connexion']!='admin'){
                echo " vous n'avez pas l'access";
            }else
            $this->render('index');
        }
    
    }

?>