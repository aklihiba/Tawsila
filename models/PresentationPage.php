<?php
    require_once("Model.php");
    require_once('PageElements.php');

    class PresentationPage extends Model {
        public function __construct()
        {
            $this->getConnection();
            //get all elements except the list of les annonces
            $table = $this->getAll("presentation_page","id");
            foreach($table as $row){
                $this->table[] = new PageElements($row);
            }
           
        }
        public function all(){
            return $this->table;
        }

        public function test(){
            foreach ($this->table as $row){
                
                echo '<p>'.$row->content().'</p>';
            }
        }

        public  function update($id, $type, $content ){
          
              $this->getConnection();
              $sql = " UPDATE presentation_page SET type='".$type."', content='".$content."' WHERE id=".$id;
              $this->query($sql);
          }

        public function ajouter($id,$type, $content, $class){
            try {
                $this->getConnection();

                $sql = "INSERT INTO presentation_page (id, type, content, class)
                VALUES (".$id.",'".$type."', '".$content."', '".$class."')" ;
          
                $this->_connexion->exec($sql);
              //  echo "New record created successfully";
              } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
              }
        }  
        
    }
    // $v = new PresentationPage();
    // $v->test();
?>