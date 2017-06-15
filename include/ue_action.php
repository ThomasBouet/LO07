
<?php
include('include/database.php');
include('include/bibliotheque.php');

if (isset($_POST)) {
    for ($i = 1; $i < count($_POST["sigle"]); $i++) {
        $sigle = $_POST["sigle"][$i];
        $desc = $_POST["desc"][$i];
        $categorie = $_POST["categorie"][$i];
        $affectation = $_POST["affectation"][$i];
        $credits = $_POST["credits"][$i];
        $requete = "INSERT INTO `Ue` VALUES ('$sigle','$desc','$credits','$affectation','$categorie')";
        $resultat = mysqli_query($database, $requete);
        if ($resultat) {
            echo("oui");
        } else {
            echo("erreur");
            mysqli_error($database);
        }
    }
}
else {
        echo("pas de bonnes entrees");
    }




?>