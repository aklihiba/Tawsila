<?php
    class ViewGenerator {
        
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
        public function spanclass($class){
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

        public function cadre($bg,$color){
          echo '<body style="background-color:'.$bg.'; border-color:'.$color.' ; border-style:groove; margin: 0.5%; padding:0.5%">';
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

        public function button($name, $class, $onclick){
          echo '<button class="'.$class.'" onclick="'.$onclick.'">'.$name.'</button>' ;
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
        public function login($header){
            echo "<div id='login'>";
            $this->center();
           
            $this->div();
            echo ' <a onclick="closelogin()" class="close-icon"></a>';
            echo '<form action="'.PRE.'/accueil" method="post">';
            $this->divend();$this->div();  
                $this->image($header->logo(),150);
                $this->divend();$this->div();    
                $this->input("mail", "mail","email","input");
                $this->divend();$this->div();   
                $this->input("pwd", "pwd","mot de passe","mdpinput");
                $this->divend();$this->div();   
                $this->link("Inscription", "smalllink","vous n'avez pas de compte inscriver-vous");
                $this->divend();$this->div();   
                $this->submit("Connexion","login", $header->buttonsClass());
                $this->divend();
             echo "</form>";   
            $this->centerend();
            $this->divend();
        }
        
        public function diapo(array $diapo){
            $this->divclass("diaporama");
            foreach($diapo as $img){
               echo' <a href="'.$img->link().'">';
               $this->imageh($img->image(),150);
               echo'</a>';             
            }
            $this->divend();
        }
        
        public function link($link, $class,$text){
            echo '<a href="'.PRE.'/'.$link.'" class="'.$class.'">'.$text.'</a>';
        }
        public function input($id,$name,$hint, $class){
            echo ' <input type="text" id="'.$id.'" name="'.$name.'" placeholder="'.$hint.'" class="'.$class.'">';
        }
        public function password($id,$name,$hint, $class){
            echo ' <input type="password" id="'.$id.'" name="'.$name.'" placeholder="'.$hint.'" class="'.$class.'">';
        }
        public function submit($content, $name, $class){
            echo '<input class="'.$class.'" name="'.$name.'" type="submit" value="'.$content.'" >';
        }

        public function annoncebox($a){
           $this->spanclass('annoncebox');
                $this->imageh($a->photo(),80);
                $this->div();
                    echo '<h3>'.$a->titre().'</h3>';
                    echo '<h4>wilaya: '.$a->wilaya_depart().'->'.$a->wilaya_arrive().'</h4>';
                    $this->link("Accueil/annonce/".$a->id(),"smalllink","lire la suite");
                    //TODO: un peu de description and lire la suite!
                $this->divend();
           $this->spanend();
        }
        
    }
?>

