
<form action="<?= PRE ?>/accueil/publier" method="post">

<?php
$g->center();
    foreach($all as $e){
    $g->divclass('publier');    
        switch( $e->type())
        {
            case 'h1' :
              
                echo '<h1 class="'.$e->class().'">'.$e->content().'</h1>';
               
                break;
            case 'dropdown' :
               
                switch ($e->name()){
                    case 'transport':
                       
                      
                        $g->dropdowncheckbox($transports,$e->name(), $e->content(),$e->class());
                      
                        break;  
                    case 'type':
                       
                       
                        $g->dropdownradio($type,$e->name(), $e->content(),$e->class());
                       
                        break;
                    case 'volume':
                        
                        $g->fourchette($volumes,$e->name(), $e->content(),$e->class());
                     
                        break;  
                    case 'poids':
                       
                        $g->fourchette($poids,$e->name(), $e->content(),$e->class());
                       
                        break;
                    default:
                   
                        $g->dropdownradio($wilayas,$e->name(), $e->content(),$e->class());  
                      
                    }
                                  
            break;
            case 'p' :
               
                echo '<p class="'.$e->class().'">'.$e->content().'</p>';
               
                break; 
            case 'input' :
               
                $g->input($e->name(), $e->name(), $e->content(), $e->class());
                 
                break;
                case 'biginput' :
                $g->biginput($e->name(), $e->name(), $e->content(), $e->class());
                break;    
            case 'fileselect':
                $g->fileselect( $e->name(), $e->content(), $e->class());
                
                break;
            case 'button':
                $g->submit($e->content(), $e->name(), $e->class());  
                break;
            default:
                echo 'element pas reconu';    
        }
       
        $g->divend();
    }
   

$g->centerend();
?>

</form>