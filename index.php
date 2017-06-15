<!DOCTYPE html>
<html>
<?php
include('layout/header.php')
?>
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Projet LO07</a>
        <div class="collapse navbar-collapse" id="navbarExample">
            <ul class="sidebar-nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><i class="fa fa-fw fa-dashboard"></i> Acceuil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-fw fa-wrench"></i> Création d'un cursus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-fw fa-table"></i> Visualisation d'un cursus</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper py-3">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Acceuil</li>
            </ol>
            <div class="card-block">
                <a class="btn btn-default btn-lg btn-block" href="/create/assos"><i class="fa fa-wrench fa-lg" aria-hidden="true"></i>
                    Création d'un cursus</a>
                <hr />
                <a class="btn btn-default btn-lg btn-block" href="/create/students"><i class="fa fa-table fa-lg" aria-hidden="true"></i>
                    Visualisation d'un cursus
                </a>
            </div>
        </div>
    </div>
</html>