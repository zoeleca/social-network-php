<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnés </title> 
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
                <img src = "../Images/picnic.jpg" alt = "Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes qui
                        suivent les messages de l'utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?></p>

                </section>
            </aside>
            <main class='contacts'>
                <?php

                $userId = intval($_GET['user_id']);

                $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");

                $SQLQuery = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
                $Res = $mysqli->query($SQLQuery);

                
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
