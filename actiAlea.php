<?php
$lieu=$_GET['var1'];
$accompagnemment=$_GET['var2'];
$comment=$_GET['var3'];
$db = new PDO('mysql:host=shakinboiz3.mysql.db;dbname=shakinboiz3;charset=utf8', 'shakinboiz3', '3Bananes');
// session_start();
// $id_session=$_SESSION['id_session'];
$id_session=6;
$stat=$db->query("SELECT * FROM statistique WHERE stat_util=$id_session");
$stat_id=$stat->rowCount();
#######  L'utilisateur est connecté et table statistiques remplie  ########
if(isset($id_session)&&($stat_id != 0)){
    $nbcate=$db->query("SELECT * FROM categorie"); // nombre de catégories
    $cate=$nbcate->rowCount();
    // classer les cate préférées de l user
    $request=$db->query("SELECT *,SUM(choix_a) FROM statistique,categorie,appartient WHERE  stat_util=$id_session AND appart_acti=stat_acti AND id_cate=appart_cate GROUP BY nom_cate ORDER BY SUM(choix_a) DESC");
    while($donnees = $request->fetch(PDO::FETCH_ASSOC)){
   $pref[]=$donnees['appart_cate'];
    }
    for($i=1;$i<=$cate;$i++){    $proba[$i]=1; /* 8.3% */   }
    $proba[$pref[0]]=4; // 33%
    $proba[$pref[1]]=3; //25%
    $proba[$pref[2]]=2; // 17%
    //Le nombre aléatoire, alea, sera compris entre 1 et $cate+6 //  6= (4 + 3+ 2)-3
    $alea=rand(1,$cate+6);
    // La somme sera initialisée à 0;
    $somme = 0;
    // On récupère l’ID de l’activité qui correspond au nombre aléatoire
	for($compteur=0;$somme<$alea;$compteur++){        $somme=$somme + $proba[$compteur];    }
    $catePref=$compteur-1;
    if($accompagnemment==0){
        $request=$db->query("SELECT * FROM activite,enFonction,sePratique,appartient WHERE id_acti=pratique_acti AND fonction_acti=id_acti AND pratique_lieu= $lieu AND fonction_hum=$comment AND appart_cate=$catePref");
    }
    else if($accompagnemment==1){
        $request=$db->query("SELECT * FROM activite,sexerce,sePratique,appartient WHERE id_acti=pratique_acti AND sexerce_acti=id_acti AND pratique_lieu= $lieu AND sexerce_comp=$comment AND appart_cate=$catePref");
}
########   L'utilisateur n'est pas connecté ou n'a pas de compte   ########
}else{
    if($accompagnemment==0){ // Il est seul
  $request=$db->query("SELECT * FROM activite,enFonction,sePratique WHERE id_acti=pratique_acti AND fonction_acti=id_acti AND pratique_lieu= $lieu AND fonction_hum=$comment");
}
else if($accompagnemment==1){ // Il est accompagné
  $request=$db->query("SELECT * FROM activite,sexerce,sePratique WHERE id_acti=pratique_acti AND sexerce_acti=id_acti AND pratique_lieu= $lieu AND sexerce_comp=$comment");
}
}

$total=$request->rowCount();
$nbAlea=rand(0,$total-1);

while($donnees = $request->fetch(PDO::FETCH_ASSOC)){
  $activite[]=$donnees;
}
echo(json_encode($activite[$nbAlea]));
?>
