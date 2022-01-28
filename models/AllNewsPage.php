<?php
    require_once('Model.php');
    require_once('Newsmodel.php');

    class AllNewsPage extends Model {

        public function __construct($id=0)
        {
            if($id==0){
                $this->getConnection();
                //get all elements except the list of les annonces
                $table = $this->getAll("news","id");
                foreach($table as $row){
                    $this->table[$row['id']] = new Newsmodel($row);
                }
            }else{
                $this->getConnection();
                $sql = "SELECT * FROM news WHERE id=".$id ; 
                $data = $this->request($sql);
                if (!is_null($data)) {
                    $this->table[]= new Newsmodel($data);
                } 
            }
           
        }
        public function all(){
            return $this->table;
        }
        public function getnews(){
            return $this->table[0];
        }
        public function test(){
            foreach ($this->table as $row){

                echo '<h1>'.$row->titre().'</h1>';
            }
        }
        public function delete($id){
            $sql = "DELETE FROM news WHERE id=".$id;
            $this->query($sql);
            $sql = "DELETE FROM news_component WHERE new_id=".$id;
            $this->query($sql);
        }
    }

    //$v = new AllNewsPage();
    //$v->test();

?>