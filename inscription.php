<?php
    $login=$_POST["login"];
    $email=$_POST["email"];
    //retourne un nombre hexadecimal de 32 caractères pour éviter d'enregistrer les mdp des utilisateurs
    $mdpConnex=md5($_POST["mdp"]); //pour la page connexion
    $mdpInscri=md5($_POST["mdp"]); //pour la page déconnexion
    //$bdd = new PDO('mysql:host=shakinboiz3.mysql.db;dbname=shakinboiz3;charset=utf8', 'shakinboiz3', '3Bananes');
    $user="shakinboiz3";
    $passwd="3Bananes";
    $host="shakinboiz3.mysql.db";
    $bdd="shakinboiz3";
    $connexion=mysqli_connect($host, $user, $passwd) or die ("connexion refusee");
    mysqli_select_db($connexion, $bdd);

    $insert="INSERT INTO utilisateur VALUES ('', '$login', '$mdpInscri', '', '', '$email', '')";
    mysqli_query($connexion, $insert) or die ("Connexion nulle");
    
    header('location:../acti');
    
?>
