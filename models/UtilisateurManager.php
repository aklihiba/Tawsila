<?php
    require_once('Model.php');
    require_once('Utilisateur.php');
class UtilisateurManager extends Model{
    
    public function __construct($id=0)
    {
        $this->getConnection();
        if ($id!=0) {
            $this->table[]= $this->rechercheByid($id);
        }
        elseif($id=='none'){
            $this->table = null;
        } else{
            $data = $this->getAll('utilisateur','id');
            if ($data != 0) {
                foreach($data as $row){
                    $this->table[] = new Utilisateur($row);
                }
            }
        }
    }
    public function all(){return $this->table;}
    public function getuser(){
        return $this->table[0];
        /*incase construct with id*/
    }
    public function rechercheByid($id){
        $sql = "SELECT * FROM utilisateur WHERE id=".$id ; 
        $data = $this->request($sql);
        if (!is_null($data)) {
            return new Utilisateur($data);
        } 
        return null;    
    }

    public function test(){
        foreach ($this->table as $row){

            echo '<h1>'.$row->nom().'</h1>';
        }
    }
    public function connect($mail, $pwd){
        $sql = "SELECT * FROM utilisateur WHERE mail='".$mail."' AND pwd='".$pwd."'" ; 
        $data = $this->request($sql);
        if ($data != null) {

            return new Utilisateur($data);
        } 
        
        return null; 
    }
}
//$v = new UtilisateurManager();
//$v->test();
?>