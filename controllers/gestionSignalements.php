<?php
    class GestionSignalements extends ControllerAdmin{

        public function __construct(){
            session_start();
            if(!isset($_SESSION['connexion'])){
                $_SESSION['connexion']='admin';
            }
            $this->loadModel('AnnonceManager');
            $this->loadModel('UtilisateurManager');
            $this->loadModel('SignalementManager');
            
        }

        public function index(){

            $manager = new SignalementManager();
            $annonces = new AnnonceManager();
            $user = new UtilisateurManager();
            $signs = $manager->all();
            foreach($signs as $a){
                $id = $a->annonce();
                $a->setAnnonce($annonces->rechercheByid($id));

                $id = $a->emetteur();
                $a->setEmetteur($user->rechercheByid($id));

                $id = $a->mis_en_cause();
                $a->setMis_en_cause($user->rechercheByid($id));
                
               
            }

            $this->render('index',compact('signs'));
        }

        public function signalement($id){
            $ids = explode('-',$id);
            $manager = new SignalementManager($ids[0],$ids[1],$ids[2]);
            $annonces = new AnnonceManager();
            $user = new UtilisateurManager();
            $s = $manager->getSignalement();

            $id = $s->annonce();
                $s->setAnnonce($annonces->rechercheByid($id));

                $id = $s->emetteur();
                $s->setEmetteur($user->rechercheByid($id));

                $id = $s->mis_en_cause();
                $s->setMis_en_cause($user->rechercheByid($id));
                

            $this->render('signalement',compact('s'));            
        }
    }    

?>