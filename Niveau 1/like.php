<?php
session_start();
$userId = intval($_SESSION['connected_id']);

$mysqli = new mysqli("localhost", "root", "root", "socialnetwork");

// Include necessary files

if (isset($_POST['like_number'], $_POST['post_id'])) {
  // Get the post ID from the form submission
  $post_id = intval($_POST["post_id"]);
  $userId = intval($_SESSION['connected_id']);

  // Update the like count in the database
  $addLike = "INSERT INTO likes "
    . "(id, user_id, post_id)" . "VALUES (NULL, $userId, $post_id)"
  ;
  // Perform necessary database operations to increment the like count
  $ok = $mysqli->query($addLike);

  // Redirect back to the original page after updating the like count
  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit;
} else {
  echo ("Échec de la connexion 3125");
  exit;
}

