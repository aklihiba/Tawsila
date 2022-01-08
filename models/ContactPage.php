<?php
    require_once("PageElements.php");
    require_once("Administrateur.php");
    require_once('Model.php');
    class ContactPage extends Model{
        
        public function __construct()
        {
            $this->getConnection();
            $table = $this->getAll("contact_page","id");
            foreach($table as $row){
                if($row['type']!="admin"){
                    $this->table[] = new PageElements($row);
                }
                else{
                    $this->table[] = new Administrateur($row);
                }
                
            }
        }
    }

?>