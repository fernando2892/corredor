/**
 * Controladores
 */

'use strict';
angular.module('Login.controllers', []).

controller('loginController', function($scope, loginService) {


	$scope.msjLogin=false;

		////login corredor
			$scope.validaLogin=function(){

				loginService.login($scope.usuarioLogin,$scope.claveLogin).
				success(function (response) {

					
				if(angular.isUndefined(response[0])){
					$scope.msjLogin=true;
				}else{

					 $('body').removeClass().removeAttr('style');$('.modal-backdrop').remove();
					$('#modalLogin').modal('hide');

					window.setTimeout(function(){
						window.location.href = '#/home';
					},300);
					
				}
		    });
			}

	
});