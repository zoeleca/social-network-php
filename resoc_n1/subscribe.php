<?php
// Start session
session_start();

// Step 1: Get the user ID from the session or URL parameter
$userId = isset($_SESSION['connected_id']) ? $_SESSION['connected_id'] : intval($_GET['user_id']);

// Step 2: Connect to the database
$mysqli = new mysqli("localhost", "root", "root", "socialnetwork");

// Step 3: Execute SQL query to fetch followed users
$laQuestionEnSql = "
    SELECT users.* 
    FROM followers 
    LEFT JOIN users ON users.id = followers.followed_user_id
    WHERE followers.following_user_id = '$userId'
    GROUP BY users.id
";
$lesInformations = $mysqli->query($laQuestionEnSql);

// Step 4: Process followed users
while ($row = $lesInformations->fetch_assoc()) {
        $followedUserId = $row["followed_user_id"]; // Assuming this is the column name from your database

        // Insert into following table
        $addFollowingQuery = "INSERT INTO following (following_user_id, followed_user_id)
                          VALUES ('$userId', '$followedUserId')";

        // Insert into followers table
        $addFollowersQuery = "INSERT INTO followers (following_user_id, followed_user_id)
                          VALUES ('$followedUserId', '$userId')";

        // Execute queries
        if ($mysqli->query($addFollowingQuery) === TRUE && $mysqli->query($addFollowersQuery) === TRUE) {
                echo "New records inserted successfully.";
        } else {
                echo "Error: " . $mysqli->error;
        }
}
// récupérer l'id de la session et celle sur laquelle je clique
// comment formater sous forme de requête post pour mettre en bdd
// Close database connection
$mysqli->close();
