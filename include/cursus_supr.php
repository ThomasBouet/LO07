<?php
include "database.php";
$etu = $match['params']['id'];
$cursus = $match['params']['cursus'];

$sql = "DELETE FROM ElemForm WHERE IdEleve= '$etu' AND IdParcours='$cursus'";
$resultat = mysqli_query($database, $sql);
if ($resultat) {
    echo("Cursus effacé avec succès !");
} else {
    echo("non");
    mysqli_error($database);
}

