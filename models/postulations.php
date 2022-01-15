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
                $sql = $sql."WHERE annonce=".$id;
            }
            elseif($type=='transporteur'){
                //transporteur
                $sql = $sql."WHERE transporteur=".$id;
            }
            else{
                //creating new postulation
                //id=annonce type=transporteur
                $this->save($id, (int)$type);
            }

            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new AnnonceTransporteur($row);
            }
        }
        public function all(){
            return $this->table ;
        }
        public function save($annonce, $transporteur){
            $rqst = "INSERT INTO postulations (annonce, transporteur) VALUES (".$annonce.", ".$transporteur.")" ;
            $this->query($rqst);
            
        }
        public function annuler($annonce, $transporteur){
            $rqst = "DELETE FROM postulations WHERE annonce=".$annonce." AND transporteur=".$transporteur ;
            $this->exec($rqst);
        }
    }
?>