<?php
require_once 'database.php';
require_once 'bibliotheque.php';

$sigle = $_POST["sigle"];
$desc = $_POST["desc"];
$categorie = $_POST["categorie"];
$affectation = $_POST["affectation"];
$credits = $_POST["credits"];
$requete = "INSERT INTO `Ue` VALUES ('$sigle','$desc','$credits','$affectation','$categorie')";
$resultat = mysqli_query($database, $requete);
if ($resultat) {
    echo("oui");
} else {
    echo("erreur");
    mysqli_error($database);
}