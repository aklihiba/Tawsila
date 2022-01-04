<?php
class Fonts extends Model {
    
    public function __construct()
    {
        $this->getConnection();
        $sql = "SELECT * FROM fonts ORDER BY id" ;
        $query = $this->_connexion->prepare($sql);
        try{
            $query->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        while( $row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $this->table[$row["id"]]= $row["name"] ;
        }
        
    }

    public function font1(){
        return $this->table['1'] ;
    }

    public function font2(){
        return $this->table['2'] ;
    }

}

?>