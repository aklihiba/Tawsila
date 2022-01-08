<?php
    require_once("Model.php");
    require_once("StatElements.php");
    require_once("AnnonceManager.php");
    require_once("UtilisateurManager.php");
    class StatistiquePage extends Model {

        public function __construct()
        {
            $this->getConnection();
            $data = $this->getAll("statistique_page","id");
            foreach($data as $row){
                if ($row['contentType']=='annonce') {
                    $manager = new AnnonceManager(); 
                    $this->table[] = $manager->rechercheByid($row['content']);
                }
                elseif($row['contentType']=='utilisateur') {
                    $manager = new UtilisateurManager(); 
                    $this->table[] = $manager->rechercheByid($row['content']);
                }
                else {
                     $this->table[] = new StatElements($row);
                }
               
            }
           
        }
        public function getElements(){
            return $this->table;
        }
        public function test(){
            foreach ($this->table as $row){
                echo '<p>'.$row->content().'</p>';
            }
        }
       
    }
  //  $v = new StatistiquePage();
  //  $v->test();
?>