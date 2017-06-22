<?php
include "database.php";
$etu = $match['params']['id'];
$cursus = $match['params']["cursus"];


$sql = "SELECT * FROM ElemForm WHERE IdEleve= '$etu' AND IdParcours='$cursus'";
$res = mysqli_query($database, $sql);
$resultats=array();
while ($row = mysqli_fetch_array($res))
{
    $resultats[] = $row;
}
var_dump($sql);
echo("<pre>");

echo("</pre>");


$sqlparcours="SELECT MAX(IdParcours) FROM ElemForm";
$resu = mysqli_query($database, $sqlparcours);
$parcourstab = mysqli_fetch_array($resu);
$parcours= $parcourstab[0]+1;



for ($i=0;$i<count($resultats);$i++){
    $idetu = intval($resultats[$i]["IdEleve"]);
    $sem = intval($resultats[$i]["sem_seq"]);
    $semlab = $resultats[$i]["sem_label"];
    $sigle = $resultats[$i]["sigle"];
    $utt = $resultats[$i]["utt"];
    $profil = $resultats[$i]["profil"];
    $credit = intval($resultats[$i]["creditobt"]);
    $resul = $resultats[$i]["resultat"];


    var_dump($idetu,$sem,$semlab,$sigle,$utt,$profil,$credit,$resul,$parcours);



    $requete = "INSERT INTO `ElemForm` VALUES ('$idetu','$sem','$semlab','$sigle','$utt','$profil','$credit','$resul','$parcours')";
echo("</br>");
    var_dump($requete);

    $resultat = mysqli_query($database, $requete);
    if ($resultat) {
//        echo("parcours enregistre sur $parcours");
        flash( 'status', '<strong>Parcours dupliqué</strong> avec success sur le cursus n°'.$parcours,'alert alert-success');
        header('Location:' . '/student/' . $etu . '/' . $parcours);
    } else {
//        echo("erreur");
        flash( 'status', '<strong>Mince Alors!</strong> Erreur','alert alert-danger');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        mysqli_error($database);
    }


}






