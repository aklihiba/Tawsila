<?php
    require_once('AnnonceTransporteur.php');
    require_once("Model.php");
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
            else{
                //transporteur
                $sql = $sql."WHERE transporteur=".$id;
            }

            $data = $this->requestAll($sql);
            foreach($data as $row){
                $this->table[] = new AnnonceTransporteur($row);
            }
        }
    }
?>