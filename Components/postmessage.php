<?php


$mysqli = new mysqli("localhost", "root", "root", "socialnetwork");


$listAuteurs = [];
$laQuestionEnSql = "SELECT * FROM users";
$lesInformations = $mysqli->query($laQuestionEnSql);
while ($user = $lesInformations->fetch_assoc()) {
    $listAuteurs[$user['id']] = $user['alias'];
}


$enCoursDeTraitement = isset($_POST['auteur']);
if ($enCoursDeTraitement) {

    //echo "<pre>" . print_r($_POST, 1) . "</pre>";

    $authorId = $_POST['auteur'];
    $postContent = $_POST['message'];


    $authorId = intval($mysqli->real_escape_string($authorId));
    $postContent = $mysqli->real_escape_string($postContent);


    $SQLQuery = "INSERT INTO posts "
        . "(id, user_id, content, created, parent_id) "
        . "VALUES (NULL, "
        . $authorId . ", "
        . "'" . $postContent . "', "
        . "NOW(),"
        . "NULL);";

    $Res = $mysqli->query($SQLQuery);
    if (!$Res) {
        echo "Impossible d'ajouter le message: " . $mysqli->error;
    } else {
        echo "Message posté en tant que :" . $listAuteurs[$authorId];
    }
}
?>
<form action="../Pages/wall.php?user_id=<?php echo $userId ?>" method="post">
    <input type='hidden' name='auteur' value='<?php echo $userId ?>'>
    <dt><label for='message'></label></dt>
    <dd><textarea name='message' placeholder="Poster un message..."></textarea></dd><br>
    <!--
    <dt><label for='tag'></label></dt>
    <input type='hidden' name='tag' value='???'>
    <dd><input name='tag' placeholder='#Ajouter un tag'></input></dd><br>
    </dl>
-->
    <input type='submit'>
</form>