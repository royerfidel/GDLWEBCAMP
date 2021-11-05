<?php
  include 'conexion.php';
  setlocale(LC_ALL, 'spanish');

?>


  <section class="seccion contenedor">
    
    <h2>Registro de usuario</h2>

    <form id="registro"  class="registro" action="pagar.php" method="POST">
      
      	<div id="datos_usuario" class="registro caja clearfix">
        
        	<div class="campo">
          
          		<label for="nombre">Nombre:</label>

          		<input type="text" name="nombre" id="nombre" class="datos-usuario" placeholder="tu Nombre" required="">

        	</div>

        	<div class="campo">
          
          		<label for="apellido">Apellido:</label>

          		<input type="text" name="apellido" id="apellido" placeholder="tu Apellido">
          
        	</div>

        	<div class="campo">
          
          		<label for="email">Email:</label>

          		<input type="email" name="email" id="email" class="datos-usuario" placeholder="tu Email" required="">
          
        	</div>

        	<div id="error"></div>

      	</div><!--datos_usuario registro caja clearfix-->





      	<div id="paquetes" class="paquetes">
        
        	<h3>Elije el numero de boletos</h3>

        	<!--PRECIOS-->
        	<section class="precios seccion">

          		<h2>Precios</h2>

          		<div class="contenedor clearfix">
                
                <div class="next">
                  <?php  
                    $sql_num_dias="SELECT numero_dias FROM boletos ORDER BY numero_dias ASC";
                    $result=$conn->query($sql_num_dias);

                    //ARRAY PARA ALMACENAR LOS NUMEROS DE DIAS
                    $array_num_dias=array();

                    while ($num_dias=$result->fetch_assoc()) {

                      $array_num_dias[]=$num_dias['numero_dias'];
                      ?>  
                        <i class="fas fa-circle circle" id="<?php echo $num_dias['numero_dias']; ?>"></i>
                      <?php

                    }
                  ?>


                </div>

            		<ul class="lista-precios clearfix">

            			<?php  

            				$sql="SELECT * FROM boletos ORDER BY numero_dias ASC";
            				$result=$conn->query($sql);
                    $i=0;

                    //ARRAY PARA ALMACENAR LOS IDS DE LOS BOLETOS
                    $id_boleto=array();

            				while ($boletos=$result->fetch_assoc()) {

                      //ALMACENAR LOS TIPOS DE BOLETOS EN EL ARRAY
                      $ndias[]=$boletos['numero_dias'];

            					?>
            						
            						<li class="datos_boleto"> 
  			                		<div class="tabla-precio" id="contenedor<?php echo $boletos['numero_dias'] ?>">
  			                  		<h3><?php echo $boletos['descripcion']; ?></h3>
  			                  		<p class="numero">$<?php echo $boletos['precio']; ?></p>

  			                  		<ul>

  							                <li>Bocadillos gratis</li>

  							                <li>Bocadillos gratis</li>

  							                <li>Bocadillos gratis</li>

  			                  		</ul><!--.numero-->
  		                  					
  	                  				 	<?php

                                  //EXTRAER EL DIA DE LA FECHA DEL EVENTO 
                                  $sql_dia_evento="SELECT DISTINCT fecha_evento FROM eventos";
                                  $dia_evento=$conn->query($sql_dia_evento);
                                  $array_dias_evento=array();
                                  
                                  //EXTRAER EL NOMBRE DEL DIA DE LA FECHA DEL EVENTO Y  ALAMCENARLO EN UN ARRAY
                                  while ($dias_evento=$dia_evento->fetch_assoc()) {
                                    $dias_evento=strftime("%A", strtotime($dias_evento['fecha_evento']));
                                    $array_dias_evento[]=$dias_evento;
                                    
                                  }
                                  //ELIMINAR LOS VALORES REPETIDOS
                                  $array_dias_evento=array_unique($array_dias_evento);

                    						?>
                    						
                                <?php  

                                  if ($boletos['numero_dias']>1) {
                                    ?>
                                      <div id="lista-dias-evento">
                                        <?php  
                                            
                                            foreach ($array_dias_evento as $key => $value){
                                              //CONDICIONES PARA REEMPLAZAR LOS CARACTERES RAROS
                                              if ( strpos($value, 'rcoles') ) {
                                                $valor_dia="miércoles";
                                              }elseif ( strpos($value, 'bado') ) {
                                                $valor_dia="sábado";
                                              }else{                                             
                                                $valor_dia=$value;
                                              }
                                              ?>
                                              <div class="valor-dia">
                                                <input type="checkbox" value="<?php echo $valor_dia; ?>" id="<?php echo $valor_dia.$boletos['numero_dias']; ?>" class="<?php echo $boletos['numero_dias']; ?> check_dia<?php echo $boletos['numero_dias']; ?> boletos">
                                                <label>
                                                  <?php
                                                    //CONVERTIR EN MAYUSCULA EL PRIMER CARACTER DE LA PALABRA
                                                    echo ucwords($valor_dia);
                                                  ?> 
                                                </label>   
                                              </div>                        
                                              <?php
                                            }
                                          ?>
                                      </div>
                                    <?php
                                  }

                                ?>
  													
  											        <?php  

                                  if ($boletos['numero_dias']==1) {
                                    ?>
                                      <div id="select_un_dia">
                                        <select name="" id="un_dia_seleccionado" class="<?php echo $boletos['numero_dias']; ?>  boletos">
                                          <option selected disabled>-- Elija un dia --</option>
                                          <?php  
                                            
                                            foreach ($array_dias_evento as $key => $value){
                                              //CONDICIONES PARA REEMPLAZAR LOS CARACTERES RAROS
                                              if ( strpos($value, 'rcoles') ) {
                                                $valor_dia="miércoles";
                                              }elseif ( strpos($value, 'bado') ) {
                                                $valor_dia="sábado";
                                              }else{                                             
                                                $valor_dia=$value;
                                              }
                                              ?>
                                                <option value="<?php echo $valor_dia; ?>" class="<?php echo $valor_dia; ?>">
                                                  <?php
                                                    //CONVERTIR EN MAYUCULA EL PRIMER CARACTER DE LA PALABRA
                                                    echo ucwords($valor_dia);
                                                  ?>                      
                                                </option>
                                              <?php
                                            }
                                             
                                          ?>
                                        </select>
                                      </div>
                                    <?php
                                  }

                                ?>

                                <br>

  			                  			<div class="orden">
  			                    
  			                    			<label for="pase_dia">Boletos deseados:</label>

  			                    			<input type="number" min="0" name="boletos[<?php echo $boletos['tipo']; ?>][cantidad]" id="<?php echo $boletos['tipo']; ?>" size="3" placeholder="0" class="<?php echo $boletos['numero_dias']; ?> boletos nboletos<?php echo $boletos['numero_dias']; ?>">

  			                    			<input type="hidden" value="<?php echo $boletos['precio'] ?>" name="boletos[<?php echo $boletos['tipo']; ?>][precio]">

  			                 				</div><!--.orden-->

  			                		</div><!--tabla-precio-->

			              		</li>

            					<?php
                      $i++;
            				}

            			?>
              			

            		</ul><!--lista-precios clearfix-->

          		</div><!--contenedor clearfix-->

        	</section><!--.precios .seccion-->

      	</div><!--#paquetes .paquetes-->

    <div id="eventos" class="eventos clearfix">

         <h3>Elige tus talleres</h3>

         <div class="caja">

              <?php  

                try {

                  require_once 'include/funciones/conexion.php';
                  $sql="SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado FROM eventos JOIN categoria_evento ON eventos.id_cat_evento=categoria_evento.id_categoria JOIN invitados ON eventos.id_inv=invitados.invitado_id ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento";

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

                  //REEMPLAZAR LOS DIAS QUE CONTENGAN CARACTERES EXTRAÑOS
                  if ( strpos($dia, 'coles') ) {
                    $dia_imprimir="MIÉRCOLES";
                  }else if ( strpos($dia, 'bado') ) {
                    $dia_imprimir="SÁBADO";
                  }else{
                    $dia_imprimir=$dia;
                  }
                      
                  ?>
                  
                  <div id="<?php echo strtoupper($dia_imprimir); ?>" class="contenido-dia clearfix">

                    <h4 class="text-center nombre-dia">
                        <?php  echo $dia_imprimir; ?>
                    </h4>

                    <?php  

                    foreach ($eventos['eventos'] as $tipo => $evento_dia) {
                      
                      ?>

                      <div>
                        <p><?php echo $tipo; ?>:</p>
                        <?php  
                      
                          foreach ($evento_dia as $evento) {         
                              $idEventos=array();
                            ?>
                            <label>

                              <input type="checkbox" name="registro[]" id="<?php echo $evento['id'] ?>" value="<?php echo $evento['id'] ?>" class="idEvento<?php echo $evento['id'];?> ">
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

        <div id="resumen" class="resumen clearfix">
           
          <h3>Pago extra</h3>

          <div class="caja clearfix">
            
            <div class="extras">
              
              <div class="orden">
                
                <label for="camisa_evento">Camisa del evento $10 <small>(promoción 7% dscto.)</small></label>

                <input type="number" name="pedido_extra[camisas][cantidad]" min="0" id="camisa_evento" size="3" placeholder="0">
                <input type="hidden" value="10" name="pedido_extra[camisas][precio]">

              </div><!--orden-->

              <div class="orden">
                
                <label for="etiquetas">Paquetes de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>

                <input type="number" name="pedido_extra[etiquetas][cantidad]" min="0" id="etiquetas" size="3" placeholder="0">
                <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">

              </div><!--orden-->

              <div class="orden">
                
                <label for="regalo">Seleccione un regalo</label><br>

                <select id="regalo" name="regalo" required="">
                  
                  <option value="" disabled="" selected="">--Seleccione un regalo--</option>

                  <option value="2">Etiquetas</option>

                  <option value="1">Pulsera</option>

                  <option value="3">Plumas</option>

                </select><br>

                <input type="button" id="calcular" class="button" value="Calcular">

              </div><!--orden-->

            </div><!--extras-->

            <div class="total">
              
              <p>Resumen</p>

              <div id="lista-productos"></div>

              <p>Total</p>

              <div id="suma-total"></div>


              <!--MANDAR LOS IDS DE LOS EVENTOS SELECIONADOS EN LOS CHECKBOX-->
              <script>               

                var primerId=$('#primerId').val();
                var ultimoId=$('#ultimoId').val();
                var listaIdEventos=[];

                $('#calcular').on('click', function(){

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

              <?php  
                //CONVERTIR EN  STRING EL ARRAY QUE ALMACENO LOS TIPOS DE BOLETO
                $ndias=implode(',', $ndias);

                $array_num_dias=implode(',', $array_num_dias);
              ?>
              
              <!-- ALMACENA LOS DIAS MARCADOS -->
              <input type="hidden" id="dias_marcados">
              
              <!-- ALMACENA TODOS LOS  NUMEROS DE DIAS DE LOS BOLETOS -->
              <input type="hidden" id="ndias"  value="<?php echo $ndias; ?>">
              
              <!-- ALMACENA LOS IDS DE LOS EVENTOS SELECCIONADOS EN LOS CHECKBOX-->
              <input type="hidden" name="arrayIdEventos" id="arrayIdEventos">
              <input type="hidden" name="lista_boletos" id="lista_boletos">

              <input type="hidden" name="total_pedido" id="total_pedido">
              <input type="hidden" name="tota_descuento" value="tota_descuento">
              <input type="submit" name="submit" id="btnRegistro" class="button" value="Pagar"> 

            </div><!--total-->

          </div><!--caja clearfix-->

        </div><!--resumen-->

    </form>

  </section><!--seccion contenedor-->

