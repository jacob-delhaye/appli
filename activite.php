<?php

    // Connexion à la BDD
    $db = mysql_connect('shakinboiz3.mysql.db', 'shakinboiz3', '3Bananes'); 
    mysql_select_db('shakinboiz3',$db);

    //recupération l'id de l'activité acceptée
    $recup_id = isset($_POST['recup_id'])?$_POST['recup_id']:NULL;
    session_start();

    $id_login = $_SESSION['id_session'];

    //si l'user est connectée et donc id_session est rempli
    if(isset($id_login)) {
      //insère dans la table actiEnCours les données
        mysql_query("INSERT INTO `actiEnCours` (`enCours_acti`, `enCours_util`) VALUES ('$recup_id', '$id_login')");
        
    }

?>
