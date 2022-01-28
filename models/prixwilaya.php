<?php
    class prixWilaya extends Model{

        public function __construct()
        {
            $this->getConnection();
            $rqst = "SELECT * FROM prix" ;
            $this->table = $this->requestAll($rqst);
        }

        public function all(){
            return $this->table;
        }
        
        public function updateprix($w1, $w2, $prix){
            $this->getConnection();
            $sql="UPDATE prix SET prix=".$prix." WHERE wilaya1='".$w1."' AND wilaya2='".$w2."'";
            $this->query($sql);
        }

    }

?>