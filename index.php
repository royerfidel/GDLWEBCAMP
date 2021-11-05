<?php
  include 'include/template/header.php';
  include 'include/template/conexion.php';
?>


<div id="seccion-principal" class="secciones">
  <?php include 'include/template/principal.php' ?>
</div>

<div id="seccion-conferencia" class="secciones">
  <?php include 'include/template/conferencia.php' ?>
</div>

<div id="seccion-calendario" class="secciones">
  <?php include 'include/template/calendario.php' ?>
</div>

<div id="seccion-invitados" class="secciones">
  <?php include 'include/template/invitados.php' ?>
</div>

<div id="seccion-reservaciones" class="secciones">
  <?php include 'include/template/registro.php' ?>
</div>

<!--FOOTER Y SCRIPTS-->
<?php include 'include/template/footer.php'; ?>