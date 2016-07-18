/**
 * Login servicio
 */

angular.module('Login.services', [])
  .factory('loginService', function($http) {

    var angularAPI = {};
    
    angularAPI.login = function(correo,clave) {
        return $http({
          method: 'POST',
          url: '/ApiCorredor/public/index.php/validaLogin',
          params:{
        	  correo:correo,
        	  clave:clave    		
    	  }
        });
    }
    
    

    return angularAPI;
  });