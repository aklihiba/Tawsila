<?php
    require_once ("Model.php");

    class TypeAnnonce extends Model {

        public function __construct()
        {
            $this->getConnection();
            $table = $this->getAll("annonce_type","type");
            foreach($table as $row){
               $this->table[]=$row['type']; 
            }
        }
        public function all(){
            return $this->table;
        }

        public function vider(){
            $this->getConnection();
            $sql = "DELETE FROM annonce_type";
            $this->query($sql);
        }
        public function inserer($table){
            $this->getConnection();
            $sql="INSERT INTO annonce_type (type) VALUES ";
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