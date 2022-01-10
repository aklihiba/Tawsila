<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tawsila</title>
    <?php $g = new ViewGenerator($couleur);  ?>
</head>
<?php $g->cadre(); ?>
    <header>
<?php
   
    //TODO : generate cadre with padding and margins
    //logo
    $g->imageh($header->logo(),50);
    //buttons
    $g->span();
    foreach($header->buttons() as $button){
        $g->button($button,$header->buttonsClass());
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
