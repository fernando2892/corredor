/**
 * Importación
 */

angular.module('Tomador.services', [])
  .factory('tomadorService', function($http) {

    var angularAPI = {};


    angularAPI.consultarCliente = function(cedula, idPol) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/consultarCliente',
        params: {
          ci: cedula,
          idPol: idPol
        }
      });
    }

    angularAPI.consultarClienteDatos = function(cedula, menor) {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/consultarClienteDatos',
        params: {
          ci: cedula,
          menor:menor
        }
      });
    }

    angularAPI.comboParentesco = function() {
      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/comboParentesco',
      });
    }


    angularAPI.insertarModificarTomador = function(cedula, nombre, apellido, sexo, correo, telefono, telefonoA, fechaNac, direccion, id, idParent, tomador, idPol,menor) {

      return $http({
        method: 'POST',
        url: '/ApiCorredor/public/index.php/insertarModificarTomador',
        params: {
          ci: cedula,
          nombre: nombre,
          apellido: apellido,
          sexo: sexo,
          correo: correo,
          telefono: telefono,
          telefonoA: telefonoA,
          fechaNac: fechaNac,
          direccion: direccion,
          id: id,
          idParent: idParent,
          tomador: tomador,
          idPol: idPol,
          menor:menor
        }
      });
    }


    return angularAPI;
  });