<?php 
session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// Suppression des cookies de connexion automatique
setcookie('login', '');
setcookie('password', '');

//redirige vers la page activité aléatoire
header('location:../acti');
?>
