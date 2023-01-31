<!DOCTYPE html>
<html lang="fr">
    <?php
    	session_start(); 

        require_once('../../functions/mypdo.class.php');
        $vpdo = new mypdo ();
        $db = $vpdo->connexion;
        $result = $vpdo->getNomClub();
        $row = $result->fetch(PDO::FETCH_OBJ);
        $_SESSION['nomClub'] = $row->nomClub;

        require_once('../../functions/mypdo.class.php');
        $vpdo = new mypdo ();
        $db = $vpdo->connexion;
        $result = $vpdo->getMoyennes();
        $row = $result->fetch(PDO::FETCH_OBJ);
        $_SESSION['moyenneNote'] = $row->moyNote;
        $_SESSION['moyenneClassement'] = $row->moyClassement;
	?>
	<head>
    	<meta charset="utf-8"/>
    	<link rel="stylesheet" type="text/css" href="../../style/style.css"/>
        <?php
                if(isset($_SESSION['connect'])){
                    echo '
                        <title>Page de '.$_SESSION['prenom'].'</title>
                    ';
                }else{
                    echo '<p>Erreur</p>';
                }
            ?> 
	</head>
	<body>
        <nav class="navbar">
            <?php
                if(isset($_SESSION['isAdmin'])){
                    echo '
                    <a href="#" class="logo">Profil de '.$_SESSION['prenom'].' / Administrateur</a>
                    ';
                } elseif(isset($_SESSION['isDirector'])) {
                    if(isset($_SESSION['isPresident'])){
                        echo '
                        <a href="#" class="logo">Profil de '.$_SESSION['prenom'].' / Directeur & Président</a>
                        ';                        
                    } else {
                        echo '
                        <a href="#" class="logo">Profil de '.$_SESSION['prenom'].' / Directeur</a>
                        ';
                    }                  
                } else {
                    echo '
                    <a href="#" class="logo">Profil de '.$_SESSION['prenom'].'</a>
                    ';   
                }
            ?>
            <div class="nav-links">
                <?php
                    if(isset($_SESSION['isAdmin'])){
                        echo '
                        <ul>
                            <li><a href="../user/admin_concours.php">Concours</a></li>
                            <li><a href="../user/admin_clubs.php">Clubs</a></li>
                            <li><a href="../../functions/deconnexion.php">Deconnexion</a></li>
                        </ul>
                        ';
                    } elseif(isset($_SESSION['isDirector'])) {
                        if(isset($_SESSION['isPresident'])){
                            echo '
                            <ul>
                                <li><a href="../user/directeur_concours.php">Concours</a></li>
                                <li><a href="../user/directeur_club.php">Mon club</a></li>
                                <li><a href="../user/president_concours.php">Concours attribué</a></li>
                                <li><a href="../../functions/deconnexion.php">Deconnexion</a></li>
                            </ul>
                            ';                           
                        } else {
                            echo '
                            <ul>
                                <li><a href="../user/directeur_concours.php">Concours</a></li>
                                <li><a href="../user/directeur_club.php">Mon club</a></li>
                                <li><a href="../../functions/deconnexion.php">Deconnexion</a></li>
                            </ul>
                            ';
                        }                   
                    } elseif(isset($_SESSION['isPresident'])) {
                        echo '
                            <ul>
                                <li><a href="#">Concours</a></li>
                                <li><a href="../user/concours_competiteur.php">Mes Concours/a></li>
                                <li><a href="../../functions/deconnexion.php">Deconnexion</a></li>
                            </ul>
                        ';       
                    } else {
                        echo '
                        <ul>
                            <li><a href="../user/concours_competiteur.php">Mes Concours</a></li>
                            <li><a href="../../functions/deconnexion.php">Deconnexion</a></li>
                        </ul>
                        ';   
                    }
                ?>
            </div>
        </nav>

        <header></header>
        <section class="profil">
                    <section class="col1">
                    <form action="">
                        <?php
                            if(isset($_SESSION['connect'])){
                                echo '
                                    <p>Mon profil</p><br>
                                    <p>Mail : '.$_SESSION['mail'].'</p><br>
                                    <p>Nom : '.$_SESSION['nom'].'</p><br>
                                    <p>Prénom : '.$_SESSION['prenom'].'</p><br>
                                    <p>Adresse : '.$_SESSION['adresse'].'</p><br>
                                    <p>Date de license : '.$_SESSION['dateLicense'].'</p><br>
                                    <p>Club : '.$_SESSION['nomClub'].'</p><br>
                                    <p>Moyenne des notes : '.$_SESSION['moyenneNote'].'</p><br>
                                    <p>Moyenne des classements : '.$_SESSION['moyenneClassement'].'</p><br>
                                ';
                            }else{
                                echo '<p>Erreur</p>';
                            }
                        ?> 
                    </form>
                    </section>
        </section>
        <footer>
            <p>Copyright &copy; Bury Hugo, Axel Lory & Sarlat Meven</p>
            <p>2020 - 2022 | All Right Reserved.</p>
        </footer>
	</body>

</html>