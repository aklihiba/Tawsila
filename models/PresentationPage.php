<?php
    require_once("Model.php");
    require_once('PageElements.php');

    class PresentationPage extends Model {
        public function __construct()
        {
            $this->getConnection();
            //get all elements except the list of les annonces
            $table = $this->getAll("presentation_page","id");
            foreach($table as $row){
                $this->table[] = new PageElements($row);
            }
           
        }
        public function getElements(){
            return $this->table;
        }

        public function test(){
            foreach ($this->table as $row){
                
                echo '<p>'.$row->content().'</p>';
            }
        }
        
    }
     $v = new PresentationPage();
     $v->test();
?>