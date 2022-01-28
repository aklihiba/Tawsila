<?php 
    class NewsComponent extends Model{
        private $_id;
    private $_type;
    private $_content;
    private $_class;
    private $_newid;

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

        public function setType($type)
        {
            if (is_string($type))
            {
                $this->_type = $type;
            }
        }

        public function setContent($content)
        {
            if(is_string($content))
            {
                $this->_content = $content; 
            }
        }

        public function setClass($class)
        {
            if(is_string($class))
            {
                $this->_class = $class;
            }
        }
        public function setNew_id($id){
            $this->_newid= $id;
        }
        public function id(){return $this->_id;}
        public function content(){return $this->_content;}
        public function type(){return $this->_type;}
        public function class(){return $this->_class;}
        public function news_id(){return $this->_newid;}

        public function save(){
            $this->getConnection();
            $sql = "INSERT INTO news_component (type, content, class, new_id) VALUES (
                    '".$this->type()."', '".$this->content()."', '".$this->class()."', ".$this->news_id().")" ;
        
            $this->query($sql);        
        }
    }

?>