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
        public function vider(){
            $this->getConnection();
            $sql = "DELETE FROM moyen_transport";
            $this->query($sql);
        }
        public function inserer($table){
            $this->getConnection();
            $sql="INSERT INTO moyen_transport (moyen) VALUES ";
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