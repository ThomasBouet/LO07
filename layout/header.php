<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="Tevi EA & Thomas Bouet ">
    <title>Projet LO07</title>
    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/sb-admin.css" rel="stylesheet">
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
                    <a class="nav-link" href="/create"><i class="fa fa-fw fa-wrench"></i> Création d'un cursus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-fw fa-table"></i> Visualisation d'un cursus</a>
                </li>
            </ul>
        </div>
    </nav>