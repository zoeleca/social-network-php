<?php
session_start();
// Initialize $userId variable
$userId = null;
// Check if the user is logged in
if (isset($_SESSION['connected_id'])) {
    $userId = $_SESSION['connected_id'];
} else {
    // Redirect to login page if user is not logged in
    echo ("you need to login first :)");
    header("Location: ../Pages/login.php");
    exit();
}
?>
<img src="img/tulip.jpg" alt="Logo de notre réseau social" />
<nav id="menu">
    <a href="../Pages/news.php">Actualités</a>
    <a href="../Pages/wall.php?user_id=<?php echo $userId ?>">Mur</a>
    <a href="../Pages/feed.php?user_id=<?php echo $userId ?>">Flux</a>
    <a href="../Pages/tag.php">Mots-clés</a>
</nav>
<nav id="user">
    <a href="#">Profil</a>
    <ul>
        <li><a href="../Pages/settings.php?user_id=<?php echo $userId ?>">Paramètres</a></li>
        <li><a href="../Pages/followers.php?user_id=<?php echo $userId ?>">Mes suiveurs</a></li>
        <li><a href="../Pages/subscriptions.php?user_id=<?php echo $userId ?>">Mes abonnements</a></li>
    </ul>

</nav>