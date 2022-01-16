<?php
    require_once('models/Utilisateur.php');
    class Contact extends Controller{
        public function __construct(){
            session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='anonyme';
            }
            
            $this->loadModel('ContactPage');
            $this->loadModel('AdministrateurManager');
            
        }
        public function index(){
            $all = new ContactPage();
            $all = $all->all();
            $admins = new AdministrateurManager();
            $admins = $admins->getAdmins();
            $this->render('index',compact('all','admins'));
        }
    
    }
?>