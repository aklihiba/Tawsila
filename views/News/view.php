<?php

    foreach($all as $e){
        $g->div();
        switch($e->type()){
            case 'h1':
                $g->titre(1,$e->content(),$e->class());
                break;
            case 'h2':
                $g->titre(2,$e->content(),$e->class());
                break;    
            case 'p':
                $g->paragraphe($e->content(),$e->class());
                break;
            case'img':
                $g->center();
                $g->imageh($e->content(),'30%');
                $g->centerend();
                break;
            
           
        }
        $g->divend();

    }
    $g->paragraphe('nombre de vues: '.$nbvues,'paragraphe');

?>