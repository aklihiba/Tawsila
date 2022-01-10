<?php
require_once('Model.php');

class Footer extends Model {
    
    public function __construct()
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
        $this->table['menu'] = explode(' ', $this->table['menu']);
    }
    public function logo(){return $this->table['logo'];}
    public function class(){return $this->table['class'];}
    public function menu(){return $this->table['menu'];}
}
//$v = new Footer();
//echo $v->table['menu'][2];
?>