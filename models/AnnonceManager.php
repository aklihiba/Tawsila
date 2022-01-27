<?php
    require_once("Annonce.php");
    require_once("Model.php");
    class AnnonceManager extends Model{

        public function __construct($id=0)
        {
            
            $this->getConnection();
            if ($id!=0) {
               $this->table[]= $this->rechercheByid($id);
            }
            else {
                $data = $this->getfilteredAnnonce();
                if ($data != 0) {
                    foreach($data as $row){
                        $this->table[] = new Annonce($row);
                    }
                }
               
            }
            
        }

        public function all(){return $this->table;}

        public function getannonce(){
            return $this->table[0];
            /*incase construct with id*/
        }
        public function getallannonces(){
            $this->table = null;
            $this->getConnection();
            $sql = "SELECT * FROM annonce" ; 
            $data = $this->requestAll($sql);
            if (!is_null($data)) {
                foreach($data as $row){
                    $this->table[] = new Annonce($row);
                }
                
            } 
            return $this->table;
        }
        public function getfilteredAnnonce(){
            
            //get the filters
            $rqst = "SELECT * FROM criteres_annonce WHERE used=true ORDER BY operation" ;
            $filters = $this->requestAll($rqst);
            
            //get les annonces
            $sql = "SELECT * FROM annonce ";
            $orderby = 0;
            $op = 0;
            foreach($filters as $filter){
               
                if($filter['operation']!="ORDER BY"){
                    // flitre sur les valeurs des colonnes
                    //exemple : ceux de la wilaya d'alger, avec un poids </> a 10,...
                    if($op==0){
                        $op++;
                        if(is_numeric($filter['valeur'])){
                            $sql = $sql." WHERE ".$filter['colonne'].$filter['operation'].$filter['valeur'];
                        }elseif(is_string($filter['valeur'])){
                            $sql = $sql." WHERE ".$filter['colonne'].$filter['operation']."'".$filter['valeur']."'";
                        }
                    }
                    else{
                        $sql = $sql." AND ".$filter['colonne'].$filter['operation']."'".$filter['valeur']."'";
                    }
                 
                    //ex: SELECT * FROM annonce WHERE poidsMax < 10 

                }
                
            }
            // recuperer que les annonces non archivees 
            if($op == 0){
                    $sql = $sql." WHERE archive=0 AND publier=1 ";
            }
            else{
                    $sql = $sql." AND archive=0 AND publier=1 ";
            }
               
            //filtre sur l'ordre
             //exemple : most vued annonces, plus lourd,...
            foreach($filters as $filter){
                 
                if($filter['operation']=="ORDER BY"){
                    //the first orderby filter
                    if($orderby == 0 ){
                        $orderby++;
                        $sql = $sql." ORDER BY  ".$filter['colonne']." ".$filter['valeur'];
                    }
                    else { // all the rest of the filters
                        $sql = $sql." AND ".$filter['colonne']." ".$filter['valeur'];
                    }
                   
                    //ex: SELECT * FROM annonce ORDER BY vues ASC AND poidMin DESC...
                }
            }

            // limit the enteries to 8
             $sql = $sql." LIMIT 8";

             
             //TODO : check if it's LIMIT 8 or SELECT TOP 8
    
             return $this->requestAll($sql);
        } 
        //recherche par id
        public function rechercheByid($id){
            
            $sql = "SELECT * FROM annonce WHERE id=".$id ; 
            $data = $this->request($sql);
            if (!is_null($data)) {
                return new Annonce($data);
            } 
            return null;
        }
            
        //recherche par arrive
        public function rechercheWilayaArrive(string $arrive){
            $this->table = null;
            $sql = "SELECT * FROM annonce WHERE wilaya_arrive='".$arrive."' AND archive=false AND publier=true " ; 
            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new Annonce($row);
            }
        }
        //recherche par depart
        public function rechercheWilayaDepart(string $depart){
            $this->table = null;
            $sql = "SELECT * FROM annonce WHERE wilaya_depart='".$depart."' AND archive=false AND publier=true " ; 
            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new Annonce($row);
            }
        }
        //recherche par depart et arrive
        public function rechercheWilaya(string $depart, string $arrive){
            $this->table = null;
            $sql = "SELECT * FROM annonce WHERE wilaya_depart='".$depart."' AND wilaya_arrive='".$arrive."' AND archive=false AND publier=true " ; 
            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new Annonce($row);
               
            }
            
        }
        public function rechercheClientNotArchived($client){
            $this->table = null;
            $sql = "SELECT * FROM annonce WHERE client=".$client." AND archive=false " ; 
            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new Annonce($row);
               
            }
        }
        public function rechercheClient($client){
            $this->table = null;
            $sql = "SELECT * FROM annonce WHERE client=".$client ; 
            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new Annonce($row);
               
            }
        }
        public function rechercheTransiteur($transiteur){
            $this->table = null;
            $sql = "SELECT * FROM annonce WHERE transiteur=".$transiteur ; 
            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new Annonce($row);
               
            }
        }
        public function rechercheTransiteurNotArchived($transiteur){
            $this->table = null;
            $sql = "SELECT * FROM annonce WHERE transiteur=".$transiteur." AND archive=false" ; 
            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new Annonce($row);
               
            }
        }
        public function test(){
            foreach ($this->table as $row){

                echo '<h1>'.$row->titre().'</h1>';
            }
        }

        //statistique
        public function nombreannonce(){
            $sql = "SELECT id FROM annonce" ; 
            $data = $this->requestAll($sql);
            if ($data != null) {

                return count($data);
            }   
            return 0; 
            }
        
            public function topannonce(){
                $sql = "SELECT id, max(vues) FROM annonce" ; 
                $data = $this->request($sql);
                if ($data != null) {
                    unset($data['max(id)']);
                    return $data['id'];
                }   
                return 0; 
            }
            
        
         
    }
// $v = new AnnonceMAnager();
// $a =$v->topannonce();
//echo $a->photo();

 
?>