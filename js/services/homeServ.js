/**
 * Home servicio
 */

angular.module('Home.services', [])
  .factory('homeService', function($http) {

    var angularAPI = {}; 


    angularAPI.variableSesion = function() {
        return $http({
          method: 'POST',
          url: '/ApiCorredor/public/index.php/consultarSesion'         
        });
    }  



    return angularAPI;
  });