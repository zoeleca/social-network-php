<?php 
session_start();
if ($_SESSION['connected_id'] !== TRUE) {
    header("Location: http://localhost/reseau-social-php-zoe_remi_philippe/Niveau1/login.php");
    echo 'You must log in first'; 
    exit();
}
else {
    $_SESSION['connected_id']=$user['id'];
}
?>