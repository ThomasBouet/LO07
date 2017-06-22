<?php
include_once "database.php";
$etu = $match['params']['id'];
$cursus = $match['params']['cursus'];
$ues=[];
foreach ($_POST["ue"] as $post){
    $ues[]=$post;
}

foreach ($ues as $ue) {
    $sql = "DELETE FROM ElemForm WHERE IdEleve= '$etu' AND IdParcours='$cursus' AND Sigle='$ue'";
    $resultat = mysqli_query($database, $sql);
    if ($resultat) {
        flash( 'status', '<strong>Success</strong>! UE effacée','alert alert-success');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        flash( 'status', '<strong>Erreur!</strong>','alert alert-danger');
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        mysqli_error($database);
    }
}