<?php
    require_once 'database.php';
    require_once 'bibliotheque.php';

    if (isset ($_POST['IdEtu'],$_POST['nom'],$_POST['prenom'],$_POST["admission"],$_POST['filiere'])){
        $IdEtu=$_POST['IdEtu'];
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $admission=$_POST['admission'];
        $filiere=$_POST['filiere'];
        $requete="INSERT INTO `Etudiant` VALUES ('$IdEtu','$nom','$prenom','$admission','$filiere')";
        $resultat=mysqli_query($database,$requete);
        if ($resultat){
            flash( 'status', 'Utilisateur ajouté avec <strong>succès</strong>!','alert alert-success');
            header('Location: ' . '/student/' . $IdEtu);
        }
        else {
            flash( 'status', '<strong>Mince Alors!</strong> Quelque chose c\'est mal passé (Mysql)','alert alert-danger');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            mysqli_error($database);
        }
    }
    else {
        flash( 'status', '<strong>Mince Alors!</strong> Quelque chose c\'est mal passé (wrong input)','alert alert-danger');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }