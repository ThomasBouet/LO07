<?php
require_once 'database.php';
require_once 'bibliotheque.php';


$etu = $_POST["etu"];

$sql="SELECT MAX(IdParcours) FROM ElemForm WHERE IdEleve=$etu";
$resu = mysqli_query($database, $sql);
$parcourstab = mysqli_fetch_array($resu);
$parcours= $parcourstab[0]+1;

for ($i = 0; $i < count($_POST["ue"]); $i++) {
    $ue = $_POST["ue"][$i];
    $num = $_POST["num"][$i];
    $sem = $_POST["sem_label"][$i];
    $profil = $_POST["profil"][$i];
    $utt = $_POST["UTT"][$i];
    $res = $_POST["resultat"][$i];
    if ($res=='F' or $res=="ABS"){
        $credits=0;
    }
    else {
        $sql="SELECT credit FROM Ue Where IdUe='$ue'";
        $resu = mysqli_query($database, $sql);
        $credits = mysqli_fetch_array($resu);

    }




    $requete = "INSERT INTO `ElemForm` VALUES ('$etu','$num','$sem','$ue','$utt','$profil','$credits[0]','$res','$parcours')";

    $resultat = mysqli_query($database, $requete);
    if ($resultat) {
        echo("parcours enregistre sur $parcours");
    } else {
        echo("erreur");
        mysqli_error($database);
    }
}

?>