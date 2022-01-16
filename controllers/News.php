<?php
    require_once('models/Utilisateur.php');
    require_once('models/NewsComponent.php');
    require_once('models/Newsmodel.php');
    require_once('models/NewsPage.php');
    class News extends Controller{
        public function __construct(){
            session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='anonyme';
            }
            
            $this->loadModel('AllNewsPage');
            
        }
        public function index(){
            $all = new AllNewsPage();
            $all = $all->all();
           
            $this->render('index',compact('all'));
        }

        public function view($id){
            $all = new NewsPage($id);
            $all = $all->all();
           
            $this->render('view',compact('all'));
        }
    
    }
?>