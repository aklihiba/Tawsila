<?php
    require_once("Model.php");
    require_once('AnnonceTransporteur.php');
   
    class Postulations extends Model{

        public function __construct(string $id, string $type="annonce")
        {   
            //type : annonce or transporteur
            // pour savoir si on recupere la liste des postulations d'une annonce specifique
            //on toutes les postulations envoyer a un utilisateur
            $sql = "SELECT * FROM postulations ";
            $this->getConnection();
            if($type=="annonce"){
                $sql = $sql."WHERE anonnce=".$id;
            }
            elseif($type=='transporteur'){
                //transporteur
                $sql = $sql."WHERE transporteur=".$id;
            }
            else{
                //creating new postulation
                $this->save($id, (int)$type);
            }

            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new AnnonceTransporteur($row);
            }
        }

        public function save($annonce, $transporteur){
            $rqst = "INSERT INTO postulations (annonce, transporteur) VALUES (".$annonce.", ".$transporteur.")" ;
            $this->request($rqst);
            
        }
    }
?>