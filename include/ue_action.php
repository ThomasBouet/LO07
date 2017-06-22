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
    flash( 'status', 'Ue ajouté avec <strong>succès</strong>!','alert alert-success');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    flash( 'status', '<strong>Mince Alors!</strong> Quelque chose c\'est mal passé (Mysql)','alert alert-danger');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    mysqli_error($database);
}