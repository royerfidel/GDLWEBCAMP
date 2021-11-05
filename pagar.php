

<?php 

	// paypal/rest-api-sdk-php/lib/PayPal/Api
	use PayPal\Api\Payer;
	use PayPal\Api\Item;
	use PayPal\Api\ItemList;
	use PayPal\Api\Details;
	use PayPal\Api\Amount;
	use PayPal\Api\Transaction;
	use PayPal\Api\RedirectUrls;
	use PayPal\Api\Payment;

	require 'include/paypal.php';

	if (isset($_POST['submit'])) {

		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$email=$_POST['email'];
		$regalo=$_POST['regalo'];
		$fecha=date('Y-m-d H:i:s');
		$total_pagado=$_POST['total_pedido'];

		//PEDIDOS
		$boletos=$_POST['boletos'];
		$numero_boletos=$boletos;
		$camisas=$_POST['pedido_extra']['camisas']['cantidad'];
		$precioCamisa=$_POST['pedido_extra']['camisas']['precio'];
		$pedidoExtra=$_POST['pedido_extra'];
		$etiquetas=$_POST['pedido_extra']['etiquetas']['cantidad'];
		$precioEtiqueta=$_POST['pedido_extra']['etiquetas']['precio'];

		include_once 'include/funciones/funciones.php';
		$pedido=productos_json($boletos, $camisas, $etiquetas);

		//EVENTOS
		$eventos=$_POST['arrayIdEventos'];
		$arrayIdEventos=explode(',', $eventos);
		$registro=eventos_json($arrayIdEventos);

		//exit;

		try {

			require_once('include/funciones/conexion.php');
			$stmt=$conn->prepare("INSERT INTO registrados(nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssssis",$nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total_pagado);
			$stmt->execute();
			$ID_registro=$stmt->insert_id;
			$afectado=$stmt->affected_rows;
			$stmt->close();
			$conn->close();
			//header('Location: validar_registro.php?exitoso=1');
			
		} catch (Exception $e) {
				
			$error=$e->getMessage();

		}

	}


	//METODO DE PAGO
	$compra=new Payer();
	$compra->setPaymentMethod('paypal');

	$i=0;
	$arreglo_pedido=array();

	//RECORRER LOS BOLETOS COMPRADOS
	foreach ($numero_boletos as $key => $value) {
	
		if ((int)$value['cantidad'] > 0) {

			${"articulo$i"}=new Item();
			//SE ALMACENA EN EL ARRAY
			$arreglo_pedido[]=${"articulo$i"};
			//SE ASIGNA EL PRODUCTO QUE SE COMPRARÁ
			${"articulo$i"}->setName('Pase: '.$key)
			//SE ASIGNA LA MONEDA
					       ->setCurrency('USD')
			//SE ASIGNA LA CANTIDAD A COMPRAR
					       ->setQuantity((int)$value['cantidad'])
			//SE ASIGNA EL PRECIO
					       ->setPrice((float)$value['precio']);
			$i++;

		}

	}


	//RECORRER LOS PEDIDOS EXTRA(CAMISAS, ETIQUETAS)
	foreach ($pedidoExtra as $key => $value) {
		
		if ((int)$value['cantidad'] > 0) {

			if ($key=='camisas') {
				
				$precio=(float)$value['precio'] * .93;

			}else{

				$precio=(int)$value['precio'];

			}

			${"articulo$i"}=new Item();
			//SE ALMACENA EN EL ARRAY
			$arreglo_pedido[]=${"articulo$i"};
			//SE ASIGNA EL PRODUCTO QUE SE COMPRARÁ
			${"articulo$i"}->setName('Extras: '.$key)
			//SE ASIGNA LA MONEDA
					       ->setCurrency('USD')
			//SE ASIGNA LA CANTIDAD A COMPRAR
					       ->setQuantity((int)$value['cantidad'])
			//SE ASIGNA EL PRECIO
					       ->setPrice($precio);

		}

	}




	//LISTA DE ARTICULOS
	$listaArticulos=new ItemList();
	//GUARDAR LOS ARTICULOS EN UN ARRAY
	$listaArticulos->setItems($arreglo_pedido);







	//CANTIDAD A PAGAR
	$cantidad=new Amount();
	//TIPO DE MONEDA
	$cantidad->setCurrency('USD')
	//TOTAL- CANTIDAD COBRADA
			 ->setTotal($total_pagado);



	//TRANSACCION DEL DINERO
	$transaccion=new Transaction();
	//CANTIDAD A PAGAR
	$transaccion->setAmount($cantidad)
	//LISTA DE ARTICULOS
				->setItemList($listaArticulos)
	//DESCRIPCION
				->setDescription('Pago GDLWebCamp')
	//NUMERO PARA IDENTIFICAR EL PAGO
				->setInvoiceNumber($ID_registro);


	//REDIRECCIONAR
	$redireccionar=new RedirectUrls();
	//REDIRIGIR DESPUES DE COMPRAR
	$redireccionar->setReturnUrl(URL_SITIO.'/pago_finalizado.php?exito=true&id_pago='.$ID_registro)
	//REDIRIGIR SI ES QUE CANCELA LA COMPRAR
				  ->setCancelUrl(URL_SITIO.'/pago_finalizado.php?exito=false&id_pago='.$ID_registro);


	$pago=new Payment();
	//ALERTA 
	$pago->setIntent('sale')
		 ->setPayer($compra)
		 ->setRedirectUrls($redireccionar)
		 ->setTransactions(array($transaccion));

	try {
		
		$pago->create($apiContext);

	} catch (PayPal\Exception\PayPalConnectionException $pce) {
		?>
		<pre>
			<?php 
				print_r(json_decode($pce->getData())); 
				exit;
			?>
		</pre>
		<?php
	}

	//ENLACE DE APROBACION- SE REALIZO LA COMPRA EXITOSAMENTE
	$aprobado=$pago->getApprovalLink();
	header('Location:'.$aprobado);


?>
