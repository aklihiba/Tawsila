<?php
    require_once("Model.php");
    require_once("StatElements.php");
    require_once("AnnonceManager.php");
    require_once("UtilisateurManager.php");
    class StatistiquePage extends Model {

        public function __construct()
        {
            $a = new AnnonceManager();
            $u = new UtilisateurManager();
            $this->getConnection();
            $data = $this->getAll("statistique_page","id");
            
            foreach($data as $row){
            
                $this->table[] = new StatElements($row);
                
            }

            for ($i=0; $i < count($this->table); $i++) { 
               
                switch($this->table[$i]->title()){
                    case 'clients':
                        $this->table[$i]->setContent($u->nombreclient());
                       
                        break;
                    case 'transporteurs':
                        $this->table[$i]->setContent($u->nombretransporteur()) ;
                        break;
                    case "annonces":
                        $this->table[$i]->setContent( $a->nombreannonce());
                        break;
                    case 'Top annonce':
                        $this->table[$i]->setContent($a->topannonce()) ;
                        break;
                    case 'Top transporteur':
                     //   $this->table[$i]->setContent($u->toptransporteur()) ;      
                        break;       
                }
            }
           
        }
        public function all(){
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