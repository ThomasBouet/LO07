<?php
$page='cursuscrea';
include('../layout/header.php');
include_once('../include/database.php');
include_once('../include/bibliotheque.php');
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
            <form method="POST" action="/include/cursus_action.php">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-lg-5">
                                <div class="form-group row">
                                    <label for="numetu" class="col-4 col-form-label">Numéro étudiant:</label>
                                    <div class="col-6">
                                        <?php echo(genereSelect($nom,"etu","etu"));?>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-7 text-right">
                                <a href="createetu.php" class="btn btn-secondary">Ajouter un Étudiant</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div id='container'>
                            <div id="dynamicInputHidden" style="display : none;">
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
                                                    <input type="text" class="form-control" name="sem_label[]">
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
                        </div>
                        <div id="dynamicInput1">
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
                                                <input type="text" class="form-control" name="sem_label[]">
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
                                <button type="button" onclick="addInput('dynamicInput');" class="btn btn-secondary">Ajouter une UV au cursus</button>
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
</body>
</html>