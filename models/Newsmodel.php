<?php
    class Newsmodel {
        private $_id;
        private $_titre;
        private $_photo ; 
        private $_description ; 
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

        public function id(){return $this->_id;}
        public function photo(){return $this->_photo;}
        public function titre(){return $this->_titre;}
        public function description(){return $this->_description;}
    }
?>