<?php

/*
 * @link http://phpform.net/math_captcha.php
 */

require('../configuration/config.php');
require('../modele/database.php');
require('../modele/admin.php');

session_start();

if (isset($_POST['submit'])) {

    if (
        isset($_POST['userName']) && !empty($_POST['userName'])
        && (isset($_POST['mdp']) && !empty($_POST['mdp']) && ($_POST['check']) == $_SESSION['check'])
    ) {
        $BDD = new BBD($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD);
        //$BDD->creerAdministrateur("administrateur", "admin");
        $monAdmin = $BDD->getAdmin($_POST['userName']);
        if ($monAdmin) {
            //on compare les mdp

            if (password_verify($_POST['mdp'], $monAdmin->getMdp())) {
                require('../../front/vue/ajouterPersonnage.html');
            } else {
                //envoie MSG mdp incorrect
                $erreur = "mot de passe incorrect";
                header('Location: ../../front/vue/connexion.php?erreur=' . $erreur);
            }
        } else {
            //envoie msg erreur ADMIN introuvable
            $erreur = "administrateur inexistant";
            header('Location: ../../front/vue/connexion.php?erreur=' . $erreur);
        }
    } else if (($_POST['check']) != $_SESSION['check']) {
        $erreur = "catcha incorrect";
        header('Location: ../../front/vue/connexion.php?erreur=' . $erreur);
    }
}
