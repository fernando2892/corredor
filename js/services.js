/**
 * Servicios
 */

angular.module('AplicacionWeb.services', [])
  .factory('myService', function($http) {

    var angularAPI = {};

      
    angularAPI.login = function(correo,clave) {
        return $http({
          method: 'POST',
          url: 'http://www.corredor.com/validaLogin',
          params:{correo:correo,
            clave:clave
    	  }
        });
      }
    
    

    angularAPI.consultarClientesPoliza = function(idPoliza) {

        return $http({
          method: 'POST',
          url: '/ApiCorredor/public/index.php/consultarClientesPoliza',
          params:{idPoliza:idPoliza}
        });
      }

      angularAPI.cerrarSesion = function() {

        return $http({
          method: 'POST',
          url: '/ApiCorredor/public/index.php/cerrarSesion',
        });
      }

      angularAPI.validarSesion = function() {

        return $http({
          method: 'POST',
          url: '/ApiCorredor/public/index.php/validarSesion',
        });
      }
    
    

    return angularAPI;
  });