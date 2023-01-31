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
                        <title>'.$_SESSION['nomClub'].': Membres</title>
                    ';
                }else{
                    echo '<p>Erreur</p>';
                }
            ?> 
	</head>
	<body>
        <nav class="navbar">
            <?php
            echo '<a href="#" class="logo">' . $_SESSION['nomClub'] . ' : Membres</a>';
            ?> 
            <div class="nav-links">
                <ul>
                    <li><a href="./menu.php">Profil</a></li>
                    <li><a href="./directeur_concours.php">Concours</a></li>
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
                    $result = $vpdo->listeMembreClub();
                    if($result && $row = $result->fetch ( PDO::FETCH_OBJ) ) {
                        echo '<tr>
                        <th> Nom </th>
                        <th> Prénom </th>
                        <th> Age </th>
                        <th> Email </th>
                        <th> Date de License </th>
                        </tr>';
                        do {
                            echo '<tr><td>'.$row->nom.'</td><td>'.$row->prenom.'</td><td>'.$row->age.'</td><td>'.$row->email.'</td><td>'.$row->dateLicense.'</td>';
                        } while($row = $result->fetch ( PDO::FETCH_OBJ));
                    }
                    else {
                        echo '<h2 style="color: white;"> Aucun club</h2>';
                    }
                ?>
                </tbody>
                </table>
	</body>

</html>