<?php
  $id=$_GET['id'];

  if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Error");
  }

  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header.php'; 
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar invitados
        <small>Llena el formulario para editar un Invitado</small>
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

                <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="POST" action="modelo-invitados.php" enctype="multipart/form-data">


                  <div class="box-body">

                    <?php 

                      $sql="SELECT* FROM invitados WHERE invitado_id=".$id;
                      $resultado=$conn->query($sql);
                      $invitado=$resultado->fetch_assoc();

                    ?>

                    <div class="form-group">

                      <label for="nombre_invitado">Nombre</label>
                      <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Nombre" value="<?php echo $invitado['nombre_invitado'] ?>">

                    </div>


                    <div class="form-group">

                      <label for="apellido_invitado">Apellido</label>
                      <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Nombre" value="<?php echo $invitado['apellido_invitado'] ?>">

                    </div>


                    <div class="form-group">
                      
                      <label for="biografia_invitado">Biografia</label>
                      <textarea class="form-control" name="biografia_invitado" rows="8" placeholder="Bigrafia" id="biografia_invitado"><?php echo $invitado['descripcion']; ?></textarea>

                    </div>

                    <div class="form-group">
                      
                      <label for="imagen_actual">Imagen actual</label>
                      <br>
                      <img src="../img/<?php echo $invitado['url_imagen']; ?>" alt="Imagen invitado" width="200">

                    </div>


                    <div class="form-group">
                      <label for="imagen_invitado">Imagen</label>
                      <input type="file" id="imagen_invitado" name="archivo_imagen">

                      <p class="help-block">Añada la imagen del inidviduo aquí</p>
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
                    <input type="hidden" name="id_registro" value="<?php echo $invitado['invitado_id']; ?> ">
                    <button type="submit" class="btn btn-primary" id="crear_registro_admin">Guardar</button>
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


