<?php

include("./config.php");

class Test {
    private $db;
  
    // Constructeur chargé d'ouvrir la BD
    function __construct($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD) {
      try {
        $this->db = new PDO($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD);
        if (!$this->db) {
          die ("Erreur. Base de données inexistante");
        }
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    }
}

$test= new Test($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD);
if($test){
    echo 'connexion reussie a la base de donnée';
}
else{
    echo 'echec de connexion';
}