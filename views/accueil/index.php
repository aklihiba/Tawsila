
<form action="<?= PRE ?>/accueil" method="post">
<?php
    for ($i=0; $i <count($all) ; $i++) { 
       if(! is_null($all[$i])){ 
        if($all[$i]->type()=='input'){
             $g->input($all[$i]->name(),$all[$i]->name(), $all[$i]->content(), $all[$i]->class());
        }
        elseif($all[$i]->type()=='button'){
             $g->submit($all[$i]->content(), $all[$i]->name(), $all[$i]->class());

        }
    }
    }
    
   
?>
</form>
    <hr>
<?php 
//$g->span();
if($annonces != null){
    $g->span();
    for ($j=0; $j <count($annonces) ; $j++) { 
      if($j==4){
        $g->spanend();
        echo'<hr>';  
        $g->span();
    }
        $g->annoncebox($annonces[$j]);
   }
   $g->spanend();
}
   
 //  $g->spanend();
   echo '<hr>';
    $g->link("Présentation", $all[$i-1]->class(), $all[$i-1]->content());
?>