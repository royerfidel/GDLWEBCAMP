<?php 
  
  //Devuelve el último componente de nombre de una ruta
  $archivo=basename($_SERVER['PHP_SELF']);
  //Extraemos el nombre del archivo sin la extension
  $pagina=str_replace('.php', "", $archivo);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Blank Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <!-- jQuery 3 -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <!--<script src="css/jquery.min.js"></script>-->
  <!--JQUERY-->
 <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
-->


  <!-- Bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.min.css">



  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/27c03bba1f.js" crossorigin="anonymous"></script>
  <!--<link rel="stylesheet" href="css/font-awesome.min.css">-->



  <!-- Ionicons -->
  <link rel="stylesheet" href="css/ionicons.min.css">




  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">




  <!--icheck-->
  <link rel="stylesheet" type="text/css" href="../css/icheck.css">





  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="css/bootstrap-timepicker.min.css">




  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <!--<link rel="css/select2.min.css">-->





  <!--DataTable-->
  <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">


  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">


  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="css/_all-skins.min.css">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <!--fontawesome-iconpicker-->
  <link rel="stylesheet" type="text/css" href="css/fontawesome-iconpicker.min.css">


  <?php  

    if ($pagina=="dashboard") {
      echo '<!--Libreria de graficos-->
            <link rel="stylesheet" type="text/css" href="../css/morris.css">';
    }

  ?>


  <link rel="stylesheet" type="text/css" href="css/admin.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  


</head>