<?php 
if (isset($_POST['following_id'])) {
    $followingId = intval($_POST['following_id']);
    $followerId = $_SESSION['connected_id'];
    $followingId = intval($mysqli->real_escape_string($followingId));
    $followerId = $mysqli->real_escape_string($followerId);


    $SQLQuery ="INSERT INTO followers"
    . "(id, followed_user_id, following_user_id) "
    . "VALUES (NULL, $followingId, $followerId );";

    $Res = $mysqli->query($SQLQuery);
    if (!$Res) {
        echo "Impossible d'ajouter le message: " . $mysqli->error;
    } else {
        echo "User followed n° "  . $followingId ."by". $followerId ;
    }

}

?>
<?php
if(isset($_SESSION['connected_id']) && ($_SESSION['connected_id']) != $userId ) {?>
<form action="wall.php?user_id=<?php echo $userId ?>" method="post">
    <input type='hidden' name='following_id' value="<?php echo $userId ?>">
    <button class='btn' type='submit'>Subscribe</button>
</form>
<?php } ?>