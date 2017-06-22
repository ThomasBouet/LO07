<?php
$page='studentlist';
session_start();
require('layout/header.php');
require_once('include/database.php');
require_once('include/bibliotheque.php');
$sql1 = "SELECT DISTINCT sem_seq, sigle,profil,creditobt,resultat FROM ElemForm WHERE (IdParcours=".$match['params']['cursus']." AND IdEleve=".$match['params']['id'].") ORDER BY sem_seq ASC";
$res1 = mysqli_query($database, $sql1);
$todisplay=['CS','CT','EC','HP','ME','TM']; //Cat a display
$elts = array(); //UV de base
$merged=array(); //UV + cats mergeds
while ($row = mysqli_fetch_array($res1)) {
    $elts[] = $row;
}
foreach ($elts as $elt){
    $results = mysqli_query($database, "SELECT cat FROM Ue WHERE IdUe='".$elt['sigle']."'");
    $types=array();
    while ($row = mysqli_fetch_array($results)) {
        $types[] = $row;
    }
    $elt['cat']=$types[0]['cat'];
    $merged[]=$elt;
}
$nbsemester=-1; //Nb de semestres effectues
foreach ($merged as $elt){
    $eltval=intval($elt['sem_seq']);
    if($nbsemester<$eltval && in_array($elt['cat'],$todisplay)){
        $nbsemester=$eltval;
    }
}

$sql = "SELECT * FROM Etudiant WHERE IdEtu=".$match['params']['id'];
$res = mysqli_query($database, $sql);
$students = array();
while ($row = mysqli_fetch_array($res)) {
    $students[] = $row;
}
$student=$students[0];

$status=[-1,-1];
foreach ($merged as $uv){
    if($uv['cat']=='SE'){
        $status[0]=$uv['sem_seq'];
    }
    elseif ($uv['cat']=='NPML'){
        $status[1]=$uv['sem_seq'];
    }
}
?>

<div class="content-wrapper py-3">
    <div class="container-fluid">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Projet LO07</li>
            <li class="breadcrumb-item"><a href="/student">Gestion des utilisateurs</a></li>
            <li class="breadcrumb-item"><a href="/student/<?php echo($match['params']['id'])?>"><?php echo($student['prenom']." ".$student['nom']);?></a></li>
            <li class="breadcrumb-item active">Affichage du cursus n°<?php echo($match['params']['cursus']);?></li>
        </ol>
        <div class="row">
            <div class="col col-2">
                <div class="card card-outline-primary mb-3 text-center">
                    <h4 class="card-title">Informations sur l'Étudiant</h4>
                    Nom: <?php echo($student['nom']);?></br>
                    Prénom: <?php echo($student['prenom'])?></br>
                    Numéro Étudiant: <?php echo($student['IdEtu']);?>
                </div>
                <div class="card mb-3">
                    <div class="card-header text-center">
                        Gestion du cursus
                    </div>
                    <div class="card-block text-center">
                        <div class="btn-group-vertical">
                            <a href="<?php echo($match['params']['cursus']);?>/edit" class="btn-secondary btn btn-lg">Modifier</a >
                            <a href="<?php echo($match['params']['cursus']);?>/duplicate" class="btn-secondary btn btn-lg">Dupliquer</a >
                            <a href="<?php echo($match['params']['cursus']);?>/export" class="btn-secondary btn btn-lg">Télécharger</a >
                            <a href="" data-toggle="modal" data-target="#confirm" class="btn-danger btn btn-lg">Supprimer</a >
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header text-center">
                        Vérification du réglement
                    </div>
                    <div class="card-block text-center">
                        <div class="btn-group-vertical">
                            <a href="<?php echo($match['params']['cursus']);?>/verif1" class="btn-secondary btn btn-lg">Actuel</a>
                            <a href="<?php echo($match['params']['cursus']);?>/verif2" class="btn-secondary btn btn-lg">Futur</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-10">
                <?php flash( 'status' ); ?>
                <div class="card">
                    <div class="card-header">
                        Cursus n°<?php echo($match['params']['cursus'])?>
                    </div>
                    <div class="card-block">
                        <h4>UEs:</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th></th>
                                <?php
                                    foreach (range(1,$nbsemester) as $semester){
                                        echo('<th scope="col">Semestre n°'.$semester.'</th>');
                                    }
                                ?>
                            </tr>
                            <?php
                            foreach ($todisplay as $cat) {
                                echo('<tr>');
                                echo('<th scope="row">'.$cat.'</th>');
                                for ($i = 1; $i <= $semester; $i++) {
                                    echo('<td>');
                                    $counter = 0;
                                    foreach ($merged as $uv) {
                                        if (intval($uv['sem_seq']) == $i && $uv['cat'] == $cat) {
                                            if ($counter > 0) {
                                                echo('</br>');
                                            }
                                            echo($uv['sigle'] . ' ' . $uv['creditobt'] . ' ' . $uv['resultat']);
                                            $counter = $counter + 1;
                                        }
                                    }
                                    echo('</td>');
                                }
                                echo('</tr>');
                            }
                            ?>
                        </table>

                        <br/>
                        <h4>Semestre à l'étranger & NPML:</h4>
                        <div class="row">
                            <div class="col col-6">
                                <div class="card card-inverse <?php if($status[0]==-1){echo('card-warning');} else {echo('card-success');}?> mb-3 text-center">
                                    <blockquote class="card-blockquote">
                                        <h5>Semestre à l'étranger:</h5>
                                        <footer> <?php if($status[0]==-1){echo('Non validé');} else {echo('Semestre n°'.$status[0]);}?> </footer>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="col col-6">
                                <div class="card card-inverse <?php if($status[1]==-1){echo('card-warning');} else {echo('card-success');}?> mb-3 text-center">
                                    <blockquote class="card-blockquote">
                                        <h5>NPML:</h5>
                                        <footer> <?php if($status[1]==-1){echo('Non validé');} else {echo('Semestre n°'.$status[1]);}?> </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>

                        <br/>
                        <h4>Stages:</h4>
                        <div class="row">
                            <?php
                            $counter=0;
                            foreach ($merged as $uv){
                                if($uv['cat']=='ST'){
                                    $counter=$counter+1;
                                    echo('<div class="col col-4"><div class="card card-outline-success mb-3 text-center"><div class="card-block"><blockquote class="card-blockquote">');
                                    echo('<h5>'.$uv['sigle'].'</h5>');
                                    echo('<footer>Semestre n°'.$uv['sem_seq'].'</footer>');
                                    echo('</blockquote></div></div></div>');
                                }
                            }
                            if($counter==0){
                                echo('<div class="col col-12 text-center"><h5>Aucun stage effectué</h5></div>');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Confirmer la suppression du cursus?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <a class="btn btn-danger" href="<?php echo($match['params']['cursus']);?>/delete">Supprimer</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>