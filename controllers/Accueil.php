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
          for($i=0; $i<count($all); $i++){
              if($all[$i]->content()=='Publier'){
                 $all[$i]=null;
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
        //if method POST : 
        //recherche :
        // publier:
        // login : 
        // inscription:

        $this->render('index',compact('all','annonces'));
    }

    public function read($id){
      
    }
     
 }
?>