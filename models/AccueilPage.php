<?php
    require_once("FormElements.php");
    require_once("Utilisateur.php");
    require_once("Model.php");
    class AccueilPage extends Model{
        public function __construct()
        {
            $this->getConnection();
            //get all elements except the list of les annonces
            $table = $this->getAll("accueil_page","id");
            foreach($table as $row){
                $this->table[] = new FormElements($row);
            }
           
        }
        public function getElements(){
            return $this->table;
        }
        public function test(){
            foreach ($this->table as $row){

                echo '<h1>'.$row->content().'</h1>';
            }
        }
        //login function
        public function login(string $mail, string $hashpass)
        {
            $this->getConnection();
            $sql = "SELECT * FROM utilisateur WHERE mail=".$mail." AND pwd=".$hashpass;
            $result = $this->request($sql);
            if(! is_null($result)){
                $user = new Utilisateur($result);
                return $user;
            }else return null;

        } 
       
    }
// $v = new AccueilPage();
// $v->test();
?>