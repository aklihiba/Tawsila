<script>
   
    $(document).ready(function(){
        $(".dropdown, [name='certification'], [for='certification']").hide();
        
        $("[name='transporteur']").change(
            function(){
                $(".dropdown, [name='certification'], [for='certification']").toggle();
            }
        );
    });
</script>
<form action="<?= PRE ?>/inscription/index" method='post'>

<?php
$g->divclass('container');
$g->divclass('row');
 foreach($all as $e){
   
    switch( $e->type())
    {
        case 'h1' :
            $g->divclass('col');
            $g->titre(1, $e->content(),$e->class());
            $g->divend();$g->divend();$g->divend();
            $g->divclass('container');
            $g->divclass('row');
            break;
        case 'dropdown' :
            $g->divclass('col');
            $g->dropdowncheckbox($wilayas, $e->name(), $e->content(), $e->class()); 
            $g->divend();    
            break;
        case 'input' :
            $g->divclass('col');
            $g->input($e->name(), $e->name(), $e->content(), $e->class());
            $g->divend();
            break;
            case 'mdpinput' :
                $g->divclass('col');
                $g->password($e->name(), $e->name(), $e->content(), $e->class());
                $g->divend();
                break;    
        case 'select':
            $g->divclass('col');
                  $g->divend();$g->divend();$g->divend();
                $g->divclass('container');
                $g->divclass('row');    
                $g->divclass('col');
            
                $g->select($e->name(), $e->content(), $e->class());
                $g->divend();$g->divend();$g->divend();
                $g->divclass('container');
                $g->divclass('row');
            break;
        case 'button':
            $g->divclass('col');
            $g->paragraphe($erreur, 'erreur');
            $g->submit($e->content(), $e->name(), $e->class());  
            $g->divend();
            break;
        default:
            echo 'element pas reconu';    
    }
   

}
$g->divend(); $g->divend();

?>

</form>