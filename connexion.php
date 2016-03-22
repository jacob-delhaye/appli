<?php
    // on se connecte à MySQL 
    $db = mysql_connect('shakinboiz3.mysql.db', 'shakinboiz3', '3Bananes'); 
    mysql_select_db('shakinboiz3',$db); 

    if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['password'])) {
        extract($_POST);
        $password = sha1($_POST['password']);
      
        // on recupère le password de la table qui correspond au login du visiteur
        $sql = "select mdp_util from utilisateur where login_util='".$login."'";
        $req = mysql_query($sql) or die ('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

        $data = mysql_fetch_assoc($req);

        if($data['mdp_util'] != $password) {
          echo '<div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Oh Non !</strong> Mauvais login / password. Merci de recommencer !
      </div>';
        }
        
        else {
          session_start();
          $_SESSION['login'] = $login;

          header('location:../filactu');
        }    
      }
    else {
      $champs = '<p><b>(Remplissez tous les champs pour vous connectez !)</b></p>';
    }

?>
