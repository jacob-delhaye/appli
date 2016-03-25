<?php
    // on se connecte à MySQL 
    $db = mysql_connect('shakinboiz3.mysql.db', 'shakinboiz3', '3Bananes'); 
    mysql_select_db('shakinboiz3',$db); 

    if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email'])) {
        extract($_POST);
        $password = sha1($_POST['password']);
      
        // on recupére l'id de la table qui correspond au login du visiteur
        $sql = "select id_util, mail_util from utilisateur where login_util='".$login."'";
        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

        $data = mysql_fetch_assoc($req);

        if($data['id_util'] > 0) {
          echo '<div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Oh Non !</strong> Le login existe déjà. Merci de recommencer !
      </div>';
      var_dump($data);
        }
        
        else {
          mysql_query("INSERT INTO utilisateur VALUES('','$login','$password', '', '', '$email', '')");
          session_start();
          $_SESSION['login'] = $login;
          header('location:../filactu');
        }    
      }
    else {
      $champs = '<p><b>(Remplissez tous les champs pour vous connectez !)</b></p>';
    }

?>
