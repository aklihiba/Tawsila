<?php
    class critereAnnonce extends Model{

        public function __construct()
        {
            $this->getConnection();
            $rqst = "SELECT * FROM criteres_annonce ORDER BY id" ;
            $this->table = $this->requestAll($rqst);
        }

        public function all(){
            return $this->table;
        }
        public function add($col, $val, $operator){
            $this->getConnection();
            $sql = "INSERT INTO criteres_annonce (colonne, valeur, operation, used) VALUES 
                    ('".$col."', '".$val."', '".$operator."', true)" ;
            $this->query($sql);        
        }
        public function delete($id){
            $this->getConnection();
            $sql=" DELETE FROM criteres_annonce WHERE id=".$id;
            $this->query($sql);
        }

        public function unset($id){
            $this->getConnection();
            $sql="UPDATE criteres_annonce SET used=false WHERE id=".$id;
            $this->query($sql);
        }

        public function set($id){
            $this->getConnection();
            $sql="UPDATE criteres_annonce SET used=true WHERE id=".$id;
            $this->query($sql);
        }
    }

?>