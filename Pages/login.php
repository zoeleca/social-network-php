<?php
session_start();
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Connexion</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div id="wrapper">

        <aside>
            <h2>Présentation</h2>
            <p>Bienvenue sur notre réseau social.</p>
        </aside>
        <main>
            <article>
                <h2>Connexion</h2>
                <?php
                
                $loading = isset($_POST['email']);
                if ($loading) {


                    $emailEntered = $_POST['email'];
                    $pWEntered = $_POST['motdepasse'];

                    $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
                    
                    // to not have sql injection : 
                    $emailEntered = $mysqli->real_escape_string($emailEntered);
                    $pWEntered = $mysqli->real_escape_string($pWEntered);
                    
                    
                    $pWEntered = md5($pWEntered);
                    

                    $SQLQuery = "SELECT * "
                        . "FROM users "
                        . "WHERE "
                        . "email LIKE '" . $emailEntered . "'";

                    $res = $mysqli->query($SQLQuery);
                    $user = $res->fetch_assoc();
                    if (!$user or $user["password"] != $pWEntered) {
                        echo "La connexion a échouée. ";
                    } else {
                        echo "Votre connexion est un succès : " . $user['alias'] . ".";

                        $_SESSION['connected_id'] = $user['id'];
                        $id = $user['id'];
                        header("Location: wall.php?user_id=$id");
                    }
                }
                ?>
                <form action="login.php" method="post">
                    <input type='hidden' name='???' value='achanger'>
                    <dl>
                        <dt><label for='email'>E-Mail</label></dt>
                        <dd><input type='email' name='email'></dd>
                        <dt><label for='motdepasse'>Mot de passe</label></dt>
                        <dd><input type='password' name='motdepasse'></dd>
                    </dl>
                    <input class='btn' type='submit'>
                </form>
                <p>
                    Pas de compte?
                    <a href='registration.php'>Inscrivez-vous.</a>
                </p>

            </article>
        </main>
    </div>
</body>

</html>