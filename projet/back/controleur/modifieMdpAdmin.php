<?php

include('../modele/database.php');
include('../modele/admin.php');
include('../configuration/config.php');

if ((isset($_POST['login']) && $_POST['login'] != "") && (isset($_POST['password']) && $_POST['password'] != "")) {
    $BDD = new BBD($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD);
    $resultat = $BDD->changeMdpAdministrateur($_POST['login'], $_POST['password']);
    echo $resultat;
}
