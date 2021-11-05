<?php
  include_once 'funciones/sesiones.php';
  include_once 'templates/header.php'; 
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  include_once 'funciones/funciones.php';
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        
        <div class="box-body chart-responsive">
          <div class="chart" id="grafica-registros" style="height: 300px;"></div>
        </div>

      </div>

      <h2 class="page-header">Personas</h2>

      <div class="col-lg-3 col-xs-6">

          <?php 

            $sql="SELECT COUNT(id_registrado) AS registros FROM registrados";
            $resultado=$conn->query($sql);
            $registrados=$resultado->fetch_assoc();

          ?>
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $registrados['registros'] ?></h3>

              <p>Total registros</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="lista-registrados.php" class="small-box-footer">
              Más información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">

          <?php 

            $sql="SELECT COUNT(id_registrado) AS registros FROM registrados WHERE pagado=1";
            $resultado=$conn->query($sql);
            $registrados=$resultado->fetch_assoc();

          ?>
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $registrados['registros'] ?></h3>

              <p>Pagados</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="lista-registrados.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">

          <?php 

            $sql="SELECT COUNT(id_registrado) AS registros FROM registrados WHERE pagado=0";
            $resultado=$conn->query($sql);
            $registrados=$resultado->fetch_assoc();

          ?>
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $registrados['registros'] ?></h3>

              <p>No pagados</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-times"></i>
            </div>
            <a href="lista-registrados.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->


        <div class="col-lg-3 col-xs-6">

          <?php 

            $sql="SELECT SUM(total_pagado) AS ganacias FROM registrados WHERE pagado=1";
            $resultado=$conn->query($sql);
            $registrados=$resultado->fetch_assoc();

          ?>
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>$<?php echo (float)$registrados['ganacias'] ?></h3>

              <p>Ganancias totales</p>
            </div>
            <div class="icon">
              <i class="fas fa-funnel-dollar"></i>
            </div>
            <a href="lista-registrados.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->  

        <h2 class="page-header">Regalos</h2>

        <div class="col-lg-3 col-xs-6">

          <?php 

            $sql="SELECT COUNT(id_registrado) AS pulseras FROM registrados WHERE pagado=1 AND regalo=1";
            $resultado=$conn->query($sql);
            $regalo=$resultado->fetch_assoc();

          ?>
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo (float)$regalo['pulseras'] ?></h3>

              <p>Pulseras</p>
            </div>
            <div class="icon">
              <i class="fas fa-code"></i>>
            </div>
            <a href="lista-registrados.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col --> 

        <div class="col-lg-3 col-xs-6">

          <?php 

            $sql="SELECT COUNT(id_registrado) AS etiquetas FROM registrados WHERE pagado=1 AND regalo=2";
            $resultado=$conn->query($sql);
            $regalo=$resultado->fetch_assoc();

          ?>
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo (float)$regalo['etiquetas'] ?></h3>

              <p>Etiquetas</p>
            </div>
            <div class="icon">
              <i class="fas fa-tags"></i>
            </div>
            <a href="lista-registrados.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col --> 

        <div class="col-lg-3 col-xs-6">

          <?php 

            $sql="SELECT COUNT(id_registrado) AS plumas FROM registrados WHERE pagado=1 AND regalo=3";
            $resultado=$conn->query($sql);
            $regalo=$resultado->fetch_assoc();

          ?>
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo (float)$regalo['plumas'] ?></h3>

              <p>Plumas</p>
            </div>
            <div class="icon">
              <i class="fas fa-pen"></i>
            </div>
            <a href="lista-registrados.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col --> 


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
  include_once 'templates/footer.php';
?>


