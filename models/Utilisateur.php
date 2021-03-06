<?php
    require_once ('Model.php');
    class Utilisateur extends Model{
        private $_id;
        private $_nom;
        private $_prenom;
        private $_adresse;
        private $_mail;
        private $_telephone;
        private $_type;
        private $_wilayas_depart;
        private $_wilayas_arrive;
        private $_gain;
        private $_note;
        private $_statut;
        private $_demande_certification;
        private $_photo;
        private $_pwd;
        private $_admin_msg;

        public function __construct(array $data)
        {
            $this->hydrate($data);

        }


        public function hydrate(array $data)
        {
            foreach($data as $key => $value)
            {
                
                $method = 'set'.ucfirst($key);
                if (method_exists($this, $method))
                {
                    $this->$method($value);
                }
            }
        }

        public function setId($id)
        {
            $id = (int) $id;
            if ($id > 0)
            {
                $this->_id = $id;
            }
        }

        public function setNom($nom)
        {
            if (is_string($nom))
            {
                $this->_nom = $nom;
            }
        }
        public function setPrenom($prenom)
        {
            if (is_string($prenom))
            {
                $this->_prenom = $prenom;
            }
        }

        public function setAdresse($adresse)
        {
            if(!is_null($adresse))
            {
                if (is_string($adresse))
                {
                    $this->_adresse = $adresse;
                }
            }
            
        }
    

        public function setWilayas_depart($wilaya)
        {
           if(is_array($wilaya)){
            $this->_wilayas_depart = $wilaya;
           }else{
               $this->_wilayas_depart = explode(", ",$wilaya);
           }   
           
        }
        public function setDepart($string){
            //use when saving to the db
            $this->_wilayas_depart = $string;
        }
        public function setArrive($string){
            //use when saving to the db
            $this->_wilayas_arrive= $string;
        }
        public function setWilayas_arrive($wilaya)
        {
            if(is_array($wilaya)){
                $this->_wilayas_arrive= $wilaya;
               }else{
                $this->_wilayas_arrive = explode(", ",$wilaya);
               }
        }

        public function setMail($mail)
        {
            if (is_string($mail))
            {
                $this->_mail = $mail;
            }
        }

        public function setTelephone($tel)
        {
            if (is_string($tel))
            {
                $this->_telephone = $tel;
            }
        }

        public function setType($type)
        {
            if (is_string($type))
            {
                $this->_type = $type;
            }
        }

        public function setGain($gain)
        {
           $this->_gain = (float) $gain ;
        }

        public function setNote($note)
        {
           $this->_note = (float) $note ;
        }

        public function setPhoto($photo)
        {
            if(!is_null($photo))
            {
                if (is_string($photo))
                {
                    $this->_photo = $photo;
                }
            }
            
        }
        public function setStatut($statut)
        {
            if (is_string($statut))
            {
                $this->_statut = $statut;
            }
        }

        public function setDemande_certification($c)
        {
           $this->_demande_certification = (bool) $c ;
        }
        public function setPwd($pwd)
        {
            if (is_string($pwd))
            {
                $this->_pwd = $pwd;
            }
        }
        public function setAdmin_msg($msg){
            $this->_admin_msg = $msg;
        }

        public function admin_msg(){return $this->_admin_msg;}
        public function id(){return $this->_id ;}
        public function nom(){return $this->_nom ;}
        public function prenom(){return $this->_prenom ;}
        public function adresse(){return $this->_adresse ;}
        public function mail(){return $this->_mail ;}
        public function telephone(){return $this->_telephone ;}
        public function type(){return $this->_type ;}
        public function wilayas_depart(){return $this->_wilayas_depart ;}
        public function wilayas_arrive(){return $this->_wilayas_arrive ;}
        public function gain(){return $this->_gain ;}
        public function note(){return $this->_note ;}
        public function statut(){return $this->_statut ;}
        public function photo(){return $this->_photo ;}
        public function demande_certification(){return $this->_demande_certification;}
        public function pwd(){return $this->_pwd ;}

        public function depart(){
            $s = '';
            $w = $this->wilayas_depart();
            for ($i=0; $i <count($w) ; $i++) { 
               if($i==0){ $s = $w[$i];}
               else{

                $s =  $s.', '.$w[$i] ;
               }
            }
            return $s;
        }
        public function arrive(){
            $s = '';
            $w = $this->wilayas_arrive();
            for ($i=0; $i <count($w) ; $i++) { 
               if($i==0){ $s = $w[$i];}
               else{

                $s =  $s.', '.$w[$i] ;
               }
            }
            return $s;
        }

        //modify and save
        public function insererClient(){
            try {
                $this->getConnection();
                
                $sql = "INSERT INTO utilisateur (nom, prenom, adresse, mail, telephone, type, pwd )
                VALUES ('".$this->nom()."', '".$this->prenom()."', '".$this->adresse()."', '".$this->mail()."', '".$this->telephone()."',
                'client', '".md5($this->pwd())."')" ;
          
                $this->_connexion->exec($sql);
               // echo "New record created successfully";
              } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
              }
        }
        public function insererTransporteur(){
            try {
                $this->getConnection();

                $sql = "INSERT INTO utilisateur (nom, prenom, adresse, mail, telephone, type, wilayas_depart, wilayas_arrive, 
                gain, statut, demande_certification, pwd )
                VALUES ('".$this->nom()."', '".$this->prenom()."', '".$this->adresse()."', '".$this->mail()."', '".$this->telephone()."',
                'transporteur', '".$this->depart()."', '".$this->arrive()."', '0', 'en attente', ".$this->demande_certification().",
                '".md5($this->pwd())."')" ;
          
                $this->_connexion->exec($sql);
              //  echo "New record created successfully";
              } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
              }
        }
        public function updateClient($changedpwd){
            $this->getConnection();
            if($changedpwd){
            $sql = " UPDATE utilisateur SET 
            nom='".$this->nom()."',
            photo='".$this->photo()."',
            prenom='".$this->prenom()."',
            telephone='".$this->telephone()."',
            adresse='".$this->adresse()."',
            pwd='".md5($this->pwd())."'           
            WHERE id=".$this->id();
            }else{
                $sql = " UPDATE utilisateur SET 
            nom='".$this->nom()."',
            photo='".$this->photo()."',
            prenom='".$this->prenom()."',
            telephone='".$this->telephone()."',
            adresse='".$this->adresse()."',
            pwd='".$this->pwd()."'           
            WHERE id=".$this->id();
            }

            $this->query($sql);
        }

        public function updateTransporteur($changedpwd){
            $this->getConnection();
            if($changedpwd){
                $sql = " UPDATE utilisateur SET 
            nom='".$this->nom()."',
            photo='".$this->photo()."',
            wilayas_depart='".$this->depart()."',
            wilayas_arrive='".$this->arrive()."',
            prenom='".$this->prenom()."',
            telephone='".$this->telephone()."',
            adresse='".$this->adresse()."',
            pwd='".md5($this->pwd())."'           
            WHERE id=".$this->id();

            }else{
                $sql = " UPDATE utilisateur SET 
            nom='".$this->nom()."',
            photo='".$this->photo()."',
            wilayas_depart='".$this->depart()."',
            wilayas_arrive='".$this->arrive()."',
            prenom='".$this->prenom()."',
            telephone='".$this->telephone()."',
            adresse='".$this->adresse()."',
            pwd='".$this->pwd()."'           
            WHERE id=".$this->id();

            }
            
            $this->query($sql);
        }
        public function existedeja(){
            $this->getConnection();
            $sql = "SELECT * FROM utilisateur WHERE mail='".$this->mail()."'";
            $data = $this->request($sql);
            if ($data != null) {
                return true;
            } 
        
            return false; 
        }

        public function noter($note){
            if($this->note() == 0 ){
                $this->setNote($note);
            }else{
                $this->setNote(($this->note()+$note)/2);
            }
            $this->getConnection();
            $sql = " UPDATE utilisateur SET note=".$this->note()." WHERE id=".$this->id();
            $this->query($sql);
        }

        public function transiter($gain){
            $this->setGain($this->gain()+$gain);
            $this->getConnection();
            $sql = " UPDATE utilisateur SET gain=".$this->gain()." WHERE id=".$this->id();
            $this->query($sql);
        }

        public function valider(){
            $this->setStatut('valid??');
            $this->getConnection();
            $sql = " UPDATE utilisateur SET statut='".$this->statut()."' WHERE id=".$this->id();
            $this->query($sql);
        }
        
        public function refuser(){
            $this->setStatut('refus??');
            $this->getConnection();
            $sql = " UPDATE utilisateur SET statut='".$this->statut()."' WHERE id=".$this->id();
            $this->query($sql);
        }
        
        public function certifier(){
            $this->setStatut('certifi??');
            $this->getConnection();
            $sql = " UPDATE utilisateur SET statut='".$this->statut()."' WHERE id=".$this->id();
            $this->query($sql);
        }
        public function banir(){
            $this->setStatut('banie');
            $this->getConnection();
            $sql = " UPDATE utilisateur SET statut='".$this->statut()."' WHERE id=".$this->id();
            $this->query($sql);
        }
        public function sendmsg($msg){
            $this->setAdmin_msg($msg);
            $this->getConnection();
            $sql = " UPDATE utilisateur SET admin_msg='".$this->admin_msg()."' WHERE id=".$this->id();
            $this->query($sql);
        }
    }
    /*
    $data= array(
        'nom'=> 'akli',
        'prenom'=>'hiba',
        'adresse'=>'alger',
        'mail'=>'hiba@akli.dz',
        'telephone'=>'0987654312',
        'type'=>'client',
        'pwd'=>'1234'
    );
    $v = new Utilisateur($data);
    echo $v->nom();
    echo $v->prenom();
    echo $v->adresse();
    $v->insererClient();
    */
?>