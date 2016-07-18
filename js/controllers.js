/**
 * Controladores
 */

'use strict';

/* Controllers */
angular.module('AplicacionWeb.controllers', []).

controller('indexController', function($scope, myService) {

	$scope.varSession = null;
	$scope.Parentesco = 0;
	$scope.ocultarPT = true;
	$scope.tomador_ci = "";
	$scope.tomador_id = 0;
	$scope.formNino = false;
	$scope.reqCiAdulto = true;
	$scope.reqCiRepre = false;
	$("#menuCorredor2").hide();
	$("#myCarousel").show();


	$('.navbar-collapse a').click(function(){
    $(".navbar-collapse").collapse('hide');
	});

	$scope.formNinoAct = function() {

		$scope.formNino = true;
		$scope.reqCiAdulto = false;
		$scope.reqCiRepre = true;
		$scope.tomador_menor = true;
		$scope.resetFormClientes();


	}

	$scope.formAdultoAct = function() {

		$scope.formNino = false;
		$scope.reqCiAdulto = true;
		$scope.reqCiRepre = false;
		$scope.tomador_menor = false;
		$scope.resetFormClientes();
	}

	$scope.menuCarrusel=function(){

		$("#menuCorredor2").show();
		$("#menuCorredor1").hide();
		$("#myCarousel").hide();
	}
	


	$scope.consultarClientesTabla = function(idPol) {

		myService.consultarClientesPoliza(idPol).success(function(response) {

			$scope.beneficiarios = response;

		});

	}

	

	$scope.resetFormClientes = function() {

		$scope.tomador_ci = "";
		$("#tomador_ci").val("");
		$scope.tomador_nombre = "";
		$scope.tomador_apellido = "";
		$scope.tomador_correo = "";
		$scope.tomador_telefono = "";
		$scope.tomador_telefonoA = "";
		$scope.tomador_fechaNac = "";
		$scope.tomador_direccion = "";
		$scope.tomador_id = 0;
		$scope.seleccionSexoM = null;
		$scope.seleccionSexoF = null;
		$scope.Parentesco = "";
		$scope.tomador = false;


	}



	$scope.consultarClientePoliza = function(datos) {


		if (angular.isUndefined(datos)) {


			$scope.tomador_nombre = "";
			$scope.tomador_apellido = "";
			$scope.tomador_correo = "";
			$scope.tomador_telefono = "";
			$scope.tomador_telefonoA = "";
			$scope.tomador_fechaNac = "";
			$scope.tomador_direccion = "";
			$scope.tomador_id = "";
			$scope.seleccionSexoM = null;
			$scope.seleccionSexoF = null;
			$scope.Parentesco = 0;
			$scope.tomador = false;
			$scope.tomador_id = 0;



		} else {

			$("#tomador_ci").val(datos.ci);
			$scope.tomador_ci = datos.ci;
			$scope.seleccionSexoM = null;
			$scope.seleccionSexoF = null;

			if (datos.sexo == "M") {
				$scope.seleccionSexoM = true;
			}
			if (datos.sexo == "F") {
				$scope.seleccionSexoF = true;
			}
			$scope.tomador_nombre = datos.nombre;
			$scope.tomador_apellido = datos.apellido;
			$scope.tomador_correo = datos.correo;
			$scope.tomador_telefono = datos.telefono_principal;
			$scope.tomador_telefonoA = datos.telefono_adicional;
			$scope.tomador_fechaNac = datos.fecha_nacimiento;
			$scope.tomador_direccion = datos.direccion;
			$scope.tomador_id = datos.id;
			$scope.tomador = datos.tomador;
			$scope.Parentesco = datos.parentId;

			if (angular.isUndefined(datos.parentId)) {

				$scope.Parentesco = 0;
			}

		}
	}


	$scope.resetearFormulario = function(form) {

		document.getElementById(form).reset();
	}


	// Funcion que permite cambiar el numero 1230.00 a 1.230,00 Se usa
	// para los resultados
	$scope.cambiarPuntosComas = function(numero, decimal) {
		var num = parseFloat(numero).toFixed(2).replace(
			/\d(?=(\d{3})+\.)/g, '$&,');

		var auxFinal = "";
		var aux = [];
		aux = num.split(",");
		var longNum = aux.length;
		for (var i = 0; i < longNum; i++) {
			if (i == (longNum - 1)) {
				auxFinal = auxFinal + aux[i];
			} else {
				auxFinal = auxFinal + aux[i] + "-";
			}

		}
		var auxFinal2 = "";
		var aux2 = [];
		aux2 = auxFinal.split(".");
		var longNum1 = aux2.length;
		for (var i = 0; i < longNum1; i++) {
			if (i == (longNum1 - 1)) {
				auxFinal2 = auxFinal2 + aux2[i];
			} else {
				auxFinal2 = auxFinal2 + aux2[i] + ",";
			}

		}
		auxFinal2 = auxFinal2.replace(/-/g, ".");

		if (decimal == false) {
			var auxFinal3 = "";
			var aux3 = [];
			aux3 = auxFinal2.split(",");
			auxFinal3 = aux3;
			return auxFinal3;
		} else {

			return auxFinal2;
		}

	};

			// Funcion que permite colocar el formato numerico 1.230,00 al momento de escribir
			$scope.formatoPuntos = function(donde, caracter, decimal) {
				var decimales = false
				if (decimal != 0) {
					var dec = new Number("2");
					decimales = true
				} else {
					dec = new Number("0");
				}

				var pat = /[\*,\+,\(,\),\?,\\,\$,\[,\],\^]/
				var valor = donde.value
				var largo = valor.length
				var crtr = true

				if (isNaN(caracter) || pat.test(caracter) == true) {
					if (pat.test(caracter) == true) {
						caracter = "\\" + caracter
					}
					var carcter = new RegExp(caracter, "g")
					var valor2 = valor.replace(carcter, "")
					donde.value = valor2
					crtr = false
				} else {
					var nums = new Array()
					var cont = 0
					for (var m = 0; m < largo; m++) {
						if (valor.charAt(m) == "." || valor.charAt(m) == " "
								|| valor.charAt(m) == ",") {
							continue;
						} else {
							nums[cont] = valor.charAt(m)
							cont++
						}

					}
				}

				if (decimales == true) {
					var ctdd = eval(1 + dec);
					var nmrs = 1
				} else {
					ctdd = 1;
					nmrs = 3
				}

				var cad1 = "", cad2 = "", cad3 = "", tres = 0
				if (largo > nmrs && crtr == true) {
					for (var k = nums.length - ctdd; k >= 0; k--) {
						cad1 = nums[k]
						cad2 = cad1 + cad2
						tres++
						if ((tres % 3) == 0) {
							if (k != 0) {
								cad2 = "." + cad2
							}
						}
					}

					for (var dd = dec; dd > 0; dd--) {
						var v=cad3;
						cad3 += nums[nums.length - dd]
						
					}
					if (decimales == true) {
						
						cad2 += "," + cad3
					}
					
					
					if(v!="undefined")
					donde.value = cad2
				}
			}

	// Funcion que permite colocar el formato numerico 1230.00
	$scope.formatoNumBD = function(numero) {
		var numFinal = "";
		var arrayNum = [];
		arrayNum = numero.split(".");
		var longNum = arrayNum.length;
		for (var i = 0; i < longNum; i++) {
			if (i == (longNum - 1)) {
				numFinal = numFinal + arrayNum[i];
			} else {
				numFinal = numFinal + arrayNum[i] + "";
			}

		}
		numFinal = numFinal.replace(",", ".");
		return numFinal;
	}

	//*** ENCABEZADO PANEL IMPORTACION
	//$scope.panelImportacion = function(idProforma, expProforma) {
	//	$scope.encabezado_idProforma = idProforma;
	//	$scope.encabezado_expProforma = expProforma;
	//	};

	// **********MODAL DE OPCIONES**********//
	$scope.modalOpciones = function(contenido, opcionAcep) {
		//$scope.contenidoModal = contenido;
		$('#contenidoModal').empty();
		$('#contenidoModal').html('<p class="letraContenidoModal">' + contenido + '</p>');

		$("#modal_aceptar").click(function() {
			//if (opcionAcep == 1) {
			$scope.cerrarSesion();
			//}					
		});
	};

	//*** Cambia valor NAN por 0
	$scope.valida = function(campo) {
		var valor = null;
		if (isNaN(campo) == true || campo == undefined) {
			valor = 0;
		} else {
			valor = campo;
		}
		return (valor);
	}

	//*** Deshabilitar formulario
	$scope.desabilitarFormulario = function(idForm) {

		var inputs = $("#" + idForm + " input");
		$(inputs).each(function(i, val) {
			$(this).attr('disabled', true);
		});

		//				var selects = $("#" + idForm + " select");
		//				$(selects).each(function(i, val) {
		//					$(this).selectmenu('disable');
		//				});

		var textareas = $("#" + idForm + " textarea");
		$(textareas).each(function(i, val) {
			$(this).attr('disabled', true);
		});

		var buttons = $("#" + idForm + " button");
		$(buttons).each(function(i, val) {
			$(this).attr('disabled', true);
		});
	}

	//*** Habilitar formulario
	$scope.habilitarFormulario = function(idForm) {

		var inputs = $("#" + idForm + " input");
		$(inputs).each(function(i, val) {
			$(this).attr('disabled', false);
		});

		var selects = $("#" + idForm + " select");
		$(selects).each(function(i, val) {
			$(this).selectmenu('enable');
		});

		var textareas = $("#" + idForm + " textarea");
		$(textareas).each(function(i, val) {
			$(this).attr('disabled', false);
		});

		var buttons = $("#" + idForm + " button");
		$(buttons).each(function(i, val) {
			$(this).attr('disabled', false);
		});

	}

	//*** Restar fechas
	$scope.restarFechas = function(f1) {
		var anno = (new Date()).getFullYear();
		var mes = (new Date()).getMonth() + 1;
		var dia = (new Date()).getDate();
		mes = (mes < 10) ? ("0" + mes) : mes;
		dia = (dia < 10) ? ("0" + dia) : dia;
		// f2 fecha de hoy
		var f2 = anno + "-" + mes + "-" + dia;
		var aFecha1 = f1.split('-');
		var aFecha2 = f2.split('-');
		var fFecha1 = Date.UTC(aFecha1, aFecha1[1] - 1, aFecha1[2]);
		var fFecha2 = Date.UTC(aFecha2, aFecha2[1] - 1, aFecha2[2]);
		var dif = fFecha1 - fFecha2;
		var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
		return dias;
	}

	//*** Sumar dias a fecha
	$scope.sumarDias = function(d, fecha2) {
		var parts = fecha2.split('-');
		var fecha = parts[2] + '-' + parts[1] + '-' + parts;

		var Fecha = new Date();
		var sFecha = fecha;
		var sep = sFecha.indexOf('/') != -1 ? '/' : '-';
		var aFecha = sFecha.split(sep);
		var fecha = aFecha[2] + '/' + aFecha[1] + '/' + aFecha;
		fecha = new Date(fecha);
		fecha.setDate(fecha.getDate() + parseInt(d));
		var anno = fecha.getFullYear();
		var mes = fecha.getMonth() + 1;
		var dia = fecha.getDate();
		mes = (mes < 10) ? ("0" + mes) : mes;
		dia = (dia < 10) ? ("0" + dia) : dia;
		//var fechaFinal = dia+sep+mes+sep+anno;
		var fechaFinal = anno + sep + mes + sep + dia;
		return fechaFinal;
	}

	$scope.validarSesion=function(){
		myService.validarSesion().success(function(response){
			if (angular.isUndefined(response[0])) {
			window.location="/#"
			$("#menuCorredor1").show();
			$("#menuCorredor2").hide();
			$("#myCarousel").show();
			$scope.varSession=null;
		}else{
			$scope.varSession=response[0];
		}
		})
	}

	$scope.cerrarSesion=function(){
		myService.cerrarSesion().success(function(response){
			window.location="/#"
			$("#menuCorredor1").show();
			$("#menuCorredor2").hide();
			$("#myCarousel").show();
		})
	}



});