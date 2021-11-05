$(document).ready(function(){

	$('#guardar-registro').on('submit', function(e){

	    e.preventDefault();
	    //CAPTURA LOS DATOS
	    var datos=$(this).serializeArray();

	    console.log(datos);

	    $.ajax({
	        type: $(this).attr('method'),
	        data: datos,
	        url: $(this).attr('action'),
	        dataType: 'json',
	        success: function(data){
	            var resultado = data;
	            console.log(data);
	        	if (resultado.respuesta == 'exito') {
	        		console.log(data);
		            Swal.fire(
		              'Exitoso!',
		              'Se guardo correctamente!',
		              'success'
		            )/*.then((result) => {
		              /* Read more about handling dismissals below */
		              /*if (result) {
		                
		                setTimeout(function(){
		                window.location.href='admin-area.php'
		              }, 1000);

		              }
		            })*/


		        }else{

		            Swal.fire(
		              'Error!',
		              'Hubo un error!',
		              'error'
		            )
		            console.log('error');

		          
		        }

	        }	

	    });

    });


	
	$('.borrar_registro').on('click', function(e){

		//e.preventDefault();

		var id=$(this).attr('data-id');	
		var tipo=$(this).attr('data-tipo');

		Swal.fire({
		  title: 'Estas seguro?',
		  text: "No se podrá recuperar el archivo!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, borrar!'
		}).then((result) => {

		    if (result.value) {
			    $.ajax({

					type:'POST',
					data:{
						'id':id,
						'registro':'eliminar'
					},
					url:'modelo-'+tipo+'.php',
					success:function(data){
						console.log(data);
						var resultado=JSON.parse(data);

						console.log(resultado);

						if (resultado.respuesta=='exito') {

							Swal.fire(
				              'Exitoso!',
				              'Se elimino correctamente!',
				              'success'
				            )
							jQuery('[data-id="'+resultado.id_eliminado+'"]').parents('tr').remove();

						}

					}

				});
			}
		})



	});



	//se trabajo con archivos(imagenes o documentos locales)
	$('#guardar-registro-archivo').on('submit', function(e){

		e.preventDefault();
		//CAPTURA LOS DATOS
		var datos=new FormData(this);

		$.ajax({
			type: $(this).attr('method'),
			data: datos,
			url: $(this).attr('action'),
			dataType: 'json',
			contentType: false,
			processData: false,
			async: true,
			cache: false,
			success: function(data){
				var resultado = data;
				if (resultado.respuesta == 'exito') {

					Swal.fire(
		              'Exitoso!',
		              'Se guardo correctamente!',
		              'success'
		            )
					console.log(data);


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


	

});