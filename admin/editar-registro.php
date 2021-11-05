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
       Editar registrado
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

                  $sql="SELECT * FROM registrados WHERE id_registrado=".$id;
                  $resultado=$conn->query($sql);
                  $registrado=$resultado->fetch_assoc();

                ?>

                <form class="editar-registrado" role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-registro.php">


                  <div class="box-body">

                    <div class="form-group">

                      <label for="nombre_registrado">Nombre</label>
                      <input type="text" class="form-control" id="nombre_registrado" name="nombre_registrado" value="<?php echo $registrado['nombre_registrado']; ?>" placeholder="Nombre">

                    </div>

                    <div class="form-group">

                      <label for="apellido_registrado">Apellido</label>
                      <input type="text" class="form-control" id="apellido_registrado" name="apellido_registrado" placeholder="Nombre" value="<?php echo $registrado['apellido_registrado']; ?>">

                    </div>

                    <div class="form-group">

                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $registrado['email_registrado']; ?>">

                    </div>

                    <?php  

                      $pedido=$registrado['pases_articulos'];
                      $boletos=json_decode($pedido, true);

                    ?>

                    <div class="form-group">

                      <div id="paquetes" class="paquetes">
                              
                              <h3>Elije el numero de boletos</h3>

                                <!--PRECIOS-->
                                <section class="precios seccion">

                                  <h2>Precios</h2>

                                  <div class="contenedor clearfix">

                                    <ul class="lista-precios clearfix row">

                                      <li class="col-md-4">

                                        <div class="tabla-precio text-center">

                                          <h3>Paso por día (viernes)</h3>
                                          <p class="numero">$30</p>
                                          <ul>

                                            <li>Bocadillos gratis</li>

                                            <li>Bocadillos gratis</li>

                                            <li>Bocadillos gratis</li>

                                          </ul>

                                          <div class="orden">
                                            
                                            <label for="pase_dia">Boletos deseados:</label>

                                            <input type="number" min="0" name="boletos[un_dia][cantidad]" class="form-control" id="pase_dia" size="3" placeholder="0" value="<?php echo $boletos['un_dia']; ?>">
                                            <input type="hidden" value="30" name="boletos[un_dia][precio]">

                                          </div>

                                        </div><!--tabla-precio-->

                                      </li>

                                      <li class="col-md-4">

                                        <div class="tabla-precio text-center">

                                          <h3>Todos los dias</h3>
                                          <p class="numero">$50</p>
                                          <ul>

                                            <li>Bocadillos gratis</li>

                                            <li>Bocadillos gratis</li>

                                            <li>Bocadillos gratis</li>

                                          </ul>

                                          <div class="orden">
                                            
                                            <label for="pase_completo">Boletos deseados:</label>

                                            <input type="number" min="0" name="boletos[completo][cantidad]" class="form-control" id="pase_completo" size="3" placeholder="0" value="<?php echo $boletos['pase_completo']; ?>">
                                            <input type="hidden" value="50" name="boletos[completo][precio]">

                                          </div>

                                        </div><!--tabla-precio-->

                                      </li>

                                      <li class="col-md-4">

                                        <div class="tabla-precio text-center">

                                          <h3>Pase por dos dias</h3>

                                          <p class="numero">$45</p>

                                          <ul>

                                            <li>Bocadillos gratis</li>

                                            <li>Bocadillos gratis</li>

                                            <li>Bocadillos gratis</li>

                                          </ul>

                                          <div class="orden">
                                            
                                            <label for="pase_dosdias">Boletos deseados:</label>

                                            <input type="number" min="0" name="boletos[2dias][cantidad]" id="pase_dosdias" class="form-control" size="3" placeholder="0" value="<?php echo $boletos['pase_2dias ']; ?>">
                                            <input type="hidden" value="45" name="boletos[2dias][precio]">

                                          </div>

                                        </div><!--tabla-precio-->

                                      </li>

                                    </ul><!--lista-precios clearfix-->

                                  </div><!--contenedor clearfix-->

                                </section><!--.precios .seccion-->

                              </div><!--#paquetes .paquetes-->
                      </div><!--.form-group-->

                      <div class="form-group">                   
                        <div class="box-header with-border">
                          <h3 class="box-title">Elige los talleres</h3>
                          <div id="eventos" class="eventos clearfix">

                            <div class="caja">

                                <?php  

                                  $eventos=$registrado['talleres_registrados'];
                                  
                                  if ($eventos!="") {
                                    $eventos=explode(':', $eventos);
                                    $eventos=str_replace(array("[","]","}",'"'), "", $eventos[1]);
                                    $eventosId=explode(',', $eventos);
                                  }else{
                                    $eventosId=array();
                                  }
                                  //$id_eventos_registrados=json_decode($eventos, true);

                                  try {

                                    $sql="SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado FROM eventos JOIN categoria_evento ON eventos.id_cat_evento=categoria_evento.id_categoria JOIN invitados ON eventos.id_inv=invitados.invitado_id ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento";

                                    $resultado=$conn->query($sql);

                                    $sql2="SELECT COUNT(*) AS limite FROM eventos";

                                    $sqlPrimerId="SELECT MIN(evento_id) AS evento_id FROM eventos";

                                    $sqlUltimoId="SELECT MAX(evento_id) AS evento_id FROM eventos ORDER BY evento_id DESC LIMIT 1";

                                    $resultado=$conn->query($sql);

                                    $resultado2=$conn->query($sql2);
                                    $limite=$resultado2->fetch_assoc();

                                    $resultado3=$conn->query($sqlPrimerId);
                                    $primerId=$resultado3->fetch_assoc();

                                    $resultado4=$conn->query($sqlUltimoId);
                                    $ultimoId=$resultado4->fetch_assoc();
                                    
                                  } catch (Exception $e) {
                                    
                                    echo $e->getMessage();

                                  }

                                  $eventos_dias=array();

                                  while ($eventos=$resultado->fetch_assoc()) {
                                    
                                    $fecha=$eventos['fecha_evento'];
                                    //traduce al each(array)spañol
                                    setlocale(LC_ALL, 'es_ES');
                                    //NOS DEVUELVE EL NOMBRE DEL DIA
                                    $dia_semana=strftime("%A", strtotime($fecha));

                                    $categoria=$eventos['cat_evento'];

                                    $dia=array(
                                      'dia'=>$dia_semana,
                                      'nombre_evento'=>$eventos['nombre_evento'],
                                      'hora'=>$eventos['hora_evento'],
                                      'id'=>$eventos['evento_id'],
                                      'nombre_invitado'=>$eventos['nombre_invitado'],
                                      'apellido_invitado'=>$eventos['apellido_invitado'],


                                    );
                                    $eventos_dias[$dia_semana]['eventos'][$categoria][]=$dia;

                                  }

                                  foreach ($eventos_dias as $dia => $eventos) {
                                  
                                    ?>

                                    <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix row">

                                      <h4 class="text-center nombre-dia"><?php

                                        $dias_español=array(
                                          'monday'=>'lunes',
                                          'tuesday'=>'martes',
                                          'wednesday'=>'miercoles',
                                          'thursday'=>'jueves',
                                          'friday'=>'viernes',
                                          'saturday'=>'sábado',
                                          'sunday'=>'domingo'
                                        );
                                        $i=0;
                                        foreach ($dias_español as $key => $value) {
                                          //echo $key."  ".$dia."<br>";
                                          if (strtolower($dia)==$key) {
                                            echo $value;
                                          }

                                        } 
                                        ?></h4>

                                      <?php  

                                      foreach ($eventos['eventos'] as $tipo => $evento_dia) {
                                        
                                        ?>

                                        <div class="col-md-4">
                                          <p><?php echo $tipo; ?>:</p>
                                          <?php  

                                          foreach ($evento_dia as $evento) {
                                            ?>
                                            <label>

                                              <input <?php echo (in_array($evento['id'], $eventosId)? 'checked': ''); ?> type="checkbox" class="idEvento<?php echo $evento['id'];?>" name="registro[]" id="<?php echo $evento['id'] ?>" value="<?php echo $evento['id'] ?>">
                                              <time><?php echo $evento['hora'] ?></time> <?php echo $evento['nombre_evento'] ?><br>
                                              <span class="autor"><?php echo $evento['nombre_invitado']." ".$evento['apellido_invitado']; ?></span>

                                              <input type="hidden" name="" id="primerId" value="<?php echo $primerId['evento_id']; ?>">
                                              <input type="hidden" name="" id="ultimoId" value="<?php echo $ultimoId['evento_id']; ?>">

                                            </label>

                                            <?php

                                          }

                                          ?>
                                        </div>

                                        <?php

                                      }

                                      ?>

                                    </div> 

                                    <?php

                                  }

                                ?>


                            </div><!--.caja-->

                        </div> <!--#eventos .eventos .clearfix-->
                          <div id="eventos" class="eventos clearfix">

                           <h3>Elige tus talleres</h3>

                             <div id="resumen" class="resumen clearfix">
                               
                              <h3>Pago extra</h3>

                              <div class="caja clearfix row">
                                
                                <div class="extras col-md-6">
                                  
                                  <div class="orden">
                                    
                                    <label for="camisa_evento">Camisa del evento $10 <small>(promoción 7% dscto.)</small></label>

                                    <input value="<?php echo $boletos['camisas']; ?>" type="number" name="pedido_extra[camisas][cantidad]" min="0" id="camisa_evento" class="form-control"size="3" placeholder="0">
                                    <input type="hidden" value="10" name="pedido_extra[camisas][precio]">

                                  </div><!--orden-->

                                  <div class="orden">
                                    
                                    <label for="etiquetas">Paquetes de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                                    <input value="<?php echo $boletos['etiquetas']; ?>" type="number" name="pedido_extra[etiquetas][cantidad]" min="0" id="etiquetas" class="form-control"size="3" placeholder="0">
                                    <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">

                                  </div><!--orden-->

                                  <div class="orden">
                                    
                                    <label for="regalo">Seleccione un regalo</label><br>

                                    <select id="regalo" name="regalo" required="" class="form-control  <!--seleccionar--> ">
                                      
                                      <option value="" disabled="" selected="">--Seleccione un regalo--</option>

                                      <option value="2" <?php echo ($registrado['regalo'] == 2) ? 'selected':''; ?>>Etiquetas</option>

                                      <option value="1" <?php echo ($registrado['regalo'] == 1) ? 'selected':''; ?>>Pulsera</option>

                                      <option value="3" <?php echo ($registrado['regalo'] == 3) ? 'selected':''; ?>>Plumas</option>

                                    </select><br>

                                    <input type="button" id="calcular" class="btn btn-success" value="Calcular">

                                  </div><!--orden-->

                                </div><!--extras-->

                                <div class="total">
                                  
                                  <p>Resumen</p>

                                  <div id="lista-productos"></div>

                                  <p>Total ya pagado: $<?php echo (float)$registrado['total_pagado']; ?></p>


                                  <p>Total</p>

                                  <div id="suma-total"></div></div><!--total-->

                                  <script>

                                    var primerId=$('#primerId').val();
                                    var ultimoId=$('#ultimoId').val();
                                    var listaIdEventos=[];

                                    $('#calcular').on('click', function(){
                                      console.log();
                                      while(primerId<=ultimoId){
                                        
                                        if ($('.idEvento'+primerId).prop('checked')) {

                                          listaIdEventos.push($('.idEvento'+primerId).val());

                                        }
                                        
                                        primerId++;

                                      }

                                      $('#arrayIdEventos').val(listaIdEventos);

                                      console.log(listaIdEventos);

                                    });

                                  </script>

                              </div><!--caja clearfix-->

                            </div><!--resumen-->
                      </div> <!--#eventos .eventos .clearfix-->
                      </div>
                    </div><!--TALLERES-->

                  <div class="box-footer">

                    <input type="hidden" name="total_pedido" id="total_pedido">
                    <input type="hidden" name="tota_descuento" id="tota_descuento" value="tota_descuento">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $registrado['id_registrado']; ?>">
                    <input type="hidden" name="fecha_registro" value="<?php echo $registrado['fecha_registro']; ?>">
                     <input type="hidden" name="arrayIdEventos" id="arrayIdEventos"> 
                    <button type="submit" class="btn btn-primary" id="btnRegistro">Guardar</button>

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


