<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Flux</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <?php include '../Components/header.php'
        ?>
    </header>
    <div id="wrapper">
        <?php
        
        $userId = intval($_GET['user_id']);
        ?>
        <?php
        
        $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
        ?>

        <aside>
            <?php

            $SQLQuery = "SELECT * FROM `users` WHERE id= '$userId' ";
            $Res = $mysqli->query($SQLQuery);
            $user = $Res->fetch_assoc();

            ?>
            <img src="../Images/picnic.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez tous les message des utilisatrices
                    auxquel est abonnée l'utilisatrice <?php echo $user['alias'] ?>
                    (n° <?php echo $userId ?>)
                </p>

            </section>
        </aside>
        <main>
            <?php


            $SQLQuery = "
                    SELECT posts.content,
                    posts.created,
                    posts.user_id,
                    posts.id,
                    users.alias as author_name,  
                    count(likes.id) as like_number,  
                    GROUP_CONCAT(DISTINCT tags.label) AS taglist, GROUP_CONCAT(DISTINCT tags.id) AS tag_ids
                    FROM followers 
                    JOIN users ON users.id=followers.followed_user_id
                    JOIN posts ON posts.user_id=users.id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE followers.following_user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
            $Res = $mysqli->query($SQLQuery);
            if (!$Res) {
                echo ("Échec de la requete : " . $mysqli->error);
            }

            //get posts from followers
            while ($post = $Res->fetch_assoc() or $userId = $Res->fetch_assoc()) {
            ?>

                <article>
                    <?php include '../Components/article.php' ?>
                </article>
            <?php
            }
            ?>
        </main>
    </div>
</body>

</html>