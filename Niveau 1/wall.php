<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>ReSoC - Mur</title>
  <meta name="author" content="Julien Falconnet">
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php
  include 'header.php';
  ?>
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
    ?>
    <?php
    /**
     * Etape 2: se connecter à la base de donnée
     */
    $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
    ?>

    <aside>
      <?php
      /**
       * Etape 3: récupérer le nom de l'utilisateur
       */
      $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
      $lesInformations = $mysqli->query($laQuestionEnSql);
      $user = $lesInformations->fetch_assoc();
      //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
      ?>
      <?php
        include 'aside.php';
      ?>
        </p>
      </section>
    </aside>
    </aside>
    <main>
      <?php
      /**
       * Etape 3: récupérer tous les messages de l'utilisatrice
       */
      $laQuestionEnSql = "
                    SELECT posts.content, posts.created, users.alias as author_name, 
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
      $lesInformations = $mysqli->query($laQuestionEnSql);
      if (!$lesInformations) {
        echo ("Échec de la requete : " . $mysqli->error);
      }

      /**
       * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
       */
      while ($post = $lesInformations->fetch_assoc()) {

        $date = new DateTime($post['created']);
        $timeZone = (iterator_to_array(IntlTimeZone::createEnumeration('FR')));
        $tz = reset($timeZone);
        $formatter = IntlDateFormatter::create(
          'fr_FR',
          IntlDateFormatter::FULL,
          IntlDateFormatter::SHORT,
          $tz,
          IntlDateFormatter::GREGORIAN
        );

        ?>
        <article>
          <h3>
            <time datetime='2020-02-01 11:12:13'>
              <?php echo ucwords($formatter->format($date)) ?>
            </time>
          </h3>
          <address>
            <?php echo $post['author_name'] ?>
          </address>
          <div>
            <p>
              <?php echo $post['content'] ?>
            </p>
          </div>
          <?php
          include 'footer.php';
          ?>
        </article>
      <?php } ?>


    </main>
  </div>
</body>

</html>