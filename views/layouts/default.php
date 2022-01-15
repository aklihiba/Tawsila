
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tawsila</title>
    <script type="text/javascript" src="<?= PRE ?>/ressource/JS/jquery.js"></script>

</head>
<?php $g->cadre($couleur->bgcolor(),$couleur->bordercolor()); ?>
    <header>
    <style>
        #login{
            background-color: <?= $couleur->bgcolor()?>;
            display: none;
            position:static;
            height: 200;
            width: 300;
            z-index: 4;
        }
        .close-icon
{
  display:block;
  box-sizing:border-box;
  width:20px;
  height:20px;
  border-width:2px;
  border-style: solid;
  border-color:<?= $couleur->bordercolor()?>;
  border-radius:100%;
  background: -webkit-linear-gradient(-45deg, transparent 0%, transparent 46%, white 46%,  white 56%,transparent 56%, transparent 100%), -webkit-linear-gradient(45deg, transparent 0%, transparent 46%, white 46%,  white 56%,transparent 56%, transparent 100%);
  background-color:<?= $couleur->secondarycolor()?>;
  transition: all 0.3s ease;
}
    </style>
    <script>
        
        function fireClickEvent(element) {
    var evt = new window.MouseEvent('click', {
        view: window,
        bubbles: true,
        cancelable: true
    });

    element.dispatchEvent(evt);
    }
        function Connexion(){
            document.getElementById("login").style.display = "block";
        }
        function Déconnexion(){
            var a = document.createElement('a');
            a.href = "/projet/accueil/deconnexion";
          
            fireClickEvent(a);
        }
        function closelogin(){
            document.getElementById("login").style.display = "none";
        }
        function Inscription(){
            var a = document.createElement('a');
            a.href = "/projet/Inscription";
          
            fireClickEvent(a);
        }
       
    </script>


<?php
   

    //logo
    $g->imageh($header->logo(),50);
    //buttons
    $g->span();
    foreach($header->buttons() as $button){
        
        if($button=="Déconnexion"){
            echo'<form action="'.PRE.'/accueil" method="post">';
            $g->submit($button,"deconnexion",$header->buttonsClass());
            echo '</form>';
        }elseif($button=="Connexion") {
          
        $g->button($button,$header->buttonsClass(), $button."()");
        //login popup
            $g->login($header);
        
        }else{
            $g->button($button,$header->buttonsClass(), $button."()");
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
