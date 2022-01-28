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
        public function vider(){
            $this->getConnection();
            $sql = "DELETE FROM fourchette_poids";
            $this->query($sql);
        }
        public function inserer($table){
            $this->getConnection();
            $sql="INSERT INTO fourchette_poids (poids) VALUES ";
            for ($i=0; $i < count($table); $i++) { 
                if($i==0){
                    $sql = $sql."('".$table[$i]."')";
                }else
                $sql = $sql.", ('".$table[$i]."')";
            }
            $this->query($sql);
           
        }
    }
   
?>