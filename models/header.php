<?php
    require_once('Model.php');
    class Header extends Model{
        private $_logo;
        private $_buttons;
        private $_menu;
        private $_buttonsClass;
        private $_menuClass;

        public function __construct(string $type="anonyme")
        {
            $this->getConnection();
            $sql = "SELECT * FROM header WHERE type='".$type."'"; //type: anonyme, user, admin
            $data = $this->request($sql);
            
            if(!is_null($data)){
               
                $this->hydrate($data);
            }
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

        public function setLogo($logo){
            $this->_logo = $logo;
        }
        public function setButtons($buttons){
            $this->_buttons = explode(" ",$buttons);
        }
        public function setMenu($menu){
            $this->_menu = explode(" ",$menu);
        }
        public function setButtons_style($style){
            $this->_buttonsClass = $style;
        }
        public function setMenu_style($style){
            $this->_menuClass = $style;
        }

        public function logo(){return $this->_logo;}
        public function buttons(){return $this->_buttons;}
        public function menu(){return $this->_menu;}
        public function buttonsClass(){return $this->_buttonsClass;}
        public function menuClass(){return $this->_menuClass;}
    }
  
    
?>

