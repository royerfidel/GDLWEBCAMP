

(function(){

	'use-strict';

	var regalo =  document.getElementById('regalo');
	
	document.addEventListener('DOMContentLoaded', function(){

		//datos de usuario
		var nombre = document.getElementById('nombre');
		var apellido = document.getElementById('apellido');
		var email = document.getElementById('email');

		//datos de los pases
		var pase_dia = document.getElementById('un_dia');
		var pase_dosdias = document.getElementById('2dias');
		var pase_completo = document.getElementById('completo');

		//botones y divs
		var calcular = document.getElementById('calcular');
		var error = document.getElementById('error');
		var botonRegistro = document.getElementById('btnRegistro');
		var lista_productos = document.getElementById('lista-productos');
		var suma = document.getElementById('suma-total');

		var etiquetas = document.getElementById('etiquetas');
		var camisas = document.getElementById('camisa_evento');

		if (botonRegistro!=undefined) {
			botonRegistro.disabled = true;
		}

		if (document.getElementById('calcular')) {
			
			calcular.addEventListener('blur', calcularMontos);

			pase_dia.addEventListener('blur', mostrarDias);
			pase_dosdias.addEventListener('blur', mostrarDias);
			pase_completo.addEventListener('blur', mostrarDias);

			var formulario_editar=document.getElementsByClassName('editar-registrado');

			if (formulario_editar.length > 0) {

				if ( pase_dia.value || pase_dosdias.value || pase_completo.value ) {

					mostrarDias();

				}

			}

			//validar para que el campo no este vacio
			nombre.addEventListener('blur', function(){
				if (this.value=='') {
					console.log('error');
					error.style.display='block';
					error.innerHTML="Este campo es obligatorio";
				}else{
					error.style.display='none';
				}
			});

			//Validar que se un email 

			email.addEventListener('blur', function(){
				if (this.value.indexOf('@') > -1) {
					error.style.display='none';
				}else{
					error.style.display='block';
					error.innerHTML='Email no valido';
				}
			});

			function calcularMontos(){
				//event.preventDefault();
				if (regalo.value==='') {
					alert('Debes elegir un regalo');
					regalo.focus();
				}else{
					var boletosDia = parseInt(pase_dia.value, 10) || 0,
						boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
						boletoCompleto = parseInt(pase_completo.value, 10) || 0,
						cantCamisas = parseInt(camisas.value, 10) || 0,
						cantEtiquetas = parseInt(etiquetas.value, 10) || 0;
					var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) 
						+ (boletoCompleto * 50) + ((cantCamisas * 10) * .93) + (cantEtiquetas * 2);

						var listadoProductos = [];

						if (boletosDia>=1) {

							listadoProductos.push(boletosDia + ' Pases por dia');

						}
						if (boletos2Dias>=1) {

							listadoProductos.push(boletos2Dias + ' Pases por 2 dias');

						}
						if (boletoCompleto>=1) {

							listadoProductos.push(boletoCompleto + ' boletos completos');

						}
						if (cantEtiquetas>=1) {

							listadoProductos.push(cantEtiquetas + ' etiquetas');
							
						}
						if (cantCamisas>=1) {

							listadoProductos.push(cantCamisas + ' camisas');
							
						}

						lista_productos.style.display = "block";
						lista_productos.innerHTML = '';

						for (var i = 0 ; i < listadoProductos.length; i++) {
							
							lista_productos.innerHTML += listadoProductos[i] + '<br/>';

						}
						suma.innerHTML ='$' + totalPagar.toFixed(2);
						botonRegistro.disabled=false;

						document.getElementById('total_pedido').value=totalPagar;


					
					//console.log(listadoProductos);
				}
			}

			function mostrarDias(){
				var boletosDia = parseInt(pase_dia.value, 10) || 0,
						boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
						boletoCompleto = parseInt(pase_completo.value, 10) || 0,
						cantCamisas = parseInt(camisas.value, 10) || 0,
						cantEtiquetas = parseInt(etiquetas.value, 10) || 0;
				var diasElegidos=[];

				if (boletosDia>0) {

					diasElegidos.push('viernes');

				}
				if (boletos2Dias>0) {

					diasElegidos.push('viernes', 'sabado');

				}
				if (boletoCompleto>0) {

					diasElegidos.push('viernes', 'sabado', 'domingo');

				}
				//console.log(diasElegidos);
			}
		}

	});
	
	var a=document.getElementById('mapa');
	if (a!=undefined) {
		var map = L.map('mapa').setView([-12.00762, -76.915192], 16);
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		L.marker([-12.00762, -76.915192]).addTo(map)
		    .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
		    .openPopup();
	}

})();
