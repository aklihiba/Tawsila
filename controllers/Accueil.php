<?php
 class Accueil extends Controller {
    public function __construct(){
        session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='anonyme';
            }
     
        $this->loadModel('AccueilPage');
        $this->loadModel('AnnonceManager');
        $this->loadModel('UtilisateurManager');
        $this->loadModel('Transport');
        $this->loadModel("Volumes");
        $this->loadModel("Poids");
        $this->loadModel('Wilaya');
        $this->loadModel('TypeAnnonce');
        $this->loadModel('PublierPage');
       
    }

    public function index(){
       
        $manager = new AnnonceManager();
        $annonces = $manager->all();
        $usrm = new UtilisateurManager("none");

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // login :
            if(isset($_POST['login'])){
               
               if($_POST['mail']!="" && $_POST['pwd']!=""){
                   $user = $usrm->connect($_POST['mail'], md5($_POST['pwd']));
                   if($user != null){
                        
                        $_SESSION['user']= $user;
                        $_SESSION['user_type']= $user->type();
                        $_SESSION['connexion']='user';                       
                   }
                 
               }
               
              
           }
           //deconnexion
           if(isset($_POST['deconnexion'])){
               
               session_unset();
               $_SESSION['connexion']='anonyme';
            } 
            //publier
            if(isset($_POST['publier'])){
                
                $this->Publier();
            }  
            //recherche
            if(isset($_POST['recherche'])){
              
                if($_POST['depart'] != "" && $_POST['arrive'] !=""){

                    $dep = ucfirst(strtolower($_POST['depart']));
                    $arv =  ucfirst(strtolower($_POST['arrive'])); 
            
                    $manager->rechercheWilaya($dep,$arv);
                }
                if($_POST['depart'] == ""){
                    $arv =  ucfirst(strtolower($_POST['arrive'])); 
                    $manager->rechercheWilayaArrive($arv);
                }
                if($_POST['arrive'] ==""){
                    $dep = ucfirst(strtolower( $_POST['depart']));
                    $manager->rechercheWilayaDepart($dep);
                } 
                
                $annonces = $manager->all();
            }   
       } 
     

        $acc = new AccueilPage();
        $all= $acc->getElements();
        //enlever le bouton publier pour les utilisateur non connectes 
        if($_SESSION['connexion']=='anonyme'){
           
          for($i=0; $i<count($all); $i++){
              if($all[$i]->content()=='Publier'){
                 $all[$i]=null;
              }
          }
        }
       
        

        $this->render('index',compact('all','annonces'));
    }
    
    
    public function Annonce($id){
       $manager = new AnnonceManager($id);

       if($manager->all() != null){
            $annonce = $manager->all()[0];
       }
       
       //filtrer les  infos des annonces a afficher dans le cas non connectes
       if($_SESSION['connexion']=='anonyme'){
          $annonce->restrict();
       }
       
       $this->render('annonce',compact('annonce'));
    }

    public function Publier(){
        //method POST:


        $user = $_SESSION['user'];
        //fourchette poids
        $poids = new Poids();
        $poids = $poids->all();
       
        //fourchette volume
        $volumes = new Volumes();
        $volumes = $volumes->all();

        //liste wilaya
        $wilayas = new Wilaya();
        $wilayas = $wilayas->all();

        //moyen de transport
        $transports = new Transport();
        $transports = $transports->all();

        //publierpage
        $all = new PublierPage();
        $all = $all->getElements();
        $this->render('publier', compact('user','poids','volumes','wilayas','transports','all'));
    }

     
 }
?>