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
        <div class="card">
            <div class="card-block">
                <table class="table">
                    <thead class="thead-default">
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Affectation</th>
                        <th>Description</th>
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
                            </tr>
                        ");
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>








    </div>
    <script>
        var counter = 0;
        var limit = 30;
        var original = document.getElementById('dynamicInputHidden');
        function addInput() {
            if (counter == limit) {
                alert("You have reached the limit of adding " + counter + " inputs");
            } else {
                var original = document.getElementById('dynamicInputHidden');
                var clone = original.cloneNode(true);
                counter++;
                clone.id = 'dynamicInput' + counter;
                var id = clone.id;
                clone.style = "display : initial;";
                clone.name = 'clone' + counter;
                original.parentNode.appendChild(clone);
            }
        }
    </script>
</div>
</body>
</html>
