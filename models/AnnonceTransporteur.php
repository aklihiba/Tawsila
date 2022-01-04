<?php

require_once("AnnonceManager.php");
require_once("UtilisateurManager.php");

class AnnonceTransporteur{
    private $_annonce;
    private $_transporteur;

    public function __construct(array $data)
    {
      

        foreach($data as $key => $value){
            if($key=="annonce"){
                $manager = new AnnonceMAnager();
                $this->_annonce = $manager->rechercheByid($value);
            }
            if ($key=="transporteur") {
                $manager = new UtilisateurManager();
                $this->_transporteur = $manager->rechercheByid($value);
            }
      }

    }

   

   public function annonce(){
       return $this->_annonce;
   }
   public function transporteur(){
       return $this->_transporteur ;
   }

}

?>