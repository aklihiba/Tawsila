<?php
      require_once('models/Annonce.php');
      require_once('models/Utilisateur.php');
      require_once('models/Suggestions.php');
      require_once('models/Demandes.php');
      require_once('models/Postulations.php');

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
                
                header("Location:".PRE."/accueil/publier");
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
       // post method and actions :
        
       //getting the data to send it to the view. 
       $manager = new AnnonceManager($id);

       if($manager->all() != null){

            $annonce = $manager->all()[0];
            $suggestions = new Suggestions($annonce->id(),'annonce'); 
            if($annonce->transiteur()!== null){
                $u = new UtilisateurManager($annonce->transiteur());
                $transiteur = $u->getuser();
            }
            $restrict = false;
            $sugg_act = '';
            $dem_act = '';
            $post_act = '';
            $trans_act = '';
            if($_SESSION['connexion']!='anonyme'){
                $user = $_SESSION['user'];
                if($user->id()==$annonce->client()){
                    //le proprietaire de l'annonce
                    $sugg_act = 'demander' ;
                    $trans_act = 'signaler' ;
                    if($annonce->demandes()>0){
                        $demandes = new Demandes($annonce->id(),'annonce');
                        $dem_act = 'annuler';
                    }
                    if($annonce->postulations()>0){
                        $postulations = new Postulations($annonce->id(),'annonce');
                        $post_act = 'accepter';
                    }
                    $actions = array('modifier', 'supprimer');
                    if($annonce->transiteur()!== null){
                        $actions[] = 'noter' ; 
                    }
                }else{
                    switch($_SESSION['user_type']){
                        case 'transporteur':
                            $actions = array();
                            if($annonce->transiteur()!== null){
                                if($user->id()==$annonce->transiteur()){
                                    $actions[]= 'signaler';
                                }
                            }else{
                                $post = new AnnonceTransporteur(array(
                                    'annonce'=> $annonce->id(),
                                    'transporteur'=> $user->id()
                                ));
                                $p= new Postulations($annonce->id(),'annonce');
                                $postulations = $p->all(); 
                                if($postulations != null){
                                   if(in_array($post, $postulations)){
                                        $actions[] = 'confirmer';
                                   }else{
                                       $actions[] = 'postuler';
                                   }
                                }
                                else{
                                    $actions[] = 'postuler';
                                }
                            }
                           
                            break;
                        case 'client':
                            //nothing to do    
                            break;
                        case 'admin':
                            if($annonce->demandes()>0){
                                $demandes = new Demandes($annonce->id(),'annonce');
                               
                            }
                            if($annonce->postulations()>0){
                                $postulations = new Postulations($annonce->id(),'annonce');
                              
                            }
                            $actions = array('valider','annuller');
                            break;
                        default:
                        echo 'something is wrong within your user type';    
                    }
                }
            }else{
                $restrict = true;
                $annonce->restrict();
            }
            
            
            $annonce->incVues();

            $this->render('annonce',compact('annonce','suggestions','transiteur','demandes','postulations','actions','restrict','sugg_act','dem_act','post_act','trans_act'));
    }else{
        echo 'wrong id';
    }
    }

    public function Publier(){
        if($_SESSION['connexion']=='user'){
        //method POST:
        if($_SERVER["REQUEST_METHOD"] == "POST"){
          
            $annonce = new Annonce(array());
            if(isset($_POST['titre'])){
                $annonce->setTitre($_POST['titre']);
              
            }
            else{
                $annonce->setTitre("");
            }
            
            $annonce->setDate(date("Y-m-d"));
            if(isset($_POST['photo'])){
                $annonce->setPhoto($_POST['photo']);
            }
            else{
                $annonce->setPhoto("");
            }
            if(isset($_POST['depart'])){
                $annonce->setWilaya_depart($_POST['depart']);
            }
            else{
                $annonce->setWilaya_depart("");
            }
            if(isset($_POST['arrive'])){
                $annonce->setWilaya_arrive($_POST['arrive']);
            }
            else{
                $annonce->setWilaya_arrive("");
            }
            if(isset($_POST['transport'])){
                $trans="";
                foreach($_POST['transport'] as $t){
                    $trans = $trans.", ".$t ; 
                }
                $annonce->setTransport($trans);
            }
            else{
                $annonce->setTransport("");
            }
            if(isset($_POST['type'])){
                $annonce->setType($_POST['type']);
            }
            else{
                $annonce->setType("");
            }
            if(isset($_POST['poids'])){
                $p = explode("-",$_POST['poids']);
                
                $annonce->setPoidsMin((float)$p[0]);
                $annonce->setPoidsMax((float)$p[1]);
            }
            else{
                $annonce->setPoidsMax(0);
                $annonce->setPoidsMin(0);
            }
            if(isset($_POST['volume'])){
                $p = explode("-",$_POST['volume']);
                
                $annonce->setVolumeMin((float)$p[0]);
                $annonce->setVolumeMax((float)$p[1]);
            }
            else{
                $annonce->setVolumeMax(0);
                $annonce->setVolumeMin(0);
            }
            if(isset($_POST['description'])){
                $annonce->setDescription($_POST['description']);
            }
            else{
                $annonce->setDescription("");
            }
            $annonce->setEtat("en attente de validation");
           
            $user = $_SESSION['user'];
            $annonce->setClient($user->id());

            $annonce->calculPrix();   

            $id = $annonce->save();
            
            //creer les suggestions
            $sug = new Suggestions($id," ");
        
           //header("Location:".PRE."/accueil");            
        }

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

        //type de l'annonce
        $type = new TypeAnnonce();
        $type = $type->all();
        
        //publierpage
        $all = new PublierPage();
        $all = $all->getElements();

        $this->render('publier', compact('poids','volumes','wilayas','transports','type', 'all'));
        }
        else{
            echo 'vous devez etre connecter pour publier';
        }
    }

     
 }
?>