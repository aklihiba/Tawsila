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
        public function vider(){
            $this->getConnection();
            $sql = "DELETE FROM fourchette_volume";
            $this->query($sql);
        }
        public function inserer($table){
            $this->getConnection();
            $sql="INSERT INTO fourchette_volume (volume) VALUES ";
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