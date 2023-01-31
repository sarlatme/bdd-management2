<!DOCTYPE html>
<html lang="fr">
    <?php
    	session_start();
        if(isset($_GET['idc'])){
            $concours = $_GET['idc'];
        }
	?>
	<head>
    	<meta charset="utf-8"/>
    	<link rel="stylesheet" type="text/css" href="../../style/style-list.css"/>
        <?php
                if(isset($_SESSION['isPresident'])){
                    echo '
                        <title>Concours attibué / dessins</title>
                    ';
                }else{
                    echo '<p>Erreur</p>';
                }
            ?> 
	</head>
	<body>
        <nav class="navbar">
            <a href="#" class="logo">Concours attribué / dessins</a>
            <div class="nav-links">
                <ul>
                    <li><a href="./president_concours.php">Retour au concours</a></li>
                </ul>
            </div>
        </nav>

        <header></header>
            <?php
                    echo '
                    <a href="./president_concours-participants.php?idc='.$concours.'" class="switch">Participants</a>
                    ';
            ?> 
            <table>
                <thead>
                </thead>
                <tbody>
                <?php
                    require_once('../../functions/mypdo.class.php');
                    $vpdo = new mypdo ();
                    $db = $vpdo->connexion;
                    $result = $vpdo->listeDessinConcours($concours);
                    if($result && $row = $result->fetch ( PDO::FETCH_OBJ) ) {
                        echo '<tr>
                        <th> Nom </th>
                        <th> Prenom </th>
                        <th> Dessin </th>
                        <th> CLassement </th>
                        <th> Note </th>
                        <th> Commentaire </th>
                        </tr>';
                        do {
                            echo '<tr><td>'.$row->nom.'</td><td>'.$row->prenom.'</td><td>'.$row->leDessin.'</td><td>'.$row->classement.'</td><td>'.$row->note.'</td><td>'.$row->commentaire.'</td>';
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