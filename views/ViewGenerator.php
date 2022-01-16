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
          echo '<button type="button" class="'.$class.'" onclick="'.$onclick.'">'.$name.'</button>' ;
        }
        
        public function menu(array $contenu, $class){
           $this->divclass($class);
            foreach($contenu as $element){
                if($element=='Profil'){
                    echo '<a href="'.PRE.'/'.$element.'/index/'.$_SESSION['user']->id().'">'.$element.'</a>';
                }else
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
                $this->password("pwd", "pwd","mot de passe","mdpinput");
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
        public function biginput($id,$name,$hint, $class){
            echo ' <textarea id="'.$id.'" name="'.$name.'" placeholder="'.$hint.'" class="'.$class.'"></textarea>';
        }
        public function fileselect($name, $content, $class){
           echo ' <label for="'.$name.'" class="'.$class.'">'.$content.'</label>';
           echo ' <input type="file" id="'.$name.'" name="'.$name.'" class="'.$class.'" title=" " >';
        }

        public function inputvalue($id,$name,$value, $class){
            echo ' <input type="text" id="'.$id.'" name="'.$name.'" value="'.$value.'" class="'.$class.'">';
        }
        public function biginputvalue($id,$name,$value, $class){
            echo ' <textarea id="'.$id.'" name="'.$name.'" class="'.$class.'">'.$value.'</textarea>';
        }
        public function fileselectvalue($name, $content, $value, $class){
           echo ' <label for="'.$name.'" class="'.$class.'">'.$content.'</label>';
           echo ' <input type="file" id="'.$name.'" name="'.$name.'" class="'.$class.'" value ="'.$value.'" title="'.$value.'" >';
        }        

        public function annoncebox($a){
           $this->spanclass('annoncebox');
                $this->imageh($a->photo(),80);
               $this->div();
                    echo '<h3>'.$a->titre().'</h3>';
                    echo '<h4>wilaya: '.$a->wilaya_depart().'->'.$a->wilaya_arrive().'</h4>';
                    $this->link("Accueil/annonce/".$a->id(),"smalllink","lire la suite");
                  
                $this->divend();
           $this->spanend();
        }

        public function dropdowncheckbox(array $values, $name, $content, $class){
            //checkbox for multiselection
            $this->divclass($class);
            $this->button($content,$class."btn","");
            $this->divclass($class."-content");
            for ($i=0; $i <count($values) ; $i++) { 
                echo '<input type="checkbox" id="'.$name.'" name="'.$name.'[]" value="'.$values[$i].'">';
                echo'<label for="'.$name.'"> '.$values[$i].'</label><br>';

            }
            $this->divend();
            $this->divend();


        }
        public function dropdownradio(array $values, $name, $content, $class){
            //radio for one element selection
            $this->divclass($class);
            
            $this->button($content,$class."btn","");
            $this->divclass($class."-content");
         
            for ($i=0; $i <count($values) ; $i++) { 
                echo '<input type="radio" id="'.$name.$i.'" name="'.$name.'" value="'.$values[$i].'">';
                echo'<label for="'.$name.$i.'"> '.$values[$i].'</label><br>';

            }
           
            $this->divend();
            $this->divend();

        }
        public function fourchette(array $values, $name, $content, $class){
            $this->divclass($class);
            
            $this->button($content,$class."btn","");
            $this->divclass($class."-content");
           
            for ($i=0; $i <count($values)-1 ; $i++) { 
                echo '<input type="radio" id="'.$name.$i.'" name="'.$name.'" value="'.$values[$i].'-'.$values[$i+1].'">';
                echo'<label for="'.$name.$i.'"> entre '.$values[$i].' et '.$values[$i+1].'</label><br>';
            }
          //  echo '<input type="radio" id="'.$name.$i.'" name="'.$name.'" value="'.$values[$i].'-'.'1000'.'">';
          //  echo'<label for="'.$name.$i.'"> '.$values[$i].' ou plus.'.'</label><br>';
            
            $this->divend();
            $this->divend();
        }

        public function titre($size, $content, $class){
            echo '<h'.$size.' class="'.$class.'">'.$content.'</h'.$size.'>';
        }
        public function paragraphe($content, $class){
            echo '<p class="'.$class.'">'.$content.'</p>';
        }
        
        public function userbox($user, $action){
            $this->spanclass('userbox');
                $this->div();
                    $this->imageh($user->photo(),80);
                    $this->titre(5,$user->statut(),"titre");
                $this->divend();    
                $this->div();
                    $this->titre(4, $user->nom().' '.$user->prenom(), "titre");
                    $this->paragraphe('wilayas depart: '.$user->depart(), "paragraphe");
                    $this->paragraphe('wilayas arrivé: '.$user->arrive(), "paragraphe");
                    $this->paragraphe('note: '.$user->note().'/5',"paragraphe");
            $this->divend();
            $this->div();
            if($action != ''){
                $this->submit($action, $action.$user->id(), 'smallbutton');
            }
            if($_SESSION['connexion']!='anonyme'){
                $this->link('profil/index/'.$user->id(),'smalllink','profil');
            }
            $this->divend();    
           $this->spanend();
        }

        public function select($name , $content , $class){
            $this->divclass($class);
            echo '<input class="'.$class.'" type="checkbox" id="'.$name.'" name="'.$name.'">';
            echo'<label class="'.$class.'" for="'.$name.'"> '.$content.'</label><br>';
            $this->divend();
        }

        public function adminbox($a){
            $this->divclass('adminbox');
            $this->div();
                $this->imageh($a->photo(),150);
            $this->divend();
            $this->div();
                $this->titre(1,$a->nom().' '.$a->prenom(),'titre1');
                $this->titre(2,$a->age().' ans','titre2');
            $this->divend();    
            $this->divend();
        }
        
    }
?>

