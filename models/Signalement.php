<?php
    require_once('Model.php');
    class Signalement extends Model{
        private $_annonce;
        private $_emetteur;
        private $_misencause;
        private $_description;

        public function __construct($data)
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

        public function setAnnonce($id)
        {
           
                $this->_annonce = $id;
            
        }

        public function setEmetteur($id)
        {
           
                $this->_emetteur = $id;
            
        }

        public function setMis_en_cause($id)
        {
           
                $this->_misencause = $id;
            
        }
        
        public function setDescription($desc)
        {
            if (is_string($desc))
            {
                $this->_description = $desc;
            }
        }

        public function annonce(){return $this->_annonce;}
        public function emetteur(){return $this->_emetteur;}
        public function mis_en_cause(){return $this->_misencause;}
        public function description(){return $this->_description ;}


        public function save(){
            
            try {
                $this->getConnection();
                $sql = "INSERT INTO signalement (annonce, emetteur, mis_en_cause, description)
                VALUES ('".$this->annonce()."', '".$this->emetteur()."', '".$this->mis_en_cause()."', '".$this->description()."')" ;
          
                $this->_connexion->exec($sql);
              //  echo "New record created successfully";
              } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
              }
        }

        public function recherche(){
            $sql = 'SELECT * FROM signalement WHERE annonce='.$this->annonce().' AND emetteur='.$this->emetteur().' AND mis_en_cause='.$this->mis_en_cause();
            $this->getConnection();
             $d = $this->request($sql);
             if($d != null){
                 return true;
             }else{
                 return false;
             }
        }
       
        public function rechercheemetteur(){
            $sql = 'SELECT * FROM signalement WHERE emetteur='.$this->emetteur();
            $this->getConnection();
             $d = $this->requestAll($sql);
             if($d != null){
                 return $d;
             }else{
                 return null;
             }
        }
       
    }
  //  $v = new Signalement(array("annonce"=>1,"emetteur"=>2,"mis_en_cause"=>1));
  //  echo $v->annonce();
  //  $v->save();

?>