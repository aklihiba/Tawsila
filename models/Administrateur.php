<?php
class Administrateur{
    private $_id;
    private $_nom;
    private $_prenom;
    private $_age;

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

        public function setNom($nom)
        {
            if (is_string($nom))
            {
                $this->_nom = $nom;
            }
        }

        public function setPrenom($prenom)
        {
            if(is_string($prenom))
            {
                $this->_prenom = $prenom; 
            }
        }

        public function setAge($age)
        {
            $age = (int) $age;
            if ($age > 0)
            {
                $this->_age = $age;
            }
        }
        
        public function id(){return $this->_id;}
        public function prenom(){return $this->_prenom;}
        public function nom(){return $this->_nom;}
        public function age(){return $this->_age;}
}

?>
