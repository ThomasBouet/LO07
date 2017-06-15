<?php $page='accueil'; require('layout/header.php')?>

    <div class="content-wrapper py-3">
        <div class="container-fluid">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Accueil</li>
            </ol>
            <div class="card-block">
                <a class="btn btn-default btn-lg btn-block" href="/create"><i class="fa fa-wrench fa-lg" aria-hidden="true"></i>
                    Création d'un cursus</a>
                <hr />
                <a class="btn btn-default btn-lg btn-block" href="/create/students"><i class="fa fa-table fa-lg" aria-hidden="true"></i>
                    Visualisation d'un cursus
                </a>
            </div>
        </div>
    </div>
</body>
</html>