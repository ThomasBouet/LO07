<?php
include_once('database.php');
include_once('bibliotheque.php');

$ues=[];
foreach ($_POST["ue"] as $post){
    $ues[]=$post;
}

foreach ($ues as $ue) {
    $sql = "DELETE FROM Ue WHERE IdUe='$ue'";
    $resultat = mysqli_query($database, $sql);
    if ($resultat) {
        echo("Ue effacée avec succès !");
    } else {
        echo("non");
        mysqli_error($database);
    }
}

