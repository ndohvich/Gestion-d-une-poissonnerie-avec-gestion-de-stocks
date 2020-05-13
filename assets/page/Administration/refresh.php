<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=poissonnerie','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//me permet de compter le nombre de personne qui travail dans la poissonnerie
$requser = $bdd->query("SELECT * FROM employes");
$userexist = $requser->rowCount();

$nombre_personnel = $userexist;

//me permet de compter le nombre de fournisseurs de la poissonnerie
$requser1 = $bdd->query("SELECT * FROM fournisseurs");
$userexist1 = $requser1->rowCount();

$nombre_fournisseur = $userexist1;

//me permet de compter le nombre de produits de la poissonnerie
$requser2 = $bdd->query("SELECT * FROM produits");
$userexist2 = $requser2->rowCount();

$nombre_produits = $userexist2;

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tableau de Bord
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?id=<?php echo $_SESSION['id'] ?>"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Tableau de Bord</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total de Produits <br> Vendus</span>
                <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    0 FCFA
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Nombre de <br> Fournisseurs</span>
              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                  <?php
                    echo $nombre_fournisseur;
                  ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total <br> vendu</span>
              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    0 FCFA
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Quantité de Produits <br>en Stock</span>
              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo $nombre_produits ?> Produits
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Quantité de Poissons <br> Vendus</span>
              <span class="info-box-number">0 kg</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Quantité de Crustacés <br> vendus</span>
              <span class="info-box-number">0 kg</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Quantité de Poulets <br>vendus</span>
              <span class="info-box-number">0 kg</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Personnel de la <br>Poissonnerie</span>
              <span class="info-box-number">
                <?php
                  echo $nombre_personnel;
                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    </div>