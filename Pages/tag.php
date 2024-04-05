<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>ReSoC - Mes abonnés </title>
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
                <p>Sur cette page vous trouverez la liste des mots-clés. </p>
            </section>
        </aside>


        <main class='contacts'>
            <?php
            //DB Connection
            $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
            $SQLQuery = "
                    SELECT *
                    FROM tags
                    ";
            $Res = $mysqli->query($SQLQuery);


            //displaying tags label and id
            while ($tag = $Res->fetch_assoc()) {
            ?>
                <article>
                    <a href="tags.php?tag_id=<?php echo $tag['id'] ?>">
                        <h3><?php echo $tag['label'] ?></h3>
                    </a>
                    <p>Id : <?php echo $tag['id'] ?></p>
                </article>
            <?php } ?>
        </main>
    </div>
</body>

</html>