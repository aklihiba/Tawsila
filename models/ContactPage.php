<?php
    require_once("PageElements.php");
    require_once("Administrateur.php");
    require_once('Model.php');
    class ContactPage extends Model{
        
        public function __construct()
        {
            $this->getConnection();
            $table = $this->getAll("contact_page","id");
            foreach($table as $row){
                  $this->table[] = new PageElements($row);
                /*
                if($row['type']!="admin"){
                }
                else{
                    $this->table[] = new Administrateur($row);
                }
                */
                
            }
        }
        public function all(){
            return $this->table;
        }

        public  function update($id, $type, $content ){
          
            $this->getConnection();
            $sql = " UPDATE contact_page SET type='".$type."', content='".$content."' WHERE id=".$id;
            $this->query($sql);
        }

        public function ajouter($type, $content, $class){
            try {
                $this->getConnection();

                $sql = "INSERT INTO contact_page (type, content, class)
                VALUES ('".$type."', '".$content."', '".$class."')" ;
          
                $this->_connexion->exec($sql);
              //  echo "New record created successfully";
              } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
              }
        }  
    }

?>