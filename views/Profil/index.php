<script>
    function modifier(id){
            var a = document.createElement('a');
            a.href = "/projet/profil/modifier/"+id;
          
            fireClickEvent(a);
        }

        $(document).ready(function(){
            $(".profil_info").css('display','flex');
            $(".profil_info").css('justify-content','space-around');
            $(".profil_info>div").css('margin','5%');

        });    
</script>

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
    $g->button('modifier','bigbutton','modifier('.$id.')');
    $g->divend();
$g->divend();
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
if($id==$userid){
    if(isset($postulations)){
        if($postulations != null){
            $g->titre(2,"vos postulations",'titre2');
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