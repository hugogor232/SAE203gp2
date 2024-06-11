<?php
session_start();

include ('functions.php');

$valid_username = 'user';
$valid_password = 'bonjour';

if ($_POST['username'] === $valid_username && $_POST['password'] === $valid_password) {
    $_SESSION['pseudo'] = $valid_username;
    header('Location: profil.php');
    exit;
} else {
    header('Location: login.php?error=1');
    exit;
}

?>