<?php
    require_once(ROOT.'models/header.php');
    require_once(ROOT.'models/Footer.php');
    require_once(ROOT.'models/Diaporama.php');
    require_once(ROOT.'models/Couleur.php');
    
abstract class Controller {
   
    public function __construct(){
        $this->loadModel('StringModel');
       
    }

    public function loadModel(string $model){
        require_once(ROOT.'models/'.$model.'.php');
        $this->$model = new $model();
    }


    public function render(string $file, array $data = []){
        extract($data);

        ob_start();
        //header and footer for the layout
        if(isset($_SESSION['user_type'])){
            $header = new header('user');    
     
        }
        else{
            $header = new header('anonyme');      
        }
        $footer = new footer();
        $couleur = new Couleurs();
        
        //diapo for the accueil page
        if($this instanceof Accueil){
            $diapo = new Diaporama();
        }
        
        require_once(ROOT.'views/ViewGenerator.php');
        $g = new ViewGenerator(); 
        require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$file.'.php');
        $content = ob_get_clean();
        
        require_once(ROOT.'views/layouts/default.php');
        
    }
}

?>