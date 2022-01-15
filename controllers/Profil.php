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

    }
}

?>