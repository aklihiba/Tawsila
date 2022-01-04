<?php
class Footer extends Model {
    
    public function __construct(array $data)
    {
        $this->getConnection();
        $sql = "SELECT * FROM footer" ;
        $query = $this->_connexion->prepare($sql);
        try{
            $query->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->table = $query->fetch(PDO::FETCH_ASSOC); // logo, menu, class
    }

}

?>