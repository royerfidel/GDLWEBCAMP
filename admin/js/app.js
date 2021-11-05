  $(document).ready(function () {


    $('.sidebar-menu').tree();

    //date picker
    $('#fecha').datepicker({
      autoclose: true
    });

    //Ttime picker
    $('.hora').timepicker({
      showInputs: false
    });

    //Initialize Select2 Elements
    $('.seleccionar').select2();

    $('#icono').iconpicker();

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
    });

  
    //DATATABLE
    $('#registros').DataTable({
      'paging'      : true,
      'lengthChange': 10,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'language' : {
        paginate:{
          next:'Siguiente',
          previous:'Anterior',
          last:'Ultimo',
          first:'Primero'
        },
        info:'Mostrando _START_ a _END_ de _TOTAL_ resultados',
        emptyTable:'No hay registros',
        infoEmpty:'0 registros',
        search:'Buscar'  
      } 
    });



    //VERIFICAR QUE EL PASSWORD
    //$('#crear_registro_admin').attr('disabled', true);
    $('#repetir_password').on('input', function(){

      var password_nuevo=$('#password').val();
      var usuario=$('#usuario').val();

      if ($(this).val() == password_nuevo) {

        $('#resultado_password').text('Correcto'); 
        $('#resultado_password').parents('.form-group').addClass('has-success').removeClass('has-error');
        $('input#resultado').parents('.form-group').addClass('has-success').removeClass('has-error');
        if (usuario!="") {
          $('#crear_registro_admin').attr('disabled', false);
        }

      }else{

        $('#resultado_password').text('No son iguales'); 
        $('#resultado_password').parents('.form-group').addClass('has-error').removeClass('has-success');
        $('input#resultado').parents('.form-group').addClass('has-error').removeClass('has-success');

      }

    });




    //ENLZAMOS UN ARCHIVO PHP
    $.getJSON('servicio-registrado.php', function(data){

      var a=document.getElementById('grafica-registros');
      if (a!=undefined) {
        // LINE CHART- graficos
        var line = new Morris.Line({
          element: 'grafica-registros',
          resize: true,
          data: data,
          xkey: 'fecha',
          ykeys: ['cantidad'],
          labels: ['Item 1'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto'
        });
      }

    });

    //MOSTRAR LOS EVENTOS SI EL NUMERO DE BOLETOS ES MAYOR QUE 0
    $('.contenido-dia').hide();

    if($('#pase_dia').val()>0 || $('#pase_completo').val()>0 || $('#pase_dosdias').val()>0){
      $('.contenido-dia').show();
    }

    $('.boletos').mouseout(function(){

      if($('#pase_dia').val()>0 || $('#pase_completo').val()>0 || $('#pase_dosdias').val()>0){
        $('.contenido-dia').show();

      }else{

        $('.contenido-dia').hide();

      }
        
    });

  })


  