<?php 

	include_once 'funciones/funciones.php';
	//error_reporting(0);
	$nombre= isset($_POST['nombre_invitado'])? $_POST['nombre_invitado'] : '';
	$apellido= isset($_POST['apellido_invitado'])? $_POST['apellido_invitado'] : '';
	$biografia= isset($_POST['biografia_invitado'])? $_POST['biografia_invitado'] : '';
	$id_registro= isset($_POST['id_registro'])? $_POST['id_registro'] : '';


	if ($_POST['registro']=='nuevo') {

		$directorio='../img/invitados/';

		//Devuelve TRUE si el nombre de archivo existe y es un directorio, FALSE si no. 
		if (!is_dir($directorio)) {
			
			//Crea un directorio
			mkdir($directorio, 0755, true);

		}

		//MOVER EL ARCHIVO
		if (move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio.$_FILES['archivo_imagen']['name'])) {
			
			$imagen_url=$_FILES['archivo_imagen']['name'];
			$imagen_resultado='Se subio correctamente';

		}else{

			$respuesta=array(

				'respuesta'=>error_get_last()

			);

		}


		try {

			$stmt=$conn->prepare('INSERT INTO invitados(nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES(?, ?, ?, ?)');
			$stmt->bind_param('ssss', $nombre, $apellido, $biografia, $imagen_url);
			$stmt->execute();
			$id_insertado=$stmt->insert_id;

			if ($stmt->affected_rows) {
				
				$respuesta=array(

					'respuesta'=>'exito',
					'id_insertado'=>$id_insertado,
					'resultado_imagen'=>$imagen_resultado

				);

			}else{

				$respuesta=array(

					'respuesta'=>'error'

				);

			}

			$stmt->close();
			$conn->close();

			
		} catch (Exception $e) {

			$resultado=array(

				'respuesta'=>$e->getMessage()

			);
			
		}
		

		echo json_encode($respuesta);

	}









	if ($_POST['registro']=='actualizar') {

		$directorio='../img/invitados/';

		//Devuelve TRUE si el nombre de archivo existe y es un directorio, FALSE si no. 
		if (!is_dir($directorio)) {
			
			//Crea un directorio
			mkdir($directorio, 0755, true);

		}

		//MOVER EL ARCHIVO
		if (move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio.$_FILES['archivo_imagen']['name'])) {
			
			$imagen_url=$_FILES['archivo_imagen']['name'];
			$imagen_resultado='Se subio correctamente';

		}else{

			$respuesta=array(

				'respuesta'=>error_get_last()

			);

		}


		try {

			if ($_FILES['archivo_imagen']['size'] > 0) {
				
				//con imagen
				$stmt=$conn->prepare('UPDATE invitados SET nombre_invitado=?, apellido_invitado=?, descripcion=?, url_imagen=?, editado=NOW() WHERE invitado_id=?');
				$stmt->bind_param("ssssi", $nombre, $apellido, $biografia, $imagen_url, $id_registro);

			}else{

				//sin imagen
				$stmt=$conn->prepare('UPDATE invitados SET nombre_invitado=?, apellido_invitado=?, descripcion=? WHERE invitado_id=?');
				$stmt->bind_param("sssi", $nombre, $apellido, $biografia, $id_registro);

			}

			$estado=$stmt->execute();
			$registros=$stmt->affected_rows;

			if ($estado==true) {
				
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

			$stmt=$conn->prepare("DELETE FROM invitados WHERE invitado_id=?");
			$stmt->bind_param('i', $id_borrar);
			$stmt->execute();
			if ($stmt->affected_rows) {
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

