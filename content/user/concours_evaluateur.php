<!DOCTYPE html>
<html lang="fr">
    <?php
    	session_start();
	?>
	<head>
    	<meta charset="utf-8"/>
    	<link rel="stylesheet" type="text/css" href="../../style/style-list.css"/>
        <title>Mes concours</title>
	</head>
	<body>
        <nav class="navbar">
            <a href="#" class="logo">Mes concours en tant qu'évaluateur</a>
            <div class="nav-links">
                <ul>
                    <li><a href="./menu.php">Profil</a></li>
                    <li><a href="./concours_competiteur.php">Compétiteur</a></li>
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
                    $vpdo = new mypdo ();
                    $db = $vpdo->connexion;
                    $result = $vpdo->listeConcoursEvaluateur();
                    if($result && $row = $result->fetch ( PDO::FETCH_OBJ) ) {
                        echo '<tr>
                        <th> Theme </th>
                        <th> Etat </th>
                        <th> Date de début </th>
                        <th> Date de fin </th>
                        </tr>';
                        do {
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