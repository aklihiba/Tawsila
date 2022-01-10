<?php
    class ViewGenerator {
        private $c ;
        public function __construct($colors)
        {
            $this->c = $colors;
        }
        public function div(){
            echo '<div>';
        }
        public function divend(){
            echo '</div>';
        }
        public function divclass($class){
            echo '<div class="'.$class.'">';
        }
        public function span(){
            echo '<span>';
        }
        public function spancalss($class){
            echo '<span class="'.$class.'">';
        }
        public function spanend(){
            echo '</span>';
        }
        public function center(){
            echo '<center>';
        }
        public function centerend(){
            echo '</center>';
        }

        public function cadre(){
          echo '<body style="border-color:'.$this->c->bordercolor().' ; border-style:groove; margin: 0.5%; padding:0.5%">';
        }
        public function bodyend(){
            echo '</body>';
        }
    //header
        public function image($link){
            echo '<img src="'.PRE.'/ressource/images/'.$link.'" alt="">';
        }
        public function imageh($link, $heigt){
            echo '<img src="'.PRE.'/ressource/images/'.$link.'" height="'.$heigt.'">';
        }

        public function button($name, $class){
          echo '<button class="'.$class.'">'.$name.'</button>' ;
        }

        public function menu(array $contenu, $class){
           $this->divclass($class);
            foreach($contenu as $element){
                echo '<a href="'.PRE.'/'.$element.'">'.$element.'</a>';
                // Accueil Presentation News...
            }
            $this->divend();
        }

    //footer
        public function footer(array $menu, $logo, $class){
            $this->center();
                $this->divclass($class);
                    $this->image($logo);
                    $this->span();
                        $this->menu($menu,$class);
                    $this->spanend();
                $this->divend();
            $this->centerend();
        }  
        
    //accueil
        public function diapo(array $diapo){
            $this->divclass("diaporama");
            foreach($diapo as $img){
               echo' <a href="'.$img->link().'">';
               $this->imageh($img->image(),150);
               echo'</a>';             
            }
            $this->divend();
        }
        
        
        
    }
?>

