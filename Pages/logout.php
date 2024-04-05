<?php
// Start the session
session_start();

// Unset all session variables --> learn about array()
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other page
header("Location: login.php");
exit();
?>