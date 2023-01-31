<!DOCTYPE html>
<html lang="fr">
    <?php
    	session_start();
	?>
	<head>
    	<meta charset="utf-8"/>
    	<link rel="stylesheet" type="text/css" href="../../style/style-list.css"/>
        <?php
                if(isset($_SESSION['isDirector'])){
                    echo '
                        <title>Liste des concours en cours et à venir / Directeur</title>
                    ';
                }else{
                    echo '<p>Erreur</p>';
                }
            ?> 
	</head>
	<body>
        <nav class="navbar">
            <a href="#" class="logo">Liste des concours en cours et à venir / Directeur</a>
            <div class="nav-links">
                <ul>
                    <li><a href="./menu.php">Profil</a></li>
                    <li><a href="./directeur_club.php">Mon club</a></li>
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
                    $result = $vpdo->listeConcoursDispo();
                    if($result && $row = $result->fetch ( PDO::FETCH_OBJ) ) {
                        echo '<tr>
                        <th> Theme </th>
                        <th> Descriptif </th>
                        <th> Date de début </th>
                        <th> Date de fin </th>
                        <th> Etat </th>
                        <th> Nom du président </th>
                        <th> Prénom du président </th>
                        <th> Club </th>
                        </tr>';
                        do {
                            echo '<tr><td>'.$row->theme.'</td><td>'.$row->descriptif.'</td><td>'.$row->dateDebut.'</td><td>'.$row->dateFin.'</td><td>'.$row->etat.'</td><td>'.$row->nom.'</td><td>'.$row->prenom.'</td><td>'.$row->nomClub.'</td>';
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