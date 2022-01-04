<?php
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
                $sql = $sql."WHERE anonnce = ".$id;
            }
            else{
                //transporteur
                $sql = $sql."WHERE transporteur = ".$id;
            }

            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new AnnonceTransporteur($row);
            }
        }
    }
?>