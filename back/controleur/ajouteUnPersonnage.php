<?php


//integration des classes
require('../modele/database.php');
require('../configuration/config.php');

if (isset($_POST) && isset($_FILES['file'])) {


    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $path = "../../upload";
    $info = getimagesize($_FILES['file']['tmp_name']);
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $formatImage = array('jpg', 'png');


    if (in_array($ext, $formatImage)) {

        if (file_exists("$path/$name")) {
            echo $name . " existe déja";
        } else {
            move_uploaded_file($tmpName, "$path/$name");
            echo "votre fichier a été bien enregistré";
        }
    } else {
        echo "Mauvaise extension. ";
    }
    $BDD = new BBD($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD);
    $BDD->creerUnePersonneBDD($_POST, $_FILES);
}
