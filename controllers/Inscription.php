<?php
      require_once('models/Utilisateur.php');

class Inscription extends Controller{

    public function __construct(){
        session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='anonyme';
            }
     
        $this->loadModel('InscriptionPage');
        $this->loadModel('UtilisateurManager');
        $this->loadModel('Wilaya');
   
    } 
    
    public function index(){
        $erreur="";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $user = new Utilisateur(array());
            if(! empty($_POST['nom'])){
                $user->setNom($_POST['nom']);
            }else{
                $erreur=$erreur.'nom doit etre rempli <br> ';
            }
            if(! empty($_POST['prenom'])){
                $user->setPrenom($_POST['prenom']);
            }
            else{
                $erreur=$erreur.'prenom doit etre rempli <br>';
            }
            if(! empty($_POST['email'])){
                $user->setMail( $_POST['email']);
                if ($user->existedeja()){
                    $erreur=$erreur.'cette adresse email existe deja <br> ';
                }
            }else{
                $erreur=$erreur.'email doit etre rempli <br>';
            }
            if(! empty($_POST['numero'])){
                $user->setTelephone($_POST['numero']);
            }
            else{
                $erreur=$erreur.'numero doit etre rempli <br>';
            }
            if(! empty($_POST['adresse'])){
                $user->setAdresse($_POST['adresse']);
            }else{
                $erreur=$erreur.'adresse doit etre rempli <br>';
            }
            if(!empty($_POST['mdp']) && !empty($_POST['mdp2'])){
                if($_POST['mdp']==$_POST['mdp2']){
                    $user->setPwd($_POST['mdp']);
                }else{
                    $erreur=$erreur.'le mot de passe doit etre le meme <br>';
                }
            }else{
                $erreur=$erreur.'mot de passe doit etre rempli <br>';
            }
            
            if(isset($_POST['transporteur'])){
                $user->setStatut('en attente');
                $user->setType('transporteur');
                $user->setGain(0);
                if(isset($_POST['certification'])){
                    $user->setDemande_certification(true);
                }else{
                    $user->setDemande_certification(false);
                }
                if(! empty($_POST['wilayadpr'])){
                    $user->setWilayas_depart($_POST['wilayadpr']);
                }else{
                    $erreur=$erreur.'choisissez au moins une wilaya de depart<br> ';
                }
                if(! empty($_POST['wilayaarv'])){
                    $user->setWilayas_arrive($_POST['wilayaarv']);
                }else{
                    $erreur=$erreur.'choisissez au moins une wilaya d`arrive <br> ';
                }
                if($erreur==""){
                    $user->insererTransporteur();
                    $_SESSION['user']= $user;
                    $_SESSION['user_type']= $user->type();
                    $_SESSION['connexion']='user';
                    header('Location: '.PRE);  
                }
            }else{
                if($erreur==""){
                    $user->setType('client');
                    $user->insererClient();
                    $_SESSION['user']= $user;
                    $_SESSION['user_type']= $user->type();
                    $_SESSION['connexion']='user'; 
                    header('Location: '.PRE);  
                }
                
            }
            

        }

        $all = new InscriptionPage();
        $all = $all->getElements();

        $wilayas = new Wilaya();
        $wilayas = $wilayas->all();

        $this->render('index', compact('wilayas','all','erreur'));

    }
}

?>