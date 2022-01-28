
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tawsila</title>
    <script type="text/javascript" src="<?= PRE ?>/ressource/JS/jquery.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<?php 
$g->cadre($couleur->bgcolor(),$couleur->bordercolor());
require_once('ressource/styles/style.php');
?>
<header>
    
<?php
   

    
    //buttons
    $g->spanclass('header');
    //logo
    $g->imageh($header->logo(),50);
    if($_SESSION['connexion']=='admin'){
        $g->button("Déconnexion",$header->buttonsClass(),"Déconnexion()");
    }else{
        foreach($header->buttons() as $button){
        
        if($button=="Déconnexion"){
            $g->button("Déconnexion",$header->buttonsClass(),"Déconnexion()");
        }elseif($button=="Connexion") {
            
        // $g->button($button,$header->buttonsClass(), $button."()");
        
        $g->login($header, $couleur);
        
            }else{
                $g->button($button,$header->buttonsClass(), $button."()");
            }
        }
    }
    
 
    $g->spanend();
   
    //diapo
    if(isset($diapo)){
        $g->diapo($diapo->getImages());
    }
    //menu
    $g->menu($header->menu(),$header->menuClass());
?>
    </header>
    <main>
        <?= $content ?>
    </main>

    <footer>
<?php
    //footer
    $g->footer($footer->menu(),$footer->logo(),$footer->class());

?>
    </footer>
<?php  $g->bodyend(); ?>
</html>
