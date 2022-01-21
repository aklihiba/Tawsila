<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tawsila</title>
    <script type="text/javascript" src="<?= PRE ?>/ressource/JS/jquery.js"></script>

</head>
<header>
<?php 
    require_once(ROOT.'ressource/JS/scripts.php');

    $g->cadre($couleur->bgcolor(),$couleur->bordercolor()); 
    //logo
    $g->imageh($header->logo(),50);
    //buttons
    $g->span();
    $g->submit("Déconnexion","deconnexion",$header->buttonsClass());
    $g->spanend();
    $g->adminmenu($header->menu(),$header->menuClass());


?>
</header>
<main>
        <?= $content ?>
    </main>