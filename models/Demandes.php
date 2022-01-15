<?php
    require_once('Model.php');

    require_once('AnnonceTransporteur.php');
    class Demandes extends Model{

        public function __construct(string $id, string $type="annonce")
        {   
            //type : annonce or transporteur
            // pour savoir si on recupere la liste des demandes d'une annonce specifique
            //on toutes les demandes envoyer a un utilisateur
            $sql = "SELECT * FROM demandes ";
            $this->getConnection();
            if($type=="annonce"){
                $sql = $sql."WHERE annonce=".$id;
            }
            elseif($type=="transporteur"){
                //transporteur
                $sql = $sql."WHERE transporteur=".$id;
            }
            else{
                 //creating new demande
                 //id= annonce, type= transporteur
                 $this->save($id, (int)$type);
            }

            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new AnnonceTransporteur($row);
            }
        }

        public function all(){
            return $this->table;
        }
        public function save($annonce, $transporteur){
            $rqst = "INSERT INTO demandes (annonce, transporteur) VALUES (".$annonce.", ".$transporteur.")" ;
            $this->query($rqst);
            
        }
        public function annuler($annonce, $transporteur){
            $rqst = "DELETE FROM demandes WHERE annonce=".$annonce." AND transporteur=".$transporteur ;
            $this->exec($rqst);
        }
    }
?>