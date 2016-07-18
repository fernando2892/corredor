/**
 * Home
 */

'use strict';

angular.module('Home.controllers', ['ngRoute']).

controller('homeController', function($scope, homeService) {
	
	$scope.validarSesion();
	$scope.menuCarrusel();
	$scope.VarSesion=null;
	
	

	$scope.consultarVariableSesion=function(){

		//$scope.VarSesion=varSesion;
				
		homeService.variableSesion().success(function (response) {

			$scope.varSession=response;

		})
	};

	$scope.consultarVariableSesion();



});