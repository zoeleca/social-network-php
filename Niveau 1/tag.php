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
        <?php include 'header.php'
            ?>
        </header>
        <div id="wrapper">          
            <aside>
                <img src = "picnic.jpg" alt = "Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez les derniers messages comportant
                        le mot-clé </p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                // Etape 1: récupérer l'id de l'utilisateur
             //   $userId = intval($_GET['user_id']);
                // Etape 2: se connecter à la base de donnée
                $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
                // Etape 3: récupérer le nom de l'utilisateur
                $laQuestionEnSql = "
                    SELECT *
                    FROM tags
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Etape 4: à vous de jouer
                //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 
                while ($tag = $lesInformations->fetch_assoc()){
                    ?>
                <article>
                    <a href="tags.php?tag_id=<?php echo $tag['id']?>">
                        <h3><?php echo $tag['label'] ?></h3></a>
                    <p>Id : <?php echo $tag['id'] ?></p>
                </article>
                <?php }?>
            </main>
        </div>
    </body>
</html>
