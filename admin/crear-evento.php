<?php
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
        Crear Evento
        <small>Llena el formulario para crear un evento</small>
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

              <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-evento.php">

                <div class="box-body">

                  <div class="form-group">

                    <label for="titulo_evento">Titulo Evento</label>
                    <input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Titulo Evento">

                  </div>

                  <div class="form-group">
                    <label for="nombre">Categoría:</label>
                    <select name="categoria_evento" class="form-control seleccionar">
                      <option value="0" disabled="true">--Seleccione--</option>
                      <?php

                        try {

                          $sql="SELECT * FROM categoria_evento";
                          $resultado=$conn->query($sql);
                          while ($cat_evento=$resultado->fetch_assoc()) {

                            ?>
                              <option value="<?php echo $cat_evento['id_categoria'] ?>"><?php echo $cat_evento['cat_evento']; ?></option> 
                            <?php

                          }
                          
                        } catch (Exception $e) {
                          
                          echo "Error: ".$e->getMessage();

                        }

                      ?>

                    </select>
                  </div>

                   <div class="form-group">
                    <label>Fecha evento:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="fecha" name="fecha_evento" autocomplete="off">
                    </div>
                    <!-- /.input group -->
                  </div>


                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Hora:</label>


                      <div class="input-group">
                        <input type="text" class="form-control hora" name="hora_evento"> 

                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>

                  <div class="form-group">
                    <label for="nombre">Invitado o  Ponente:</label>
                    <select name="invitado" class="form-control seleccionar">
                      <option value="0" disabled="true">--Seleccione--</option>
                      <?php

                        try {

                          $sql="SELECT invitado_id, nombre_invitado, apellido_invitado FROM invitados";
                          $resultado=$conn->query($sql);
                          while ($invitados=$resultado->fetch_assoc()) {

                            ?>
                              <option value="<?php echo $invitados['invitado_id'] ?>"><?php echo $invitados['nombre_invitado']." ".$invitados['apellido_invitado']; ?></option> 
                            <?php

                          }
                          
                        } catch (Exception $e) {
                          
                          echo "Error: ".$e->getMessage();

                        }

                      ?>

                    </select>
                  </div>
                  <!--<div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" id="exampleInputFile">

                    <p class="help-block">Example block-level help text here.</p>
                  </div>
                </div>-->
                <!-- /.box-body -->

                <div class="box-footer">
                  <input type="hidden" name="registro" value="nuevo">
                  <button type="submit" class="btn btn-primary" id="guardar-registro">Añadir</button>
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
