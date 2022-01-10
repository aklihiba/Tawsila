<?php
    require_once ("Model.php");

    class Transport extends Model {

        public function __construct()
        {
            $this->getConnection();
            $table = $this->getAll("moyen_transport","moyen");
            foreach($table as $row){
               $this->table[]=$row['moyen']; 
            }
        }
        public function all(){
            return $this->table;
        }
    }
   
?>