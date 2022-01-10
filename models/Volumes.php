<?php
    require_once ("Model.php");

    class Volumes extends Model {

        public function __construct()
        {
            $this->getConnection();
            $table = $this->getAll("fourchette_volume","volume");
            foreach($table as $row){
               $this->table[]=$row['volume']; 
            }
        }
        public function all(){
            return $this->table;
        }
    }
   
?>