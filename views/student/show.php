<?php
$page='studentlist';
require('layout/header.php');
require_once('include/database.php');
require_once('include/bibliotheque.php');
$sql = "SELECT * FROM Etudiant WHERE IdEtu=".$match['params']['id'];
$res = mysqli_query($database, $sql);
$resultats = array();
while ($row = mysqli_fetch_array($res)) {
    $resultats[] = $row;
}
$resultats=$resultats[0];
?>

<div class="content-wrapper py-3">
    <div class="container-fluid">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item ">Projet LO07</li>
            <li class="breadcrumb-item ">Gestion des utilisateurs</li>
            <li class="breadcrumb-item active">Affichage</li>
        </ol>
        <div class="row">
            <div class="col col-2">
                <div class="card card-outline-primary mb-3 text-center">
                    <h4 class="card-title">Informations sur l'Étudiant</h4>
                    Nom: <?php echo($resultats['prenom']);?></br>
                    Prénom: <?php echo($resultats['nom'])?></br>
                    Numéro Étudiant: <?php echo($resultats['IdEtu']);?>
                </div>
            </div>
            <div class="col col-10">
                <div class="card">
                    <div class="card-header">
                        Cursus de l'Étudiant
                    </div>
                    <div class="card-block">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
