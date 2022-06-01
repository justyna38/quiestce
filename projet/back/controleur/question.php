<?php
require('../configuration/config.php');
require('../modele/database.php');

//TEST
//$_POST['question'] = "yeux";
//$_POST['modeQuestion']=1;
//$_POST['reponseUtilisateur']="marrons";
//$_POST['reponse'] = "marrons";
//$_POST['solution'] = "Elsa";
//$_POST['initialisation']="Elsa";
//Fin du test



if (isset($_POST['initialisation'])) {
    $BDD = new BBD($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD);
    $listePersonnage = $BDD->getpersonnages();
    if ($listePersonnage) {
        $listeQuestions = $BDD->getQuestions();
        if ($listeQuestions) {
            $monPersonnage = $BDD->selectionneUnePersonne($listePersonnage);
            $tableauPartie = array();
            $tableauPartie = ['bonneReponse' => $monPersonnage, 'personnagesParties' => $listePersonnage, 'listeQuestions' => $listeQuestions];
            echo json_encode($tableauPartie);
        } else {
            echo 'aucune question en base de donnée';
        }
    } else {
        echo 'aucun personnage en base de donnée';
    }
}

//ALGO
//On recupere le mode de question et la reponse de l'utilisateur
//on interroge la BDD
//Si le point est en question est verifié alors on renvoie un true au JS
//Sinon un false


if ((isset($_POST['question']) && ($_POST['question'] != "")) && (isset($_POST['solution']) && ($_POST['solution'] != "")) && (isset($_POST['reponse']) && ($_POST['reponse'] != ""))) {
    $BDD = new BBD($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD);
    $reponse = $BDD->getterDynamique($_POST['question'], $_POST['reponse'], $_POST['solution']);
    if ($reponse) {
        echo "true";
    } else {
        echo "false";
    }
}


if (isset($_POST['reponse']) && $_POST['reponse'] != "") {
    $BDD = new BBD($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD);
    $reponse = $BDD->getReponse($_POST['reponse']);
    echo json_encode($reponse);
}


//Permet de recuperer la photo apres la croix
if (isset($_POST['photo']) && (isset($_POST['prenom']) && $_POST['prenom'] != "")) {
    $BDD = new BBD($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD);
    $reponse = $BDD->getPhotoBDD($_POST['prenom']);
    echo json_encode($reponse);
}
