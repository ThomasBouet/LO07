<?php
$page='cursuscrea';
include('layout/header.php');
include_once('include/database.php');
include_once('include/bibliotheque.php');
$resultat = array('A', 'B', 'C', 'D', 'E', 'F', 'ADM', 'RES', 'ABS');
$yesno = array('Y', 'N');
$num = array(1, 2, 3, 4, 5, 6,7,8,9,10,11,12);
$ues=selectdata('IdUe','Ue',$database);
$nom = selectdata("IdEtu","Etudiant",$database);
?>

    <div class="content-wrapper py-3">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Projet LO07</li>
                <li class="breadcrumb-item active">Création d'un cursus</li>
            </ol>
            <?php flash( 'status' ); ?>
            <form method="post" action="">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-lg-5">
                                <div class="form-group row">
                                    <label for="etu" class="col-4 col-form-label">Numéro étudiant:</label>
                                    <div class="col-6">
                                        <?php echo(genereSelect($nom,"etu","etu"));?>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-7 text-right">
                                <a class="btn btn-secondary" data-toggle="modal" data-target="#modalcsv">Envoyer un CSV</a>
                                <a href="/student/create" class="btn btn-secondary">Ajouter un Étudiant</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div id="dynamicInput">
                            <div class="card card-outline-info mb-3 text-center">
                                <div class="card-block">
                                    <blockquote class="card-blockquote">
                                        <div class="form-group row">
                                            <label for="ue" class="col-2 col-form-label">Nom de l'UE:</label>
                                            <div class="col-10">
                                                <?php echo(genereSelect($ues,'ue[]','ue'));?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="num" class="col-2 col-form-label">Numéro du semestre:</label>
                                            <div class="col-10">
                                                <?php echo(genereSelect($num, 'num[]', 'num'));?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="sem_label" class="col-2 col-form-label">Label du semestre:</label>
                                            <div class="col-10">
                                                <input id="sem_label" type="text" class="form-control" name="sem_label[]">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profil" class="col-2 col-form-label">Profil:</label>
                                            <div class="col-10">
                                                <?php echo(genereSelect($yesno, 'profil[]', 'profil')); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="utt" class="col-2 col-form-label">UTT:</label>
                                            <div class="col-10">
                                                <?php echo(genereSelect($yesno, 'UTT[]', 'utt')); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="utt" class="col-2 col-form-label">Resultat:</label>
                                            <div class="col-10">
                                                <?php echo(genereSelect($resultat, 'resultat[]', 'resultat')); ?>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-2">
                                <button type="button" id="duplicate" class="btn btn-secondary">Ajouter une UV au cursus</button>
                            </div>
                            <div class="col col-lg-10 text-right">
                                <button type="submit" class="btn btn-primary">Valider </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#duplicate').click(function(){
                $("#dynamicInput").clone().insertAfter("#dynamicInput");
            });
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="modalcsv" tabindex="-1" role="dialog" aria-labelledby="modalcsv" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Envoi d'un CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../include/csv_action.php" enctype="multipart/form-data">
                        Fichier : <input type='file' id='csv' name='csv' accept=".csv" required> <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
                </div>
            </div>
        </div>
    </div>


</body>
</html>