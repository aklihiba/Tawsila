<?php
class PageElements {
    private $_id;
    private $_title;
    private $_titleClass;
    private $_content;
    private $_contentType;   
    private $_contentClass;

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

        public function setTitle($title)
        {
            if (is_string($title))
            {
                $this->_title = $title;
            }
        }

        public function setTitleClass($class)
        {
            if (is_string($class))
            {
                $this->_titleClass = $class;
            }
        }

        public function setContent($content)
        {
            if(is_string($content))
            {
                $this->_content = $content; 
            }
        }

        public function setContentType($type)
        {
            if(is_string($type))
            {
                $this->_contentType = $type; 
            }
        }

        public function setContentClass($class)
        {
            if(is_string($class))
            {
                $this->_contentClass = $class;
            }
        }

        public function id(){return $this->_id;}
        public function title(){return $this->_title;}
        public function titleClass(){return $this->_titleClass;}
        public function content(){return $this->_content;}
        public function contentType(){return $this->_contentType;}
        public function contentClass(){return $this->_contentClass;}
}

?>