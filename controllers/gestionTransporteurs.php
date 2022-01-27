<?php

    class GestionTransporteurs extends ControllerAdmin{

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
                            $user->sendmsg('');
                        }
                    }
                }
                
                elseif(isset($_POST['certifier'])){
                    if(isset($_POST['selected'])){
                        foreach($_POST['selected'] as $id){
                            $user = $manager->rechercheByid($id);
                            $user->certifier();
                            $user->sendmsg('');
                        }
                    }
                }

                elseif(! empty($_POST['message_valid'])){
                    if(isset($_POST['selected'])){
                        foreach($_POST['selected'] as $id){
                            $user = $manager->rechercheByid($id);
                            $user->valider();
                            $user->sendmsg($_POST['message_valid']);
                            
                        }
                    }
                }

                

                elseif(! empty($_POST['message_rejet'])){                  
                    if(isset($_POST['selected'])){
                        foreach($_POST['selected'] as $id){
                            $user = $manager->rechercheByid($id);
                            $user->refuser();
                            $user->sendmsg($_POST['message_rejet']);
                            
                        }
                    }
                }
            }
           
            $trans = $manager->getTransporteurs();

            $this->render('index', compact('trans'));
        }
    }


?>