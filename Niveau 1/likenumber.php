<?php
// Step 1 - check if the form was submitted 
/*
if (isset($post['like_number'])) {
    $userId = $_SESSION['connected_id'];
    $postId = intval($post['id']);

    //$request = "SELECT * FROM followers ";
    //$SQL = $mysqli->query($request);


    $postId = intval($mysqli->real_escape_string($postId));
    $userId = $mysqli->real_escape_string($userId);


    $SQL ="INSERT INTO likes"
    . "(id, user_id, post_id) "
    . "VALUES (NULL, $userId, $postId );";

    header("Location: " . $_SERVER['HTTP_REFERER']);

    $ok = $mysqli->query($SQL);
    if (!$ok) {
        echo "Impossible de like " . $mysqli->error;
    } else {
        echo "liked"  ;
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

