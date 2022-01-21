<?php

    class Admin extends ControllerAdmin{

        public function __construct()
        {
            //$this->loadModel('')
        }

        public function index(){
            $this->render('index');
        }
    
    }

?>