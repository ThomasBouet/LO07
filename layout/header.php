<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="Tevi EA & Thomas Bouet ">
    <title>Projet LO07</title>
    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Plugin CSS -->
    <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/sb-admin.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/tether/tether.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/vendor/chart.js/Chart.min.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for this template -->
    <script src="/js/sb-admin.min.js"></script>
</head>
<body>
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/">Projet LO07</a>
        <div class="collapse navbar-collapse" id="navbarExample">
            <ul class="sidebar-nav navbar-nav">
                <li class="nav-item <?php if($page=='accueil'){echo('active');} ?>">
                    <a class="nav-link" href="/"><i class="fa fa-fw fa-star"></i> Accueil</a>
                </li>
                <li class="nav-item <?php if($page=='cursuscrea'){echo('active');} ?>">
                    <a class="nav-link" href="/cursus/create"><i class="fa fa-fw fa-wrench"></i> Création d'un cursus</a>
                </li>
                <hr/>
                <li class="nav-item <?php if($page=='studentlist'){echo('active');} ?>">
                    <a class="nav-link" href="/student"><i class="fa fa-fw fa-table "></i> Afficher les Étudiants</a>
                </li>
                <li class="nav-item <?php if($page=='adduser'){echo('active');} ?>">
                    <a class="nav-link" href="/student/create"><i class="fa fa-fw fa-users "></i> Ajouter un Étudiant</a>
                </li>
                <hr/>

                <li class="nav-item <?php if($page=='uelist'){echo('active');} ?>">
                    <a class="nav-link" href="/ue"><i class=" fa fa-fw fa-table "></i> Affichage des UE</a>
                </li>
                <li class="nav-item <?php if($page=='ueadd'){echo('active');} ?>">
                    <a class="nav-link" href="/ue/create"><i class=" fa fa-fw fa-university "></i> Ajouter une UE</a>
                </li>
        </div>
    </nav>