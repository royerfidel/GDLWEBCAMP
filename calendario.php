

<!--ENLACES A HOJAS DE ESTILO Y LIBRERIAS, CABECERA Y BARRA-->
<?php include_once 'include/template/header.php'; ?>







  <section class="seccion  contenedor">

    <h2>Calendario de eventos</h2>

    <?php

      try {

        require_once('include/funciones/conexion.php');
        $sql="select evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado from eventos";
        $sql.=" inner join categoria_evento on eventos.id_cat_evento = categoria_evento.id_categoria ";
        $sql.=" inner join invitados on eventos.id_inv = invitados.invitado_id";
        $sql.=" order by evento_id";
        $resultado=$conn->query($sql);
        
      } catch (Exception $e) {
        
        echo $e->getMessage();

      }

    ?>

    <div class="calendario">
      
      <?php

        $calendario=array();
        while ($eventos=$resultado->fetch_assoc()) {

          $fecha=$eventos['fecha_evento'];//obtiene la fecha del evento

          $evento=array(
            'titulo'=>$eventos['nombre_evento'],
            'fecha'=>$eventos['fecha_evento'],
            'hora'=>$eventos['hora_evento'],
            'categoria'=>$eventos['cat_evento'],
            'icono'=>$eventos['icono'],
            'invitado'=>$eventos['nombre_invitado']." ".$eventos['apellido_invitado']
          );

          $calendario[$fecha][]=$evento;//agrupa segun el campo que se indique
        }//end while

        //imprime todo los event_buffer_priority_set(bevent, priority)
        foreach ($calendario as $dia => $lista_eventos) {
          ?>

            <h3>
            <?php
            //UNIX
            //setlocale(LC_TIME, 'es_ES');
            //WINDOWS
            setlocale(LC_TIME, 'spanish');
            ?>
            <i class="fa fa-calendar"></i> 
            <?php
              $fechaTotal=strftime("%A, %d de %B del %Y", strtotime($dia));
              $nombreDia=explode(',', $fechaTotal); 
              if ( strpos($nombreDia[0], 'coles') ) {
                echo "MIÉRCOLES, ".$nombreDia[1];
              }else if ( strpos($nombreDia[0], 'bado') ) {
                echo "SÁBADO, ".$nombreDia[1];
              }else{
                echo $nombreDia[0].", ".$nombreDia[1];
              }
            ?>

          </h3>
          <?php
            foreach ($lista_eventos as $evento) {
              ?>
              <div class="dia">

                <p class="titulo"><?php echo $evento['titulo']; ?></p>

                <p class="hora"><i class="far fa-clock" aria-hidden="true"></i> <?php echo $evento['fecha']." ".$evento['hora']; ?></p>

                <p class="categoria"><i class="fa <?php echo $evento['icono']; ?>" aria-hidden="true"></i> <?php echo $evento['categoria']; ?></p>

                <p class="invitado"><i class="fa fa-user"></i> <?php echo $evento['invitado']; ?></p>
                
              </div>
              <?php
            }//fin foreach eventos
        }//fin foreach calendario
      ?>

    </div>

    <?php $conn->close(); ?>

  </section><!--seccion  contenedor-->








<!--FOOTER Y SCRIPTS-->
<?php include_once 'include/template/footer.php'; ?>
