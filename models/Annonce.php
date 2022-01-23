<?php
    require_once('Model.php');
    class Annonce extends Model
    {
        private $_id;
        private $_titre;
        private $_date;
        private $_photo;
        private $_wilaya_depart;
        private $_wilaya_arrive;
        private $_depart;
        private $_arrive;
        private $_transport; //voiture, moto, camion,...
        private $_type; //colis, meuble, electromenage, demenagement, lettre, courrier,...
        private $_poidsMax; 
        private $_poidsMin; 
        private $_volumeMax;
        private $_volumeMin;
        private $_description;
        private $_etat;// en attente, valide, transite...
        private $_note; // float valeur entre 0 et 5
        private $_prix; // float
        private $_client; // l'id vers le client qui a poster cette annonce
        private $_transiteur; // l'id du transiteur
        private $_postulations; // booleen vrai (!=0) s'il y a au moins une postulation, faux (=0) sinon
        private $_demandes;// same as postulation: booleen
        private $_vues;
        private $_archive;
        private $_publier; // false once saved and true till the administrator validates it

        public function __construct( $data)
        {
            $this->hydrate($data);

        }

        
        public function hydrate(array $data)
        {
            foreach($data as $key => $value)
            {
                //the setters for each attribut
                $method = 'set'.ucfirst($key);
                if (method_exists($this, $method))
                {
                    $this->$method($value);
                }
            }
        }
        
        public function restrict(){
            //pour le mode non connecter
                        
            unset($this->_etat);
           // unset($this->_note); 
            unset($this->_prix); 
            unset($this->_client); 
            unset($this->_transiteur);
            unset($this->_postulations); 
            unset($this->_demandes);
           // unset($this->_vues);
            unset($this->_archive);
            unset($this->_publier);
                    
        }

        public function save(){
            //nouvelle insertion lots de la creation 
           
            $sql = "INSERT INTO annonce (titre, photo, date, wilaya_depart,
                wilaya_arrive, transport, type, poidsMin, poidsMax, volumeMin,
                volumeMax, description, etat, prix, client) VALUES (
                    '".$this->titre()."', '".$this->photo()."', '".$this->date()."', '".$this->Wilaya_depart()."', 
                    '".$this->Wilaya_arrive()."', '".$this->transport()."', '".$this->type()."', '".$this->poidsMin()."', 
                    '".$this->poidsMax()."', '".$this->volumeMin()."', '".$this->volumeMax()."',  '".$this->description()."',
                    '".$this->etat()."', '".$this->prix()."', '".$this->client()."')" ;
           
            
            //$sql = "INSERT INTO annonce (titre, photo, date, wilaya_depart, wilaya_arrive, transport, type, poidsMin, poidsMax, volumeMin, volumeMax, description, etat, prix, client) VALUES ('livraison colis', 'petite_boite.jpg', '2022-01-12', 'Relizane', 'Mila', 'voiture, moto', 'colis', '0', '0.1', '0', '0.1',  'c`est une boite a bijoux qui doit etre livrer cette semaine, j`accepte de travailler avec des transporteurs non certifié. ', 'en attente de validation', '1200', '1')" ;
             return $this->insert_getlastid($sql); 
                   
        }
        public function update(){
            //modifying it
            $this->getConnection();

            $sql = " UPDATE annonce SET 
            titre='".$this->titre()."',
            photo='".$this->photo()."',
            wilaya_depart='".$this->Wilaya_depart()."',
            wilaya_arrive='".$this->Wilaya_arrive()."',
            transport='".$this->transport()."',
            type='".$this->type()."',
            poidsMin='".$this->poidsMin()."',
            poidsMax='".$this->poidsMax()."',
            volumeMin='".$this->volumeMin()."',
            volumeMax='".$this->volumeMax()."',
            description='".$this->description()."'
            WHERE id=".$this->id();

            $this->query($sql);
        }
        public function demander(){
           
            if(! $this->demandes()){
                 $this->setDemandes(true);
                $this->getConnection();
                $sql = " UPDATE annonce SET demandes=true WHERE id=".$this->id();
                $this->query($sql);
            }
        }
        public function annulerdemander(){
            
            if( $this->demandes()){
                $this->setDemandes(false);
                $this->getConnection();
                $sql = " UPDATE annonce SET demandes=false WHERE id=".$this->id();
                $this->query($sql);
            }
        }
        public function postuler(){
           
            if(! $this->postulations()){
                 $this->setPostulations(true);
                $this->getConnection();
                $sql = " UPDATE annonce SET postulations=true WHERE id=".$this->id();
                $this->query($sql);
            }
        }
        public function annulerpostuler(){
          
            if( $this->postulations()){
                  $this->setPostulations(false);
                $this->getConnection();
                $sql = " UPDATE annonce SET postulations=false WHERE id=".$this->id();
                $this->query($sql);
            }
        }
        public function archiver(){
            //archive it : when the admin annule or the client supprime
            $this->getConnection();
            $this->setArchive(true);
            $sql = " UPDATE annonce SET archive=true WHERE id=".$this->id();
            $this->query($sql);
        }
        public function annulerpublication(){
            $this->getConnection();
            $sql = " UPDATE annonce SET etat='annulée' WHERE id=".$this->id();
            $this->query($sql);
            $this->archiver();
        }
        public function publish(){
            //validation de l'administrateur
            $this->setPublier(true);
            $this->getConnection();
            $sql = " UPDATE annonce SET publier=true, etat='en attente de transiteur' WHERE id=".$this->id();
            $this->query($sql);
        }
        public function transiter($transiteur){
            $this->setTransiteur($transiteur);
            $this->getConnection();
            $sql = " UPDATE annonce SET transiteur=".$transiteur.", etat='transitée' WHERE id=".$this->id();
            $this->query($sql);
        }
        public function noter($note){
            $this->setNote($note);
            $this->getConnection();
            $sql = " UPDATE annonce SET note=".$note." WHERE id=".$this->id();
            $this->query($sql);
        }
        //setters
        public function setId($id)
        {
            $id = (int) $id;
            if ($id > 0)
            {
                $this->_id = $id;
            }
        }

        public function setTitre($titre)
        {
            if (is_string($titre))
            {
                $this->_titre = $titre;
            }
        }

        public function setPhoto($photo)
        {
            if(!is_null($photo))
            {
                if (is_string($photo))
                {
                    $this->_photo = $photo;
                }
            }
            
        }
        public function setDate($date)
        {
            if(!is_null($date))
            {
                if (is_string($date))
                {
                    $this->_date = $date;
                }
            }
            
        }
    

        public function setWilaya_depart($wilaya)
        {
           
               $this->_wilaya_depart = $wilaya;
           
        }

        public function setWilaya_arrive($wilaya)
        {
           
                $this->_wilaya_arrive = $wilaya;
           
        }

        public function setDepart($depart)
        {
            if (is_string($depart))
            {
                $this->_depart = $depart;
            }
        }

        public function setArrive($arrive)
        {
            if (is_string($arrive))
            {
                $this->_arrive = $arrive;
            }
        }

        public function setTransport($transp)
        {
            if (is_string($transp))
            {
                $this->_transport = $transp;
            }
        }

        public function setType($type)
        {
            if (is_string($type))
            {
                $this->_type = $type;
            }
        }

        public function setPoidsMax($poids)
        {
           $this->_poidsMax = (float) $poids ;
        }

        public function setPoidsMin($poids)
        {
           $this->_poidsMin = (float) $poids ;
        }

        public function setVolumeMax($volume)
        {
            $this->_volumeMax = (float)$volume ;
        }

        public function setVolumeMin($volume)
        {
            $this->_volumeMin = (float)$volume ;
        }

        public function setDescription($desc)
        {
            if (is_string($desc))
            {
                $this->_description = $desc;
            }
        }

        public function setEtat($etat)
        {
            if (is_string($etat))
            {
                $this->_etat = $etat;
            }
        }

        public function setNote($note)
        {
            if(!is_null($note))
            {
                $note = (float) $note;
                if ($note > 0)
                {
                    $this->_note = $note;
                } 
            }
            
        }

        public function setPrix($prix)
        {
            if(!is_null($prix))
            {
                $prix = (float) $prix;
                if ($prix > 0)
                {
                    $this->_prix = $prix;
                }
            }
        }

        public function setClient($client)
        {
            
                $this->_client = $client;
            
        }
        public function setTransiteur($trans)
        {
              if($trans != null){
                   $this->_transiteur = $trans;
              }else{
                  $this->_transiteur='-';
              }
                   
            
        }

        public function setPostulations($post)
        {
            if(!is_null($post))
            {
                $post = (int) $post;
                $this->_postulations = $post;
                
            }
        }

        public function setDemandes($dmd)
        {
            if(!is_null($dmd))
            {
                $dmd = (int) $dmd;
                $this->_demandes = $dmd;
               
            }
        }

        public function setVues($vues)
        {
            if(!is_null($vues))
            {
                $vues = (int) $vues;
                $this->_vues = $vues;
               
            }
        }

        public function incVues(){
            $this->getConnection();
            $this->setVues($this->vues() +1) ;
           $sql = " UPDATE annonce SET vues=".$this->vues()." WHERE id=".$this->id();
           $this->query($sql);
          
        }
        public function setArchive($archive){
            $this->_archive = (bool) $archive;
        }
        public function setPublier($publier){
            $this->_publier = (bool) $publier;
        }

        //getters
        public function id()
        {
            return $this->_id ;
        }
        public function titre()
        {
            return $this->_titre ;
        }
        public function photo()
        {
            return $this->_photo ;
        }
        public function date(){
            return $this->_date; 
        }
        public function Wilaya_depart()
        {
            return $this->_wilaya_depart ;
        }
        public function Wilaya_arrive()
        {
            return $this->_wilaya_arrive ;
        }
        public function depart()
        {
            return $this->_depart ;
        }
        public function arrive()
        {
            return $this->_arrive ;
        }
        public function transport()
        {
            return $this->_transport ;
        }
        public function type()
        {
            return $this->_type ;
        }
        public function poidsMax()
        {
            return $this->_poidsMax ;
        }
        public function volumeMin()
        {
            return $this->_volumeMin;
        }
        public function poidsMin()
        {
            return $this->_poidsMin ;
        }
        public function volumeMax()
        {
            return $this->_volumeMax;
        }
        public function description()
        {
            return $this->_description ;
        }
        public function etat()
        {
            return $this->_etat ;
        }
        public function note()
        {
            return $this->_note ;
        }
        public function prix()
        {
            return $this->_prix ;
        }
        public function client()
        {
            return $this->_client ;
        }
        public function transiteur()
        {
            return $this->_transiteur ;
        }
        public function postulations()
        {
            return $this->_postulations ;
        }
        public function demandes()
        {
            return $this->_demandes;
        }
        public function vues(){
            return $this->_vues;
        }
        public function archive(){
            return $this->_archive;
        }
        public function publier(){
            return $this->_publier;
        }

        public function calculPrix(){
            //cette fonction est provisoir le temps que j'utilise maps et je calcule la distance du trajet
            if($this->_wilaya_arrive == $this->_wilaya_depart){
                $this->setPrix(500);
            }else {
                $this->setPrix(1200);
            }
            
        }


    }

?>