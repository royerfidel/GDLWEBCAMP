<?php 

	include_once 'funciones/funciones.php';
	//error_reporting(0);

	$nombre=isset($_POST['nombre_registrado'])? $_POST['nombre_registrado'] : '';
	$apellido=isset($_POST['apellido_registrado'])? $_POST['apellido_registrado'] : '';
	$email=isset($_POST['email'])? $_POST['email'] : '';


	/*BOLETOS*/
	$boletos_adquiridos=isset($_POST['boletos'])? $_POST['boletos'] : '';
	/*CAMISAS Y ETIQUETAS*/
	$camisas= isset($_POST['pedido_extra']['camisas']['cantidad'])? $_POST['pedido_extra']['camisas']['cantidad'] : '';
	$etiquetas=isset($_POST['pedido_extra']['etiquetas']['cantidad'])? $_POST['pedido_extra']['etiquetas']['cantidad'] : '';


	if ($boletos_adquiridos!="" || $camisas!="" || $etiquetas!="") {
		$pedido=productos_json($boletos_adquiridos, $camisas, $etiquetas);
	}


	$total=isset($_POST['total_pedido'])?$_POST['total_pedido']:'';
	$regalo=isset($_POST['regalo'])?$_POST['regalo']:'';


	$eventos=isset($_POST['arrayIdEventos'])? $_POST['arrayIdEventos'] : '';
	if ($eventos!="") {
		$arrayIdEventos=explode(',', $eventos);
		$registro=eventos_json($arrayIdEventos);
	}


	$fecha_registro=date('Y-m-d H:i:s');
	$id_registro=isset($_POST['id_registro'])?$_POST['id_registro']:'';


	if ($_POST['registro']=='nuevo') {
		try {

			$stmt=$conn->prepare('INSERT INTO registrados(nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
			$stmt->bind_param('ssssssis', $nombre, $apellido, $email, $fecha_registro, $pedido, $registro, $regalo, $total);
			$stmt->execute();
			$id_insertado=$stmt->insert_id;

			if ($stmt->affected_rows > 	0) {
				
				$respuesta=array(

					'respuesta'=>'exito',
					'id_insertado'=>$id_insertado

				);

			}else{

				$respuesta=array(

					'respuesta'=>'error'

				);

			}
			
		} catch (Exception $e) {

			$resultado=array(

				'respuesta'=>$e->getMessage()

			);
			
		}
		

		echo json_encode($respuesta);

	}




	if ($_POST['registro']=='actualizar') {
		
		try {

			$stmt=$conn->prepare('UPDATE registrados SET nombre_registrado=?, apellido_registrado=?, email_registrado=?, fecha_registro=?, pases_articulos=?, talleres_registrados=?, regalo=?, total_pagado=? WHERE id_registrado=?');
			$stmt->bind_param('ssssssisi', $nombre, $apellido, $email, $fecha_registro, $pedido, $registro, $regalo, $total, $id_registro );
			$stmt->execute();

			if ($stmt->affected_rows > 0) {
				
				$respuesta=array(

					'respuesta'=>'exito',
					'id_actualizado'=>$id_registro

				);

			}else{

				$respuesta=array(

					'respuesta'=>'error'

				);

			}

			$stmt->close();
			$conn->close();


		} catch (Exception $e) {

			$respuesta=array(

					'respuesta'=>$e->getMessage()

			);

		}

		echo json_encode($respuesta);

	}




	if ($_POST['registro']=='eliminar'){

		$id_borrar=$_POST['id'];

		try {

			$stmt=$conn->prepare("DELETE FROM registrados WHERE id_registrado=?");
			$stmt->bind_param('i', $id_borrar);
			$stmt->execute();
			if ($stmt->affected_rows > 0 ) {
				$respuesta=array(

					'respuesta'=>'exito',
					'id_eliminado'=>$id_borrar
					
				);
			}
			
		} catch (Exception $e) {
				
			$resultado=array(

				'respuesta'=>$e->getMessage()

			);

		}

		echo json_encode($respuesta);

	}


?>

 