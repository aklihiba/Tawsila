<?php

    class GestionAnnonces extends ControllerAdmin{

        public function __construct(){
            session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='anonyme';
            }
            $this->loadModel('AnnonceManager');
            $this->loadModel('UtilisateurManager');
            
        }

        public function index(){
            $manager = new AnnonceManager();

            $users = new UtilisateurManager('none');
            if($_SERVER['REQUEST_METHOD']=="POST"){
                if(isset($_POST['valider'])){
                   
                    if(isset($_POST['selected'])){
                        foreach($_POST['selected'] as $id){
                            $a = $manager->rechercheByid($id);
                            $a->publish();
                        }
                    }
                }
                elseif(isset($_POST['annuler'])){
                   
                    if(isset($_POST['selected'])){
                        foreach($_POST['selected'] as $id){
                            $a = $manager->rechercheByid($id);
                            $a->annulerpublication();
                        }
                    }
                }
                elseif(isset($_POST['archiver'])){
                   
                    if(isset($_POST['selected'])){
                        foreach($_POST['selected'] as $id){
                            $a = $manager->rechercheByid($id);
                            $a->archiver();
                        }
                    }
                }

            }
            
            $annonces = $manager->getallannonces();
            foreach($annonces as $a){
                $id = $a->client();
                $a->setClient($users->rechercheByid($id));
                $id = $a->transiteur();
                if($id != '-'){
                     $a->setTransiteur($users->rechercheByid($id));
                }
               
            }

            $this->render('index', compact('annonces'));
        }
    }


?>