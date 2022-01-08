<?php
    require_once('Model.php');
    require_once('News.php');

    class AllNewsPage extends Model {

        public function __construct()
        {
            $this->getConnection();
            //get all elements except the list of les annonces
            $table = $this->getAll("news","id");
            foreach($table as $row){
                $this->table[$row['id']] = new news($row);
            }
           
        }
        public function getElements(){
            return $this->table;
        }
        public function test(){
            foreach ($this->table as $row){

                echo '<h1>'.$row->titre().'</h1>';
            }
        }
    }

    //$v = new AllNewsPage();
    //$v->test();

?>