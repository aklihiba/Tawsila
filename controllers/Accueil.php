<?php
 class Accueil extends Controller {
    public function __construct(){
        $this->loadModel('AccueilPage');
        $this->loadModel('AnnonceManager');
    
       
    }

    public function index(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // login :
            if(isset($_POST['login'])){
               session_start();
               //check mail and pwd
               //connect and save user in session
               $_SESSION['user_type']='user';
              
           }
           //deconnexion
           if(isset($_POST['deconnexion'])){
               $_SESSION['user_type']=null;
            }    
       } 
     

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
      

        $this->render('index',compact('all','annonces'));
    }
    
    
    public function Annonce($id){
      
    }

     
 }
?>