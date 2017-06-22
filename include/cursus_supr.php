<?php
include_once "database.php";
$etu = $match['params']['id'];
$cursus = $match['params']['cursus'];

$sql = "DELETE FROM ElemForm WHERE IdEleve= '$etu' AND IdParcours='$cursus'";
$resultat = mysqli_query($database, $sql);
if ($resultat) {
    flash( 'status', '<strong>Succès</strong>! Cursus effacé avec succès','alert alert-success');
    header('Location:' . '/student/' . $etu);
} else {
    flash( 'status', '<strong>Erreur!</strong>','alert alert-danger');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    mysqli_error($database);
}

