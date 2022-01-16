<?php
      require_once('models/Utilisateur.php');
      require_once('models/Annonce.php');
      require_once('models/Demandes.php');
      require_once('models/Postulations.php');
class Profil extends Controller{
    public function __construct()
    {
        session_start();
        if(!isset($_SESSION['connexion'])){
            $_SESSION['connexion']='anonyme';
        }
            $this->loadModel('AnnonceManager');
            $this->loadModel('UtilisateurManager');
            $this->loadModel('AnnonceManager');
            $this->loadModel('Wilaya');
    }

    public function index($id){
        if($_SESSION['connexion']!='anonyme'){
            $m = new UtilisateurManager($id);
            $profil = $m->getuser();

            if($profil!= null){
                 //les annonces que ce profil a publier
                 $am = new AnnonceManager();
                 $am->rechercheClientNotArchived($id);
                 $annonces = $am->all();

                 if($profil->type()=='transporteur'){
                    //les annonces que ce profil a transiter
                    $am->rechercheTransiteurNotArchived($id);
                    $transitions = $am->all();
                 }  
                 
                 if($id== $_SESSION['user']->id()){
                    //son profil
                    if($profil->type()=='transporteur'){
                        //ces postulations de type annoncetransporteur : contient l'annonce et le transporteur
                        $postulations = new Postulations($id, 'transporteur');
                        $postulations = $postulations->all();
                        $demandes = new Demandes($id, 'transporteur');
                        $demandes = $demandes->all();
                    }    
                    //TODO : les signalements si necessaire 
                }
                 
                if($_SESSION['connexion']=='admin'){
                    //annonce qu'il a publier
                    $am = new AnnonceManager();
                    $am->rechercheClient($id);
                    $annonces = $am->all();
                    //ces transitions 
                    if($profil->type()=='transporteur'){
                        $am->rechercheTransiteur($id);
                        $transitions = $am->all();

                        $postulations = new Postulations($id, 'transporteur');
                        $postulations = $postulations->all();
                        $demandes = new Demandes($id, 'transporteur');
                        $demandes = $demandes->all();
                    }
                }
                $userid = $_SESSION['user']->id();
                $this->render('index', compact('id','userid','profil','annonces','transitions','demandes','postulations'));

            }else{
                echo 'wrong id';
            }
        }else{
            echo 'vous devez etre connecter pour voir un profil';
        }  
        
    }

    public function modifier($id){
        $erreur="";
        $user =$_SESSION['user'];
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(! empty($_POST['nom'])){
                $user->setNom($_POST['nom']);
            }else{
                $erreur = $erreur.'vous devez avoir un nom<br>';
            }
            if(! empty($_POST['prenom'])){
                $user->setPrenom($_POST['prenom']);
            }else{
                $erreur = $erreur.'vous devez avoir un prenom<br>';
            }
            if(isset($_POST['photo'])){
                $user->setPhoto($_POST['photo']);
            }
            if(! empty($_POST['telephone'])){
                $user->setTelephone($_POST['telephone']);
            }else{
                $erreur = $erreur.'vous devez avoir un numero de telephone<br>';
            }
            if(! empty($_POST['adresse'])){
                $user->setAdresse($_POST['adresse']);
            }else{
                $erreur = $erreur.'vous devez avoir une adresse<br>';
            }
            if((! empty($_POST['mdp']))&& (! empty($_POST['mdp']))){
                if($_POST['mdp']==$_POST['mdp2']){
                    $user->setPwd($_POST['mdp']);
                }else{
                    $erreur = $erreur.'le mot de passe doit etre identique<br>';
                }
            }
            if($user->type()=='transporteur'){
                if(isset($_POST['depart'])){
                    $reset_sugg = true;
                    $user->setWilayas_depart($_POST['depart']);
                }
                
                if(isset($_POST['arrive'])){
                    $reset_sugg = true;
                    $user->setWilayas_arrive($_POST['arrive']);
                }   

                $user->updateTransporteur();
                header('Location:'.PRE."/Profil/".$user->id());
            }else{
                $user->updateClient();
                header('Location:'.PRE."/Profil/".$user->id());

            }
            

            
        }
       
        if($user->id()==$id){
            $wilayas = new Wilaya();
            $wilayas = $wilayas->all();

            $this->render('modifier', compact('user','wilayas','erreur'));
        }else{
            echo 'vous n`avez pas l`acces a cette page';
        }

    }
}

?>