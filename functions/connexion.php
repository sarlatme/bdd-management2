<!DOCTYPE html>
<html lang="fr">
	<head>
	</head>	
	<?php
    	session_start();
	?>
	<body>
		    <?php
		        $serveur = "localhost";
		        $dbname = "siteweb";
		        $user = "user";
		        $pass = "userpass";

				$_SESSION['connect']= null;

				function securisation_bdd($donnees){
					$donnees = trim($donnees);
					$donnees = stripslashes($donnees);
					$donnees = htmlspecialchars($donnees);
					return $donnees;
				}

                $uti_mail = securisation_bdd($_POST["uti_mail"]);
                $uti_mdp = securisation_bdd($_POST["uti_mdp"]);

				try {
					$bdd = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
				} catch (PDOException $e) {
					print "Erreur !:" . $e->getMessage() . "<br/>";
					die();
				}

				$qUser = "SELECT numUtilisateur, prenom, nom, email, motDePasse, adresse, numClub, dateLicense  FROM Utilisateur WHERE email = :uti_mail";
	            $req = $bdd->prepare($qUser);
	            $req-> execute(array(":uti_mail" => $uti_mail));
	            $resultat = $req->fetch();


				if(!$resultat){
					echo "Utilisateur introuvable";
				}else{
				echo "allo";
					if($uti_mdp == $resultat['motDePasse']){
						$_SESSION['mail'] = $uti_mail;
						$_SESSION['pass'] = $uti_mdp;
						$_SESSION['num'] = $resultat['numUtilisateur'];
						$_SESSION['prenom'] = $resultat['prenom'];
						$_SESSION['nom'] = $resultat['nom'];
						$_SESSION['adresse'] = $resultat['adresse'];
						$_SESSION['numClub'] = $resultat['numClub'];
						$_SESSION['dateLicense'] = $resultat['dateLicense'];
						$_SESSION['connect']= 'true';

						$num_Utilisateur = $resultat['numUtilisateur'];
						$qAdmin = "SELECT * FROM Administrateur WHERE numAdministrateur = :num_Utilisateur";
						$isAdmin = $bdd->prepare($qAdmin);
						$isAdmin-> execute(array(":num_Utilisateur" => $num_Utilisateur));
						$resAdmin = $isAdmin->fetch();
		
						if ($isAdmin->rowCount() > 0) {
							$_SESSION['isAdmin'] = true;
						} else {
							$_SESSION['isAdmin'] = null;
						}
		
						$num_Utilisateur = $resultat['numUtilisateur'];
						$qDirector = "SELECT * FROM Directeur WHERE numDirecteur = :num_Utilisateur";
						$isDirector = $bdd->prepare($qDirector);
						$isDirector-> execute(array(":num_Utilisateur" => $num_Utilisateur));
						$resDirector = $isDirector->fetch();
		
						if ($isDirector->rowCount() > 0) {
							$_SESSION['isDirector'] = true;
						} else {
							$_SESSION['isDirector'] = null;
						}
		
						$num_Utilisateur = $resultat['numUtilisateur'];
						$qPresident = "SELECT * FROM President WHERE numPresident = :num_Utilisateur";
						$isPresident = $bdd->prepare($qPresident);
						$isPresident-> execute(array(":num_Utilisateur" => $num_Utilisateur));
						$isPresident = $isPresident->fetch();
		
						if ($isDirector->rowCount() > 0) {
							$_SESSION['isPresident'] = true;
						} else {
							$_SESSION['isPresident'] = null;
						}
						$req->closeCursor();
						header('Location: ../content/user/menu.php');
						exit();
					}else{
						header('Location: ../index.php');
						$req->closeCursor();
					}
				}


				



    
   			?>
	</body>
</html>