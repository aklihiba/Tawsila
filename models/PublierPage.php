<?php
     require_once("FormElements.php");
     require_once("Model.php");
     class PublierPage extends Model{
         
         public function __construct()
         {
             $this->getConnection();
             //get all elements except the list of les annonces
             $table = $this->getAll("publier_page","id");
             foreach($table as $row){
                 $this->table[$row['id']] = new FormElements($row);
             }
            
         }
         public function getElements(){
             return $this->table;
         }
         public function test(){
             foreach ($this->table as $row){
 
                 echo '<h1>'.$row->content().'</h1>';
             }
         }
        
        
     }

?>