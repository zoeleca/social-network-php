<?php
// Initiate session and get the user id
session_start();
$userId = intval($_SESSION['connected_id']);

// initiate connection with the database

$mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
//check for errors during connexion
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

//check that the script received the proper inputs from the page
if (isset($_POST['like_number'], $_POST['post_id'])) {
// Get the post ID from the form submission
  $post_id = intval($_POST["post_id"]);

// Check if the user has already liked the post
  $checkLikes = "SELECT * FROM likes WHERE user_id = $userId AND post_id = $post_id";
  $result = $mysqli->query($checkLikes);

  if ($result && $result->num_rows > 0) {
    // User has already liked the post
    echo ("Like déjà apposé");
    exit;
  } else {
     // Insert a new like into the database
    $addLike = "INSERT INTO likes "
      . "(id, user_id, post_id)" . "VALUES (NULL, $userId, $post_id)";
    if (!$mysqli->query($addLike)) {
      echo "Error: " . $mysqli->error;
      exit;
    }
  }
  // Go back to the original page
  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit;
} else {
  echo ("Échec de la connexion 3125");
  exit;
}






