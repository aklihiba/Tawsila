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
        public function imagew($link, $width){
            echo '<img src="'.PRE.'/ressource/images/'.$link.'" width="'.$width.'">';
        }

        public function button($name, $class, $onclick){
          echo '<button type="button" class="'.$class.'" onclick="'.$onclick.'">'.$name.'</button>' ;
        }
        
        public function menu(array $contenu, $class){
            echo '<nav class="navbar">';
           $this->divclass($class);
            foreach($contenu as $element){
                if($element=='Profil'){
                    echo '<a class="navbar-brand" href="'.PRE.'/'.$element.'/index/'.$_SESSION['user']->id().'">'.$element.'</a>';
                }else
                echo '<a class="navbar-brand" href="'.PRE.'/'.$element.'">'.$element.'</a>';
                // Accueil Presentation News...
            }
            $this->divend();
            echo ' </nav>';
        }
        public function footermenu(array $contenu, $class){
          
           $this->divclass($class);
            foreach($contenu as $element){
                if($element=='Profil'){
                    echo '<a class="smalllink" href="'.PRE.'/'.$element.'/index/'.$_SESSION['user']->id().'">'.$element.'</a>';
                }else
                echo '<a class="smalllink" href="'.PRE.'/'.$element.'">'.$element.'</a>';
                // Accueil Presentation News...
            }
            $this->divend();
          
        }

        public function adminmenu(array $contenu, $class){
            echo '<nav class="navbar">';
            $this->divclass($class);
             foreach($contenu as $element){
                 
                 echo '<a class="navbar-brand"  href="'.PRE.'/Gestion'.$element.'">'.$element.'</a>';
                 // Accueil Presentation News...
             }
             $this->divend();
            echo ' </nav>';
         }

    //footer
        public function footer(array $menu, $logo, $class){
            $this->center();
                $this->divclass($class);
                    $this->image($logo);
                    $this->divend();
                  $this->div();
                        $this->footermenu($menu,$class);
                    $this->divend();
               
            $this->centerend();
        }  
        
    //accueil
       /* public function login($header){
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
        */
        public function login($header, $couleur){
           
            echo '<button type="button" class="bigbutton" data-toggle="modal" data-target="#exampleModalCenter">
                    Connexion
             </button>';
           echo '<form action="'.PRE.'/accueil" method="post">';
            echo '  
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
               <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">';
                $this->center();
                $this->imagew($header->logo(),400);
                $this->div();    
                $this->input("mail", "mail","email","input");
                $this->divend();$this->div();   
                $this->password("pwd", "pwd","mot de passe","mdpinput");
                $this->divend();$this->div();   
                $this->link("Inscription", "smalllink","vous n'avez pas de compte inscriver-vous");
                $this->divend();
                $this->centerend();
                echo '</div>
                <div class="modal-footer">
                <button type="button" class="bigbutton" data-dismiss="modal">fermer</button>';
                
                $this->submit("Connexion","login", $header->buttonsClass());  
                echo '</div>
                </div>
            </div>
            </div>
            ';
            echo "</form>";   
        }

        public function diapo(array $diapo){
            $this->divclass("diaporama");
            $this->divclass("images");
            foreach($diapo as $img){
               echo' <a href="'.$img->link().'">';
               $this->imageh($img->image(),150);
               echo'</a>';             
            }
            $this->divend();
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
           echo '<div class="card" style="width: 15rem;">';
           echo ' <img class="card-img-top" src="'.PRE.'/ressource/images/'.$a->photo().'" >';
           echo '
           <div class="card-body">
           <h5 class="card-title titre">'.$a->titre().'</h5>
           <p class="card-text paragraphe">wilaya: '.$a->wilaya_depart().'->'.$a->wilaya_arrive().'</p>';
           $this->link("Accueil/annonce/".$a->id(),"smalllink","lire la suite");
           echo '</div>
            </div>';    
              
        }

        public function dropdowncheckbox(array $values, $name, $content, $class){
            //checkbox for multiselection
            $this->divclass($class);
            echo '<button class="'.$class.' btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           '.$content.'
          </button>';
          
            echo ' <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

            for ($i=0; $i <count($values) ; $i++) { 

                $this->divclass('dropdown-item');
                echo '<input type="checkbox" id="'.$name.'" name="'.$name.'[]" value="'.$values[$i].'">';
                echo'<label for="'.$name.'"> '.$values[$i].'</label><br>';
                $this->divend();
            }
            $this->divend();
            $this->divend();


        }
        public function dropdownradio(array $values, $name, $content, $class){
            //radio for one element selection
            $this->divclass($class);
              echo '<button class="'.$class.' btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
           '.$content.'
          </button>';
          
            echo ' <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
           
            for ($i=0; $i <count($values) ; $i++) { 
                $this->divclass('dropdown-item');
                echo '<input type="radio" id="'.$name.$i.'" name="'.$name.'" value="'.$values[$i].'">';
                echo'<label for="'.$name.$i.'">  '.$values[$i].'</label><br>';
                $this->divend();
            }
           
            $this->divend();
            $this->divend();

        }
        public function fourchette(array $values, $name, $content, $class){
            $this->divclass($class);
            echo '<button class="'.$class.' btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           '.$content.'
          </button>';
          
            echo ' <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

            for ($i=0; $i <count($values)-1 ; $i++) { 
                $this->divclass('dropdown-item');
                echo '<input type="radio" id="'.$name.$i.'" name="'.$name.'" value="'.$values[$i].'-'.$values[$i+1].'">';
                echo'<label for="'.$name.$i.'"> entre '.$values[$i].' et '.$values[$i+1].'</label><br>';
                $this->divend();
            }
        
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

            echo '<div class="card" style="width: 15rem;">';
            echo ' <img class="card-img-top" src="'.PRE.'/ressource/images/'.$user->photo().'" >';
            echo '
            <div class="card-body">
            <h5 class="card-title titre">'.$user->nom().' '.$user->prenom().'</h5>
            <p class="card-text paragraphe">statut: '.$user->statut().'</p>';
            $this->paragraphe('wilayas depart: '.$user->depart(), "card-text paragraphe");
            $this->paragraphe('wilayas arrivé: '.$user->arrive(), "card-text paragraphe");
            $this->paragraphe('note: '.$user->note().'/5',"card-text paragraphe");
            if($action != ''){
                if($action=='signaler'){
                        $this->signalementbox();
                    }else
                    $this->submit($action, $action.$user->id(), 'smallbutton');

            }
            if($_SESSION['connexion']!='anonyme'){
                $this->link('profil/index/'.$user->id(),'card-link smalllink','profil');
            }
           
            echo '</div>
             </div>';    
           
        }

        public function select($name , $content , $class){
            $this->divclass($class);
            echo '<input class="'.$class.'" type="checkbox" id="'.$name.'" name="'.$name.'">';
            echo'<label class="'.$class.'" for="'.$name.'"> '.$content.'</label><br>';
            $this->divend();
        }

        public function signalementbox(){
            $this->input('signalementdesc','signalementdesc', 'votre probleme', 'input');
            $this->button('signaler', 'smallbutton', 'signaler()');
        }

        public function adminbox($a){
            
            echo '<div class="card" style="width: 16rem;">';
            echo ' <img class="card-img-top" src="'.PRE.'/ressource/images/'.$a->photo().'" >';
            echo '
            <div class="card-body">
            <h3 class="card-title titre">'.$a->nom().' '.$a->prenom().'</h3>
            <p class="card-text paragraphe">'.$a->age().' ans'.'</p>';
            echo '</div>
             </div>';    
         
        }

        public function newsbox($n){

            echo '<div class="card" style="width: 16rem;">';
            echo ' <img class="card-img-top" src="'.PRE.'/ressource/images/'.$n->photo().'" >';
            echo '
            <div class="card-body">
            <h4 class="card-title titre">'.$n->titre().'</h4>
            <p class="card-text paragraphe">'.$n->description().'</p>';
            $this->link('News/view/'.$n->id(),'card-link smalllink','lire la suite');
            echo '</div>
             </div>';    
           
        }
        
        /***************admin */
        public function clientrow($c){
            echo "<tr>
                    <td> <input  type='checkbox'  name='selected[]' value=".$c->id()."> </td>
                    <td> <a href='".PRE."/Profil/index/".$c->id()."'>".$c->nom()." ".$c->prenom()."</a></td>
                    <td>".$c->adresse()."</td>
                    <td>".$c->mail()."</td>
                    <td>".$c->telephone()."</td>
                    <td>".$c->statut()."</td>
                   
                </tr>
            ";
        }
        public function transporteurrow($c){
            echo "<tr>
                    <td> <input  type='checkbox'  name='selected[]' value=".$c->id()."> </td>
                    <td> <a href='".PRE."/Profil/index/".$c->id()."'>".$c->nom()." ".$c->prenom()."</a></td>
                    <td>".$c->adresse()."</td>
                    <td>".$c->mail()."</td>
                    <td>".$c->telephone()."</td>
                    <td>".$c->statut()."</td>";
                    if($c->demande_certification()){
                        echo "<td>oui</td>";
                    }   else{
                        echo "<td>non</td>";
                    }     
                 echo " <td>".$c->depart()."</td>
                    <td>".$c->arrive()."</td>
                    <td>".$c->gain()."</td>
                    <td>".$c->note()."/5</td>
                   
                </tr>
            ";
        }
        public function annoncerow($c){
            echo "<tr>
                    <td> <input  type='checkbox'  name='selected[]' value=".$c->id()."> </td>
                    <td> <a href='".PRE."/Accueil/Annonce/".$c->id()."'>".$c->titre()."</a></td>
                    <td>".$c->date()."</td>
                    <td> <a href='".PRE."/Profil/index/".$c->client()->id()."'>".$c->client()->nom()." ".$c->client()->prenom()."</a></td>";
            if($c->transiteur()==null){
                echo "<td>-</td>";
            }else{
                echo "<td> <a href='".PRE."/Profil/index/".$c->transiteur()->id()."'>".$c->transiteur()->nom()." ".$c->transiteur()->prenom()."</a></td>";
            }    
            echo "    
                    <td>".$c->etat()."</td>
                    <td>".$c->wilaya_depart()."</td>
                    <td>".$c->wilaya_arrive()."</td>
                    <td>".$c->transport()."</td>
                    <td>".$c->poidsMin()." - ".$c->poidsMax()."</td>
                    <td>".$c->volumeMin()." - ".$c->volumeMax()."</td>
                    <td>".$c->type()."</td>
                    <td>".$c->prix()."</td>
                    <td>".$c->vues()."</td>
                    ";
            if($c->archive()){
                echo "<td>oui</td>";
            }   else{
                echo "<td>non</td>";
            }     
             echo "   </tr>
            ";
        }

        public function signalementrow($s){
            echo "<tr>
            <td> <a href='".PRE."/Profil/index/".$s->emetteur()->id()."'>".$s->emetteur()->id()." ".$s->emetteur()->nom()." ".$s->emetteur()->prenom()."</a></td>
            <td> <a href='".PRE."/Accueil/Annonce/".$s->annonce()->id()."'>".$s->annonce()->id()." ".$s->annonce()->titre()."</a></td>
            <td> <a href='".PRE."/Profil/index/".$s->mis_en_cause()->id()."'>".$s->mis_en_cause()->id()." ".$s->mis_en_cause()->nom()." ".$s->mis_en_cause()->prenom()."</a></td>
            <td> <a href='".PRE."/GestionSignalements/signalement/".$s->annonce()->id()."-".$s->emetteur()->id()."-".$s->mis_en_cause()->id()."'>description</a></td>
           
           
            </tr>
              ";
        }

        public function presentationrow($e, $couleur){
            echo' <tr id="'.$e->id().'">
            <td> <input  type="checkbox"  name="selected[]" value='.$e->id().'> </td>
            <td>
            <input type="text" class="form-control"  name="type'.$e->id().'"  style="width:2cm; background-color:'.$couleur.' ;" value="' . $e->type() . '" >
            </td>
            <td>
            <input type="text" class="form-control"  name="content'.$e->id().'"  style="width:max-width; background-color: '.$couleur.' ;" value="' . $e->content() . '" >
            </td>
          
            
            </tr>';
        }
        public function diaporow($e, $couleur){
            echo' <tr id="'.$e->id().'">
            <td> <input  type="checkbox"  name="selected[]" value='.$e->id().'> </td>
            <td>'. $e->image() . '</td>
            <td>'. $e->link() . '</td>
            </tr>';
        }

        public function critererow($e){
            echo' <tr id="'.$e['id'].'">
            <td> <input  type="checkbox"  name="selected[]" value='.$e['id'].'> </td>
            <td>'. $e['colonne'] . '</td>
            <td>'. $e['valeur'] . '</td>
            <td>'. $e['operation'] . '</td>';
            if($e['used']){
                echo '<td> oui </td>';
            }else{
                echo '<td> non </td>';
            }
            echo ' </tr>';
        }

        public function prixrow($e, $couleur){
            echo' <tr id="'.$e['wilaya1'].'-'.$e['wilaya2'].'">
            <td> <input  type="checkbox"  name="selected[]" value='.$e['wilaya1'].'-'.$e['wilaya2'].'> </td>
            <td>'. $e['wilaya1'] . '</td>
            <td>'. $e['wilaya2'] . '</td>
            <td>
            <input type="text" class="form-control"  name="prix'.$e['wilaya1'].'-'.$e['wilaya2'].'"  style="width:max-width; background-color: '.$couleur.' ;" value="' . $e['prix'] . '" >
            </td>';
            echo ' </tr>';
        }

        public function volumerow($e, $couleur){
            echo' <tr>
            <td>
            <input type="text" class="form-control"  name="volume[]"  style="width:max-width; background-color: '.$couleur.' ;" value="' . $e . '" >
                </td>
            </tr>';
        }
        public function poidsrow($e, $couleur){
            echo' <tr>
            <td>
            <input type="text" class="form-control"  name="poids[]"  style="width:max-width; background-color: '.$couleur.' ;" value="' . $e . '" >
                </td>
            </tr>';
        }
        public function transportrow($e, $couleur){
            echo' <tr>
            <td>
            <input type="text" class="form-control"  name="transport[]"  style="width:max-width; background-color: '.$couleur.' ;" value="' . $e . '" >
                </td>
            </tr>';
        }
        public function typerow($e, $couleur){
            echo' <tr>
            <td>
            <input type="text" class="form-control"  name="type[]"  style="width:max-width; background-color: '.$couleur.' ;" value="' . $e . '" >
                </td>
            </tr>';
        }
        public function newsrow($e){
            echo "
            <tr id='".$e->id()."'>
            <td> <input  type='checkbox'  name='selected[]' value=".$e->id()."> </td>
            <td> <a href='".PRE."/News/view/".$e->id()."'>".$e->titre()."</a></td>
            <td>". $e->date()."</td>
            <td>".$e->vues()."</td>

            </tr>";
        }
    }
?>
