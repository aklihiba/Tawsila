<?php
    class Newsmodel extends Model{
        private $_id;
        private $_titre;
        private $_photo ; 
        private $_description ; 
        private $_date;
        private $_vues;
        public function __construct(array $data)
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
            if(is_string($photo))
            {
                $this->_photo = $photo; 
            }
        }

        public function setDescription($description)
        {
            if(is_string($description))
            {
                $this->_description = $description;
            }
        }
        public function setDate($d){
            $this->_date = $d;
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
           $sql = " UPDATE news SET vues=".$this->vues()." WHERE id=".$this->id();
           $this->query($sql);
          
        }

        public function id(){return $this->_id;}
        public function photo(){return $this->_photo;}
        public function titre(){return $this->_titre;}
        public function description(){return $this->_description;}
        public function date(){return $this->_date;}
        public function vues(){
            return $this->_vues;
        }

        public function save(){
            $this->getConnection();
            $sql = "INSERT INTO news (titre, photo, description, date, vues) VALUES (
                    '".$this->titre()."', '".$this->photo()."', '".$this->description()."', '".$this->date()."', ".$this->vues().")" ;
        
             return $this->insert_getlastid($sql);        
        }
    }
?>