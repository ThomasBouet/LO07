<?php
$page='studentlist';
require('layout/header.php');
include_once("include/database.php");
include_once("include/bibliotheque.php");
/* $etu=$_POST["etu"];
 $cursus=$_POST["cursus"];*/
$etu=$match['params']['id'];
$cursus=$match['params']['cursus'];

$sql = "SELECT sigle FROM ElemForm WHERE IdEleve = $etu AND IdParcours = $cursus";
$res = mysqli_query($database, $sql);
$resultats=array();
while ($row = mysqli_fetch_array($res))
{
    $resultats[] = $row[0];
}

$sql = "SELECT * FROM Etudiant WHERE IdEtu=".$match['params']['id'];
$res = mysqli_query($database, $sql);
$students = array();
while ($row = mysqli_fetch_array($res)) {
    $students[] = $row;
}
$student=$students[0];
?>


<div class="content-wrapper py-3">
    <div class="container-fluid">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Projet LO07</li>
            <li class="breadcrumb-item"><a href="/student">Gestion des utilisateurs</a></li>
            <li class="breadcrumb-item"><a href="/student/<?php echo($match['params']['id'])?>"><?php echo($student['prenom']." ".$student['nom']);?></a></li>
            <li class="breadcrumb-item"><a href="/student/<?php echo($match['params']['id'].'/'.$match['params']['cursus'])?>">Cursus n°<?php echo($match['params']['cursus']);?></a></li>
            <li class="breadcrumb-item active">Édition</li>
        </ol>
        <?php flash( 'status' ); ?>
        <div class="card mb-3">
            <div class="card-header">
                Supprimer des UEs
            </div>
            <div class="card-block">
                <form method="POST" action="edit/del">
                    <div class="row mb-3">
                        <div class="col-12">
                            <?php echo(genereSelectMult($resultats,"ue[]","ue"));?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-12 text-right">
                            <button type="submit" class="btn btn-primary">Valider </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
        $resultat = array('A', 'B', 'C', 'D', 'E', 'F', 'ADM', 'RES', 'ABS');
        $yesno = array('Y', 'N');
        $num = array(1, 2, 3, 4, 5, 6,7,8,9,10,11,12);
        $ues=selectdata('IdUe','Ue',$database);
        $nom = selectdata("IdEtu","Etudiant",$database);
        ?>

        <div class="card">
            <div class="card-header">
                Ajouter des UEs
            </div>
            <div class="card-block">
                <form method="POST" action="">
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
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#duplicate').click(function(){
            $("#dynamicInput").clone().insertAfter("#dynamicInput");
        });
    });
</script>

</body>
</html>
