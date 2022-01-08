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
        private $_photo;
        private $_pwd;

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
        public function setPreom($prenom)
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
           
               $this->_wilayas_depart = explode(" ",$wilaya);
           
        }

        public function setwilayas_arrive($wilaya)
        {
                $this->_wilayas_arrive = explode(" ",$wilaya);
            
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

        public function setPwd($pwd)
        {
            if (is_string($pwd))
            {
                $this->_pwd = $pwd;
            }
        }
        public function id(){return $this->_id ;}
        public function nom(){return $this->_nom ;}
        public function prenom(){return $this->_prenom ;}
        public function adresse(){return $this->_adresse ;}
        public function mail(){return $this->_mail ;}
        public function telephone(){return $this->_telephone ;}
        public function type(){return $this->_type ;}
        public function wialays_depart(){return $this->_wilayas_depart ;}
        public function wilayas_arrive(){return $this->_wilayas_arrive ;}
        public function gain(){return $this->_gain ;}
        public function note(){return $this->_note ;}
        public function statut(){return $this->_statut ;}
        public function photo(){return $this->_photo ;}
        public function pwd(){return $this->_pwd ;}


        //modify and save
        /*
        public function save($type){
            try {
                $this->getConnection();
                if ($type=="transporteur") {
                   
                }
                $sql = "INSERT INTO utilisateur (nom, prenom, adresse, mail, telephone, type, wilayas_depart,
                    wilayas_arrive, gain, note, statut, photo, pwd )
                VALUES ('".$this->annonce()."', '".$this->emetteur()."', '".$this->mis_en_cause()."')" ;
          
                $this->_connexion->exec($sql);
                echo "New record created successfully";
              } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
              }
        }
        */
    }
?>