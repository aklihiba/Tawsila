<?php
$g->center();
foreach($all as $e){
    $g->div();
    $g->titre(1, $e->title(), $e->titleClass());
    switch($e->contentType()){
        case 'text':
           
            $g->titre(2, $e->content(), $e->contentClass());
            break;
        case 'annonce':
          
            $g->annoncebox($topannonce);
            break;   
        case 'utilisateur':
            $g->userbox($topuser, "");
            break;     
    }
    $g->divend();

}
$g->centerend();
?>