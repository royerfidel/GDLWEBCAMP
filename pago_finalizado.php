

<!--ENLACES A HOJAS DE ESTILO Y LIBRERIAS, CABECERA Y BARRA-->
<?php include_once 'include/template/header.php'; ?>

  <section class="seccion contenedor">
    
    <h2>Resumen registro</h2>
      <?php

        require 'include/paypal.php';

        use PayPal\Rest\ApiContext;
        use PayPal\Api\PaymentExecution;
        use PayPal\Api\Payment;

        $resultado=$_GET['exito'];
        $paymentId=$_GET['paymentId'];
        $id_pago=(int)$_GET['id_pago'];

        //VALIDAR EL PAGO CON LA API DE PAYPAL parametros:el di que se quiere revisar y nuestras credenciales
        $pago=Payment::get($paymentId, $apiContext);
        $execution=new PaymentExecution();
        //PayerID se encuentra en la Url
        $execution->setPayerId($_GET['PayerID']);
        $resultado=$pago->execute($execution, $apiContext);

        $respuesta=$resultado->transactions[0]->related_resources[0]->sale->state;


        if ($respuesta=='completed') {

          ?>

          <div class="resultado correcto">

            <?php 
              echo "Se realizo correctamnete<br>El id es".$paymentId; 
            ?>

          </div>

          <?php

          require_once('include/funciones/conexion.php');

          $stmt=$conn->prepare('UPDATE registrados SET pagado=? WHERE 
            id_registrado=?');
          $pagado=1;
          $stmt->bind_param('ii', $pagado, $id_pago);
          $stmt->execute();
          $stmt->close();
          $conn->close();

        }else{

          ?>

          <div class="resultado error">

            <?php 
              echo "El pago no se realizo"; 
            ?>
            
          </div>

          <?php

        }
        
      ?> 


  </section><!--seccion contenedor-->


<!--FOOTER Y SCRIPTS-->
<?php include_once 'include/template/footer.php'; ?>