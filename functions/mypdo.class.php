<?php
session_start();
class mypdo extends PDO{ //La classe mypdo nous permet d'aller chercher les éléments de différentes tables

    private $PARAM_hote='localhost'; // le chemin vers le serveur
    private $PARAM_utilisateur='user'; // nom d'utilisateur pour se connecter
    private $PARAM_mot_passe='userpass'; // mot de passe de l'utilisateur pour se connecter

    private $PARAM_nom_bd='siteweb'; //connexion à la base de donnée
    private $connexion;

    public function __construct() { //Constructeur de la classe
        try { // Instanciation d'un objet pdo

            $this->connexion = new PDO('mysql:host='.$this->PARAM_hote.';dbname='.$this->PARAM_nom_bd, $this->PARAM_utilisateur, $this->PARAM_mot_passe,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

        }
        catch (PDOException $e) // Regarder si il y a des erreurs de connexion
        {

            echo 'Erreur : '.$e->getMessage().'<br />';

            $this->connexion=false;

        }
    }

    public function __get($propriete) {
        switch ($propriete) {
            case 'connexion' :
                {
                    return $this->connexion;
                    break;
                }
        }
    }

    public function listeClubs() { //Récupération des appelations des différentes catégorie d'objet
      $requete = 'SELECT nomClub,nom,prenom from Club c1,Dirige d1,Utilisateur u1
      WHERE (c1.numClub = d1.numClub)
        and (d1.numDirecteur = u1.numUtilisateur);'; // Dans $requete, on réalise le chemin jusqu'à nos informations
      $result = $this->connexion->query($requete); // On récupere le resultat de la $requete
      if($result){ // Si on récupère correctement notre requète on la renvoi, sinon on ne renvoi rien
        return $result;
      }else{
        return null;
      }
    }

        // Pour la suite, les fonctions sont similaires. Seul les requètes diffèrent.


      public function listeConcours() { //Récupération des appelations des différentes catégorie d'objet
      $requete = 'SELECT theme,nom,prenom,dateDebut,dateFin,descriptif,etat,cu1.nomClub FROM Concours c1,President p1,Utilisateur ut1,Club cu1
      WHERE (c1.numPresident = p1.numPresident) 
        and(p1.numPresident = ut1.numUtilisateur)
        and (cu1.numClub = c1.numClubOrganisateur);'; // Dans $requete, on réalise le chemin jusqu'à nos informations
      $result = $this->connexion->query($requete); // On récupere le resultat de la $requete
      if($result){ // Si on récupère correctement notre requète on la renvoi, sinon on ne renvoi rien
        return $result;
      }else{
        return null;
      }
    }

    public function listeMembreClub() { //Récupération des appelations des différentes catégorie d'objet
      $myClub = $_SESSION['numClub'];
      $requete = 'SELECT nom,prenom,age,email,dateLicense from Utilisateur u1,Club c1 WHERE u1.numClub = c1.numClub and c1.numClub = '.$myClub.';'; // Dans $requete, on réalise le chemin jusqu'à nos informations
      $result = $this->connexion->query($requete); // On récupere le resultat de la $requete
      if($result){ // Si on récupère correctement notre requète on la renvoi, sinon on ne renvoi rien
        return $result;
      }else{
        return null;
      }
    }

    public function listeConcoursDispo() { //Récupération des appelations des différentes catégorie d'objet
      $requete = 'SELECT theme,nom,prenom,dateDebut,dateFin,descriptif,etat,cu1.nomClub FROM Concours c1,President p1,Utilisateur ut1,Club cu1
      WHERE (c1.numPresident = p1.numPresident) 
        and(p1.numPresident = ut1.numUtilisateur)
        and (cu1.numClub = c1.numClubOrganisateur)
        and (etat != "evalue");'; // Dans $requete, on réalise le chemin jusqu'à nos informations
      $result = $this->connexion->query($requete); // On récupere le resultat de la $requete
      if($result){ // Si on récupère correctement notre requète on la renvoi, sinon on ne renvoi rien
        return $result;
      }else{
        return null;
      }
    } 
    
    public function getNomClub() { //Récupération des appelations des différentes catégorie d'objet
      $myClub = $_SESSION['numClub'];
      $requete = 'SELECT nomClub from Club c1 WHERE c1.numClub = '.$myClub.';'; // Dans $requete, on réalise le chemin jusqu'à nos informations
      $result = $this->connexion->query($requete); // On récupere le resultat de la $requete
      if($result){ // Si on récupère correctement notre requète on la renvoi, sinon on ne renvoi rien
        return $result;
      }else{
        return null;
      }
    }

    public function listeConcoursCompetiteur() { //Récupération des appelations des différentes catégorie d'objet
      $num = $_SESSION['num'];
      $requete = 'SELECT theme,etat, dateDebut, dateFin from Concours c1,ParticipeCompetiteur p1
      WHERE c1.numConcours = p1.numConcours
          and p1.numCompetiteur ='.$num.';';
      $result = $this->connexion->query($requete); // On récupere le resultat de la $requete
      if($result){ // Si on récupère correctement notre requète on la renvoi, sinon on ne renvoi rien
        return $result;
      }else{
        return null;
      }
    }

    public function listeConcoursEvaluateur() { //Récupération des appelations des différentes catégorie d'objet
      $num = $_SESSION['num'];
      $requete = 'SELECT theme,etat, dateDebut, dateFin from Concours c1,MembreJury p1
      WHERE c1.numConcours = p1.numConcours
          and p1.numEvaluateur = '.$num.';';
      $result = $this->connexion->query($requete); // On récupere le resultat de la $requete
      if($result){ // Si on récupère correctement notre requète on la renvoi, sinon on ne renvoi rien
        return $result;
      }else{
        return null;
      }
    }

  }
?>
