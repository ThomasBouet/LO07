<?php
include "database.php";
$etu = $_POST["etu"];
$cursus = $_POST["cursus"];
echo("<pre>");
print_r($_POST);
echo("</pre>");
$ues=[];
foreach ($_POST["ue"] as $post){
    $ues[]=$post;
}

foreach ($ues as $ue) {
    $sql = "DELETE FROM ElemForm WHERE IdEleve= '$etu' AND IdParcours='$cursus' AND Sigle='$ue'";
    $resultat = mysqli_query($database, $sql);
    if ($resultat) {
        echo("Ue effacée avec succès !");
    } else {
        echo("non");
        mysqli_error($database);
    }
}