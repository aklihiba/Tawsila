
<?php

$g->divclass('profil_info');
    $g->div();
        $g->imageh($profil->photo(),150);
        if($profil->type()=='transporteur'){
            $g->titre(2,$profil->statut(),'titre2');
            $g->paragraphe('note: '.$profil->note().'/5','paragraphe');
        }
    $g->divend();
    $g->div();   
        $g->titre(1,$profil->nom().' '.$profil->prenom(),'titre1');
        $g->titre(3,$profil->type(),'titre');        
        $g->paragraphe('tel: '.$profil->telephone(),'paragraphe');
        $g->paragraphe('adresse: '.$profil->adresse(),'paragraphe');
        if($profil->type()=='transporteur'){
            $g->paragraphe('wilayas depart: '.$profil->depart(),'paragraphe');
            $g->paragraphe('wilayas d`arrivé: '.$profil->arrive(),'paragraphe');
        }
    $g->divend();
 $g->div();
    if( ($profil->statut()=='certifié') &&($id == $userid)){
       
            $g->titre(1,$profil->gain().' DA','titre1');
            $g->titre(2,($profil->gain()*15/100).' reviens a Tawsila','biglink');
     
  
    }
    if($id==$userid){
        $g->button('modifier','bigbutton','modifier('.$id.')');
    }
    $g->divend();
$g->divend();

if(($profil->admin_msg()!==null)&&(($userid == $id)||($_SESSION['connexion']=='admin'))){
    $g->divclass('adminmsg');
        $g->paragraphe($profil->admin_msg(),'paragraphe');
    $g->divend();
}
if(isset($annonces)){
    if($annonces != null){
        $g->titre(2,"les annonces publiées",'titre2');
        $g->divclass('annonce_list');
            foreach($annonces as $a){
                $g->annoncebox($a);
            }
        $g->divend();
    }
}        
    
if(isset($transitions)){
    if($transitions != null){
         $g->titre(2,"les annonces transitées",'titre2');
    $g->divclass('transition_list');
        foreach($transitions as $a){
            $g->annoncebox($a);
        }
    $g->divend();
    }   
}
if($id==$userid || $_SESSION['connexion']=='admin'){
    if(isset($postulations)){
        if($postulations != null){
            $g->titre(2,"les postulations",'titre2');
        $g->divclass('postulations_list');
            foreach($postulations as $a){
                $g->annoncebox($a->annonce());
            }
        $g->divend();
        }   
    }
    if(isset($demandes)){
        if($demandes != null){
            $g->titre(2,"les demandes recues",'titre2');
        $g->divclass('demandes_list');
            foreach($demandes as $a){
                $g->annoncebox($a->annonce());
            }
        $g->divend();
        }   
    }    
}

    
?>