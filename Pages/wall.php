<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>ReSoC - Mur</title>
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
     * Etape 1: Le mur concerne un utilisateur en particulier
     * La première étape est donc de trouver quel est l'id de l'utilisateur
     * Celui ci est indiqué en parametre GET de la page sous la forme user_id=...
     * Documentation : https://www.php.net/manual/fr/reserved.variables.get.php
     * ... mais en résumé c'est une manière de passer des informations à la page en ajoutant des choses dans l'url
     */
    $userId = intval($_GET['user_id']);

    $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
    ?>

        <aside>
            <?php
            /**
             * Etape 3: récupérer le nom de l'utilisateur
             */
            $SQLQuery = "SELECT * FROM users WHERE id= '$userId' ";
            $Res = $mysqli->query($SQLQuery);
            $user = $Res->fetch_assoc();
            //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
            ?>
            <img src="../Images/picnic.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez tous les message de l'utilisatrice : <?php echo $user['alias'] ?>
                    (n° <?php echo $userId ?>)
                </p>
            </section>
            <?php include 'followbtn.php' ?>
            <audio controls >
                <source src="swimming.mp3" autoplay="false" type="audio/mpeg"/>
                Your browser does not support the audio element.
            </audio>
        </aside>
        <main>
            <article>
                <?php include 'postmessage.php' ?>
            </article>
            <?php
            /**
             * Etape 3: récupérer tous les messages de l'utilisatrice
             */
            $SQLQuery = "
                    SELECT posts.content, posts.created, users.alias as author_name, posts.id, posts.user_id,
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist, GROUP_CONCAT(DISTINCT tags.id) AS tag_ids
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
      $Res = $mysqli->query($SQLQuery);
      if (!$Res) {
        echo ("Échec de la requete : " . $mysqli->error);
      }

      //display user's posts
      while ($post = $Res->fetch_assoc()) {
        ?>
        <article>
        <?php include '../Components/article.php' ?>

        </article>
      <?php } ?>


    </main>
  </div>
</body>

</html>