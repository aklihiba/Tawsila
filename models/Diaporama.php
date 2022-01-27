<?php
require_once('Model.php');

require_once('Image.php');

class Diaporama extends Model
{
    public function __construct()
    {
       
        $this->getConnection();
        $sql = "SELECT * FROM diaporama ORDER BY id" ;
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

    public function add($image, $link){
        try {
            $this->getConnection();

            $sql = "INSERT INTO diaporama (image, link)
            VALUES ('".$image."', '".$link."')" ;
      
            $this->_connexion->exec($sql);
          //  echo "New record created successfully";
          } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
          }
    }
    public function delete($id){

        $this->getConnection();
        $sql=" DELETE FROM diaporama WHERE id=".$id;
        $this->query($sql);

    }
}
?>