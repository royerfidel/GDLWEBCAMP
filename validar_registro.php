<?php

	if (isset($_POST['submit'])) {
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$email=$_POST['email'];
		$regalo=$_POST['regalo'];
		$fecha=date('Y-m-d H:i:s');
		$total_pagado=$_POST['total_pedido'];

		//PEDIDOS
		$boletos=$_POST['boletos'];
		$camisas=$_POST['pedido_camisas'];
		$etiquetas=$_POST['pedido_etiquetas'];

		include_once 'include/funciones/funciones.php';
		$pedido=productos_json($boletos, $camisas, $etiquetas);

		//EVENTOS
		$eventos=$_POST['registro'];
		$registro=eventos_json($eventos);
		try {

			require_once('include/funciones/conexion.php');
			$stmt=$conn->prepare("INSERT INTO registrados(nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssssis",$nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total_pagado);
			$stmt->execute();
			$stmt->close();
			$conn->close();
			header('Location: validar_registro.php?exitoso=1');
			
		} catch (Exception $e) {
				
			$error=$e->getMessage();

		}
	}	

?>

<!--ENLACES A HOJAS DE ESTILO Y LIBRERIAS, CABECERA Y BARRA-->
<?php include_once 'include/template/header.php'; ?>



  <section class="seccion contenedor">
    
    <h2>Resumen registro</h2>
    	<?php 

    		if (isset($_GET['exitoso'])) {
    			if ($_GET['exitoso']=='1') {
    					echo "Registro exitoso";
    			}
    		}

    	?>


  </section><!--seccion contenedor-->



















<!--FOOTER Y SCRIPTS-->
<?php include_once 'include/template/footer.php'; ?>