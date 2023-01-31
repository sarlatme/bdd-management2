<!DOCTYPE html>
<html lang="fr">
    <?php
    	session_start();
        if(isset($_GET['idn'])){
            $numero = $_GET['idn'];
        }
	?>
	<head>
    	<meta charset="utf-8"/>
    	<link rel="stylesheet" type="text/css" href="../../style/style-list.css"/>
        <?php
                if(isset($_SESSION['isPresident'])){
                    echo '
                        <title>Mes dessins</title>
                    ';
                }else{
                    echo '<p>Erreur</p>';
                }
            ?> 
	</head>
	<body>
        <nav class="navbar">
            <a href="#" class="logo">Mes Dessins</a>
            <div class="nav-links">
                <ul>
                    <li><a href="./menu.php">Profil</a></li>
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
                    $result = $vpdo->listeDessins($numero);
                    if($result && $row = $result->fetch ( PDO::FETCH_OBJ) ) {
                        echo '<tr>
                        <th> Dessin </th>
                        <th> Concours </th>
                        <th> Date de début </th>
                        <th> Date de fin </th>
                        <th> Note </th>
                        <th> Classement </th>
                        </tr>';
                        do {
                            echo '<tr><td>'.$row->leDessin.'</td><td>'.$row->theme.'</td><td>'.$row->dateDebut.'</td><td>'.$row->dateFin.'</td><td>'.$row->note.'</td><td>'.$row->classement.'</td>';
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