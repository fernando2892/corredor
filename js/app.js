
var routerApp =angular.module('corredor3.0', [
  'AplicacionWeb.controllers',
  'AplicacionWeb.services',
  'Login.controllers',
  'Login.services',
  'Home.controllers',
  'Home.services',  
  'Tomador.controllers',
  'Tomador.services',
  'Poliza.controllers',
  'Poliza.services',
  'ngRoute',
  'ngResource',
  'Historico.controllers',
  'Historico.services',  
  'Reportes.controllers',
  'Reportes.services',
  'DatosPersonales.controllers',
  'DatosPersonales.services',  
]);

routerApp.config(['$routeProvider', function($routeProvider) {
    
  $routeProvider.
  when("/", {templateUrl: "views/login.html", controller: "loginController"}).
  when("/home", {templateUrl: "views/home.html", controller: "homeController"}).
  when("/datosPoliza", {templateUrl: "views/poliza.html", controller: "polizaController"}).
  when("/reportes", {templateUrl: "views/reportes.html", controller: "reportesController"}).
  when("/datosPersonales", {templateUrl: "views/datosPersonales.html", controller: "datosPersonalesController"}).
  otherwise({redirectTo: '/'});
}]);
//Para validar formularios (campos requeridos)
routerApp.directive('validaFormulario', [ '$parse', function($parse) {
		return {
			require: 'form',
			
			link: function(scope, element, iAttrs, form) {
				form.$submitted = false;
				
				var fn = $parse(iAttrs.validaFormulario);
				element.on('submit', function(event) {
					scope.$apply(function() {
						form.$submitted = true;
						if (form.$valid) {
							fn(scope, { $event : event });
							form.$submitted = false;
						}
					});
				});
			}
		};
	}
]);
//Para validar campos numericos
routerApp.directive('numerosValida', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    var transformedInput = text.replace(/[^0-9]/g, '');

                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }            
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});

routerApp.directive('validaNumeroDecimal', function() {
    return {
      require: '?ngModel',
      link: function(scope, element, attrs, ngModelCtrl) {
        if(!ngModelCtrl) {
          return; 
        }

        ngModelCtrl.$parsers.push(function(val) {
          if (angular.isUndefined(val)) {
              var val = '';
          }
          
          var clean = val.replace(/[^-0-9\.]/g, '');
          var negativeCheck = clean.split('-');
			var decimalCheck = clean.split('.');
          if(!angular.isUndefined(negativeCheck[1])) {
              negativeCheck[1] = negativeCheck[1].slice(0, negativeCheck[1].length);
              clean =negativeCheck[0] + '-' + negativeCheck[1];
              if(negativeCheck[0].length > 0) {
              	clean =negativeCheck[0];
              }
              
          }
            
          if(!angular.isUndefined(decimalCheck[1])) {
              decimalCheck[1] = decimalCheck[1].slice(0,2);
              clean =decimalCheck[0] + '.' + decimalCheck[1];
          }

          if (val !== clean) {
            ngModelCtrl.$setViewValue(clean);
            ngModelCtrl.$render();
          }
          return clean;
        });

        element.bind('keypress', function(event) {
          if(event.keyCode === 32) {
            event.preventDefault();
          }
        });
      }
    };
});

routerApp.directive('validaArchivo', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.validaArchivo);
            var modelSetter = model.assign;
            
            element.bind('change', function(){
            	scope.$apply(function(){
                    if (element[0].files.length > 1) {
                      modelSetter(scope, element[0].files);
                    }
                    else {
                      modelSetter(scope, element[0].files[0]);
                    }
                  });
            });
        }
    };
}]);
/*config(['$routeProvider', function($routeProvider) {
   $routeProvider.
  	when("/", {templateUrl: "views/login.html", controller: "loginController"}).
	when("/home", {templateUrl: "views/home.html", controller: "homeController"}).
	//when("/menu", {templateUrl: "views/menu.html", controller: "menuHomeController"}).
	//when("/menu2", {templateUrl: "views/menu2.html", controller: "menuHomeController"}).
	when("/tomador", {templateUrl: "views/tomador.html", controller: "tomadorController"}).
	when("/nueva_proforma", {templateUrl: "views/nueva_proforma.html", controller: "nuevaProformaController"}).
	when("/proforma", {templateUrl: "views/proforma.html", controller: "proformaController"}).
	when("/cnp", {templateUrl: "views/cnp.html", controller: "cnpController"}).	
	when("/docEnv", {templateUrl: "views/docEnv.html", controller: "docEnvController"}).	
	when("/codAad", {templateUrl: "views/codAad.html", controller: "codAadController"}).	
	when("/exoArancel", {templateUrl: "views/exoArancel.html", controller: "exoArancelController"}).	
	when("/cartaCred", {templateUrl: "views/cartaCred.html", controller: "cartaCredController"}).	
	when("/difDolar", {templateUrl: "views/difDolar.html", controller: "difDolarController"}).	
	when("/cierreImp", {templateUrl: "views/cierreImp.html", controller: "cierreImpController"}).	
	when("/embarque", {templateUrl: "views/embarque.html", controller: "embarqueController"}).	
	when("/conciliacion", {templateUrl: "views/conciliacion.html", controller: "conciliacionController"}).
	when("/indicadores", {templateUrl: "views/indicadores.html", controller: "indicadoresController"}).
	when("/exportar", {templateUrl: "views/fileLoad.jsp", controller: "indicadoresController"}).
	when("/solicitudAad", {templateUrl: "views/solicitudAad.html", controller: "solicitudAadController"}).
	when("/adminUsuario", {templateUrl: "views/adminUsuario.html", controller: "adminUsuarioController"}).
	when("/adminRoles", {templateUrl: "views/adminRoles.html", controller: "adminRolesController"}).
	otherwise({redirectTo: '/'});
}]);*/


