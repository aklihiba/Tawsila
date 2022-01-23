<?php
    require_once('models/Signalement.php');
    class SignalementManager extends Model{
        public function __construct($a=0,$e=0,$m=0)
        {
            $this->getConnection();
            if($a!=0){
                $this->rechercheById($a,$e,$m);
            }else{
                 $table = $this->getAll("signalement","annonce");
            foreach($table as $row){
                $this->table[] = new Signalement($row);
            }
            }
           
           
        }
        public function all(){
            return $this->table;
        }
        public function rechercheById($a, $e, $m){
            $sql = 'SELECT * FROM signalement WHERE annonce='.$a.' AND emetteur='.$e.' AND mis_en_cause='.$m;
            $this->getConnection();
             $d = $this->request($sql);
             $this->table[] = new Signalement($d);
        }

        public function getSignalement(){
            return $this->table[0];
        }
    }

?>