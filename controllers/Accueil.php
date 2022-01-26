<?php
      require_once('models/Annonce.php');
      require_once('models/Utilisateur.php');
      require_once('models/Suggestions.php');
      require_once('models/Demandes.php');
      require_once('models/Postulations.php');
      require_once('models/Signalement.php');

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
    public function deconnexion(){
        session_unset();
        $_SESSION['connexion']='anonyme';
        header('Location:'.PRE);
    }
    public function index(){
       
        $manager = new AnnonceManager();
        $annonces = $manager->all();
        $usrm = new UtilisateurManager("none");

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // login :
            if(isset($_POST['login'])){
               if($_POST['mail']!="" && $_POST['pwd']!=""){
                   if($_POST['mail']=="admin" && $_POST['pwd']=="admin"){
                    $user = $usrm->connect($_POST['mail'], md5($_POST['pwd']));
                        if($user != null){
                                
                                $_SESSION['user']= $user;
                                $_SESSION['user_type']= $user->type();
                                $_SESSION['connexion']='admin'; 
                                header("Location:".PRE."/admin");                  
                        }
                   
                   }else{
                        $user = $usrm->connect($_POST['mail'], md5($_POST['pwd']));
                        if($user != null){
                              
                                $_SESSION['user']= $user;
                                $_SESSION['user_type']= $user->type();
                                $_SESSION['connexion']='user';                       
                        }
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
        if($_SESSION['connexion']!='user' ){
           
          for($i=0; $i<count($all); $i++){
              if($all[$i]->content()=='Publier'){
                 $all[$i]=null;
              }
          }
        }
       
        

        $this->render('index',compact('all','annonces'));
    }
    
    
    public function Annonce($id){
       
       //getting the data to send it to the view. 
       $manager = new AnnonceManager($id);

       if($manager->all() != null){
            
            $annonce = $manager->all()[0];

            if($_SESSION['connexion']=='user'){
                 $user = $_SESSION['user'];
            }
           
            $s = new Suggestions($annonce->id(),'annonce'); 
            $suggestions = $s->all();
            
            
             // post method and actions :
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                //administrateur :
                if($_SESSION['user_type']=='admin'){
                    // valider
                    if(isset($_POST['valider'])){
                       
                        $annonce->publish();
                    }
                    //annuler
                    if(isset($_POST['annuler'])){
                        $annonce->archiver();
                        header('Location:'.PRE.'/GestionAnnonces');
                    }
                }elseif($user->id()==$annonce->client()){
                    // le proprietaire de l'annonce:
                    if(isset($_POST['modifier'])){
                        //modifer
                        header("Location:".PRE."/accueil/modifier/".$annonce->id());
                    }
                    if(isset($_POST['supprimer'])){
                        //supprimer (archiver)
                        $annonce->archiver();
                        header('Location: '.PRE.'/accueil');
                    }
                    if(isset($_POST['note']))  {
                        //noter
                        $annonce->noter($_POST['note']);
                        //noter le transiteur
                        $m = new UtilisateurManager('none');
                        $trans = $m->rechercheByid($annonce->transiteur());
                        $trans->noter((float)$_POST['note']);
                    }          
                    if(isset($_POST['signaler'.$annonce->transiteur()])){
                        //signaler (le transiteur)
                        if(! empty($_POST['signalementdesc'])){
                            $d = array(
                                'annonce'=> $annonce->id(),
                                'emetteur'=> $annonce->client(),
                                'mis_en_cause'=>$annonce->transiteur(),
                                'description'=>$_POST['signalementdesc']
                                );
                        }
                        
                        $sign = new Signalement($d);
                        $sign->save();

                    }
                    if($annonce->demandes()>0){
                        
                        //annuler.id une demande
                        $s = new Demandes($annonce->id(),'annonce');
                        $demandes = $s->all();

                        foreach($demandes as $d){
                            if(isset($_POST['annuler'.$d->transporteur()->id()])){
                                $s->annuler($annonce->id(), $d->transporteur()->id());
                                
                                if($annonce->demandes()==1){
                                     
                                    $annonce->annulerdemander();
                                }
                                $this->Annonce($annonce->id());
                            }
                        }
                        
                        
                    } 
                    if($annonce->postulations()>0){
                        //accepter.id une postulations
                        $s = new Postulations($annonce->id(),'annonce');
                        $post = $s->all();
                        foreach($post as $d){
                            if(isset($_POST['accepter'.$d->transporteur()->id()])){
                            new Demandes($annonce->id(), $d->transporteur()->id());
                            $annonce->demander();
                            }
                        }
                    }

                    if($suggestions != null){ 
                        //demander.id (suggestions)
                        foreach($suggestions as $d){
                            if(isset($_POST['demander'.$d->transporteur()->id()])){
                                new Demandes($annonce->id(), $d->transporteur()->id());
                                $annonce->demander();
                            }
                        }
                    }
                }
                elseif($_SESSION['user_type']=='transporteur'){
                    // un transporteur
                    if(isset($_POST['postuler'])){
                        //postuler
                        new Postulations($annonce->id(), $user->id());
                        $annonce->postuler();
                        
                    }
                if(isset($_POST['annuler'])){
                    //annuler
                    $p = new Postulations($annonce->id(),'annonce');
                    $p->annuler($annonce->id(), $user->id());
                    $ppp = $p->all();
                    if(count($ppp)==1 ){
                            $annonce->annulerpostuler();
                    }
                }
                if(isset($_POST['confirmer'])){
                        //confirmer: il devient le transiteur
                        $annonce->transiter($user->id());
                        $annonce->setTransiteur($user->id());
                        $user->transiter($annonce->prix());

                } 
                if(! empty($_POST['signalementdesc'])){
                        //signaler
                    
                            $d = array(
                            'annonce'=> $annonce->id(),
                            'emetteur'=> $user->id(),
                            'mis_en_cause'=>$annonce->client(),
                            'description'=>$_POST['signalementdesc']
                            );
                        
                        $sign = new Signalement($d);
                        $sign->save();

                }
                }
            
            }

            $restrict = false;
            $sugg_act = '';
            $dem_act = '';
            $post_act = '';
            $trans_act = '';
            if($annonce->transiteur()!== null){
                $u = new UtilisateurManager($annonce->transiteur());
                $transiteur = $u->getuser();
            }
            if($_SESSION['connexion']!='anonyme'){ //includes admin and user
                
                 $user = $_SESSION['user'];
                   
                if($user->id()==$annonce->client()){
                    //le proprietaire de l'annonce
                    $sugg_act = 'demander' ;
                    if($annonce->transiteur()!== null){
                    $d = array(
                        'annonce'=> $annonce->id(),
                        'emetteur'=> $annonce->client(),
                        'mis_en_cause'=>$annonce->transiteur()
                        );
                    $sign = new Signalement($d);
                    if(! $sign->recherche()){
                        $trans_act = 'signaler' ;
                    }
                }
                    if($annonce->demandes()>0){
                        $s = new Demandes($annonce->id(),'annonce');
                        $demandes = $s->all();
                        $dem_act = 'annuler';
                    }
                    if($annonce->postulations()>0){
                        $s = new Postulations($annonce->id(),'annonce');
                        $postulations = $s->all();
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
                                        $d = array(
                                            'annonce'=> $annonce->id(),
                                            'emetteur'=>$user->id() ,
                                            'mis_en_cause'=>$annonce->client(),
                                            );
                                   
                                    $d = array(
                                        'annonce'=> $annonce->id(),
                                        'emetteur'=>$user->id() ,
                                        'mis_en_cause'=>$annonce->client()
                                        );
                                    $sign = new Signalement($d);
                                    if(! $sign->recherche()){
                                         $actions[]= 'signaler';
                                    }
                                
                                }
                            }else{
                                $post = new AnnonceTransporteur(array(
                                    'annonce'=> $annonce->id(),
                                    'transporteur'=> $user->id()
                                ));
                                $p= new Postulations($annonce->id(),'annonce');
                                $pos = $p->all(); 
                                if($pos != null){
                                   if(in_array($post, $pos)){
                                       //il a deja postuler
                                       $d = new demandes($annonce->id(),'annonce');
                                       $dem = $d->all();
                                       if($dem != null){
                                           if(in_array($post, $dem)){
                                             //le client a accepter sa postulation: une post et une demande
                                               $actions[] = 'confirmer';
                                           }else{
                                           //il a postuler mais le client n'as pas accepter
                                            $actions[] = 'annuler';
                                       }
                                       }else{
                                        $actions[] = 'annuler';
                                       }
                                        
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
                                $s = new Demandes($annonce->id(),'annonce');
                                $demandes = $s->all();
                               
                            }
                            if($annonce->postulations()>0){
                                $s = new Postulations($annonce->id(),'annonce');
                                $postulations = $s->all();
                              
                            }
                            $actions= array();
                            if(! $annonce->publier()){
                                $actions = array('valider','annuler');
                            }
                            
                            break;
                        default:
                        echo 'something is wrong within your user type';    
                    }
                }

                if($annonce->transiteur()!= null){
                    $sugg_act='';
                    $post_act='';
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
        
           header("Location:".PRE."/accueil");            
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

    public function modifier($id){

        $manager = new AnnonceManager($id);
        $annonce = $manager->getannonce();
        $reset_sugg = false;
        if($_SESSION['connexion']=='user'){
        //method POST:
        if($_SERVER["REQUEST_METHOD"] == "POST"){
          

            if(isset($_POST['titre'])){
                $annonce->setTitre($_POST['titre']);
              
            }
          
            if(isset($_POST['photo'])){
                $annonce->setPhoto($_POST['photo']);
            }
            
            if(isset($_POST['depart'])){
                $reset_sugg = true;
                $annonce->setWilaya_depart($_POST['depart']);
            }
            
            if(isset($_POST['arrive'])){
                $reset_sugg = true;
                $annonce->setWilaya_arrive($_POST['arrive']);
            }
            
            if(isset($_POST['transport'])){
                $trans="";
                foreach($_POST['transport'] as $t){
                    $trans = $trans.", ".$t ; 
                }
                $annonce->setTransport($trans);
            }
            
            if(isset($_POST['type'])){
                $annonce->setType($_POST['type']);
            }
            
            if(isset($_POST['poids'])){
                $p = explode("-",$_POST['poids']);
                
                $annonce->setPoidsMin((float)$p[0]);
                $annonce->setPoidsMax((float)$p[1]);
            }
            
            if(isset($_POST['volume'])){
                $p = explode("-",$_POST['volume']);
                
                $annonce->setVolumeMin((float)$p[0]);
                $annonce->setVolumeMax((float)$p[1]);
            }
            
            if(isset($_POST['description'])){
                $annonce->setDescription($_POST['description']);
            }
            
    
            $annonce->calculPrix();   

             $annonce->update();
            
            //creer les suggestions
            if($reset_sugg){
                //delete the other suggestions
                $suggest = new Suggestions($annonce->id(),'annonce');
                $suggestions = $suggest->all();
                if($suggestions != null){
                    foreach($suggestions as $s){
                        $suggest->annuler($s->annonce()->id(), $s->transporteur()->id());
                    }
                }
                //create new suggestions
                $sug = new Suggestions($id," ");
                
            }
            
            //
        
           header("Location:".PRE."/accueil/annonce/".$id);            
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
        

        $this->render('modifier', compact('annonce','poids','volumes','wilayas','transports','type'));
        }
        else{
            echo 'vous devez etre connecter pour modifier';
        }
    }
     
 }
?>