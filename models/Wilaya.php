<?php
    require_once ("Model.php");

    class Wilaya extends Model {

        public function __construct()
        {
            $this->getConnection();
            $table = $this->getAll("wilaya","Code");
            foreach($table as $row){
               $this->table[]=$row['Nom']; 
            }
        }
        public function all(){
            return $this->table;
        }
    }
   
?>