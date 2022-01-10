<?php
    require_once ("Model.php");

    class Poids extends Model {

        public function __construct()
        {
            $this->getConnection();
            $table = $this->getAll("fourchette_poids","poids");
            foreach($table as $row){
               $this->table[]=$row['poids']; 
            }
        }
        public function all(){
            return $this->table;
        }
    }
   
?>