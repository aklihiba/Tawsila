<?php
require_once('Model.php');
class Couleurs extends Model {
    
    public function __construct()
    {
        $this->getConnection();
        $sql = "SELECT * FROM couleur ORDER BY id" ;
        $query = $this->_connexion->prepare($sql);
        try{
            $query->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        while( $row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $this->table[$row["type"]]= $row["code"] ;
        }
        
    }

    public function bgcolor()
    {
        return $this->table['background'];
    }

    public function primarycolor()
    {
        return $this->table['primary'];
    }

    public function secondarycolor()
    {
        return $this->table['secondary'];
    }

    public function bordercolor()
    {
        return $this->table['border'];
    }

}

?>