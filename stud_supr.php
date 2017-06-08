<?php
    include('database.php');
    include('bibliotheque.php');
    $nom=array();
    $nom = selectdata("nom","Etudiant",$database);
    var_dump($nom);
    echo("<form method=\"POST\" action=\"stud_supr.php\">");
    echo(genereSelect($nom,"etu","etu"));
    echo("<input type=submit>");
    echo("</form>");


    print_r($_POST);
    $post=$_POST["etu"];
    echo("$post");
    $requete= "DELETE FROM Etudiant WHERE nom = '$post'";
    $resultat=mysqli_query($database,$requete);
    echo("[$requete]");
    var_dump($resultat);
    if ($resultat){
        echo("oui");
    }
    else {
        echo ("non");
        mysqli_error($database);
    }




?>

