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
        public function All(){
            return $this->table;
        }
    }
    //$v = new Wilaya();
    //echo $v->table[7];
?>