<?php

class BBD
{
  private $db;

  // Constructeur chargé d'ouvrir la BD
  function __construct($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD)
  {
    try {
      $this->db = new PDO($MYSQL_PDO, $MYSQL_USER, $MYSQL_PASSWD);
      if (!$this->db) {
        die("Erreur. Base de données inexistante");
      }
    } catch (PDOException $e) {
      die("PDO Error :" . $e->getMessage());
    }
  }

  //Retourner une liste de tous les personnages melangés
  public function getPersonnages(): array
  {
    $Requete = "SELECT * FROM attributs order by rand()";
    $requete = $this->db->prepare($Requete);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function getPhotoBDD($prenom)
  {
    $Requete = "SELECT photo FROM attributs WHERE prenom=?";
    $requete = $this->db->prepare($Requete);
    $requete->bindParam(1, $prenom, PDO::PARAM_STR);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  //Retourner une liste de toutes les questions
  public function getQuestions(): array
  {
    $Requete = "SELECT * FROM questions ORDER BY id";
    $requete = $this->db->prepare($Requete);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function selectionneUnePersonne($tableau)
  {
    $tailleTableau = count($tableau);
    $nombreRandom = rand(0, $tailleTableau - 1);
    $monPersonnage = $tableau[$nombreRandom];
    return $monPersonnage;
  }

  public function getReponse($idQuestion)
  {
    $requete = "SELECT reponse FROM reponses r, questions q WHERE q.id=r.id_question AND q.id=? ";
    $requete = $this->db->prepare($requete);
    $requete->bindParam(1, $idQuestion, PDO::PARAM_STR);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function getterDynamique($getter, $reponse, $solution)
  {
    $resultat = "";
    switch ($getter) {
      case "cheveux":
        $resultat = $this->getCheveux($reponse, $solution);
        break;

      case "sexe":
        $resultat = $this->getSexe($reponse, $solution);
        break;

      case "yeux":
        $resultat = $this->getYeux($reponse, $solution);
        break;

      case "chapeau":
        $resultat = $this->getChapeau($reponse, $solution);
        break;

      case "peau":
        $resultat = $this->getPeau($reponse, $solution);
        break;

      case "lunettes":
        $resultat = $this->getLunettes($reponse, $solution);
        break;


      case "chauve":
        $resultat = $this->getChauve($reponse, $solution);
        break;

      case "moustache":
        $resultat = $this->getMoustache($reponse, $solution);
        break;
    }


    return $resultat;
  }

  public function getCheveux($reponse, $solution)
  {
    $requete = "SELECT a.id FROM attributs a, reponses r WHERE a.cheveux=r.reponse AND r.reponse=? AND a.prenom=?";
    $requete = $this->db->prepare($requete);
    $requete->bindParam(1, $reponse, PDO::PARAM_STR);
    $requete->bindParam(2, $solution, PDO::PARAM_STR);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  // private function getBidule()
  // {
  //   return 'coucou';
  // }

  public function getSexe($reponse, $solution)
  {
    $requete = "SELECT a.id FROM attributs a, reponses r WHERE a.sexe=r.reponse AND r.reponse=? AND a.prenom=?";
    $requete = $this->db->prepare($requete);
    $requete->bindParam(1, $reponse, PDO::PARAM_STR);
    $requete->bindParam(2, $solution, PDO::PARAM_STR);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function getYeux($reponse, $solution)
  {
    $requete = "SELECT a.id FROM attributs a, reponses r WHERE a.yeux=r.reponse AND r.reponse=? AND a.prenom=?";
    $requete = $this->db->prepare($requete);
    $requete->bindParam(1, $reponse, PDO::PARAM_STR);
    $requete->bindParam(2, $solution, PDO::PARAM_STR);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function getChapeau($reponse, $solution)
  {
    $requete = "SELECT a.id FROM attributs a, reponses r WHERE a.chapeau=r.reponse AND r.reponse=? AND a.prenom=?";
    $requete = $this->db->prepare($requete);
    $requete->bindParam(1, $reponse, PDO::PARAM_STR);
    $requete->bindParam(2, $solution, PDO::PARAM_STR);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function getPeau($reponse, $solution)
  {
    $requete = "SELECT a.id FROM attributs a, reponses r WHERE a.peau=r.reponse AND r.reponse=? AND a.prenom=?";
    $requete = $this->db->prepare($requete);
    $requete->bindParam(1, $reponse, PDO::PARAM_STR);
    $requete->bindParam(2, $solution, PDO::PARAM_STR);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function getLunettes($reponse, $solution)
  {
    $requete = "SELECT a.id FROM attributs a, reponses r WHERE a.lunettes=r.reponse AND r.reponse=? AND a.prenom=?";
    $requete = $this->db->prepare($requete);
    $requete->bindParam(1, $reponse, PDO::PARAM_STR);
    $requete->bindParam(2, $solution, PDO::PARAM_STR);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function getChauve($reponse, $solution)
  {
    $requete = "SELECT a.id FROM attributs a, reponses r WHERE a.chauve=r.reponse AND r.reponse=? AND a.prenom=?";
    $requete = $this->db->prepare($requete);
    $requete->bindParam(1, $reponse, PDO::PARAM_STR);
    $requete->bindParam(2, $solution, PDO::PARAM_STR);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function getMoustache($reponse, $solution)
  {
    $requete = "SELECT a.id FROM attributs a, reponses r WHERE a.moustache=r.reponse AND r.reponse=? AND a.prenom=?";
    $requete = $this->db->prepare($requete);
    $requete->bindParam(1, $reponse, PDO::PARAM_STR);
    $requete->bindParam(2, $solution, PDO::PARAM_STR);
    if ($requete) {
      $requete->execute();
      $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  // private function creationDeRequeteBDD($modeQuestion)
  // {
  //   $requete = "";
  //   switch ($modeQuestion) {
  //     case 1:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND sexe='femme'";
  //       break;
  //     case 2:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND sexe='homme'";
  //       break;
  //     case 3:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND cheveux='blond'";
  //       break;
  //     case 4:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND cheveux='brun'";
  //       break;
  //     case 5:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND cheveux='chatain'";
  //       break;
  //     case 6:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND cheveux='roux'";
  //       break;
  //     case 7:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND cheveux='blanc'";
  //       break;
  //     case 8:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND cheveux='blanc'";
  //       break;
  //     case 9:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND yeux='bleux'";
  //       break;
  //     case 10:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND yeux='marrons'";
  //       break;
  //     case 11:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND yeux='verts'";
  //       break;
  //     case 12:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND peau='claire'";
  //       break;
  //     case 13:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND peau='fonce'";
  //       break;
  //     case 14:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND chauve='1'";
  //       break;
  //     case 15:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND lunettes='1'";
  //       break;
  //     case 16:
  //       $requete = "SELECT id FROM attributs WHERE prenom =? AND chapeau='1'";
  //       break;
  //   }
  //   return $requete;
  // }

  // public function requeteBDD($modeQuestion, $solution)
  // {
  //   $Requete = $this->creationDeRequeteBDD($modeQuestion);
  //   $requete = $this->db->prepare($Requete);
  //   $requete->bindParam(1, $solution, PDO::PARAM_STR);
  //   if ($requete) {
  //     $requete->execute();
  //     $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
  //     if ($resultat) {
  //       return true;
  //     } else {
  //       return false;
  //     }
  //   }
  // }

  public function creerAdministrateur($nom, $password)
  {
    $userName = $nom;
    $mdpNonHash = $password;
    $options = ['cost' => 12];
    $mdp = password_hash($mdpNonHash, PASSWORD_BCRYPT, $options);

    try {
      $requete = "INSERT INTO adminjeu(userName, mdp) values (:userName, :mdp)";
      $maRequete = $this->db->prepare($requete);

      $maRequete->bindParam(':userName', $userName, PDO::PARAM_STR);
      $maRequete->bindParam(':mdp', $mdp, PDO::PARAM_STR);
      $maRequete->execute();
    } catch (PDOException $erreur) {
      echo $erreur->getMessage();
    }
  }

  public function changeMdpAdministrateur($login, $mdp)
  {
    $admin = $this->getAdmin($login);
    $options = ['cost' => 12];
    $motDePasseHash = password_hash($mdp, PASSWORD_BCRYPT, $options);
    if ($admin) {
      $requete = "UPDATE adminjeu SET mdp=? WHERE userName=? ";
      $maRequete = $this->db->prepare($requete);
      if ($maRequete) {
        $maRequete->bindParam(1, $motDePasseHash, PDO::PARAM_STR);
        $maRequete->bindParam(2, $login, PDO::PARAM_STR);
        $resultat = $maRequete->execute();
        return $resultat;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function creerUnePersonneBDD($tableau, $image)
  {
    $prenom = $tableau['prenom'];
    $sexe = $tableau['sexe'];
    $cheveux = $tableau['cheveux'];
    $yeux = $tableau['yeux'];
    $peau = $tableau['peau'];
    $chapeau = $tableau['chapeau'];
    $lunettes = $tableau['lunettes'];
    $chauve = $tableau['chauve'];
    $moustache = $tableau['moustache'];
    $nomPhoto = $image['file']['name'];

    try {
      $requete = "INSERT INTO attributs(prenom, sexe, cheveux, yeux, chapeau, peau, lunettes, chauve, moustache, photo) values (:prenom, :sexe, :cheveux, :yeux, :chapeau, :peau, :lunettes, :chauve, :moustache, :photo)";
      $maRequete = $this->db->prepare($requete);

      $maRequete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
      $maRequete->bindParam(':sexe', $sexe, PDO::PARAM_STR);
      $maRequete->bindParam(':cheveux', $cheveux, PDO::PARAM_STR);
      $maRequete->bindParam(':yeux', $yeux, PDO::PARAM_STR);
      $maRequete->bindParam(':chapeau', $chapeau, PDO::PARAM_STR);
      $maRequete->bindParam(':peau', $peau, PDO::PARAM_STR);
      $maRequete->bindParam(':lunettes', $lunettes, PDO::PARAM_STR);
      $maRequete->bindParam(':chauve', $chauve, PDO::PARAM_STR);
      $maRequete->bindParam(':moustache', $moustache, PDO::PARAM_STR);
      $maRequete->bindParam(':photo', $nomPhoto, PDO::PARAM_STR);
      $maRequete->execute();
    } catch (PDOException $erreur) {
      echo $erreur->getMessage();
    }

    echo 'entrée ajouté en base de données';
  }

  public function getAdmin($userlogin)
  {

    $resultat = "";
    $requete = "SELECT * FROM adminjeu WHERE userNAme=:userName ";
    $maRequete = $this->db->prepare($requete);
    if ($maRequete) {
      $maRequete->bindParam(':userName', $userlogin, PDO::PARAM_STR);
      $maRequete->execute();
      $maRequete->setFetchMode(PDO::FETCH_CLASS, 'Admin');
      $resultat = $maRequete->fetch();
    }


    if ($resultat != "") {
      return $resultat;
    } else {
      return false;
    }
  }
}
