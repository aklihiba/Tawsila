<script>
    $(document).ready(function(){
            $(".admins_list").css('display','flex');
            $(".admins_list").css('justify-content','space-around');
            $(".adminbox>*").css('display','inline-block');
            $(".adminbox>*").css('margin', '0.1%');
           $(".adminbox").css('padding','1%');
           $(".adminbox").css('border','1px solid <?= $couleur->bordercolor()?>');
        });    
</script>

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
               echo '<a href="mailto:ih_akli@esi.com" class='.$e->class().'>'.$e->content().'</a>';
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