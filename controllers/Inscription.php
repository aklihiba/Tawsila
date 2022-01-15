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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $user = new Utilisateur(array());
            if(isset($_POST['nom'])){
                $user->setNom($_POST['nom']);
            }
            if(isset($_POST['prenom'])){
                $user->setPrenom($_POST['prenom']);
            }
            if(isset($_POST['email'])){
                $user->$_POST['email'];
            }
            if(isset($_POST['numero'])){
                
            }
            if(isset($_POST['adresse'])){
                
            }
            if(isset($_POST['mdp']) && isset($_POST['mdp2'])){
                if($_POST['mdp']==$_POST['mdp2']){

                }
            }
            if(isset($_POST['transporteur'])){
                
            }
            if(isset($_POST['wilayadpr'])){
                
            }
            if(isset($_POST['wilayaarv'])){
                
            }

        }

        $all = new InscriptionPage();
        $all = $all->getElements();

        $wilayas = new Wilaya();
        $wilayas = $wilayas->all();

        $this->render('index', compact('wilayas','all'));

    }
}

?>