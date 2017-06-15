<?php
    include('include/database.php');
    include('include/bibliotheque.php');

    if (isset ($_POST['IdEtu'],$_POST['nom'],$_POST['prenom'],$_POST["admission"],$_POST['filiere'])){
        $IdEtu=$_POST['IdEtu'];
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $admission=$_POST['admission'];
        $filiere=$_POST['filiere'];
        $requete="INSERT INTO `Etudiant` VALUES ('$IdEtu','$nom','$prenom','$admission','$filiere')";
        $resultat=mysqli_query($database,$requete);
        if ($resultat){
            echo("oui");
        }
        else {
            echo ("non");
            mysqli_error($database);
        }
    }
    else {
        echo("pas de bonnes entrees");
    }