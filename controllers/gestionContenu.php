<?php
    class GestionContenu extends ControllerAdmin{
    public function __construct(){
        session_start();
        if(!isset($_SESSION['connexion'])){
            $_SESSION['connexion']='admin';
        }
        $this->loadModel('PresentationPage');
        $this->loadModel('ContactPage');
        $this->loadModel('Diaporama');
    }

    public function index(){
        $this->render('index');
    }
    public function PresentationPage(){
        $model = new PresentationPage();
         $all = $model->all();

        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(isset($_POST['appliquer'])){
                if(isset($_POST['selected'])){
                    foreach($_POST['selected'] as $id){
                       $model->update($id, $_POST['type'.$id], $_POST['content'.$id] );
                       if($id> count($all)){
                        $class = "";
                        if($_POST['type'.$id]=='h1'){$class = 'titre1';}
                        if($_POST['type'.$id]=='p'){$class = 'paragraphe';}
                        $model->ajouter($id, $_POST['type'.$id], $_POST['content'.$id],$class);
                    } 
                    }
                    $model = new PresentationPage();
                    $all = $model->all();
                }
            }
        }
       
       
        $this->render('PresentationPage', compact('all'));
    }

    public function ContactPage(){

        $model = new ContactPage();
        $all = $model->all();
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(isset($_POST['appliquer'])){
                if(isset($_POST['selected'])){
                    foreach($_POST['selected'] as $id){
                       $model->update($id, $_POST['type'.$id], $_POST['content'.$id] );
                       if($id> count($all)){
                           $class = "";
                           if($_POST['type'.$id]=='h1'){$class = 'titre1';}
                           if($_POST['type'.$id]=='p'){$class = 'paragraphe';}
                           $model->ajouter($id, $_POST['type'.$id], $_POST['content'.$id],$class);
                       } 
                    }
                    $model = new ContactPage();
                    $all = $model->all();
                }
            }
        }
       
        $all = $model->all();

        $this->render('ContactPage', compact('all'));
    }
    public function theme(){
        
    }
    public function diaporama(){
        $manager = new Diaporama();
        $all = $manager->getImages();
        
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(isset($_POST['ajouter'])){
                if(isset($_POST['selected'])){
                    foreach($_POST['selected'] as $id){                      
                       if($id> $all[count($all)-1]->id()){
                        $manager->add( $_POST['image'.$id], $_POST['link'.$id] );
                    } 
                    }
                    $manager = new Diaporama();
                    $all = $manager->getImages();
                }
            }
            if(isset($_POST['supprimer'])){
                if(isset($_POST['selected'])){
                    foreach($_POST['selected'] as $id){                      
                       $manager->delete($id);
                    }
                    $manager = new Diaporama();
                    $all = $manager->getImages();
                }
            }
        }

        $this->render('diaporama',compact('all'));
    }
    public function critereAnnonce(){

    }
    public function prixWilaya(){

    }

    public function fourchettevolume(){

    }
    public function fourchettepoids(){

    }
    public function typeannonce(){

    }
    public function transport(){

    }
    }

?>