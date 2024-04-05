<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Administration</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <?php include '../Components/header.php'
        ?>
    </header>

    <?php
    $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");

    if ($mysqli->connect_errno) {
        echo ("Échec de la connexion : " . $mysqli->connect_error);
        exit();
    }
    ?>
    <div id="wrapper" class='admin'>
        <aside>
            <h2>Mots-clés</h2>
            <?php

            $SQLQuery = "SELECT * FROM `tags` LIMIT 50";
            $Res = $mysqli->query($SQLQuery);

            if (!$Res) {
                echo ("Échec de la requete : " . $mysqli->error);
                exit();
            }

            while ($tag = $Res->fetch_assoc()) {
            ?>
                <article>
                    <h3>#<?php echo $tag['label'] ?></h3>
                    <p>id : <?php echo $tag['id'] ?></p>
                    <nav>
                        <a href="tags.php?tag_id=<?php echo $tag['id'] ?>">Messages</a>
                    </nav>
                </article>
            <?php } ?>
        </aside>
        <main>
            <h2>Utilisatrices</h2>
            <?php
            
            $SQLQuery = "SELECT * FROM `users` LIMIT 50";
            $Res = $mysqli->query($SQLQuery);
            // Vérification
            if (!$Res) {
                echo ("Échec de la requete : " . $mysqli->error);
                exit();
            }

            while ($tag = $Res->fetch_assoc()) {
            ?>
                <article>
                    <h3><?php echo $tag['alias'] ?></h3>
                    <p><?php echo $tag['id'] ?></p>
                    <nav>
                        <a href="wall.php?user_id=<?php $tag['id'] ?>">Mur</a>
                        | <a href="feed.php?user_id=<?php $tag['id'] ?>">Flux</a>
                        | <a href="settings.php?user_id=<?php $tag['id'] ?>">Paramètres</a>
                        | <a href="followers.php?user_id=<?php $tag['id'] ?>">Suiveurs</a>
                        | <a href="subscriptions.php?user_id=<?php $tag['id'] ?>">Abonnements</a>
                    </nav>
                </article>
            <?php } ?>
        </main>
    </div>
</body>

</html>