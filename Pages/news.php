<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Actualités</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <?php include '../Components/header.php'
        ?>
    </header>
    <div id="wrapper">
        <aside>
            <img src="../Images/picnic.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez les derniers messages de
                    tous les utilisatrices du site.</p>
            </section>
        </aside>
        <main>
           

            <?php
           
            $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
            

            if ($mysqli->connect_errno) {
                echo "<article>";
                echo ("Échec de la connexion : " . $mysqli->connect_error);
                echo ("<p>Indice: Vérifiez les parametres de <code>new mysqli(...</code></p>");
                echo "</article>";
                exit();
            }

            $SQLQuery = "
                    SELECT posts.content,
                    posts.user_id,
                    posts.id,
                    posts.created,
                    users.alias as author_name,  
                    count(likes.id) as like_number,  
                    GROUP_CONCAT(DISTINCT tags.label) AS taglist , GROUP_CONCAT(DISTINCT tags.id) AS tag_ids
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    LIMIT 15
                    ";
            $Res = $mysqli->query($SQLQuery);
            
            if (!$Res) {
                echo "<article>";
                echo ("Échec de la requete : " . $mysqli->error);
                echo ("<p>Indice: Vérifiez la requete  SQL suivante dans phpmyadmin<code>$SQLQuery</code></p>");
                exit();
            }

            while ($post = $Res->fetch_assoc()) {
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