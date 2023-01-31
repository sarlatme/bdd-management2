<?php
session_start();
class mypdo extends PDO{

    private $PARAM_hote='localhost';
    private $PARAM_utilisateur='user';
    private $PARAM_mot_passe='userpass';
    private $PARAM_nom_bd='siteweb';
    private $connexion;

    public function __construct() {
        try {
            $this->connexion = new PDO('mysql:host='.$this->PARAM_hote.';dbname='.$this->PARAM_nom_bd, $this->PARAM_utilisateur, $this->PARAM_mot_passe,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        catch (PDOException $e)
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

    public function listeClubs() {
      $requete = 'SELECT nomClub,nom,prenom from Club c1,Dirige d1,Utilisateur u1
      WHERE (c1.numClub = d1.numClub)
        and (d1.numDirecteur = u1.numUtilisateur);';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    }

      public function listeConcours() {
      $requete = 'SELECT theme,nom,prenom,dateDebut,dateFin,descriptif,etat,cu1.nomClub FROM Concours c1,President p1,Utilisateur ut1,Club cu1
      WHERE (c1.numPresident = p1.numPresident) 
        and(p1.numPresident = ut1.numUtilisateur)
        and (cu1.numClub = c1.numClubOrganisateur);';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    }

    public function listeMembreClub() {
      $myClub = $_SESSION['numClub'];
      $requete = 'SELECT nom,prenom,age,email,dateLicense from Utilisateur u1,Club c1 WHERE u1.numClub = c1.numClub and c1.numClub = '.$myClub.';';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    }

    public function listeConcoursDispo() {
      $requete = 'SELECT theme,nom,prenom,dateDebut,dateFin,descriptif,etat,cu1.nomClub FROM Concours c1,President p1,Utilisateur ut1,Club cu1
      WHERE (c1.numPresident = p1.numPresident) 
        and(p1.numPresident = ut1.numUtilisateur)
        and (cu1.numClub = c1.numClubOrganisateur)
        and (etat != "evalue");';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    } 
    
    public function getNomClub() {
      $myClub = $_SESSION['numClub'];
      $requete = 'SELECT nomClub from Club c1 WHERE c1.numClub = '.$myClub.';';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    }

    public function listeConcoursCompetiteur() {
      $num = $_SESSION['num'];
      $requete = 'SELECT theme,etat, dateDebut, dateFin from Concours c1,ParticipeCompetiteur p1
      WHERE c1.numConcours = p1.numConcours
          and p1.numCompetiteur ='.$num.';';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    }

    public function listeConcoursEvaluateur() {
      $num = $_SESSION['num'];
      $requete = 'SELECT theme,etat, dateDebut, dateFin from Concours c1,MembreJury p1
      WHERE c1.numConcours = p1.numConcours
          and p1.numEvaluateur = '.$num.';';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    }

    public function listeConcoursPreside() {
      $num = $_SESSION['num'];
      $requete = 'SELECT c1.numConcours,theme,descriptif,dateDebut,dateFin,etat from Concours c1,President p1,Utilisateur u1
      WHERE c1.numPresident = p1.numPresident
      and u1.numUtilisateur = p1.numPresident
      and u1.numUtilisateur = '.$num.';';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    }
  
    public function listeParticipantConcours($argument) {
      $num = $argument;
      $requete = 'SELECT nom,prenom,nomClub from Concours c1,ParticipeCompetiteur p1,Utilisateur ut1, Club cl1
      WHERE c1.numConcours = p1.numConcours
          and c1.numConcours = '.$num.'
          and ut1.numClub = cl1.numClub
            GROUP by ut1.numUtilisateur;';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    }

    public function listeDessinConcours($argument) {
      $num = $argument;
      $requete = 'SELECT  nom,prenom,d1.commentaire,leDessin,classement,note from ParticipeCompetiteur cmp1, Utilisateur u1, Concours c1,Dessin d1, Evaluation e1
      WHERE c1.numConcours = d1.numConcours
          and c1.numConcours = '.$num.'
          and d1.numDessin = e1.numDessin
          and u1.numUtilisateur = cmp1.numCompetiteur
          and cmp1.numConcours = c1.numConcours
			ORDER BY `e1`.`note`  DESC;';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    }

    // public function listeDessins($argument) {
    //   $num = $argument;
    //   $requete = 'SELECT  d1.numDessin,leDessin,theme,dateDebut,dateFin,note,classement
    //     FROM Dessin d1, Concours c1, Evaluation e1
    //     WHERE d1.numConcours = c1.numConcours
    //     and d1.numCompetiteur = '.$num.';';
    //   $result = $this->connexion->query($requete);
    //   if($result){ 
    //     return $result;
    //   }else{
    //     return null;
    //   }
    // }

    public function getMoyennes() {
      $num = $_SESSION['num'];
      $requete = 'SELECT  AVG(note) AS moyNote, AVG(classement) AS moyClassement 
      from Dessin d1, Concours u1, Concours c1, Evaluation e1
      WHERE d1.numConcours = c1.numConcours
          and d1.numDessin = e1.numDessin
          and d1.numCompetiteur = '.$num.';';
      $result = $this->connexion->query($requete);
      if($result){
        return $result;
      }else{
        return null;
      }
    }


  }
?>
