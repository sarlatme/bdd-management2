<!DOCTYPE html>
<html lang="fr">
	<head>
    	<meta charset="utf-8"/>
    	<link rel="stylesheet" type="text/css" href="../../style/accueil.css"/> 	<!-- Reference fichier .css -->
        <title>Menu</title>
	</head>
    <?php
    	session_start(); //Ouverture de la session
	?>
	<body>
        <nav class="navbar">
            <a href="#" class="logo">Concours de dessin - calendrier</a>
            <div class="nav-links">
                <ul>
                    <li><a href="../../index.html">Accueil / Connexion</a></li>
                    <li><a href="./content/public/information.html">Informations</a></li>
                    <li><a href="./content/public/contact.html">Contacts</a></li>
                </ul>
            </div>
        </nav>

        <header></header>
        <h1 style="color: white; text-transform: uppercase; text-align: center;">Calendrier</h1>
        <?php
            if(isset($_SESSION['connect'])){
            echo '<h1 style="color: white; text-transform: uppercase; text-align: center;">' . $_SESSION["isAdmin"] . '</h1>';
            }
        ?>
        <footer>
            <p>Copyright &copy; Bury Hugo & Sarlat Meven</p>
            <p>2020 - 2022 | All Right Reserved.</p>
        </footer>
	</body>

</html>