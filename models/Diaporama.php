<?php
require_once('Model.php');

require_once('Image.php');

class Diaporama extends Model
{
    public function __construct()
    {
       
        $this->getConnection();
        $sql = "SELECT * FROM diaporama" ;
        $query = $this->_connexion->prepare($sql);
        try{
            $query->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        while( $row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $this->table[] = new Image($row);
        }        
    }
    public function getImages(){
        return $this->table ;
    }
}
?>