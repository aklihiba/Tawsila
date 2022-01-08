<?php
    require_once('Model.php');
    class Signalement extends Model{
        private $_annonce;
        private $_emetteur;
        private $_misencause;

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
            $id = (int) $id;
            if ($id > 0)
            {
                $this->_annonce = $id;
            }
        }

        public function setEmetteur($id)
        {
            $id = (int) $id;
            if ($id > 0)
            {
                $this->_emetteur = $id;
            }
        }

        public function setMis_en_cause($id)
        {
            $id = (int) $id;
            if ($id > 0)
            {
                $this->_misencause = $id;
            }
        }

        public function annonce(){return $this->_annonce;}
        public function emetteur(){return $this->_emetteur;}
        public function mis_en_cause(){return $this->_misencause;}
        
        public function save(){
            
            try {
                $this->getConnection();
                $sql = "INSERT INTO signalement (annonce, emetteur, mis_en_cause)
                VALUES ('".$this->annonce()."', '".$this->emetteur()."', '".$this->mis_en_cause()."')" ;
          
                $this->_connexion->exec($sql);
                echo "New record created successfully";
              } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
              }
        }
       
    }
  //  $v = new Signalement(array("annonce"=>1,"emetteur"=>2,"mis_en_cause"=>1));
  //  echo $v->annonce();
  //  $v->save();

?>