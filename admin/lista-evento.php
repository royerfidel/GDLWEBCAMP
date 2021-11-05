
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
        Lista de eventos
        <small>Aquí podrás editar y borrar los eventos </small>
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
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Controla los eventos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nombre del evento</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoría</th>
                  <th>Invitado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

              	<?php 
              		try {
              			$sql="SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, nombre_invitado, apellido_invitado FROM eventos INNER JOIN categoria_evento ON eventos.id_cat_evento=categoria_evento.id_categoria INNER JOIN invitados ON eventos.id_inv=invitados.invitado_id ORDER BY evento_id";
              			$resultado=$conn->query($sql);
                    while($eventos=$resultado->fetch_assoc()){

                      ?>

                      <tr>
                        <td><?php echo $eventos['nombre_evento']; ?></td>
                        <td><?php echo $eventos['fecha_evento']; ?></td>
                        <td><?php echo $eventos['hora_evento']; ?></td>
                        <td><?php echo $eventos['cat_evento']; ?></td>
                        <td><?php echo $eventos['nombre_invitado']." ".$eventos['apellido_invitado']; ?></td>
                        <td>
                          <a href="editar-evento.php?id=<?php echo $eventos['evento_id']; ?>" class="btn bg-orange btn-flat margin"><i class="fas fa-pencil-alt"></i></a>
                          <a href="#" data-id="<?php echo $eventos['evento_id']; ?>" class="btn bg-maroon btn-flat margin borrar_registro" data-tipo="evento"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>

                      <?php

                    }
              			
              		} catch (Exception $e) {
              			echo 'Error: '.$e->getMessage();
              		}

              	?>

                </tbody>
                <tfoot>
                <tr>
                  <th>Nombre del evento</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoría</th>
                  <th>Invitado</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
  include_once 'templates/footer.php';
?>

