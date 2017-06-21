<?php
$page='ueadd';
include_once('include/database.php');
include_once('include/bibliotheque.php');
include_once('include/elmt_formation.php');
include('layout/header.php');

$cat = selectdata("IdCat", "Categorie_UE", $database);
$affectation = array('TC', 'BR', 'TCBR', 'FCBR');
$num = array(1, 2, 3, 4, 5, 6);
?>

<div class="content-wrapper py-3">
    <div class="container-fluid">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item ">Projet LO07</li>
            <li class="breadcrumb-item ">Gestion des UE</li>
            <li class="breadcrumb-item active">Ajout</li>
        </ol>

        <div class="card">
            <div class="card-header">
                Ajout d'une UV
            </div>
            <div class="card-block">
                <form method="POST" action="">
                    <div class="form-group row">
                        <label for="Sigle" class="col-2 col-form-label">Sigle</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="sigle" id="sigle" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Catégorie" class="col-2 col-form-label">Catégorie</label>
                        <div class="col-10">
                            <?php echo(genereSelect($cat, 'categorie', 'categorie'));?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Affectation" class="col-2 col-form-label">Affectation</label>
                        <div class="col-10">
                            <?php echo(genereSelect($affectation, 'affectation', 'affectation'));?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Credits" class="col-2 col-form-label">Credits</label>
                        <div class="col-10">
                            <?php echo(genereSelect($num, 'credits', 'credits'));?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Description" class="col-2 col-form-label">Description</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="desc" id="desc">
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
