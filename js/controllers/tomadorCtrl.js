/**
 * Importación
 */

'use strict';

angular.module('Tomador.controllers', []).

controller('tomadorController', function($scope, tomadorService) {

	$("#camera_wrap_4").hide();
	$("#divMenu").hide();
	$("#menuCorredor").show();
	$scope.sexo = null;
	$scope.tomador_menor = false;
	$scope.salida = false;


	tomadorService.comboParentesco().success(function(response) {

		$scope.Parentescos = response;

	});

	$scope.habilitarCamposTP = function() {

	}

	$('#tomador_fechaNac').datepicker({
		format: 'dd-mm-yyyy'
	});

	$scope.seleccionSexo = function(sexo) {

		if (sexo == "M") {

			$scope.seleccionSexoF = false;
			$scope.seleccionSexoM = true;

		}

		if (sexo == "F") {

			$scope.seleccionSexoM = false;
			$scope.seleccionSexoF = true;

		}
	}

	$scope.consultarCliente = function(id) {

		if (id == true) {

			tomadorService.consultarCliente($scope.tomador_ci, $scope.idPol).
			success(function(response) {



				if (angular.isUndefined(response[0])) {

					tomadorService.consultarClienteDatos($scope.tomador_ci,"").
					success(function(response) {

						$scope.datosUsuario = response[0];
						$scope.consultarClientePoliza($scope.datosUsuario);
					});


				} else {

					$scope.datosUsuario = response[0];
					$scope.consultarClientePoliza($scope.datosUsuario);
				}



			});
		}

	}

	$scope.insertarModificarTomador = function() {


		if ($scope.seleccionSexoM == true) {

			$scope.sexo = "M";

		}

		if ($scope.seleccionSexoF == true) {

			$scope.sexo = "F";

		}

		if (angular.isUndefined($scope.Parentesco)) {
			$scope.Parentesco = 0;
		}
		if (angular.isUndefined($scope.tomador)) {
			$scope.tomador = false;
		}

		if($scope.formNino == true){
			$scope.ci=$scope.tomador_ci_representado;
		}else{
			$scope.ci=$scope.tomador_ci;
		}


		tomadorService.insertarModificarTomador(
			$scope.ci,
			$scope.tomador_nombre,
			$scope.tomador_apellido,
			$scope.sexo,
			$scope.tomador_correo,
			$("#tomador_telefono").val(),
			$("#tomador_telefonoA").val(),
			$("#tomador_fechaNac").val(),
			$scope.tomador_direccion,
			$scope.tomador_id,
			$scope.Parentesco,
			$scope.tomador,
			$scope.idPol,
			$scope.tomador_menor).
		success(function(response) {

			alert(response);
			$scope.resetFormClientes();
			$scope.consultarClientesTabla($scope.idPol);

		});
	}



	$scope.validaCiRepresentado = function() {


			tomadorService.consultarClienteDatos($scope.tomador_ci_parent,true).
			success(function(response) {

			$scope.tomador_ci_representado=response;


			});




	}


});