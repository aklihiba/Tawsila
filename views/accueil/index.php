
<form action="<?= PRE ?>/accueil" method="post">
<?php
    $g->divclass('container');
    $g->divclass('row');
    $g->divclass('col');
    $g->divend();
    $g->divclass('col-10');
    $g->divclass('float-right');
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
    $g->divend();
    $g->divend();
    $g->divend();
   $g->divend();
?>
</form>

    <hr>
<?php 
//$g->span();
if($annonces != null){
    $g->divclass('container');
    $g->divclass('row');
    for ($j=0; $j <count($annonces) ; $j++) { 
      if($j==4){
        $g->divend();
        echo'<hr>';  
        $g->divclass('row');
    }
        $g->divclass('col-sm');
        $g->annoncebox($annonces[$j]);
        $g->divend();
   }
   $g->divend();
   $g->divend();
}
   
 //  $g->spanend();
   echo '<hr>';
   $g->center();
   $g->divclass('commentfct');
    $g->link( $all[$i-1]->name(), $all[$i-1]->class(), $all[$i-1]->content());
    $g->divend();
    $g->centerend();
 
?>