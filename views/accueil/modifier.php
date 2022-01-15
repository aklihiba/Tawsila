<form action="<?= PRE ?>/accueil/modifier/<?= $annonce->id() ?>" method="post">
<?php
    $g->titre(1,'Modifier', 'titre1');

    $g->div();
    $g->paragraphe('depart','paragraphe');
    $g->dropdownradio($wilayas,'depart',$annonce->wilaya_depart(),'dropdown');   
    $g->divend();

    $g->div();
    $g->paragraphe('arrivé','paragraphe');
    $g->dropdownradio($wilayas,'arrive',$annonce->wilaya_arrive(),'dropdown');   
    $g->divend();

    $g->div();
        $g->inputvalue('titre','titre',$annonce->titre(),'input');
    $g->divend();

    $g->div();
    $g->biginputvalue('description','description',$annonce->description(),'biginput');
    $g->divend();

    $g->div();
    $g->fileselectvalue('photo','photo',$annonce->photo(),'biginput');
    $g->divend();

    $g->div();
    $g->paragraphe('type','paragraphe');
    $g->dropdowncheckbox($type,'type',$annonce->type(),'dropdown');   
    $g->divend();

    $g->div();
    $g->paragraphe('moyens de transports','paragraphe');
    $g->dropdowncheckbox($transports,'transport',$annonce->transport(),'dropdown');   
    $g->divend();

    $g->div();
    $g->paragraphe('poids','paragraphe');
    $g->fourchette($poids,'poids',$annonce->poidsMin().'->'.$annonce->poidsMax().' kg','dropdown');   
    $g->divend();

    $g->div();
    $g->paragraphe('volume','paragraphe');
    $g->fourchette($volumes,'volume',$annonce->volumeMin().'->'.$annonce->volumeMax().' kg','dropdown');   
    $g->divend();

    $g->submit('modifier','modifier','bigbutton');
?>
</form>

