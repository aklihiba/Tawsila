<?php
    require_once(ROOT.'models/header.php');
    require_once(ROOT.'models/Footer.php');
    require_once(ROOT.'models/Diaporama.php');
    require_once(ROOT.'models/Couleur.php');
    require_once(ROOT.'models/fonts.php');
    require_once(ROOT.'models/Utilisateur.php');
    
abstract class Controller {
   
    public function __construct(){
        
        $this->loadModel('StringModel');
       
    }

    public function loadModel(string $model){
        require_once(ROOT.'models/'.$model.'.php');
      //  $this->$model = new $model();
    }


    public function render(string $file, array $data = []){
        extract($data);

        ob_start();
        //header and footer for the layout
        if($_SESSION['connexion']=='user'){
             $header = new Header('user');
        }else{
            $header = new Header('anonyme');
        }
       
        $footer = new footer();
        $couleur = new Couleurs();
        $fonts = new Fonts();
        //diapo for the accueil page
        if($this instanceof Accueil && $file=="index"){
            $diapo = new Diaporama();
        }
        require_once(ROOT.'ressource/JS/scripts.php');
        require_once(ROOT.'views/ViewGenerator.php');
        $g = new ViewGenerator(); 
        require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$file.'.php');
        $content = ob_get_clean();
        
        require_once(ROOT.'views/layouts/default.php');
        
    }
}

?>