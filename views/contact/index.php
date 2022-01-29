

<?php

    foreach($all as $e){
        $g->div();
        switch($e->type()){
            case 'h1':
                $g->center();
                $g->titre(1,$e->content(),$e->class());
                $g->centerend();
                break;
            case 'a':
                $g->center();
               echo '<a href="mailto: '.$e->content().'" class='.$e->class().'>envoyer un email</a>';
               $g->centerend(); 
               break;
            
            case 'admin':
                $g->divclass('admins_list');
                foreach($admins as $a){
                    $g->adminbox($a);
                }
                $g->divend();
                break;
            default:
            echo'erreur';
        }
        $g->divend();
    }

?>