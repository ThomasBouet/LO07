<?php
session_start();
$page='studentlist';
require('layout/header.php');
require_once('include/database.php');
require_once('include/bibliotheque.php');
$sql1 = "SELECT * FROM Etudiant WHERE IdEtu=".$match['params']['id'];
$res1 = mysqli_query($database, $sql1);
$students = array();
while ($row = mysqli_fetch_array($res1)) {
    $students[] = $row;
}
$student=$students[0];

$sql2 = "SELECT DISTINCT `IdParcours` FROM `ElemForm` WHERE IdEleve =".$student['IdEtu']." ORDER BY `IdParcours` ASC";
$res2 = mysqli_query($database, $sql2);
$parcours = array();
while ($row = mysqli_fetch_array($res2)) {
    $parcours[] = $row[0];
}
$etu=$student['IdEtu'];
?>

<div class="content-wrapper py-3">
    <div class="container-fluid">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item ">Projet LO07</li>
            <li class="breadcrumb-item "><a href="/student">Gestion des utilisateurs</a></li>
            <li class="breadcrumb-item active">Affichage de <?php echo($student['prenom']." ".$student['nom']);?></li>
        </ol>
        <div class="row">
            <div class="col col-2">
                <div class="card card-outline-primary mb-3 text-center">
                    <h4 class="card-title">Informations sur l'Étudiant</h4>
                    Nom: <?php echo($student['prenom']);?></br>
                    Prénom: <?php echo($student['nom'])?></br>
                    Numéro Étudiant: <?php echo($student['IdEtu']);?>
                </div>
                <a href="<?php echo($student['IdEtu'])?>/create" class="btn btn-primary btn-lg btn-block">Ajouter un cursus</a>
            </div>
            <div class="col col-10">
                <?php flash( 'status' ); ?>
                <div class="card">
                    <div class="card-header">
                        Cursus de l'Étudiant
                    </div>
                    <div class="card-block">
                        <table class="table">
                            <?php
                                if(count($parcours)==0){
                                    echo('
                                    <div class="card card-inverse card-info text-center">
                                        <div class="card-block">
                                            <blockquote class="card-blockquote">
                                                Aucun cursus enregistré pour cet étudiant
                                            </blockquote>
                                        </div>
                                    </div>
                                    ');
                                } else {
                                    echo('
                                    <thead class="thead-default">
                                        <tr>
                                            <th>Nom du cursus</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ');

                                    foreach ($parcours as $table) {
                                        $Id = $table;
                                        echo("
                                    <tr >
                                        <td>Cursus n°$Id</td>
                                        <td align='right'><a href='$etu/$Id' class='btn btn-primary'>Acceder</td>
                                    </tr>
                                        ");
                                    };
                                    echo('</tbody>');
                                }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
