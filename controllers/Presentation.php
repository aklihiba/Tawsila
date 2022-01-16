<?php
    require_once('models/Utilisateur.php');
    class Presentation extends Controller{
        public function __construct(){
            session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='anonyme';
            }
            
            $this->loadModel('PresentationPage');
            
        }
        public function index(){
            $all = new PresentationPage();
            $all = $all->all();
            $this->render('index',compact('all'));
        }
    
    }
?>