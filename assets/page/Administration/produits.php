<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=poissonnerie','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Poissonnerie | Tableau de Bord</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Tableau de Bord</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar_2x.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Administrateur</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar_2x.png" class="img-circle" alt="User Image">

                <p>
                  Administrateur - Responsable
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="pages/deconnexion.php" class="btn btn-default btn-flat">Déconnexion</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar_2x.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrateur</p>
          <a href=""><i class="fa fa-circle text-success"></i> En ligne</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPALE</li>
        <li>
          <a href="index.php?id=<?php echo $_SESSION['id'] ?>">
            <i class="fa fa-dashboard"></i> <span>Tableau de Bord</span>
          </a>
        </li>
        <li>
          <a href="Fournisseur.php?id=<?php echo $_SESSION['id'] ?>">
            <i class="fa fa-th"></i> <span>Les Fournisseurs</span>
          </a>
        </li>
        <li>
          <a href="clients.php?id=<?php echo $_SESSION['id'] ?>">
            <i class="fa fa-pie-chart"></i> <span>Les Clients</span>
          </a>
        </li>
        <li>
          <a href="employes.php?id=<?php echo $_SESSION['id'] ?>">
            <i class="fa fa-laptop"></i> <span>Les Employés</span>
          </a>
        </li>
        <li class="active treeview menu-open">
          <a href="produits.php?id=<?php echo $_SESSION['id'] ?>">
            <i class="fa fa-circle-o"></i> <span>Les Produits</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tableau de Bord
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?id=<?php echo $_SESSION['id'] ?>"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Les produits</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="height:81vh;width:100%;background-color:white;">
      
      <?php include("elt_produits/index.php"); ?>      
      
    </div>

  <footer class="main-footer" style="background-color:black;color:white;">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2019 <a href="index.php">Ma Poissonnerie</a>.</strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
