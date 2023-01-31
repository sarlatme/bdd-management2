<!DOCTYPE html>
<html lang="fr">
	<head>
    	<meta charset="utf-8"/>
    	<link rel="stylesheet" type="text/css" href="style/style.css"/> 	<!-- Reference fichier .css -->
        <title>Accueil / Dessin</title>
	</head>
	<body>
        <nav class="navbar">
            <a href="#" class="logo">Concours de dessin - Accueil</a>
            <div class="nav-links">
                <ul>
                    <li><a href="#">Informations</a></li>
                    <li><a href="#">Calendrier</a></li>
                    <li><a href="#">Contacts</a></li>
                </ul>
            </div>
        </nav>

        <header></header>
        <section class="container">
            <section class="col1">
                <div class="card">
                    <p>Si vous êtes passionné de dessin et que vous avez envie de partager votre talent avec d'autres artistes, alors vous êtes au bon endroit. Nous vous proposons régulièrement des concours sur des thèmes divers et variés, pour que vous puissiez montrer votre créativité et peut-être même remporter de superbes prix. <br>
                        <br>
                        N'hésitez pas à parcourir notre site pour en savoir plus sur les concours auxquels vous pouvez participer et sur les modalités de participation. Si vous avez des questions, n'hésitez pas à nous contacter, nous sommes là pour vous aider. <br>   
                        <br>
                        Alors, prêt à mettre votre talent à l'épreuve et à vous mesurer aux autres artistes ? Inscrivez-vous dès maintenant et participez à nos concours de dessin !</p>
                </div>
            </section>
            <section class="col2">
                <form action = "functions/connexion.php" method="POST"> 
                    <p>Bienvenue</p>
                    <input type="mail" placeholder="Adresse mail" name="uti_mail" required><br>
                    <input type="password" placeholder="Mot de passe" name="uti_mdp" required><br>
                    <button type="submit">Connexion</button><br>
                    <a href="#">Password forgot</a><br>
                </form>
            </section>
        </section>
        <footer>
            <p>Copyright &copy; Bury Hugo, Axel Lory & Sarlat Meven</p>
            <p>2020 - 2022 | All Right Reserved.</p>
        </footer>
	</body>

</html>