<?php
  
    class Statistiques extends Controller{
        public function __construct(){
            session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='anonyme';
            }
            
            $this->loadModel('StatistiquePage');
            $this->loadModel('AnnonceManager');
            $this->loadModel('UtilisateurManager');
            
        }
        public function index(){
            $all = new StatistiquePage();
            $m = new AnnonceManager();
            $u = new UtilisateurManager(2);
            $topannonce = $m->topannonce();
            $topannonce = $m->rechercheByid($topannonce);
            $topuser = $u->getuser();
            $all = $all->all();
            $this->render('index',compact('all', 'topannonce', 'topuser'));
        }
    
    }
?>