<?php

abstract class Model
{
    private $host = 'localhost';
    private $db_name = "projet_web";
    private $username = "root";
    private $password = "";

    protected $_connexion;

    public $table;
   //connexion a la bdd
    public function getConnection(){
        $this->_connexion = null;

        try{
            $dsn = "mysql:dbname=".$this->db_name."; host=".$this->host.";";
            $this->_connexion = new PDO($dsn, $this->username, $this->password);
            $this->_connexion->exec('set names utf8');
        }catch(PDOException $e){
            echo 'Erreur de connexion : '.$e->getMessage();
        }
    }

    public function request(string $sql){
        $query = $this->_connexion->prepare($sql);
        try{
            $query->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $query->fetch(PDO::FETCH_ASSOC);
    }
   
    public function requestAll(string $sql){
        $query = $this->_connexion->prepare($sql);
        try{
            $query->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
   
    public function getAll(string $table, string $order=""){
        $sql = "SELECT * FROM ".$table;
        if($order != ""){
            $sql = $sql." ORDER BY ".$order;
        }
        return $this->requestAll($sql);
    }

    public function findById($table, $id){
        $sql = "SELECT * FROM ".$table." WHERE id=".$id;
        return $this->request($sql);
    }
}
?>