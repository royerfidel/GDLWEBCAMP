<?php 
	include_once 'funciones/funciones.php';
	//error_reporting(0);
	$titulo= isset($_POST['titulo_evento'])? $_POST['titulo_evento']: '' ;
	$categoria_id= isset($_POST['categoria_evento'])? $_POST['categoria_evento']: '' ;
	$invitado_id=isset($_POST['invitado'])? $_POST['invitado']: '' ;

	$fecha=isset($_POST['fecha_evento'])? $_POST['fecha_evento']: '' ;
	$fecha_formateada=date('Y-m-d', strtotime($fecha));

	$hora=isset($_POST['hora_evento'])? $_POST['hora_evento']: '' ;

	// 5:00pm == 17:00
	$hora_fomateada=date('H:i', strtotime($hora));


	if ($_POST['registro']=='nuevo') {


		try {

			$stmt=$conn->prepare('INSERT INTO eventos(nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv) VALUES(?, ?, ?, ?, ?)');
			$stmt->bind_param('sssss', $titulo, $fecha_formateada, $hora_fomateada, $categoria_id, $invitado_id);
			$stmt->execute();
			$id_insertado=$stmt->insert_id;

			if ($stmt->affected_rows) {
				
				$respuesta=array(

					'respuesta'=>'exito',
					'id_insertado'=>$id_insertado

				);

			}else{

				$respuesta=array(

					'respuesta'=>'error'

				);

			}
			
		}catch (Exception $e) {

			$respuesta=array(

				'respuesta'=>$e->getMessage()

			);
			
		}
		

		echo json_encode($respuesta);

	}




	if ($_POST['registro']=='actualizar') {
					
		$id_registro=$_POST['id_registro'];


		try {

			$stmt=$conn->prepare('UPDATE eventos SET nombre_evento=?, fecha_evento=?, hora_evento=?, id_cat_evento=?, id_inv=?, editado=NOW() WHERE evento_id=?');
			$stmt->bind_param('sssiii', $titulo, $fecha_formateada, $hora_fomateada, $categoria_id, $invitado_id, $id_registro);
			$stmt->execute();

			if ($stmt->affected_rows) {
				
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

			$stmt=$conn->prepare("DELETE FROM eventos WHERE evento_id=?");
			$stmt->bind_param('i', $id_borrar);
			$stmt->execute();
			if ($stmt->affected_rows) {
				$respuesta=array(

					'respuesta'=>'exito',
					'id_eliminado'=>$id_borrar
					
				);
			}
			
		} catch (Exception $e) {
				
			$respuesta=array(

				'respuesta'=>$e->getMessage()

			);

		}

		echo json_encode($respuesta);

	}

?>

