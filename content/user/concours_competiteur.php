<!DOCTYPE html>
<html lang="fr">
    <?php
    	session_start(); //Ouverture de la session
	?>
	<head>
    	<meta charset="utf-8"/>
    	<link rel="stylesheet" type="text/css" href="../../style/style-list.css"/> 	<!-- Reference fichier .css -->
        <title>Mes concours</title>
	</head>
	<body>
        <nav class="navbar">
            <a href="#" class="logo">Mes concours en tant que compétiteur</a>
            <div class="nav-links">
                <ul>
                    <li><a href="./menu.php">Profil</a></li>
                    <li><a href="./concours_evaluateur.php">Evaluateur</a></li>
                </ul>
            </div>
        </nav>

        <header></header>
            <table>
                <thead>
                </thead>
                <tbody>
                <?php
                    require_once('../../functions/mypdo.class.php');
                    $vpdo = new mypdo (); //initialise la classe
                    $db = $vpdo->connexion; //ouvrir la connexion
                    $result = $vpdo->listeConcoursCompetiteur();
                    if($result && $row = $result->fetch ( PDO::FETCH_OBJ) ) {
                        echo '<tr>
                        <th> Theme </th>
                        <th> Etat </th>
                        <th> Date de début </th>
                        <th> Date de fin </th>
                        </tr>';
                        do { //tant qu'une ligne de resultat est retourné on reste dans le while
                            echo '<tr><td>'.$row->theme.'</td><td>'.$row->etat.'</td><td>'.$row->dateDebut.'</td><td>'.$row->dateFin.'</td>';
                        } while($row = $result->fetch ( PDO::FETCH_OBJ));
                    }
                    else {
                        echo '<h2 style="color: white;"> Aucun concours</h2>';
                    }
                ?>
                </tbody>
                </table>
	</body>

</html>