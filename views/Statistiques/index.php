<?php
$g->divclass('container');
$g->divclass('row');
foreach($all as $e){
    
  
    switch($e->contentType()){
        case 'text':
            $g->divclass('col-lg');
            $g->center();
            $g->titre(1, $e->content(), $e->contentClass());
            $g->titre(2, $e->title(), $e->titleClass());
            $g->centerend();
            break;
        case 'annonce':
            $g->divend();
            $g->divend();
            $g->divclass('container');
            $g->divclass('row');
            $g->divclass('col-lg');
            $g->center();
            $g->titre(1, $e->title(), $e->titleClass());
            $g->annoncebox($topannonce);
            $g->centerend();
            break;   
        case 'utilisateur':
            $g->divclass('col-lg');
            $g->center();
            $g->titre(1, $e->title(), $e->titleClass());
            $g->userbox($topuser, "");
            $g->centerend();
            break;     
    }
    $g->divend();

}
$g->divend();$g->divend();
?>