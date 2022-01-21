
<form action="<?= PRE ?>/inscription/index" method='post'>

<?php
 foreach($all as $e){
    $g->div();
    switch( $e->type())
    {
        case 'h1' :
            $g->titre(1, $e->content(),$e->class());
            break;
        case 'dropdown' :
            $g->dropdowncheckbox($wilayas, $e->name(), $e->content(), $e->class());     
            break;
        case 'input' :
            $g->input($e->name(), $e->name(), $e->content(), $e->class());
            break;
            case 'mdpinput' :
                $g->password($e->name(), $e->name(), $e->content(), $e->class());
                break;    
        case 'select':
                $g->select($e->name(), $e->content(), $e->class());
            break;
        case 'button':
            $g->paragraphe($erreur, 'erreur');
            $g->submit($e->content(), $e->name(), $e->class());  
            break;
        default:
            echo 'element pas reconu';    
    }
    $g->divend();

}


?>

</form>