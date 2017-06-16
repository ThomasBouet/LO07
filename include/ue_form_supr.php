<?php
include_once('database.php');
include_once('bibliotheque.php');
if (isset($_POST)) {
    $post = $_POST["ue"];
    echo("$post");
    $requete = "DELETE FROM Ue WHERE IdUe = '$post'";
    $resultat = mysqli_query($database, $requete);
    echo("[$requete]");
    if ($resultat) {
        echo("oui");
    } else {
        echo("non");
        mysqli_error($database);
    }
}