<?php
require_once('Model.php');
require_once('UtilisateurManager.php');
require_once('AnnonceManager.php');
require_once('AnnonceTransporteur.php');

class Suggestions extends Model{
    public function __construct(string $id, string $type="annonce")
    {   
        //type : annonce or transporteur
        // pour savoir si on recupere la liste des postulations d'une annonce specifique
        //on toutes les postulations envoyer a un utilisateur
        $sql = "SELECT * FROM suggestion ";
        $this->getConnection();
        if($type=="annonce"){
            //recuperer from the db all the suggestions for this annonces
            $sql = $sql."WHERE anonnce=".$id;
        }
        elseif($type=="transporteur"){
            //recuperer all the suggestions for this transporteur
            $sql = $sql."WHERE transporteur=".$id;
        }
        else{
            //creating new suggestions for an annonce\
           
            $annonce = new AnnonceManager($id);
            $annonce = $annonce->getannonce();

            $depart = $annonce->wilaya_depart();
            $arrive = $annonce->wilaya_arrive();

            $m = new UtilisateurManager('none');
             $m->activetransporteur();
             $users = $m->all();

            
            foreach($users as $u){
                
                if(in_array($depart,$u->wilayas_depart()) && in_array($arrive,$u->wilayas_arrive())){
                    /*$suggestions[] = new AnnonceTransporteur( 
                        array(
                            'annonce'=>$annonce,
                            'transporteur'=>$u
                        )
                    );
                    */

                    $this->save($annonce->id(), $u->id());
                }
            }

        }

        $data = $this->requestAll($sql);
        foreach($data as $row){
            $this->table[] = new AnnonceTransporteur($row);
        }
    }

    public function save($annonce, $transporteur){
        $rqst = "INSERT INTO suggestion (annonce, transporteur) VALUES ('".$annonce."', '".$transporteur."')" ;
        $this->insert_getlastid($rqst);
        
    }
}

?>