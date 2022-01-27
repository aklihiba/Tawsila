<?php

    class GestionClients extends ControllerAdmin{

        public function __construct(){
            session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='admin';
            }
            
            $this->loadModel('UtilisateurManager');
            
        }

        public function index(){
            $manager = new UtilisateurManager('none');

            if($_SERVER['REQUEST_METHOD']=="POST"){
                if(isset($_POST['banir'])){
                    if(isset($_POST['selected'])){
                        foreach($_POST['selected'] as $id){
                            $user = $manager->rechercheByid($id);
                            $user->banir();
                        }
                    }
                }
            }
           
            $clients = $manager->getClients();

            $this->render('index', compact('clients'));
        }
    }


?>