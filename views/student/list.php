<?php
$page='studentlist';
require('layout/header.php');
include_once('include/database.php');
include_once('include/bibliotheque.php');
$sql = "SELECT * FROM Etudiant";
$res = mysqli_query($database, $sql);
$resultats = array();
while ($row = mysqli_fetch_array($res)) {
    $resultats[] = $row;
}
?>

<div class="content-wrapper py-3">
    <div class="container-fluid">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Projet LO07</li>
            <li class="breadcrumb-item">Gestion des utilisateurs</li>
            <li class="breadcrumb-item active">Affichage</li>
        </ol>

        <div class="card">
            <div class="card-block">
                <table class="table">
                    <thead class="thead-default">
                    <tr>
                        <th>Numéro Étudiant</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Admission</th>
                        <th>Filière</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($resultats as $table){
                        $Id=$table["IdEtu"];
                        $nom=$table["nom"];
                        $prenom=$table["prenom"];
                        $admission=$table["admission"];
                        $filiere=$table["filiere"];
                        echo("
                            <tr >
                                <td>$Id</td>
                                <td>$nom</td>
                                <td>$prenom</td>
                                <td>$admission</td>
                                <td>$filiere</td>
                                <td align='right'><a href='student/$Id' class='btn btn-primary'/>Acceder</td>
                            </tr>
                        ");
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>

