<?php

    foreach($all as $e){
        $g->div();
        switch($e->type()){
            case 'h1':
                $g->titre(1,$e->content(),$e->class());
                break;
            case 'p':
                $g->paragraphe($e->content(),$e->class());
                break;
            case'img':
                $g->center();
                $g->imageh($e->content(),'30%');
                $g->centerend();
                break;
            case 'video':
                echo'
            <center>
            <iframe width="560" height="315" src="'.$e->content().'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </center>';
                break;
            default:
            echo'erreur';
        }
        $g->divend();
    }

?>