<?php
$page='studentlist';
require('layout/header.php');
require_once('include/database.php');
require_once('include/bibliotheque.php');
$sql1 = "SELECT sem_seq, sigle,profil,creditobt,resultat FROM ElemForm WHERE IdParcours=".$match['params']['cursus']." ORDER BY sem_seq ASC";
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
                    Nom: <?php echo($student['prenom']);?></br>
                    Prénom: <?php echo($student['nom'])?></br>
                    Numéro Étudiant: <?php echo($student['IdEtu']);?>
                </div>
                <div class="card">
                    <div class="card-header">
                        Gestion du cursus
                    </div>
                    <div class="card-block">
                        <a href="" class="btn btn-danger btn-lg btn-block">Supprimer</a>
<!--                        TODO have to be fixed-->
                    </div>
                </div>
            </div>
            <div class="col col-10">
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
                                        <footer> <?php if($status[0]==-1){echo('Non validé');} else {echo('Semestre n°'.$status[1]);}?> </footer>
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
</body>
</html>