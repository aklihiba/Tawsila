<?php
    require_once("Administrateur.php");

    class AdministrateurManager extends Model{
        
        public function __construct()
        {
            $this->getConnection();
            //get all administrateurs
            $table = $this->getAll("administrateur","id");
            foreach($table as $row){
                $this->table[] = new Administrateur($row);
            }
        }
        
        public function getAdmins(){
            return $this->table;
        }
    }
?>