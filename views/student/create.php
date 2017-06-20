<?php
$page='adduser';
require_once('include/database.php');
require_once('include/bibliotheque.php');
require_once('include/etudiant.php');
$filiere = selectdata("Idfil","Filiere",$database);
$admission = array('TC','BR');
include('layout/header.php');
?>

    <div class="content-wrapper py-3">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item ">Projet LO07</li>
                <li class="breadcrumb-item active">Création d'un cursus</li>
            </ol>
            <?php flash( 'status' ); ?>
            <div class="card">
                <div class="card-header">
                    Ajout d'un étudiant
                </div>
                <div class="card-block">
                    <form method="POST" action="" onsubmit="return verification();">
                        <div class="form-group row">
                            <label for="etunum" class="col-2 col-form-label">Numéro étudiant</label>
                            <div class="col-10">
                                <input class="form-control" type="text" name="IdEtu" id="numero">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-2 col-form-label">Nom</label>
                            <div class="col-10">
                                <input class="form-control" type="text" name="nom" id="nom">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Prenom" class="col-2 col-form-label">Prenom</label>
                            <div class="col-10">
                                <input class="form-control" type="text" name="prenom" id="prenom">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Admission" class="col-2 col-form-label">Admission</label>
                            <div class="col-10">
                                <?php echo(genereSelect($admission,'admission','adm'));?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Filière" class="col-2 col-form-label">Filière</label>
                            <div class="col-10">
                                <?php echo(genereSelect($filiere,'filiere','filiere'));?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-12 text-right">
                                <input class="btn btn-primary" type="submit" value="Envoyer">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function verification()
        {
            var valid = true;
            var num = document.getElementById('numero').value;
            var nom = document.getElementById('nom').value;
            var prenom = document.getElementById('prenom').value;
            //num = Integer.parseInt(num);
            if(!(/^\d+$/.test(num))){
                alert('Veuillez entrer un numéro');
                valid = false;
            }
            if(num.length != 5){
                alert('Veuillez entrer un numéro ayant le bon format : 5 chiffres');
                valid = false;
            }
            if(!nom.match(/^\w[^0-9]+$/)){
                alert("Veuillez entrer un nom sans chiffres et sans carctère spéciaux");
                valid = false;
            }
            if(!prenom.match(/^\w[^0-9]+$/)) {
                alert("Veuillez entrer un prenom sans chiffres et sans carctère spéciaux");
                valid = false;
            }
            return valid;
        }
    </script>
</body>
</html>


