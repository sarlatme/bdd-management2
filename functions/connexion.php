<!DOCTYPE html>
<html lang="fr">
	<head>
	</head>	
	<?php
    echo "connexion";
    	session_start();  // Demarrage ou restauration de la session
	?>
	<body>
		    <?php
		        $serveur = "localhost"; //identifiant server
		        $dbname = "siteweb"; //nom de la bdd
		        $user = "user"; //nom du compte bdd
		        $pass = "userpass"; // mot de passe du compte bdd

				$_SESSION['connect']= null;

		        // if (!isset($_SESSION['connect'])){ //permet de savoir s'il y a deja une session ouverte
		        //     $uti_mail = securisation_bdd($_POST["uti_mail"]);
		        //     $uti_mdp = securisation_bdd($_POST["uti_mdp"]); 
		        // }
		        // else {
		        //     $uti_mail = securisation_bdd($_SESSION['id']);
		        //     $uti_mdp = securisation_bdd($_SESSION['pass']); 
		        // }

                $uti_mail = securisation_bdd($_POST["uti_mail"]);
                $uti_mdp = securisation_bdd($_POST["uti_mdp"]);

				function securisation_bdd($donnees){ //fonction qui empeche l'injection SQL
					$donnees = trim($donnees);
					$donnees = stripslashes($donnees);
					$donnees = htmlspecialchars($donnees);
					return $donnees;
				}
				try {
					$bdd = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
				} catch (PDOException $e) {
					print "Erreur !:" . $e->getMessage() . "<br/>";
					die();
				}
				// $bdd = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
				$qUser = "SELECT numUtilisateur, prenom, nom, email, motDePasse, adresse, numClub, dateLicense  FROM Utilisateur WHERE email = :uti_mail";
	            $req = $bdd->prepare($qUser);

	            $req-> execute(array(":uti_mail" => $uti_mail)); //verification de l'identifiant
	            $resultat = $req->fetch();


	            // $verification = password_verify( $uti_mdp, $resultat["uti_mdp"]); //verification du mot de passe associ� a l'identifiant


	            // if ($verification) //si les identifiants sont corrects
	            // {
				// 	// Ecriture d'une nouvelle valeur dans le tableau de session
				// 	$_SESSION['id'] = $uti_mail;
				// 	$_SESSION['pass'] = $uti_mdp;
				// 	$_SESSION['num'] = $resultat['uti_num'];
				// 	$_SESSION['prenom'] = $resultat['uti_prenom'];
				// 	$_SESSION['connect']= 'true';
				// 	$req->closeCursor();
				// 	header('Location: ../index.php');
 				// 	exit();
	            // }
	            // else
	            // {
	            // 	header('Location: ../include/connexion_lost.php'); //renvoie a la page d'erreur de login
	            // 	$req->closeCursor();
	            // }

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
    
   			?>
	</body>
</html>