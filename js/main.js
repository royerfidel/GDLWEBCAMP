






$(function(){


	//MOSTRAR EN QUE PAGINA SE ENCUENTRA EL USUARIO
	/*$('body.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
	$('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
	$('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');*/


	//VALIDAR QUE NO HAYA CAMPOS VACIOS
	$('.datos-usuario').on('blur', function(){

		if ($('#nombre').val()=="") {

			$('#nombre').css('border-color', 'red');

		}else{

			$('#nombre').css('border-color', 'black');
		}


		if ($('#email').val()=="") {

			$('#email').css('border-color', 'red');

		}else{

			$('#email').css('border-color', 'black');
		}
	});


	//OCULTAR Y MOSTRAR EL TITULO DE LA PAGINA WEB
	$('.nombre-sitio').hide();	
	$('.nombre-sitio').fadeIn(1500);




	//REGRESAR A LA PARTE SUPERIOR MDE LA PAGINA
	$('.subir').hide();
	$(window).scroll(function(){
		var altura_pantalla=document.body.scrollHeight;
		var desplazamientoActual = $(document).scrollTop();
		console.log(altura_pantalla+" altura");
		console.log(desplazamientoActual+" desplazamiento");
		if ((altura_pantalla*0.75)<desplazamientoActual) {
			$('.subir').fadeIn(2000);
		}else{
			$('.subir').hide();
		}
	});

	$(".subir").on("click", function(e){
        $("html, body").animate({
            scrollTop: 620
        }, 200); 
     });









	//MOSTRAR Y OCULTAR LAS SECCIONES DE LA PAGINA SIN TENER QUE RECARGAR LA PAGINA
	$('.secciones').hide();
	$('#seccion-principal').slideDown(700);
	$('.enlace-header').click(function(){

		var array_clases=$(this).prop('class').split(' ');
		$('.secciones').hide(700);
		$('#seccion-'+array_clases[0]).show(700);
		$('.enlace-header').removeClass('activo');
		$('.'+array_clases[0]).addClass('activo');
		$("html, body").scrollTop(620);
		return false;

	});









	//MOSTRAR OTRO TIPO DE BOLETO HACIENDO CLICK EN LOS CIRCULOS
	$('.tabla-precio').hide();
	var ndias=$('#ndias').val();

	if (ndias!=undefined) {

		ndias=ndias.split(',');
		var cant=ndias.length;
		var i=0;
		var array_ndias=[];

		//CONVERTIR LOS ELEMENTOS DEL ARRAY EN NUMBER
		while(i<cant){

			array_ndias.push(parseInt(ndias[i]));
			i++;

		}
	}

	var min_num_dias=Math.min.apply(null, array_ndias);
	$('#contenedor'+min_num_dias).show(1000);
	$('.circle').addClass('circle-inactive');
	$('#'+min_num_dias).addClass('circle-active');

	
	$('.circle').click(function(){

		$('.contenido-dia').hide(500);
		var boleto_id=$(this).prop('id');
		$('.circle').removeClass('circle-active');
		$('#'+boleto_id).addClass('circle-active');
		$('.tabla-precio').hide(500);
		$('#contenedor'+boleto_id).slideDown(500);
	
	});














	//MANTENER OCULTO LOS EVENTOS
	$('.contenido-dia').hide();

	//MOSTRAR Y OCULTAR SEGÚN LOS DIAS SELECIONADOS EN LOS BOLETOS
	const dias_upper=['LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO', 'DOMINGO'];
	const dias_lower=['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];
	var ndias=$('#ndias').val();
	if (ndias!=undefined) {
		ndias=ndias.split(',');
		var cant_ndias=ndias.length;
	}
	var n=0;

	$('.boletos').on('click blur', function(){

		var lista_clases=$(this).prop('class');
		lista_clases=lista_clases.split(' ');
		var class_ndias=lista_clases[0];
		console.log(lista_clases);
		if (class_ndias==0) {
			
			//MOSTRAR TODOS LOS DIAS SI ES QUE EL NUMERO DE BOLETOS ES MAYOR A 1
			if ($('.'+class_ndias).val()>0) {

				$('.contenido-dia').show(500);

			}else{

				$('.contenido-dia').hide(500);

			}

		}else if (class_ndias==1) {

			$('.contenido-dia').hide(500);

			//MOSTRAR LOS DIAS SELECCIONADOS SI ES QUE EL NUMERO DE BOLETOS ES MAYOR A 1
			var i=0;

			while(i<7){

				if ($('#un_dia_seleccionado').val()===dias_lower[i]) {
					
					if ($('.nboletos'+class_ndias).val()>0) {

						$('#'+dias_upper[i]).show(500);

					}else{

						$('.contenido-dia').hide(500);

					}
				}
				i++;
			}
			
		}else if (class_ndias>1) {



			//DESACTIVAR LOS CHECKS CUANDO SE HAYA LLEGADO AL NUMERO PERMITIDO DE DIAS
			$('.contenido-dia').hide(500);
			var dias_marcados=[];
			var i=0,
				e=0;

			while(i<7){

				if ($('#'+dias_lower[i]+class_ndias).prop('checked')===true) {

					dias_marcados.push(dias_lower[i]);
					var cant=dias_marcados.length;
					e++;

					if (e==class_ndias) {

						$(".check_dia"+class_ndias).prop('disabled', true);
						var j=0;
						
						while(j<cant){

							$('#'+dias_marcados[j]+class_ndias).prop('disabled', false);

							if ($('.nboletos'+class_ndias).val()>0) {

								$('#'+dias_marcados[j].toUpperCase()).show(500);

							}

							j++;
						}
					}else if (cant<class_ndias) {

						$(".check_dia"+class_ndias).prop('disabled', false);

					}
				}

				i++;
			}
			//GUARDAR LOS CASILLAS MARCADAS EN UN INPUT
			$('#dias_marcados').val(dias_marcados);







			//EXTRAER EL VALUE DEL INPUT DONDE SE ALAMCENO LOS DIAS MARCADOS
			var dias_marcados=$('#dias_marcados').val(),
				array_dias_marcados=dias_marcados.split(","),
				cant=array_dias_marcados.length,
				i=0;
			//MOSTRAR LOS DIAS SELECCIONADOS SI ES QUE EL NUMERO DE BOLETOS ES MAYOR A 1
			while(i<cant){

				if ($('.nboletos'+class_ndias).val() > 0 && cant==class_ndias) {

					$('#'+array_dias_marcados[i].toUpperCase()).show(500);

				}

				i++;
			}
		}

	});









	//MARCAR EL ENLACE DE LAS CATEGORIAS DE LOS EVENTOS CUANDO HAYA HECHO CLICK
	$('.eventoseminario').addClass('activo-cat-evento i');
	$('.menu-programa a').click(function(e){

		var enlace = $(this).attr('class');
		listaClases=enlace.split(" ");
		$('.'+listaClases[2]).removeClass('activo-cat-evento i');
		$('.'+listaClases[0]).addClass('activo-cat-evento i');
		//console.log(listaClases[2]);

	});



	//MUESTRA Y OCULTA SEGÚN LA CATEGORIA DEL EVENTO QUE HAYA HECHO CLICK
	$('.programa-evento .info-curso:first').show();
	$('.menu-programa a').on('click', function(){
		$('.ocultar').hide();
		var enlace = $(this).attr('href');
		$(enlace).fadeIn(1000);
		return false;//para evitar el salto
	});

	//AGREGAR ESTILO AL NOMBRE DEL SITIO
	$('.nombre-sitio').lettering();


	//FIJAR LA BARRA DE NAVEGACION
	var windowHeight = $(window).height();
	var barraAltura = $('.barra').innerHeight();
	$(window).scroll(function(){
		var scroll = $(window).scrollTop();
		if (scroll > windowHeight) {
			$('.barra').addClass('fixed');
			$('body').css({'margin-top':barraAltura+'px'});
		}else{
			$('.barra').removeClass('fixed');
			$('body').css({'margin-top':'0px'});
		}
	});


	//MOSTRAR Y OCULTAR LA BARRA DE NAVEGACION CUANDO EL TAMAÑO DE PATALLA SE REDUCE
	$('.menu-movil').on('click', function(){
		$('.navegacion-principal').slideToggle();
	});



	//ANIMACIONES PARA LOS NUMEROS
	$('.resumen-evento li:nth-child(1) p').animateNumber({number:6}, 1200);
	$('.resumen-evento li:nth-child(2) p').animateNumber({number:15}, 1200);
	$('.resumen-evento li:nth-child(3) p').animateNumber({number:3}, 1200);
	$('.resumen-evento li:nth-child(4) p').animateNumber({number:9}, 1200);

	//ANIMACIONES PARA LA CUENTA REGRESIVA
	$('.cuenta-regresiva').countdown('2020/12/10 00:00:00', function(event){
		$('#dias').html(event.strftime('%D'));
		$('#horas').html(event.strftime('%H'));
		$('#minutos').html(event.strftime('%M'));
		$('#segundos').html(event.strftime('%S'));
	});





	//VALIDAR EXISTENCIA
	var invitado_info = $('.invitado-info').val();
	if (invitado_info!=undefined) {
		//MUESTRA MDIENATE UN MODAL LA INFORMACION DE LOS INVITADOS
		$('.invitado-info').colorbox({inline:true, width:"50%"});
	}

	var boton_newsletter = $('.boton_newsletter').val();
	if (boton_newsletter!=undefined) {
		//FORMULARIO DE MAILCHIMP EN INDEX.PHP
		$('.boton_newsletter').colorbox({inline:true,width:"50%"});
	}

});
