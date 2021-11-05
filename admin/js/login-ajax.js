$(document).ready(function(){

	$('#login-admin').on('submit', function(e){

		e.preventDefault();
		//CAPTURA LOS DATOS
		var datos=$(this).serializeArray();

		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			success: function(data){
				console.log(data);
				var resultado = data;
				if(resultado.respuesta == 'exitoso') {

					Swal.fire(
					  'Login correcto!',
					  'Login correcto!',
					  'success'
					).then((result) => {
					  /* Read more about handling dismissals below */
					  if (result) {
					    
					  	setTimeout(function(){
							window.location.href='admin-area.php'
						}, 1000);

					  }
					})
		


				}else{

					Swal.fire(
					  'Error!',
					  'Hubo un error!',
					  'error'
					)
					console.log('error');

				}
			}

		})


	});

	$('#datepicker').datepicker({
      autoclose: true
    })

});