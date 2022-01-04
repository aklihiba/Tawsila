<?php
    class FormElements extends PageElements
    {
        private $_name;

        public function __construct(array $data)
        {
            parent::__construct($data);
            $this->_name = $data['name'];

        }
        
        public function name(){
            return $this->_name;
        }

    }

   
?>