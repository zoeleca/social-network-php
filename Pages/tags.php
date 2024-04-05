<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Les message par mot-clé</title>
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
        /**
         * Cette page est similaire à wall.php ou feed.php 
         * mais elle porte sur les mots-clés (tags)
         */
        /**
         * Etape 1: Le mur concerne un mot-clé en particulier
         */
        $tagId = intval($_GET['tag_id']);
        ?>
        <?php
        /**
         * Etape 2: se connecter à la base de donnée
         */
        $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
        ?>

        <aside>
            <?php
            //Get post by tag id
            $SQLQuery = "SELECT * FROM tags WHERE id= '$tagId' ";
            $Res = $mysqli->query($SQLQuery);
            $tag = $Res->fetch_assoc();

            ?>
            <img src="img/picnic.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez les derniers messages comportant
                    le mot-clé. <strong><em>#<?php echo $tag['label'] ?></em></strong>

                    (n° <?php echo $tagId ?>)
                </p>

            </section>
        </aside>
        <main>
            <?php
            $SQLQuery = "
                    SELECT posts.content,
                    posts.user_id,
                    posts.id,
                    posts.created,
                    users.alias as author_name,  
                    count(likes.id) as like_number,  
                    GROUP_CONCAT(DISTINCT tags.label) AS taglist,
                    GROUP_CONCAT(DISTINCT tags.id) AS tag_ids
                    FROM posts_tags as filter 
                    JOIN posts ON posts.id=filter.post_id
                    JOIN users ON users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE filter.tag_id = '$tagId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
            $Res = $mysqli->query($SQLQuery);
            if (!$Res) {
                echo ("Échec de la requete : " . $mysqli->error);
            }
            //display all articles
            while ($post = $Res->fetch_assoc()) {
            ?>
                <article>
                    <?php include '../Components/article.php' ?>
                </article>
            <?php } ?>
            <?php
            ?>
        </main>
    </div>
</body>

</html>