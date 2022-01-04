<?php
    require_once("Annonce.php");

    class AnnonceMAnager extends Model{

        public function __construct()
        {
            $this->getConnection();
            $data = $this->getfilteredAnnonce();
            foreach($data as $row){
                $this->table[] = new Annonce($row);
            }
        }

        public function annonces(){return $this->table;}

        public function getfilteredAnnonce(){
            
            //get the filters
            $rqst = "SELECT * FROM criteres_annonce WHERE used = true ORDER BY operation" ;
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
                        $sql = $sql." WHERE ".$filter['colonne']." ".$filter['operation']." ".$filter['valeur'];
                    }
                    else{
                        $sql = $sql." AND ".$filter['colonne']." ".$filter['operation']." ".$filter['valeur'];
                    }
                 
                    //ex: SELECT * FROM annonce WHERE poidsMax < 10 

                }
                
            }
            // recuperer que les annonces non archivees 
            if($op == 0){
                    $sql = $sql." WHERE archive = false ";
            }
            else{
                    $sql = $sql." AND archive = false ";
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
            
            $sql = "SELECT * FROM annonce WHERE $id ".$id." AND archive = false " ; 
            $data = $this->request($sql);
            return new Annonce($data);
        }
        //recherche par arrive
        public function rechercheWilayaArrive(string $arrive){
            
            $sql = "SELECT * FROM annonce WHERE wilaya_arrive = ".$arrive." AND archive = false " ; 
            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new Annonce($row);
            }
        }
        //recherche par depart
        public function rechercheWilayaDepart(string $depart){
            
            $sql = "SELECT * FROM annonce WHERE wilaya_depart = ".$depart." AND archive = false " ; 
            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new Annonce($row);
            }
        }
        //recherche par depart et arrive
        public function rechercheWilaya(string $depart, string $arrive){
            $sql = "SELECT * FROM annonce WHERE wilaya_depart = ".$depart." AND wilaya_arrive = ".$arrive." AND archive = false " ; 
            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new Annonce($row);
            }
        }
        // modifier annonce 
        //supprimer aka archiver
        //insertion d'un annonce

    }

?>