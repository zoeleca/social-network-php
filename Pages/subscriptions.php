<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnements</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
        <?php include '../Components/header.php'
            ?>
        </header>
        <div id="wrapper">
            <aside>
                <img src="../Images/picnic.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes dont
                        l'utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?>
                        suit les messages
                    </p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                // Etape 1: récupérer l'id de l'utilisateur
                $userId = intval($_GET['user_id']);
                // Etape 2: se connecter à la base de donnée
                $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
                // Etape 3: récupérer le nom de l'utilisateur
                $SQLQuery = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id='$userId'
                    GROUP BY users.id
                    ";
                $Res = $mysqli->query($SQLQuery);

                //display user's subcriptions
                while ($userId = $Res->fetch_assoc()){
                ?>
                <article>
                    <img src="../Images/cat.jpg" alt="blason"/>
                    <a href="wall.php?user_id=<?php echo $userId['id']; ?>">
                        <h3><?php echo $userId['alias'] ?></h3>
                    </a>
                    <p>Id : <?php echo $userId['id'] ?></p>                    
                </article>
                <?php }?>
            </main>
        </div>
    </body>
</html>
