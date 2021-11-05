<?php

  $id=$_GET['id'];

  if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Error");
  }
    include_once 'funciones/sesiones.php';
    include_once 'templates/header.php'; 
    include_once 'funciones/funciones.php';
    include_once 'templates/barra.php';
    include_once 'templates/navegacion.php';

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar administrador
        <small></small>
      </h1>
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>-->
    </section>

    <div class="row">
      
      <div class="col-md-8">
        
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Title</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

                <?php 

                $sql="SELECT * FROM admin WHERE id_admin=".$id;
                $resultado=$conn->query($sql);
                $admin=$resultado->fetch_assoc();

                ?>

                <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-admin.php">

                  <div class="box-body">

                    <div class="form-group">

                      <label for="usuario">Usuario</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $admin['usuario']; ?>" required>

                    </div>


                    <div class="form-group">
                      <label for="nombre">Nombre:</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre completo" value="<?php echo $admin['nombre']; ?>" required>
                    </div>


                    <div class="form-group">

                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password para Iniciar Sesión" required>

                    </div>
                    <!--<div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" id="exampleInputFile">

                      <p class="help-block">Example block-level help text here.</p>
                    </div>
                  </div>-->
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </form>
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->

        </section>


      </div>    

    </div>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
  include_once 'templates/footer.php';

?>


