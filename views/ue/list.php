<?php
$page='uelist';
require('layout/header.php');
include_once('include/database.php');
include_once('include/bibliotheque.php');
include_once('include/elmt_formation.php');
$num = array(1, 2, 3, 4, 5, 6);

$cat = selectdata("IdCat", "Categorie_UE", $database);
$affectation = array('TC', 'BR', 'TCBR', 'FCBR');
$yesno = array('Y', 'N');
$sql = "SELECT * FROM Ue";
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
            <li class="breadcrumb-item">Gestion des UE</li>
            <li class="breadcrumb-item active">Affichage des UE</li>
        </ol>
        <?php flash( 'status' ); ?>
        <div class="card">
            <div class="card-block">
                <table class="table">
                    <thead class="thead-default">
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Affectation</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($resultats as $table){
                        $Id=$table["IdUe"];
                        $desc=$table["desc"];
                        $categorie=$table["cat"];
                        $affect=$table["affectation"];
                        echo("
                            <tr >
                                <td>$Id</td>
                                <td>$categorie</td>
                                <td>$affect</td>
                                <td>$desc</td>
                                <form action='' method='post'>
                                    <input id='ue' name='ue[]' value=$Id type='hidden'>
                                    <td align='right'><button type='submit' class='btn btn-danger'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
                                        </button></td>
                                </form>
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
