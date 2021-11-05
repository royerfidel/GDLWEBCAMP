<?php 
	include_once 'funciones/funciones.php';
	//error_reporting(0);
	$usuario= isset($_POST['usuario'])? $_POST['usuario'] : '' ;
	$nombre= isset($_POST['nombre'])? $_POST['nombre'] : '' ;
	$password= isset($_POST['password'])? $_POST['password'] : '' ;
	$id_registro= isset($_POST['id_registro'])? $_POST['id_registro'] : '' ;

	if ($_POST['registro']=='nuevo') {
		
		//Encriptar el password
		$opciones=array(
			'cost'=>12
		);

		$password_hashed=password_hash($password, PASSWORD_BCRYPT, $opciones);

		try {
			
			require_once('funciones/funciones.php');

			$stmt=$conn->prepare('INSERT INTO admin(usuario, nombre, password) VALUES(?, ?, ?)');
			$stmt->bind_param('sss', $usuario, $nombre, $password_hashed);
			$stmt->execute();
			$id_registro=$stmt->insert_id;

			if ($stmt->affected_rows) {
				
				$respuesta=array(

					'respuesta'=>'exito',
					'id_admin'=>$stmt->insert_id

				);

			}else{

				$respuesta=array(

					'respuesta'=>'error'

				);

			}

			$stmt->close();
			$conn->close();


		} catch (Exception $e) {
			
			echo "Error".$e->getMessage();

		}

		echo json_encode($respuesta);

	}




	if ($_POST['registro']=='actualizar') {
				

		try {

			if (empty($_POST['password'])) {
					
				$stmt=$conn->prepare('UPDATE admin SET usuario=?, nombre=?, editado=NOW() WHERE id_admin=?');
				$stmt->bind_param('ssi', $usuario, $nombre, $id_registro);

			}else{

				$opciones=array(

					'cost'=>12

				);

				$hash_password=password_hash($password, PASSWORD_BCRYPT, $opciones);
				
				require_once('funciones/funciones.php');

				$stmt=$conn->prepare('UPDATE admin SET usuario=?, nombre=?, password=?, editado=NOW() WHERE id_admin=?');
				$stmt->bind_param('sssi', $usuario, $nombre, $hash_password, $id_registro);

			}

			$stmt->execute();

			if ($stmt->affected_rows) {
				
				$respuesta=array(

					'respuesta'=>'exito',
					'id_actualizado'=>$stmt->insert_id

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

			$stmt=$conn->prepare("DELETE FROM admin WHERE id_admin=?");
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

