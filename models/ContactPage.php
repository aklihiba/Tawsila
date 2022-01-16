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
                  $this->table[] = new PageElements($row);
                /*
                if($row['type']!="admin"){
                }
                else{
                    $this->table[] = new Administrateur($row);
                }
                */
                
            }
        }
        public function all(){
            return $this->table;
        }
    }

?>