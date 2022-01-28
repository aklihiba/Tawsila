<?php 
    require_once('Model.php');
    require_once('NewsComponent.php');

    class NewsPage extends Model {

        public function __construct($newsId)
        {
            $newsId = (int) $newsId ;
            $this->getConnection();
            if ($newsId > 0) {
                $sql = "SELECT * FROM news_component WHERE new_id=".$newsId." ORDER BY id";
                $data = $this->requestAll($sql);
                if (!is_null($data)) {
                    foreach($data as $row){
                        $this->table[] = new NewsComponent($row);
                    }
                }
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
        public function update($id, $titre, $photo, $description){
            $this->getConnection();
            $sql = "UPDATE news SET titre='".$titre."', photo='".$photo."', description='".$description."' WHERE id=".$id;
            $this->query($sql);
        }
        public function updatecomponent($id, $type, $content, $class){
            $this->getConnection();
            $sql = " UPDATE news_component SET type='".$type."', content='".$content."', class='".$class."' WHERE id=".$id;
            $this->query($sql);
        }
    }
   //$v = new NewsPage(3);
   // $v->test();
?>