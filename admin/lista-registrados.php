
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
        Lista de registrados
        <small></small>
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
              <h3 class="box-title">Administra a los invitados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha Registro</th>
                  <th>Articulos</th>
                  <th>Talleres</th>
                  <th>Regalo</th>
                  <th>Compra</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

              	<?php 
              		try {

              			$sql="SELECT registrados.*, regalos.nombre_regalo FROM registrados
                    JOIN  regalos ON registrados.regalo=regalos.id_regalo";
              			$resultado=$conn->query($sql);
              			
              		} catch (Exception $e) {

              			echo 'Error: '.$e->getMessage();

              		}
              		while($registrado=$resultado->fetch_assoc()){

              			?>

              			<tr>
		                  <td><?php
                            echo $registrado['nombre_registrado']." ".$registrado['apellido_registrado']; 
                            $pagado=$registrado['pagado'];
                            if ($pagado) {

                              echo "<br><span class='badge bg-green'>Pagado</span>";
                              
                            }else{

                              echo "<br><span class='badge bg-red'>No ha pagado</span>";

                            }
                          ?>
                      </td> 
		                  <td><?php echo $registrado['email_registrado']; ?></td>
                      <td><?php echo $registrado['fecha_registro']; ?></td>

                      <td>
                        <?php
                          $articulos=json_decode($registrado['pases_articulos'], true);
                          $arreglo_articulos=array(
                            'un_dia'=>'Pase un dia',
                            'pase_2dias'=>'Pase 2 dias',
                            'pase_completo'=>'Pase completo',
                            'camisas'=>'Camisas',
                            'etiquetas'=>'Etiquetas'
                          );

                          foreach ($articulos as $llave => $articulo) {
                            if (array_key_exists('cantidad', $articulos)) {
                              echo $articulo['cantidad']." ".$arreglo_articulos[$llave]."<br>";
                            }else{
                              echo $articulo." ".$arreglo_articulos[$llave]."<br>";
                            }
                            
                          }
                        ?>  
                                   
                      </td>

                      <td>
                        <?php 
                          $eventos_resultado=$registrado['talleres_registrados']; 
                          if ($eventos_resultado!="") {                           
                            $talleres=json_decode($eventos_resultado, true);
                            //CONVERTIR UN ARRAY EN CADENA
                            $talleres=implode("','", $talleres['eventos']);

                            $sql_talleres="SELECT  nombre_evento, fecha_evento, hora_evento FROM eventos WHERE evento_id IN ('".$talleres."')";
                            $resultado_talleres=$conn->query($sql_talleres);

                            while ($eventos=$resultado_talleres->fetch_assoc()) {
                              
                              echo "-".$eventos['nombre_evento']." ".$eventos['fecha_evento']." ".$eventos['hora_evento']."<br>";

                            }
                          }

                        ?>
                        
                      </td>
                      <td><?php echo $registrado['regalo']; ?></td>
                      <td>$ <?php echo (float)$registrado['total_pagado']; ?></td>
		                  <td>
		                  	<a href="editar-registro.php?id=<?php echo $registrado['id_registrado']; ?>" class="btn bg-orange btn-flat margin"><i class="fas fa-pencil-alt"></i></a>
		                  	<a href="#" data-id="<?php echo $registrado['id_registrado']; ?>" class="btn bg-maroon btn-flat margin borrar_registro" data-tipo="registro"><i class="fa fa-trash"></i></a>
		                  </td>
		                </tr>

              			<?php

              		}
              	?>

                </tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha Registro</th>
                  <th>Articulos</th>
                  <th>Talleres</th>
                  <th>Regalo</th>
                  <th>Compra</th>
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

