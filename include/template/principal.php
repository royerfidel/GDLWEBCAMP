

<!--TEXTO DE CONTENIDO-->
<section class="seccion  contenedor">

  <h2>La mejor conferencia de diseño web ada</h2>

  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat.</p>

</section><!--seccion  contenedor-->



<!--CONTENIDO DEL VIDEO-->
<section class="programa">

	<div class="contenedor-video">

	  	<video autoplay loop poster="img/bg-talleres.jpg">

		    <source src="video/video.mp4" type="video/mp4">

		    <source src="video/video.webn" type="video/webn">

		    <source src="video/video.ogv" type="video/ogg">

	  	</video>

	</div><!--contenedor-video--->

















  <!--CONTENIDO TEXTUAL-->
  <div class="contenido-programa">

    <div class="contenedor">

      <div class="programa-evento">

          <h2>Programa del evento</h2>

          <?php

          	try {

  	            $sql="SELECT * FROM categoria_evento";
  	            $resultado=$conn->query($sql);
            
          	} catch (Exception $e) {
            
            		echo $e->getMessage();

          	}

        	?>

  	    <nav class="menu-programa">
  	        <?php
  		        while ($cat=$resultado->fetch_array(MYSQLI_ASSOC)) {
  		        ?>
  		           	<a href="#<?php echo strtolower($cat['cat_evento']); ?>" class="evento<?php echo strtolower($cat['cat_evento']); ?>  claseEvento"><i class="fa <?php echo $cat['icono'] ?>" aria-hidden="true"> <?php echo $cat['cat_evento']; ?></i></a>
  		        <?php
  		        }
  	        ?>
  	    </nav><!--menu-programa-->

        	<?php 
          	try {

              	$sql_idCatEvento="SELECT id_categoria FROM categoria_evento ORDER BY id_categoria ASC";
            		$sql_totalIdCatEvento="SELECT COUNT(id_categoria) AS total_idCatEvento FROM categoria_evento";

            		$result=$conn->query($sql_idCatEvento);
            		$result2=$conn->query($sql_totalIdCatEvento);

            		$total_idCatEvento=$result2->fetch_assoc();

            		while ($id_categoria=$result->fetch_assoc()) {

        				$sql="SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado FROM eventos";
              		$sql.=" INNER JOIN categoria_evento on eventos.id_cat_evento = categoria_evento.id_categoria ";
              		$sql.=" INNER JOIN invitados on eventos.id_inv = invitados.invitado_id";
              		$sql.=" and eventos.id_cat_evento='".$id_categoria['id_categoria']."'";
              		$sql.=" order by evento_id limit 2;";

              		$conn->multi_query($sql);
              		do {
                 			$resultado=$conn->store_result();
                 			$row=$resultado->fetch_all(MYSQLI_ASSOC);
                 			$i=0;
                 			foreach ($row as $evento) {
                  			if ($i%2==0) {
                  			?>
                     				<div id="<?php echo strtolower($evento['cat_evento']) ?>" class="info-curso ocultar clearfix">
  		                			<?php
  		                			} ?>
  		                    		<div class="detalle-evento">
  		                     			<h3><?php echo $evento['nombre_evento']; ?></h3>
  		                      			<p><i class="far fa-clock" aria-hidden="true"></i><?php echo $evento['hora_evento'] ?></p>
  		                     			<p><i class="fas fa-calendar" aria-hidden="true"></i><?php echo $evento['fecha_evento'] ?></p>
  		                        		<p><i class="fas fa-user" aria-hidden="true"></i><?php echo $evento['nombre_invitado']." ".$evento['apellido_invitado']; ?></p>
  		                    		</div><!--detalle-evento-->
  		                    		<?php 
  		                    			if ($i%2==1) {
  		                    			?>
  		                    				<a href="#" class="calendario enlace-header button float-rigth">Ver todos</a>
                    				</div><!----->
                   			<?php
                    			}
                   			$i++;
                 			}
                 			$resultado->free();
               		} while ( $conn->more_results() && $conn->next_result());

            		}

          	} catch (Exception $e) {
            
            		echo $e->getMessage();
          	}

        	?>

      </div><!--programa-evento--->

    </div> <!--contenedor-->

  </div><!---contenido-programa-->

</section><!--programa-->




<!--SECCION DE INVITADOS-->
<?php include 'include/template/invitados.php' ?>



<!--CONTADOR-->
<section>

  <div class="contador parallax">

    <div class="contador">

      <ul class="resumen-evento clearfix">

        <li>

          <p class="numero"></p>Invitados

        </li>

        <li>

          <p class="numero"></p>Talleres

        </li>

        <li>

          <p class="numero"></p>Dias

        </li>

        <li>

          <p class="numero"></p>Conferencias

        </li>

      </ul><!--resumen-evento clearfix-->

    </div><!--contador-->

  </div><!--contador parallax-->

</section>



<!--PRECIOS-->
<section class="precios seccion">

  <h2>Precios</h2>

  <div class="contenedor clearfix">

    <ul class="lista-precios clearfix">

      <li>

        <div class="tabla-precio">

          <h3>Paso por día</h3>
          <p class="numero">$30</p>
          <ul>

            <li>Bocadillos gratis</li>

            <li>Bocadillos gratis</li>

            <li>Bocadillos gratis</li>

          </ul>

          <a href="" class="button hollow">Comprar</a>

        </div><!--tabla-precio-->

      </li>

      <li>

        <div class="tabla-precio">

          <h3>Todos los dias</h3>
          <p class="numero">$30</p>
          <ul>

            <li>Bocadillos gratis</li>

            <li>Bocadillos gratis</li>

            <li>Bocadillos gratis</li>

          </ul>

          <a href="" class="button hollow">Comprar</a>

        </div><!--tabla-precio-->

      </li>

      <li>

        <div class="tabla-precio">

          <h3>Pase por dos dias</h3>

          <p class="numero">$30</p>

          <ul>

            <li>Bocadillos gratis</li>

            <li>Bocadillos gratis</li>

            <li>Bocadillos gratis</li>

          </ul>

          <a href="" class="button hollow">Comprar</a>

        </div><!--tabla-precio-->

      </li>

    </ul><!--lista-precios clearfix-->

  </div><!--contenedor clearfix-->

</section><!--precios seccion-->



<!--GOOGLE MAPS-->
<div id="mapa">

</div><!--mapa-->



<!--TESTIMONIALES-->
<section class="seccion">

  <h2>Testimoniales</h2>

  <div class="testimoniales contenedor clearfix">

    <div class="testimonial clearfix">

      <blockquote>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>

        <footer class="info-testimonial">

          <img src="img/testimonial.jpg" alt="imagen testimonial">

          <cite>Oswaldo Aponte Escovedo <span>Diseñador de Bolivia</span></cite>

        </footer><!--info-testimonial-->

      </blockquote>

    </div>

    <div class="testimonial clearfix">

      <blockquote>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>

        <footer class="info-testimonial">

          <img src="img/testimonial.jpg" alt="imagen testimonial">

          <cite>Oswaldo Aponte Escovedo <span>Diseñador de Bolivia</span></cite>

        </footer><!--info-testimonial-->

      </blockquote>

    </div>

    <div class="testimonial clearfix">

      <blockquote>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>

        <footer class="info-testimonial">

          <img src="img/testimonial.jpg" alt="imagen testimonial">

          <cite>Oswaldo Aponte Escovedo <span>Diseñador de Bolivia</span></cite>

        </footer><!--info-testimonial-->

      </blockquote>

    </div><!--testimonial clearfix-->

  </div><!--testimoniales contenedor clearfix-->

</section><!--seccion-->




<!--NEWSLETTER-->
<div class="newsletter parallax">

  <div class="contenido contenedor">

    <p>Registrate al newsletter:</p>

    <h3>gdlwebcam</h3>

    <a href="#mc_embed_signup" class="boton_newsletter button transparent">Registro</a>

  </div><!--contenido contenedor-->

</div><!--newsletter parallax-->



<!--CONTADOR-->
<section class="seccion clearfix">

  <h2>Faltan</h2>

  <div class="cuenta-regresiva">

    <ul class="clearfix">

      <li>

        <p id="dias" class="numero"></p> días

      </li>

      <li>

        <p id="horas" class="numero"></p> horas

      </li>

      <li>

        <p id="minutos" class="numero"></p> minutos

      </li>

      <li>

        <p id="segundos" class="numero"></p> segundos

      </li>

    </ul><!--clearfix-->

  </div><!--cuenta-regresiva-->

</section><!--seccion clearfix-->

