<?php
 class Accueil extends Controller {
    public function __construct(){
        $this->loadModel('AccueilPage');
        $this->loadModel('AnnonceManager');
       
    }

    public function index(){
        $acc = new AccueilPage();
        $all= $acc->getElements();
        //enlever le bouton publier pour les utilisateur non connectes 
        if(!isset($_SESSION['user_type'])){
          foreach($all as $e){
              if($e->content()=='Publier'){
                  unset($e);
              }
          }
        }
        $manager = new AnnonceManager();
        $annonces = $manager->all();
        //filtrer les  infos des annonces a afficher dans le cas non connectes
        if(!isset($_SESSION['user_type'])){
            foreach($annonces as $a){
                $a->restrict();
            }
          }

        $this->render('index');
    }

    public function read($id){
      
    }
     
 }
?>