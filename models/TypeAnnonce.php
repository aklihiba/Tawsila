<?php
    require_once ("Model.php");

    class TypeAnnonce extends Model {

        public function __construct()
        {
            $this->getConnection();
            $table = $this->getAll("mannonce_type","type");
            foreach($table as $row){
               $this->table[]=$row['type']; 
            }
        }
        public function all(){
            return $this->table;
        }
    }
   
?>