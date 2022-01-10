<?php
    class Presentation extends Controller{
        public function __construct(){
            session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='anonyme';
            }
            $this->loadModel('PresentationPage');
            
        }
        public function index(){
            $this->render('index');
        }
    
    }
?>