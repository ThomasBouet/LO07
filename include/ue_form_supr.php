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
        flash( 'status', '<strong>Succès</strong>! L\'UE '.$ue.' a bien été suppprimée','alert alert-success');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        flash( 'status', '<strong>Erreur!</strong>','alert alert-danger');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        mysqli_error($database);
    }
}

