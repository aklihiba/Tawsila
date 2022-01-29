
<?php
if($_SESSION['connexion'] != 'anonyme'){
    echo '<form id="annonce" action="'.PRE.'/accueil/annonce/'.$annonce->id().'" method="post">';
}
//first the restricted info :
$g->divclass('container');
$g->divclass('row');
$g->divclass('col');

    $g->imageh($annonce->photo(),200);
    $g->titre('5','proprietaire: '.$prop->nom().' '.$prop->prenom(),'titre');
    $g->paragraphe('publier le: '.$annonce->date(),'paragraphe');
    $g->divend();
    $g->divclass('col-5');
        $g->titre(1, $annonce->titre(),'titre1');
        $g->titre(2, $annonce->wilaya_depart().'->'.$annonce->wilaya_arrive(),'titre2');
        $g->paragraphe('type d`annonce: '.$annonce->type(),'paragraphe');
        $g->paragraphe('moyens de transport: '.$annonce->transport(),'paragraphe');
        $g->paragraphe('poids entre '.$annonce->poidsMin().'kg et '.$annonce->poidsMax().'kg','paragraphe');
        $g->paragraphe('volume entre '.$annonce->volumeMin().'m3 et '.$annonce->volumeMax().'m3','paragraphe');
        $g->paragraphe('nombre de vues: '.$annonce->vues(),'paragraphe');
        if($annonce->note()!= 0 ){
            $g->paragraphe('la note: '.$annonce->note(),'paragraphe');            
        }
        


$g->divend();
    if($_SESSION['connexion'] != 'anonyme'){
$g->divclass('col');
$g->center();
            $g->titre(1, $annonce->prix().' DA','titre1');
            $g->paragraphe($annonce->etat(),'paragraphe');
            foreach($actions as $a){
                if($a=='noter'){
                    $g->input('note','note', 'note', 'input');
                    $g->button($a, 'mediumbutton', 'noter()');
                }elseif($a=='signaler'){
                  $g->signalementbox();
                }else
                $g->submit($a, $a, 'mediumbutton');
                
            }
            $g->centerend();            
$g->divend();
    }
    
$g->divend();
$g->divend();
$g->paragraphe($annonce->description(),'paragraphe');
if($_SESSION['connexion'] != 'anonyme'){
    if(isset($transiteur)){

        $g->titre(2, 'Le transiteur', 'titre2');
        $g->divclass('container');
        $g->divclass('row');
        $g->divclass('col-sm');
        $g->userbox($transiteur, $trans_act);
        $g->divend();  $g->divend();  $g->divend();  
    }
    if(isset($postulations)){
        $g->titre(2, 'Les postulations', 'titre2');
        $g->divclass('container');
        $g->divclass('row');
        foreach($postulations as $p){
            $g->divclass('col-sm');
              $g->userbox($p->transporteur(), $post_act);
              $g->divend();  
        }
        $g->divend();   $g->divend();  
    }
    if(isset($demandes)){
        $g->titre(2, 'Les demandes', 'titre2');
        $g->divclass('container');
        $g->divclass('row');
        foreach($demandes as $p){
            $g->divclass('col-sm');
              $g->userbox($p->transporteur(), $dem_act);
              $g->divend();  
        }
        $g->divend();  
        $g->divend();  
    }
}

if(isset($suggestions)){
    $g->titre(2, 'Les suggestions', 'titre2');
    $g->divclass('container');
    $g->divclass('row');
    foreach($suggestions as $p){
        $g->divclass('col-sm');
          $g->userbox($p->transporteur(), $sugg_act);
        $g->divend();  
    }
    $g->divend();  
    $g->divend();  
}
if($_SESSION['connexion'] != 'anonyme'){
    echo '</form>';
}

?>

